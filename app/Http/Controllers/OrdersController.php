<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Item;
use App\Coupon;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Refund;
use Mail;

class OrdersController extends Controller
{
    /**
     * PAGE: Admin/Order/
     * GET: /admin/Order/
     * This method handles the index view of Order
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Order Index',
            'description' => 'Order index',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        if(isset($_GET['status'])) {
            $orders = Order::where('status', '=', $_GET['status'])
                ->whereNotNull('strip_cus_id')
                ->orderBy('status', 'ASC')
                ->paginate(20);
        }elseif(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $orders = Order::whereHas('User', function ($q) {
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
            ->orderBy('status', 'ASC')
            ->paginate(20);
        }else{
            $orders = Order::orderBy('status', 'ASC')->whereNotNull('strip_cus_id')->paginate(20);
        }



        return view('orders/admin/index', compact('orders', 'meta'));
    }

    /**
     * PAGE: Admin/Order/Dispatch
     * GET: /admin/Order/dispatch
     * This method handles sets the status of an order to 1
     * @param Order $orders
     * @return
     */
    public function admin_dispatch(Order $orders, Request $request){
        $orderObj = Order::where('id', '=', $orders->id)->with('Item')->with('User')->get();

        $meta = array(
            'title' => 'Order Dispatch',
            'description' => 'Order Dispatch',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        if(isset($request->save) && !empty($request->save)) {
            $this->validate($request, [
                'po_ref' => array('required')
            ]);

            $orders->update(array(
                    'po_ref' => $request->po_ref
                )
            );

            $data = array(
                'name' => $orderObj[0]->User->name,
                'email' => $orderObj[0]->User->email,
                'address_1' => $orderObj[0]->address_1,
                'address_2' => $orderObj[0]->address_2,
                'town' => $orderObj[0]->town,
                'county' => $orderObj[0]->county,
                'postcode' => $orderObj[0]->postcode,
                'country' => $orderObj[0]->country,
                'total' => $orderObj[0]->total,
                'postage' => $orderObj[0]->postage,
                'po_ref' => $request->po_ref
            );

            // Need to email customer with Order information.
            $tempArray = array();
            foreach ($orderObj[0]->Item as $key => $item) {
                if (isset($item->ItemImages[0]) && !empty($item->ItemImages[0])) {
                    $image = (array)$item->ItemImages[0]['original'];
                } else {
                    $image = array('image' => '/images/no-image.png', 'title' => 'No Image');
                }

                if (!isset($tempArray[$item->id])) {
                    $tempArray[$item->id] = (array)$item['original'];
                    $tempArray[$item->id]['image'] = $image;
                    $tempArray[$item->id]['quantity'] = 1;
                } else {
                    $tempArray[$item->id]['quantity']++;
                }
            }
            $email = $orderObj[0]->User->email;
            $data['items'] = $tempArray;
                Mail::queue('emails.order-cus-dispatched', $data, function($message) use ($email){
                    $message->subject("Order Dispatched");
                    $message->from('hello@ketogram.co.uk');
                    $message->to($email);
                });

                Mail::queue('emails.order-us-dispatched', $data, function($message) use ($email){
                    $message->subject("Order Dispatched");
                    $message->from('hello@ketogram.co.uk');
                    $message->to('hello@ketogram.co.uk');
                });

            $orders->update(array('status' => 1));

            return redirect('/admin/orders/')->with('status', 'Order status updated successfully.');
        }
        return view('orders/admin/dispatch', compact('orders', 'meta'));
    }

    /**
     * PAGE: Admin/Order/Cancel
     * GET: /admin/Order/cancel
     * This method handles the cancellation view of Order
     * @param Order $Order
     * @return
     */
    public function admin_cancelShow(Order $orders){
        $meta = array(
            'title' => 'Order Delete',
            'description' => 'Order Delete',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        return view('orders/admin/cancel', compact('meta', 'orders'));
    }

    /**
     * PAGE: Admin/Order/Cancel
     * POST: /admin/Order/cancel
     * This method handles the cancellation view of Order
     * @param Order $Order
     * @return
     */
    public function admin_cancel(Order $orders){
        $order = Order::where('id', '=', $orders->id)->with('Item')->with('User')->get();

        $data = array(
            'name' => $order[0]->User->name,
            'email' => $order[0]->User->email,
            'address_1' => $order[0]->address_1,
            'address_2' => $order[0]->address_2,
            'town' => $order[0]->town,
            'county' => $order[0]->county,
            'postcode' => $order[0]->postcode,
            'country' => $order[0]->country,
            'total' => $order[0]->total,
            'postage' => $order[0]->postage
        );

        // Need to email customer with Order information.
        $tempArray = array();
        foreach($order[0]->Item as $key => $item){
            if(isset($item->ItemImages[0]) && !empty($item->ItemImages[0])){
                $image = (array) $item->ItemImages[0]['original'];
            }else{
                $image = array('image' => '/images/no-image.png', 'title' => 'No Image');
            }

            if(!isset($tempArray[$item->id])){
                $tempArray[$item->id] = (array) $item['original'];
                $tempArray[$item->id]['image'] = $image;
                $tempArray[$item->id]['quantity']=1;
            }else{
                $tempArray[$item->id]['quantity']++;
            }
        }
        $email = $order[0]->User->email;
        $data['items'] = $tempArray;
        Mail::queue('emails.order-cus-cancelled', $data, function($message) use ($email){
            $message->subject("Order Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to($email);
        });

        Mail::queue('emails.order-us-cancelled', $data, function($message) use ($email){
            $message->subject("Order Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to('hello@ketogram.co.uk');
        });

        // Need update stock numbers.
        foreach($tempArray as $key => $item){
            Item::where('id', '=', $item['id'])->increment('stock', $item['quantity']);
        }

        //update status of order
        $orders->update(array('status' => 2));

        //need to refund stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $refund = Refund::create(array(
            "charge" => $order[0]->strip_charge_id
        ));

        return redirect('/admin/orders/')->with('status', 'Order cancelled successfully.');
    }

    /**
     * PAGE: Admin/Order/edit
     * GET: /admin/Order/edit
     * This method handles the edit view of Order
     * @param Order $Order
     * @return
     */
    public function admin_editShow(Order $orders){
        $meta = array(
            'title' => 'Order Edit',
            'description' => 'Order edit',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        $categories = DB::table('food_categories')->where('is_active', 1)->pluck('name', 'id');
        return view('orders/admin/create', compact('meta', 'orders', 'categories'));
    }

    /**
     * PAGE: Admin/Order/edit
     * POST: /admin/Order/edit
     * This method handles the editing of Order
     * @param Request $request Order $Order
     * @return
     */
    public function admin_edit(Request $request, Order $orders){
        $this->validate($request, [
            'title' => array('required','unique:orders,title,'.$orders->id, 'max:255'),
            'category_id' => 'Integer',
            'text' => 'required',
            'price' => array('required', 'Integer'),
            'subscription' => 'Integer',
            'is_active' => 'Integer'
        ]);

        $orders->update(array(
                'title' => $request->title,
                'text' => $request->text,
                'price' => $request->price,
                'protein' => $request->protein,
                'carbs' => $request->carbs,
                'fat' => $request->fat,
                'fibre' => $request->fibre,
                'cals' => $request->cals,
                'serving' => $request->serving,
                'subscription' => $request->subscription,
                'is_active' => $request->is_active
            )
        );

        if($request->has('categories')) {
            $orders->FoodCategory()->sync($request->categories);
        }
        return redirect('/admin/orders/')->with('status', 'Order Edited successfully.');
    }

    /**
     * PAGE: Shop
     * GET: /shop
     * This method handles the view of the Shop
     * @param
     * @return
     */
    public function shop(){
        $meta = array(
            'title' => 'ketogram Shop',
            'description' => 'Ketogram Shop, low carb, keto, ketosis ',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        if(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $items = Item::where('is_order', '=',  '1')
                ->where('is_active', '=', '1')
                ->where('is_featured', '=', '0')
                ->where('is_order', '=', '0')
                ->where(function($query){
                    $query->where('title', 'like', '%' . $_GET['keywords'] . '%');
                    $query->orWhere('text', 'like', '%' . $_GET['keywords'] . '%');
                })
                ->orderBy('sort', 'ASC')
                ->paginate(9);
        }elseif(isset($_GET['category']) && !empty($_GET['category'])){
            $items = Item::where('is_order', '=',  '1')
                ->where('is_active', '=', '1')
                ->where('is_featured', '=', '0')
                ->where('is_order', '=', '0')
                ->whereHas('FoodCategory', function($query){
                    $query->where('name', '=', $_GET['category']);
                })
                ->orderBy('sort', 'ASC')
                ->paginate(9);
        }else{
            $items = Item::where(array('is_active' => '1', 'is_order' => '1', 'is_featured' => '0'))->orderBy('sort', 'ASC')->paginate(9);
        }

        $featuredItems = Item::where(array('is_active' => '1', 'is_order' => '1', 'is_featured' => '1'))->orderBy('sort', 'ASC')->get();

        $items->appends(request()->query())->links();

        //setting our stock level based on db minus the cart value
        if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
            $cookie = json_decode($_COOKIE['cart'], true);
            //doing the same for relatedItems now
            foreach($items as $key => $item){
                if(isset($cookie[$item->id]) && !empty($cookie[$item->id])) {
                    $items[$key]->stock = $items[$key]->stock - $cookie[$item->id];
                }
            }
        }

        $categories = DB::table('food_categories')->where('is_active', 1)->pluck('name', 'id');
        return view('orders/shop', compact('items', 'meta', 'categories', 'featuredItems'));
    }

    /**
     * PAGE: checkout
     * GET: /checkout
     * This method handles the checkout process
     * @param
     * @return
     */
    public function checkout(){
        //redirect if user is not logged in yet
        if(!Auth::check()){
            return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/checkout'));
        }

        $meta = array(
            'title' => 'ketogram Shop',
            'description' => 'Ketogram Shop, low carb, keto, ketosis',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        $previousOrderAddress = Order::where(array('user_id' => Auth::id()))->orderBy('created_at', 'DESC')->limit(1)->get();

        if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
            $cookie = json_decode($_COOKIE['cart'], true);
            $cookieArray = array();
            foreach ($cookie as $key => $cook) {
                $cookieArray[] = $key;
            }
            $items = Item::whereIn('id', $cookieArray)->where(array('is_active' => '1', 'is_order' => '1'))->get();

            $totalCount = 0;
            $totalPrice = 0;
            $totalWeight = 0;
            $is_gift = 0;
            foreach ($items as $key => $item) {
                if(isset($item->is_gift) && $item->is_gift >= 1){
                    $is_gift = 1;
                }

                if (isset($cookie[$item->id]) && !empty($cookie[$item->id])) {
                    $totalCount += $cookie[$item->id];
                    $totalWeight += $cookie[$item->id] * $items[$key]->weight;
                    $items[$key]->stock = $items[$key]->stock - $cookie[$item->id];
                    $items[$key]->quantity = $cookie[$item->id];

                    if (isset($items[$key]->itemSales[0]) && !empty($items[$key]->itemSales[0])) {
                        $totalPrice += ($cookie[$item->id] * $items[$key]->itemSales[0]->price);
                    } else {
                        $totalPrice += ($cookie[$item->id] * $items[$key]->price);
                    }
                }
            }
            $items->totalCount = $totalCount;
            $items->totalPrice = $totalPrice;
            $items->totalWeight = $totalWeight;
            $items->postage = 0;
            $items->gift = $is_gift;

            //working out postage based on weight and UK based country.
            $items->postage = $this->getPostage($totalWeight, $items->postage, 'United Kingdom');

        }else{
            return redirect('/shop')->withErrors(['No items in cart to checkout.']);
        }
        return view('orders/checkout', compact('meta', 'previousOrderAddress', 'items'));
    }

    /**
     * PAGE: Payment
     * Post: /payment
     * This method validates the checkout data, and then redirects user to stripe form.
     * @param
     * @return
     */
    public function payment(Request $request){
        //redirect if user is not logged in yet
        if(!Auth::check()){
            return redirect('/login')->with(array('status' => 'Please login to complete checkout.', 'back' => '/checkout'));
        }

        $meta = array(
            'title' => 'ketogram Shop',
            'description' => 'Ketogram Shop, low carb, keto, ketosis',
            'section' => 'Order',
            'subSection' => 'Order'
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

        //we need to validate our cart and pricing to make sure no funny business has been going on.
        if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
            $cookie = json_decode($_COOKIE['cart'], true);
            $cookieArray = array();
            foreach ($cookie as $key => $cook) {
                $cookieArray[] = $key;
            }
            $items = Item::whereIn('id', $cookieArray)->where(array('is_active' => '1', 'is_order' => '1'))->get();

            $totalCount = 0;
            $totalPrice = 0;
            $totalWeight = 0;
            foreach ($items as $key => $item) {
                if (isset($cookie[$item->id]) && !empty($cookie[$item->id])) {
                    $totalCount += $cookie[$item->id];
                    $totalWeight += $cookie[$item->id] * $items[$key]->weight;
                    $items[$key]->stock = $items[$key]->stock - $cookie[$item->id];
                    $items[$key]->quantity = $cookie[$item->id];

                    if (isset($items[$key]->itemSales[0]) && !empty($items[$key]->itemSales[0])) {
                        $totalPrice += ($cookie[$item->id] * $items[$key]->itemSales[0]->price);
                    } else {
                        $totalPrice += ($cookie[$item->id] * $items[$key]->price);
                    }
                }
            }
            $items->totalCount = $totalCount;
            $items->totalPrice = $totalPrice;
            $items->totalWeight = $totalWeight;
            $items->postage = 0;

            //working out postage based on weight and UK based country.
            $items->postage = $this->getPostage($totalWeight, $items->postage, $request->country);

            //Now need to see if we have coupon and apply the discount.
            $user = User::where('id', '=', Auth::id())->get();
            if(isset($request->coupon) && !empty($request->coupon)){
                $coupon = Coupon::where('coupons.code', '=', $request->coupon)
                    ->where('coupons.count', '>=', 1)
                    ->where('valid_from', '<',  Carbon::now())
                    ->where('valid_to', '>',  Carbon::now())
                    ->get();

                //check if we have user_id or user_email we need ensure the right user is trying to use it.
                if(!empty($coupon[0]->user_id) || !empty($coupon[0]->user_email)){
                    if($user[0]->id != $coupon[0]->user_id && $user[0]->email != $coupon[0]->user_email){
                        return redirect()->back()->withErrors(['Coupon has been tempered with.']);
                    }
                }

                $totalPrice = $totalPrice * ((100 - $coupon[0]->percentage) / 100);
                $request->merge(array('coupon_id' => $coupon[0]->id));
            }

            $totalPrice = $totalPrice + $items->postage;

            //now we can do the final comparison to insure we have proper price.
            if($totalPrice != $request->total){
                return redirect()->back()->withErrors(['Total does not match internal number...stop messing about']);
            }

            //we need to create a holder Order in our database.
            $request->merge(array('postage' => $items->postage));

            $order = Order::create($request->except(array('coupon')));

            //we need to populate our orders_items table
            $tempItems = array();
            foreach($cookie as $key => $cook){
                for($i = 1; $i<=$cook; $i++){
                    $tempItems[] = $key;
                }
            }
            $order->Item()->detach();
            $order->Item()->attach($tempItems);

            return view('orders/payment', compact('meta', 'totalPrice', 'user', 'order'));

        }else{
            return redirect('/shop')->withErrors(['No items in cart to checkout.']);
        }
    }

    public function getPostage($totalWeight, $postage, $country){
        //if United Kingdom
        if($country == 'United Kingdom') {
            for ($i = 1; $i <= 99; $i++) {
                switch ($totalWeight) {
                    case $totalWeight < 2000:
                        $postage += 3.90;
                        $totalWeight -= 2000;
                        break;
                    case $totalWeight < 5000:
                        $postage += 14.75;
                        $totalWeight -= 5000;
                        break;
                    case $totalWeight < 10000:
                        $postage += 21.25;
                        $totalWeight -= 10000;
                        break;
                    case $totalWeight < 20000:
                        $postage += 29.55;
                        $totalWeight -= 20000;
                        break;
                    default:
                        $postage += 29.55;
                        $totalWeight -= 20000;
                }
                if ($totalWeight <= 0) {
                    break;
                }
            }
        //if not UK use different method
        }else{
            for ($i = 0; $i < 99; $i++) {
                if($totalWeight <= 2000) {
                    $postage += ceil((($totalWeight / 250) * 1.75) + 10);
                    $totalWeight -= 2000;
                }else{
                    $postage += ceil(((2000 / 250) * 1.75) + 10);
                    $totalWeight -= 2000;
                }
                if($totalWeight <= 0){
                    break;
                }
            }
        }
        return $postage;
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

        $order = Order::where('id', '=', $request->order_id)->with('Item')->with('User')->get();
//        $order = Order::where('id', '=', 20)->with('Item.ItemImages')->with('User')->get();

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source'  => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount'   => ($order[0]->total * 100),
                'currency' => 'gbp'
            ));

            // Need to add strip_cus_id to order field
            Order::where('id', '=', $request->order_id)->update(array('strip_cus_id' => $customer->id, 'strip_charge_id' => $charge->id));



            // Need to email us that order has been made
            $data = array(
                'name' => $order[0]->User->name,
                'email' => $order[0]->User->email,
                'address_1' => $order[0]->address_1,
                'address_2' => $order[0]->address_2,
                'town' => $order[0]->town,
                'county' => $order[0]->county,
                'postcode' => $order[0]->postcode,
                'country' => $order[0]->country,
                'total' => $order[0]->total,
                'postage' => $order[0]->postage
            );


            // Need to email customer with Order information.
            $tempArray = array();
            foreach($order[0]->Item as $key => $item){
                if(isset($item->ItemImages[0]) && !empty($item->ItemImages[0])){
                    $image = (array) $item->ItemImages[0]['original'];
                }else{
                    $image = array('image' => '/images/no-image.png', 'title' => 'No Image');
                }

                if(!isset($tempArray[$item->id])){
                    $tempArray[$item->id] = (array) $item['original'];
                    $tempArray[$item->id]['image'] = $image;
                    $tempArray[$item->id]['quantity']=1;
                }else{
                    $tempArray[$item->id]['quantity']++;
                }
            }
            $email = $order[0]->User->email;
            $data['items'] = $tempArray;
            Mail::queue('emails.order-cus', $data, function($message) use ($email){
                $message->subject("Order Confirmation");
                $message->from('hello@ketogram.co.uk');
                $message->to($email);
            });

            Mail::queue('emails.order-us', $data, function($message) {
                $message->subject("Someone has ordered items in the shop");
                $message->from('hello@ketogram.co.uk');
                $message->to('hello@ketogram.co.uk');
            });

            // Need update stock numbers.
            foreach($tempArray as $key => $item){
                Item::where('id', '=', $item['id'])->decrement('stock', $item['quantity']);
            }

            // Need to clear cart from cookies.
            setcookie('cart', '', time() - 3600, '/');

            // Update coupon if used.
            if(isset($order[0]->coupon_id) && !empty($order[0]->coupon_id)){
                Coupon::where('id', '=', $order[0]->coupon_id)->decrement('count', 1);
                Coupon::where('id', '=', $order[0]->coupon_id)->increment('number_used', 1);
            }

            return redirect('/orders/'.Auth::id())->with('status', 'Payment Accepted! We will post your order ASAP. Thank you :)');
        } catch (\Exception $ex){
            return $ex->getMessage();
        }
    }


    /**
     * PAGE: Orders/{User}
     * GET: /orders/{user}
     * This method handles the index of orders on the frontend
     * @param User
     * @return
     */
    public function orders(User $user){
        $meta = array(
            'title' => 'ketogram Shop',
            'description' => 'Ketogram Shop, low carb, keto, ketosis ',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        //if logged in user is not the same as page ID bounce them out
        if($user->id != Auth::id()){
            return redirect()->back()->withErrors(['Current user does not match user orders']);
        }

        //We need to get orders based on their current statuses.
        $pendingOrders = Order::where('user_id', '=', $user->id)->with('Item.ItemImages')->where('status', '=', 0)->orderBy('created_at', 'DESC')->get();

        $dispatchedOrders = Order::where('user_id', '=', $user->id)->where('status', '=', 1)->orderBy('created_at', 'DESC')->get();

        $cancelledOrders = Order::where('user_id', '=', $user->id)->where('status', '=', 2)->orderBy('created_at', 'DESC')->get();

        return view('orders/index', compact('meta', 'pendingOrders', 'dispatchedOrders', 'cancelledOrders'));
    }

    /**
     * PAGE: /Order/Cancel
     * GET: /Order/cancel
     * This method handles the cancellation view of Order
     * @param Order $Order
     * @return
     */
    public function cancel(Order $order){
        if($order->user_id != Auth::id()){
            return redirect()->back()->withErrors(['Order does not belong to current user.']);
        }

        $meta = array(
            'title' => 'Order Delete',
            'description' => 'Order Delete',
            'section' => 'Order',
            'subSection' => 'Order'
        );

        return view('orders/cancel', compact('meta', 'order'));
    }

    /**
     * PAGE: /Order/cancel-post
     * POST: /Order/cancel-post
     * This method handles the cancellation of an Order on the frontend
     * @param Order $Order
     * @return
     */
    public function cancel_post(Order $order){
        $orderObj = Order::where('id', '=', $order->id)->with('Item')->with('User')->get();

        $data = array(
            'name' => $orderObj[0]->User->name,
            'email' => $orderObj[0]->User->email,
            'address_1' => $orderObj[0]->address_1,
            'address_2' => $orderObj[0]->address_2,
            'town' => $orderObj[0]->town,
            'county' => $orderObj[0]->county,
            'postcode' => $orderObj[0]->postcode,
            'country' => $orderObj[0]->country,
            'total' => $orderObj[0]->total,
            'postage' => $orderObj[0]->postage
        );

        // Need to email customer with Order information.
        $tempArray = array();
        foreach($orderObj[0]->Item as $key => $item){
            if(isset($item->ItemImages[0]) && !empty($item->ItemImages[0])){
                $image = (array) $item->ItemImages[0]['original'];
            }else{
                $image = array('image' => '/images/no-image.png', 'title' => 'No Image');
            }
            if(!isset($tempArray[$item->id])){
                $tempArray[$item->id] = (array) $item['original'];
                $tempArray[$item->id]['image'] = $image;
                $tempArray[$item->id]['quantity']=1;
            }else{
                $tempArray[$item->id]['quantity']++;
            }
        }
        $email = $orderObj[0]->User->email;
        $data['items'] = $tempArray;
        Mail::queue('emails.order-cus-cancelled', $data, function($message) use ($email){
            $message->subject("Order Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to($email);
        });

        Mail::queue('emails.order-us-cancelled', $data, function($message) use ($email){
            $message->subject("Order Cancelled");
            $message->from('hello@ketogram.co.uk');
            $message->to('hello@ketogram.co.uk');
        });

        // Need update stock numbers.
        foreach($tempArray as $key => $item){
            Item::where('id', '=', $item['id'])->increment('stock', $item['quantity']);
        }

        //update status of order
        $order->update(array('status' => 2));

        //need to refund stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $refund = Refund::create(array(
            "charge" => $orderObj[0]->strip_charge_id
        ));

        return redirect('/orders/'.Auth::id())->with('status', 'Order cancelled successfully.');
    }
}
