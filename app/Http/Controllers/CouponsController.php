<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Coupon;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CouponsController extends Controller
{
    /**
     * PAGE: Admin/Coupons/
     * GET: /admin/coupons/
     * This method handles the index view of Coupons
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Coupons Index',
            'description' => 'Coupons index',
            'section' => 'Coupon',
            'subSection' => 'Coupon'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $coupons = Coupon::whereHas('User', function ($q) {
                $q->where('name', 'like', '%' . $_GET['keywords'] . '%');
                $q->orWhere('email', 'like', '%' . $_GET['keywords'] . '%');

            })
            ->orderBy('created_at', 'ASC')
            ->paginate(20);
        }else{
            $coupons = Coupon::paginate(20);
        }
        return view('coupons/admin/index', compact('coupons', 'meta'));
    }

    /**
     * PAGE: Admin/Coupons/Create
     * GET: /admin/coupons/create
     * This method handles the creation view of Coupons
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Coupons Index',
            'description' => 'Coupons index',
            'section' => 'Coupon',
            'subSection' => 'Coupon'
        );

        $users = DB::table('users')->pluck('name', 'id');
        return view('coupons/admin/create', compact('meta', 'coupons', 'users'));
    }

    /**
     * PAGE: Admin/Coupons/Create
     * POST: /admin/coupons/create
     * This method handles the creation of Coupons
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'user_id' => 'Integer',
            'referrer_id' => 'Integer',
            'user_email' => 'Email',
            'valid_to' => array('required', 'date'),
            'valid_from' => array('required', 'date'),
            'count' => array('required', 'Integer'),
            'percentage' => array('required', 'Integer', 'between:0,50'),
            'code' => array('required', 'unique:coupons'),
            'is_subscription' => 'Integer'
        ]);


        Coupon::create(array(
                'user_id' => $request->user_id,
                'referrer_id' => $request->referrer_id,
                'user_email' => $request->user_email,
                'valid_to' => $request->valid_to,
                'valid_from' => $request->valid_from,
                'count' => $request->count,
                'percentage' => $request->percentage,
                'code' => $request->code,
                'is_subscription' => $request->is_subscription
            )
        );

        return redirect('/admin/coupons/')->with('status', 'Coupons added successfully.');
    }

    /**
     * PAGE: Admin/Coupons/Delete
     * GET: /admin/coupons/delete
     * This method handles the deletion view of Coupons
     * @param Coupons $coupons
     * @return
     */
    public function admin_deleteShow(Coupon $coupons){
        $meta = array(
            'title' => 'Coupons Delete',
            'description' => 'Coupons Delete',
            'section' => 'Coupon',
            'subSection' => 'Coupon'
        );

        return view('coupons/admin/delete', compact('meta', 'coupons'));
    }

    /**
     * PAGE: Admin/Coupons/Delete
     * POST: /admin/coupons/delete
     * This method handles the deletion view of Coupons
     * @param Coupon $coupons
     * @return
     */
    public function admin_delete(Coupon $coupons){
        $coupons->delete();

        return redirect('/admin/coupons/')->with('status', 'Coupons deleted successfully.');
    }

    /**
     * PAGE: Admin/Coupons/edit
     * GET: /admin/coupons/edit
     * This method handles the edit view of Coupons
     * @param Coupon $coupons
     * @return
     */
    public function admin_editShow(Coupon $coupons){
        $meta = array(
            'title' => 'Coupons Edit',
            'description' => 'Coupons edit',
            'section' => 'Coupon',
            'subSection' => 'Coupon'
        );

        $users = DB::table('users')->pluck('name', 'id');
        return view('coupons/admin/create', compact('meta', 'coupons', 'users'));
    }

    /**
     * PAGE: Admin/Coupons/edit
     * POST: /admin/coupons/edit
     * This method handles the editing of Coupons
     * @param Request $request Coupon $coupons
     * @return
     */
    public function admin_edit(Request $request, Coupon $coupons){
        $this->validate($request, [
            'user_id' => 'Integer',
            'referrer_id' => 'Integer',
            'user_email' => 'Email',
            'valid_to' => array('required', 'date'),
            'valid_from' => array('required', 'date'),
            'count' => array('required', 'Integer'),
            'percentage' => array('required', 'Integer', 'between:0,50'),
            'code' => array('required', 'unique:coupons,code,'.$coupons->id),
            'is_subscription' => 'Integer'
        ]);

        $input = array(
            'user_id' => $request->user_id,
            'referrer_id' => $request->referrer_id,
            'user_email' => $request->user_email,
            'valid_to' => $request->valid_to,
            'valid_from' => $request->valid_from,
            'count' => $request->count,
            'percentage' => $request->percentage,
            'code' => $request->code,
            'is_subscription' => $request->is_subscription
        );

        $coupons->update($input);
        return redirect('/admin/coupons/')->with('status', 'Coupons Edited successfully.');
    }


    /**
     * PAGE: /Coupons/share
     * POST: /coupons/share
     * This method handles the POST / GET so a user can view or generate their affliate code.
     * @param Request $request, User $user
     * @return
     */
    public function share(Request $request, User $user){

        //if logged in user is not the same as page ID bounce them out
        if($user->id != Auth::id()){
            return redirect()->back()->withErrors(['Current user does not match user subscriptions']);
        }

        $meta = array(
            'title' => 'ketogram Subscriptions',
            'description' => 'Ketogram Shop, low carb, keto, ketosis Subscriptions',
            'section' => 'Subscription',
            'subSection' => 'Subscription'
        );

        //if we have a request then generate new coupon form.
        if(isset($request->_token) && !empty($request->_token)){
            $code = $this->generateCode();
            $data = array(
                'referrer_id' => Auth::id(),
                'valid_from' => date('Y-m-d'),
                'valid_to' => date('Y-m-d', strtotime('+20 year')),
                'count' => '99999',
                'percentage' => '10',
                'code' => $code
            );
            Coupon::create($data);
            return redirect()->back()->with('status', 'Coupon Generated!');
        }

        //check if user has a referrer coupon alreay
        $coupon = Coupon::where('referrer_id', '=', Auth::id())->orderBy('created_at', 'DESC')->first();

        $user['subscription_count'] = 0;
        foreach($user->Referrer as $referrer){
            $user['subscription_count'] +=  $referrer->number_used;
        }


        return view('coupons/share', compact('meta', 'coupon', 'user'));


    }

    /**
     * generateAjaxCode
     *
     * @return html with random Code
     */
    public function generateAjaxCode(){
        $new_code = $this->generateCode();

        if(!empty($new_code)){
            return '<input id="new_code" value="'.$new_code.'" class="form-control" readonly/>';
        }
    }

    /**
     * generateCode
     *
     * @return $string New Code
     */
    public function generateCode(){
        $loop = 0;
        while($loop == 0) {
            $new_code = Str::random(8);
            if (Coupon::where('code', '=',  $new_code)->exists()) {
                $loop = 0;
            }else{
                $loop = 1;
            }
        }

        if(!empty($new_code)){
            return $new_code;
        }
    }

    /**
     * check_coupon
     *
     * @return JSON
     */
    public function check_coupon($code){
        if(isset($code) && !empty($code)){
            $coupon = Coupon::where('code', '=', $code)->get();
            //if code does not match code
            if($coupon->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'No coupon matching that code was found'
                ]);
            }

            //if coupon count is less than zero
            if($coupon[0]->count <= 0){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon has been exhausted'
                ]);
            }

            //if valid from date falls outside current time
            if(strtotime($coupon[0]->valid_from) > time()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon is not valid yet.'
                ]);
            }

            //if valid to date falls outside current time
            if(strtotime($coupon[0]->valid_to) < time()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon has expired'
                ]);
            }

            //check if we have user_id or user_email we need ensure the right user is trying to use it.
            if(!empty($coupon[0]->user_id) || !empty($coupon[0]->user_email)){
                //we need to get the users email as the Auth doesn't carry it.
                $user = User::where('id', '=', Auth::id())->get();
                if($user->isEmpty()){
                    return response()->json([
                        'status' => 'error',
                        'text' => 'You don\'t appear to be logged in...'
                    ]);
                }

                if($user[0]->id != $coupon[0]->user_id && $user[0]->email != $coupon[0]->user_email){
                    return response()->json([
                        'status' => 'error',
                        'text' => 'Coupon does not match the user.'
                    ]);
                }
            }

            //checking if the code can be used for subscriptions only
            if($coupon[0]->is_subscription == 1){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon only works for subscriptions.'
                ]);
            }

            //Now we have passed the failure criteria we can return the success.
            return response()->json([
                'status' => 'success',
                'text' => 'Success! Enjoy the '.$coupon[0]->percentage.'% off.',
                'percent' => $coupon[0]->percentage
            ]);

        }else{
            return response()->json([
                'status' => 'error',
                'text' => 'Please provide code.'
            ]);
        }
    }

    /**
     * check_coupon
     *
     * @return JSON
     */
    public function check_coupon_custom($code){
        if(isset($code) && !empty($code)){
            $coupon = Coupon::where('code', '=', $code)->get();
            //if code does not match code
            if($coupon->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'No coupon matching that code was found'
                ]);
            }

            //if coupon count is less than zero
            if($coupon[0]->count <= 0){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon has been exhausted'
                ]);
            }

            //if valid from date falls outside current time
            if(strtotime($coupon[0]->valid_from) > time()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon is not valid yet.'
                ]);
            }

            //if valid to date falls outside current time
            if(strtotime($coupon[0]->valid_to) < time()){
                return response()->json([
                    'status' => 'error',
                    'text' => 'Coupon has expired'
                ]);
            }

            //check if we have user_id or user_email we need ensure the right user is trying to use it.
            if(!empty($coupon[0]->user_id) || !empty($coupon[0]->user_email)){
                //we need to get the users email as the Auth doesn't carry it.
                $user = User::where('id', '=', Auth::id())->get();
                if($user->isEmpty()){
                    return response()->json([
                        'status' => 'error',
                        'text' => 'You don\'t appear to be logged in...'
                    ]);
                }

                if($user[0]->id != $coupon[0]->user_id && $user[0]->email != $coupon[0]->user_email){
                    return response()->json([
                        'status' => 'error',
                        'text' => 'Coupon does not match the user.'
                    ]);
                }
            }

            //Now we have passed the failure criteria we can return the success.
            return response()->json([
                'status' => 'success',
                'text' => 'Success! Enjoy the '.$coupon[0]->percentage.'% off.',
                'percent' => $coupon[0]->percentage
            ]);

        }else{
            return response()->json([
                'status' => 'error',
                'text' => 'Please provide code.'
            ]);
        }
    }
}
