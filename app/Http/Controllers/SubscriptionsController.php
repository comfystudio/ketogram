<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use DB;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Coupon;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Refund;
use Stripe\Subscription as StripSubscription;
use Stripe\Coupon as StripCoupon;
use Mail;

class SubscriptionsController extends Controller
{
    /**
     * PAGE: Admin/Subscription/
     * GET: /admin/Subscription/
     * This method handles the index view of Subscription
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Subscription Index',
            'description' => 'Subscription index',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($_GET['status'])) {
            $subscriptions = Subscription::where('is_custom', '=', $_GET['status'])
                ->where('is_active', '=', '1')
                ->whereNotNull('strip_sub_id')
                ->orderBy('last_payment', 'DESC')
                ->paginate(20);
        }elseif(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $subscriptions = Subscription::whereHas('User', function ($q) {
                $q->where('name', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('address_1', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('address_2', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('town', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('county', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('postcode', 'like', '%' . $_GET['keywords'] . '%');
            })
                ->orWhereHas('Item', function ($query) {
                    $query->where('title', 'like', '%' . $_GET['keywords'] . '%');
                })
                ->orderBy('last_payment', 'DESC')
                ->paginate(20);
        }else{
            $subscriptions = Subscription::orderBy('last_payment', 'DESC')->paginate(20);
        }


        return view('subscriptions/admin/index', compact('subscriptions', 'meta'));
    }

    /**
     * PAGE: Admin/Subscription/Cancel
     * GET: /admin/Subscription/cancel
     * This method handles the cancellation view of Subscription
     * @param Subscription $Subscription
     * @return
     */
    public function admin_cancelShow(Subscription $subscriptions){
        $meta = array(
            'title' => 'Subscription Delete',
            'description' => 'Subscription Delete',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        return view('subscriptions/admin/cancel', compact('meta', 'subscriptions'));
    }

    /**
     * PAGE: Admin/Subscription/Cancel
     * POST: /admin/Subscription/cancel
     * This method handles the cancellation view of Subscription
     * @param Subscription $Subscription
     * @return
     */
    public function admin_cancel(Subscription $subscriptions){
        $subscription = Subscription::where('id', '=', $subscriptions->id)->with('Item')->with('User')->get();

        $data = array(
            'name' => $subscription[0]->User->name,
            'email' => $subscription[0]->User->email,
            'address_1' => $subscription[0]->address_1,
            'address_2' => $subscription[0]->address_2,
            'town' => $subscription[0]->town,
            'county' => $subscription[0]->county,
            'postcode' => $subscription[0]->postcode,
            'country' => $subscription[0]->country,
        );

        $email = $subscription[0]->User->email;
        Mail::queue('emails.sub-cus-cancelled', $data, function($message) use ($email){
            $message->subject("Subscription Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to($email);
        });

        Mail::queue('emails.sub-us-cancelled', $data, function($message) use ($email){
            $message->subject("Subscription Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to('hello@ketogram.co.uk');
        });

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $sub = StripSubscription::retrieve($subscription[0]->strip_sub_id);
        $sub->cancel();

        $subscriptions->update(array('is_active' => 0));

        return redirect('/admin/subscriptions/')->with('status', 'Subscription cancelled successfully.');
    }

    /**
     * PAGE: Admin/Subscription/edit
     * GET: /admin/Subscription/edit
     * This method handles the edit view of Subscription
     * @param Subscription $Subscription
     * @return
     */
    public function admin_editShow(Subscription $subscriptions){
        $meta = array(
            'title' => 'Subscription Edit',
            'description' => 'Subscription edit',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        $items = DB::table('items')->where(array('is_active' => 1, 'subscription' => 1))->pluck('title', 'id');
        return view('subscriptions/admin/create', compact('meta', 'subscriptions', 'items'));
    }

    /**
     * PAGE: Admin/Subscription/edit
     * POST: /admin/Subscription/edit
     * This method handles the editing of Subscription
     * @param Request $request Subscription $Subscription
     * @return
     */
    public function admin_edit(Request $request, Subscription $subscriptions){
        $this->validate($request, [
            'address_1' => 'required',
            'postcode' => 'required'
        ]);

        $subscriptions->update(array(
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'town' => $request->town,
                'county' => $request->county,
                'postcode' => $request->postcode,
                'is_custom' => $request->is_custom,
            )
        );

        $subscriptions->Item()->detach();
        if($request->has('items')) {
            $subscriptions->Item()->attach($request->items);
        }
        if($_POST['is_custom'] != 1 || !$request->has('items')){
            $subscriptions->Item()->detach();
        }
        return redirect('/admin/subscriptions/')->with('status', 'Subscription Edited successfully.');
    }


    /**
     * PAGE: Admin/subscriptions/ajax-get-items
     * POST: Admin/subscriptions/ajax-get-items
     * This method handles getting items for admin
     */
    public function ajaxGetItems(Request $request){
        if(!empty($_POST['current'])){
            $current = $_POST['current'];
            $items = DB::table('items')->where(array('is_active' => 1, 'subscription' => 1))->pluck('title', 'id');
            return view('subscriptions/admin/_ajax_items', compact('current', 'items'))->render();
        }
    }

    /**
     * PAGE: /Subscription/
     * GET: //Subscription/
     * This method handles the index view of Subscription
     * @param
     * @return
     */
    public function index(){
        $meta = array(
            'title' => 'Ketogram Subscription box',
            'description' => 'Ketogram Faqs, Keto, Ketosis, low carb, UK, Belfast, Subscription',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );


        return view('subscriptions/index', compact('meta'));
    }


    /**
     * PAGE: /Custom/
     * GET: /custom/
     * This method handles the custom subscription page.
     * @param
     * @return
     */
    public function custom(){
        $meta = array(
            'title' => 'ketogram Subscribe',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscribe',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $items = Item::where('subscription', '=',  '1')
                ->where('is_active', '=', '1')
                ->where(function($query){
                    $query->where('title', 'like', '%' . $_GET['keywords'] . '%');
                    $query->orWhere('text', 'like', '%' . $_GET['keywords'] . '%');
                })
                ->orderBy('title', 'ASC')
                ->paginate(9);
        }elseif(isset($_GET['category']) && !empty($_GET['category'])){
            $items = Item::where('subscription', '=',  '1')
                ->where('is_active', '=', '1')
                ->whereHas('FoodCategory', function($query){
                    $query->where('name', '=', $_GET['category']);
                })
                ->orderBy('title', 'ASC')
                ->paginate(9);
        }else{
            $items = Item::where(array('is_active' => '1', 'subscription' => '1'))->orderBy('title', 'ASC')->paginate(9);
        }

        $items->appends(request()->query())->links();


        //checking cookie to see if we have stored custom items
        if(isset($_COOKIE['custom']) && !empty($_COOKIE['custom'])){
            $cookie = json_decode($_COOKIE['custom'], true);
            $cookieArray = array();
            foreach ($cookie as $key => $cook) {
                $cookieArray[] = $key;
            }
            $itemsCustom = Item::whereIn('id', $cookieArray)->where(array('is_active' => '1', 'subscription' => '1'))->get();
            $totalPrice = 0;
            foreach ($itemsCustom as $key => $item) {
                if (isset($cookie[$item->id]) && !empty($cookie[$item->id])) {

                    $itemsCustom[$key]->stock = $itemsCustom[$key]->stock - $cookie[$item->id];
                    $itemsCustom[$key]->quantity = $cookie[$item->id];

                    if (isset($itemsCustom[$key]->itemSales[0]) && !empty($itemsCustom[$key]->itemSales[0])) {
                        $totalPrice += ($cookie[$item->id] * $itemsCustom[$key]->itemSales[0]->price);
                    } else {
                        $totalPrice += ($cookie[$item->id] * $itemsCustom[$key]->price);
                    }
                }
            }

            $itemsCustom->totalPrice = $totalPrice;
        }


        $categories = DB::table('food_categories')->where('is_active', 1)->pluck('name', 'id');


        return view('subscriptions/custom', compact('meta', 'items', 'categories', 'cookie', 'itemsCustom'));
    }

    /**
     * PAGE: /Subscriptions/remove-custom-items/{item}
     * GET: /Subscriptions/remove-custom-items/{item}
     * This method removes items from cookie and returns results.
     * @param Item $items
     * @return
     */
    public function ajax_remove_custom_items(Item $item){
        if(isset($item->id) && !empty($item->id)){
            $items = json_decode($_COOKIE['custom'], true);
            unset($items[$item->id]);
            setcookie('custom', json_encode($items), time()+600000, '/');
            $data = $this->buildCustomData($items);
            return response()->json(json_encode($data));
        }else{
            return redirect()->back()->withErrors(['Item does not exist']);
        }
    }

    public function buildCustomData($items){
        //potato move but I need to create an array of the keys to pass into the below database call.
        $tempItems = array();
        foreach($items as $key => $temp){
            $tempItems[] = $key;
        }

        $data = Item::with('itemImages')->with('itemSales')->where(array('items.is_active' => 1, 'items.subscription' => 1))
            ->whereIn('items.id', $tempItems)
            ->get();

        //we need to append a quantity to our fields
        $totalCount = 0;
        $totalPrice = 0;
        foreach($data as $key => $dat){
            if(array_key_exists($dat->id, $items)){
                $totalCount += $items[$dat->id];

                if(isset($data[$key]->itemSales[0]) && !empty($data[$key]->itemSales[0])) {
                    $totalPrice += ($items[$dat->id] * $data[$key]->itemSales[0]->price);
                }else{
                    $totalPrice += ($items[$dat->id] * $data[$key]->price);
                }

                $data[$key]->quantity = $items[$dat->id];
            }
        }
        $data['totalCount'] = $totalCount;
        $data['totalPrice'] = $totalPrice;
        return $data;
    }


    /**
     * PAGE: checkout
     * GET: /checkout
     * This method handles the checkout process
     * @param
     * @return
     */
    public function checkout($custom = false)
    {
        //redirect if user is not logged in yet
        if ($custom) {
            if (!Auth::check()) {
                return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/subscribe-checkout/custom'));
            }
        } else {
            if (!Auth::check()) {
                return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/subscribe-checkout'));
            }
        }

        $meta = array(
            'title' => 'ketogram Subscribe',
            'description' => 'Ketogram Shop, low carb, keto, ketosis, Subscribe',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if ($custom){
            if (isset($_COOKIE['custom']) && !empty($_COOKIE['custom'])) {
                $cookie = json_decode($_COOKIE['custom'], true);
                $items = $this->buildCustomData($cookie);
            } else {
                return redirect('/subscriptions')->withErrors(['No items in custom subscribe to checkout.']);
            }
        }


        return view('subscriptions/checkout', compact('meta', 'items', 'custom'));

    }

    /**
     * PAGE: Payment
     * Post: /payment
     * This method validates the checkout data, and then redirects user to stripe form.
     * @param
     * @return
     */
    public function payment(Request $request){
        if($request->custom){
            if(!Auth::check()) {
                return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/subscribe-checkout/custom'));
            }
        }else{
            if(!Auth::check()){
                return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/subscribe-checkout'));
            }
        }

        $meta = array(
            'title' => 'ketogram Subscribe',
            'description' => 'Ketogram Shop, low carb, keto, ketosis, Subscribe',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        $this->validate($request, [
            'address_1' => 'required',
            'address_2' => 'required',
            'town' => 'required',
            'county' => 'required',
            'postcode' => 'required',
            'country' => 'required',
        ]);

        $request->merge(array(
            'user_id' => Auth::id(),
        ));

        $request->first_price = 30;

        if($request->custom){
            if(isset($_COOKIE['custom']) && !empty($_COOKIE['custom'])) {
                $cookie = json_decode($_COOKIE['custom'], true);
                $items = $this->buildCustomData($cookie);
            }else{
                return redirect('/subscriptions')->withErrors(['No items in custom subscribe to checkout.']);
            }
        }

        //Now need to see if we have coupon and apply the discount.
        $user = User::where('id', '=', Auth::id())->get();
        if(isset($request->coupon) && !empty($request->coupon)) {
            $coupon = Coupon::where('coupons.code', '=', $request->coupon)
                ->where('coupons.count', '>=', 1)
                ->where('valid_from', '<', Carbon::now())
                ->where('valid_to', '>', Carbon::now())
                ->get();

            //check if we have user_id or user_email we need ensure the right user is trying to use it.
            if (!empty($coupon[0]->user_id) || !empty($coupon[0]->user_email)) {
                if ($user[0]->id != $coupon[0]->user_id && $user[0]->email != $coupon[0]->user_email) {
                    return redirect()->back()->withErrors(['Coupon has been tempered with.']);
                }
            }

            $request->merge(array('coupon_id' => $coupon[0]->id));
            $request->merge(array('first_price' => ((100 - $coupon[0]->percentage) / 100) * 30));
        }


        if($request->custom) {
            if ($items['totalPrice'] > 25) {
                return redirect()->back()->withErrors(['Total does not match internal number...stop messing about']);
            }
            $request->merge(array('is_custom' => 1));
        }else{
            $request->merge(array('is_custom' => 0));
        }
        $request->merge(array('is_active' => 0));

        $subscription = Subscription::create($request->except(array('coupon', 'custom')));

        if($request->custom) {
            //we need to populate our orders_items table
            $tempItems = array();
            foreach ($cookie as $key => $cook) {
                for ($i = 1; $i <= $cook; $i++) {
                    $tempItems[] = $key;
                }
            }
            $subscription->Item()->detach();
            $subscription->Item()->attach($tempItems);
        }

        return view('subscriptions/payment', compact('meta', 'user', 'subscription'));


    }


    /**
     * PAGE: Payment-Create
     * Post: /payment-create
     * This method will finalise the payment and create stripe customer and charge.
     * @param
     * @return
     */
    public function payment_create(Request $request){
        if(!$request){
            return redirect()->back()->withErrors(['Error with request please contact site admin']);
        }

        $subscription = Subscription::where('id', '=', $request->subscription_id)->with('Coupon')->with('Item')->with('User')->get();

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source'  => $request->stripeToken
            ));


            if($subscription[0]->coupon_id){
                $coupon = StripCoupon::create(array(
                    "id" => $subscription[0]->Coupon->id.'-'.date("YmdHi"),
                    "duration" => "forever",
                    "percent_off" => $subscription[0]->Coupon->percentage,
                ));

                $sub = StripSubscription::create(array(
                    "customer" => $customer->id,
                    "items" => array(
                        array(
                            "plan" => "standard",
                        ),
                    ),
                    "coupon" =>$subscription[0]->Coupon->id.'-'.date("YmdHi"),
                ));

            }else{
                $sub = StripSubscription::create(array(
                    "customer" => $customer->id,
                    "items" => array(
                        array(
                            "plan" => "standard",
                        ),
                    ),
                ));
            }

            // Need to add strip_cus_id to order field
            Subscription::where('id', '=', $request->subscription_id)->update(array(
                    'strip_cus_id' => $customer->id, 'strip_sub_id' => $sub->id, 'last_payment' => date("Y-m-d", $sub->current_period_start), 'active_until' => date("Y-m-d", $sub->current_period_end),
                    'is_active' => 1
                )
            );

            // Need to email us that order has been made
            $data = array(
                'name' => $subscription[0]->User->name,
                'email' => $subscription[0]->User->email,
                'address_1' => $subscription[0]->address_1,
                'address_2' => $subscription[0]->address_2,
                'town' => $subscription[0]->town,
                'county' => $subscription[0]->county,
                'postcode' => $subscription[0]->postcode,
                'country' => $subscription[0]->country,
            );

            $email = $subscription[0]->User->email;
            Mail::queue('emails.subscribe-cus', $data, function($message) use ($email){
                $message->subject("Subscription Confirmation");
                $message->from('hello@ketogram.co.uk');
                $message->to($email);
            });

            Mail::queue('emails.subscribe-us', $data, function($message) {
                $message->subject("Someone has subscribed!");
                $message->from('hello@ketogram.co.uk');
                $message->to('hello@ketogram.co.uk');
            });


            // Need to clear custom from cookies.
            setcookie('custom', '', time() - 3600, '/');

            // Update coupon if used.
            if(isset($subscription[0]->coupon_id) && !empty($subscription[0]->coupon_id)){
                Coupon::where('id', '=', $subscription[0]->coupon_id)->decrement('count', 1);
                Coupon::where('id', '=', $subscription[0]->coupon_id)->increment('number_used', 1);

                //Need to work out if coupon has referrer and if they have reached 10 in their total we email us and them to get a thankyou box thing.
                if(isset($subscription[0]->Coupon->referrer_id) && !empty($subscription[0]->Coupon->referrer_id)){
                    $referrerUser = User::where('id', '=', $subscription[0]->Coupon->referrer_id)->first();
                    $subscriptionCount = 0;
                    foreach($referrerUser->Referrer as $referrer){
                        $subscriptionCount +=  $referrer->number_used;
                    }
                    //if total count is a modulus of 10 then send emails.
                    if(($subscriptionCount % 10) == 0){
                        $data = array(
                            'name' => $referrerUser->name,
                            'email' => $referrerUser->email,
                            'count' => $subscriptionCount,
                            'user_id' => $referrerUser->id
                        );
                        $email = $referrerUser->email;
                        Mail::queue('emails.affiliate-cus', $data, function($message) use ($email){
                            $message->subject("Thank you from Ketogram");
                            $message->from('hello@ketogram.co.uk');
                            $message->to($email);
                        });

                        Mail::queue('emails.affiliate-us', $data, function($message) {
                            $message->subject("Affiliate user need a gift");
                            $message->from('hello@ketogram.co.uk');
                            $message->to('hello@ketogram.co.uk');
                        });
                    }
                }
            }

            return redirect('/subscriptions/'.Auth::id())->with('status', 'Payment Accepted! We will post your subscription ASAP. Thank you :)');
        } catch (\Exception $ex){
            return $ex->getMessage();
        }
    }


    /**
     * PAGE: Subscriptions/{User}
     * GET: /subscriptions/{user}
     * This method handles the index of subscriptions on the frontend
     * @param User
     * @return
     */
    public function subscriptions(User $user){
        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        //if logged in user is not the same as page ID bounce them out
        if($user->id != Auth::id()){
            return redirect()->back()->withErrors(['Current user does not match user subscriptions']);
        }

        //We need to get subscriptions based on their current statuses.
        $subscriptions = Subscription::where('user_id', '=', $user->id)->with('Item.ItemImages')->where('is_active', '=', 1)->orderBy('created_at', 'DESC')->get();
        $cancelledsubscriptions = Subscription::where('user_id', '=', $user->id)->where('is_active', '=', 0)->orderBy('created_at', 'DESC')->get();

        $user['subscription_count'] = 0;
        foreach($user->Referrer as $referrer){
            $user['subscription_count'] +=  $referrer->number_used;
        }

        return view('subscriptions/manage', compact('meta', 'subscriptions', 'cancelledsubscriptions', 'user'));
    }


    /**
     * PAGE: Subscriptions/renew/{$subscription}
     * GET: /subscriptions/renew/{$subscription}
     * This method handles
     * @param Subscription
     * @return
     */
    public function renew(Subscription $subscription, Request $request){
        if($subscription->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($request->renew) && !empty($request->renew)){


//            if(Hash::check($request->password, Auth::User()->password)){
//                $user->update(array('password' => Hash::make($request->new_password)));
//                return redirect()->back()->with('status', 'Password successfully updated.');
//
//            }else{
//                return redirect()->back()->withErrors(['Old Password is not correct']);
//            }
        }

        return view('subscriptions/renew', compact('meta', 'subscription'));
    }

    /**
     * PAGE: Subscriptions/cancel/{$subscriptions}
     * GET: /subscriptions/cancel/{$subscriptions}
     * This method handles user cancelling their subscription
     * @param Subscription
     * @return
     */
    public function cancel(Subscription $subscriptions, Request $request){
        if($subscriptions->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($request->action) && !empty($request->action)){
            $subscription = Subscription::where('id', '=', $subscriptions->id)->with('Item')->with('User')->get();

            $data = array(
                'name' => $subscription[0]->User->name,
                'email' => $subscription[0]->User->email,
                'address_1' => $subscription[0]->address_1,
                'address_2' => $subscription[0]->address_2,
                'town' => $subscription[0]->town,
                'county' => $subscription[0]->county,
                'postcode' => $subscription[0]->postcode,
                'country' => $subscription[0]->country,
            );

            $email = $subscription[0]->User->email;
            Mail::queue('emails.sub-cus-cancelled', $data, function($message) use ($email){
                $message->subject("Subscription Cancelled");
                $message->from('hello@ketogram.co.uk');
                $message->to($email);
            });

            Mail::queue('emails.sub-us-cancelled', $data, function($message) use ($email){
                $message->subject("Subscription Cancelled");
                $message->from('hello@ketogram.co.uk');
                $message->to('hello@ketogram.co.uk');
            });

            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $sub = StripSubscription::retrieve($subscription[0]->strip_sub_id);
            $sub->cancel();

            $subscriptions->update(array('is_active' => 0));

            return redirect('/subscriptions/'.Auth::id())->with('status', 'Subscription cancelled successfully.');

        }

        return view('subscriptions/cancel', compact('meta', 'subscriptions'));
    }

    /**
     * PAGE: Subscriptions/cancel/{$subscriptions}
     * GET: /subscriptions/cancel/{$subscriptions}
     * This method handles user cancelling their subscription
     * @param Subscription
     * @return
     */
    public function standard(Subscription $subscriptions, Request $request){
        if($subscriptions->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($request->action) && !empty($request->action)){
            $subscriptions->update(array('is_custom' => 0));
            return redirect('/subscriptions/'.Auth::id())->with('status', 'Subscription has been set to standard mode.');
        }

        return view('subscriptions/standard', compact('meta', 'subscriptions'));
    }


    /**
     * PAGE: Subscriptions/address/{$subscriptions}
     * GET: /subscriptions/address/{$subscriptions}
     * This method handles user updating their address for subscription
     * @param Subscription
     * @return
     */
    public function address(Subscription $subscriptions, Request $request){
        if($subscriptions->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($request->action) && !empty($request->action)){
            $this->validate($request, [
                'address_1' => 'required',
                'postcode' => 'required'
            ]);

            $subscriptions->update(array(
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'town' => $request->town,
                    'county' => $request->county,
                    'postcode' => $request->postcode,
                )
            );
            return redirect('/subscriptions/'.Auth::id())->with('status', 'Subscription delivery address has been updated.');
        }

        return view('subscriptions/address', compact('meta', 'subscriptions'));
    }


    /**
     * PAGE: Subscriptions/custom/{$subscriptions}
     * GET: /subscriptions/custom/{$subscriptions}
     * This method handles user switching from standard to custom subscription
     * @param Subscription
     * @return
     */
    public function custom_switch(Subscription $subscriptions, Request $request){
        if($subscriptions->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        if(isset($request->action) && !empty($request->action)){
            $subscriptions->update(array('is_custom' => 1));
            return redirect('/subscriptions/edit/'.$subscriptions->id);
        }

        return view('subscriptions/custom_switch', compact('meta', 'subscriptions'));
    }

    /**
     * PAGE: Subscriptions/edit/{$subscriptions}
     * GET: /subscriptions/edit/{$subscriptions}
     * This method handles user editing their custom Subscription
     * @param Subscription
     * @return
     */
    public function edit(Subscription $subscriptions, Request $request){
        if($subscriptions->user_id != Auth::id()){
            return redirect('/')->withErrors(['User does not match subscription']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        $items = Item::where(array('is_active' => '1', 'subscription' => '1'))->with('ItemImages')->get();

        foreach($subscriptions->Item as $item){
            $subscriptions['totalPrice'] += $item['price'];
        }

        if(isset($request->action) && !empty($request->action)){
            //need to work out total price again so we are not getting ripped off.
            $totalPrice = 0;
            $itemsPrice = Item::where(array('is_active' => '1', 'subscription' => '1'))->pluck('price', 'id')->toArray();

            foreach($request->all()['items'] as $item_id){
                if(!empty($item_id) && $item_id != 0){
                    $totalPrice += $itemsPrice[$item_id];
                }
            }

            //if over 25 we bounce them back with an error
            if($totalPrice > 25){
                return redirect()->back()->withErrors(['Box Capacity has been exceeded. Please remove items']);
            }

            $subscriptions->Item()->detach();
            if($request->has('items')) {
                $temp = array();
                foreach($request->items as $item){
                    if(!empty($item) && $item != null){
                        $temp[] = $item;
                    }
                }
                $subscriptions->Item()->attach($temp);
            }


            return redirect('/subscriptions/'.Auth::id())->with('status', 'Subscription has been updated.');
        }

        return view('subscriptions/edit', compact('meta', 'items', 'subscriptions'));
    }

    /**
     * PAGE: Subscriptions/stripe
     * GET: /subscriptions/stripe
     * This method handles a failed subscription payment recieved from stripe api
     * @return
     */
    public function check_cancel(){
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $input = @file_get_contents("php://input");
        $event_json = json_decode($input);

        if(isset($event_json->type) && $event_json->type == 'customer.subscription.deleted'){
            //trying to find payment with stripe customer id.
            $subscription = Subscription::where('id', '=', $event_json->id)->with('User')->with('Item')->get();

            if($subscription && !empty($subscription)){
                $data = array(
                    'name' => $subscription[0]->User->name,
                    'email' => $subscription[0]->User->email,
                    'address_1' => $subscription[0]->address_1,
                    'address_2' => $subscription[0]->address_2,
                    'town' => $subscription[0]->town,
                    'county' => $subscription[0]->county,
                    'postcode' => $subscription[0]->postcode,
                    'country' => $subscription[0]->country,
                );

                $email = $subscription[0]->User->email;
                Mail::queue('emails.sub-cus-cancelled', $data, function($message) use ($email){
                    $message->subject("Subscription Cancelled Due To Payment Failure");
                    $message->from('hello@ketogram.co.uk');
                    $message->to($email);
                });

                Mail::queue('emails.sub-us-cancelled', $data, function($message) use ($email){
                    $message->subject("Subscription Cancelled Due To Payment Failure");
                    $message->from('hello@ketogram.co.uk');
                    $message->to('hello@ketogram.co.uk');
                });

                $subscription->update(array('is_active' => 0));
            }
        }
        http_response_code(200);
        exit;
    }


}
