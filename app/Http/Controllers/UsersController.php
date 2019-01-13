<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Query;
use DB;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * PAGE: Admin/User/
     * GET: /admin/users/
     * This method handles the index view of User
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'User Index',
            'description' => 'User index',
            'section' => 'Users',
            'subSection' => 'Index'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $users = User::where('name', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('email', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        }else{
            $users = User::orderBy('created_at', 'DESC')->paginate(20);
        }


        //we need to get the count of subscriptions that used this user coupon.
        foreach($users as $key => $user){
            $users[$key]['subscription_count'] = 0;
            foreach($user->Referrer as $referrer){
                $users[$key]['subscription_count'] +=  $referrer->number_used;
            }
        }
        return view('users/admin/index', compact('users', 'meta'));
    }

    /**
     * PAGE: Admin/User/Create
     * GET: /admin/users/create
     * This method handles the creation view of User
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'User Index',
            'description' => 'User index',
            'section' => 'Users',
            'subSection' => 'Index'
        );
        return view('users/admin/create', compact('meta'));
    }

    /**
     * PAGE: Admin/User/Create
     * POST: /admin/users/create
     * This method handles the creation of User
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'name' => array('required','unique:users', 'max:50'),
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        // Need to check if the password and confirm_password are the same
        if($request->input('password') != $request->input('confirm_password')){
            return Redirect::back()->withInput()->withErrors('Password and confirm password do not match.');
        }else{
            User::create(array(
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                )
            );
            return redirect('/admin/users/')->with('status', 'User added successfully.');
        }
    }

    /**
     * PAGE: Admin/User/Delete
     * GET: /admin/users/delete
     * This method handles the deletion view of User
     * @param User $user
     * @return
     */
    public function admin_deleteShow(User $user){
        $meta = array(
            'title' => 'Users Delete',
            'description' => 'Users Delete',
            'section' => 'Users',
            'subSection' => 'Delete'
        );

        return view('users/admin/delete', compact('meta', 'user'));
    }

    /**
     * PAGE: Admin/User/Delete
     * POST: /admin/users/delete
     * This method handles the deletion view of User
     * @param User $user
     * @return
     */
    public function admin_delete(User $user){
        $user->delete();

        return redirect('/admin/users/')->with('status', 'User deleted successfully.');
    }

    /**
     * PAGE: Admin/User/edit
     * GET: /admin/users/edit
     * This method handles the edit view of User
     * @param User $user
     * @return
     */
    public function admin_editShow(User $user){
        $meta = array(
            'title' => 'User Edit',
            'description' => 'User edit',
            'section' => 'Users',
            'subSection' => 'Edit'
        );

        return view('users/admin/create', compact('meta', 'user'));
    }

    /**
     * PAGE: Admin/User/edit
     * POST: /admin/users/edit
     * This method handles the editing of User
     * @param Request $request User $user
     * @return
     */
    public function admin_edit(Request $request, User $user){
        $this->validate($request, [
            'name' => array('required','unique:users,name,'.$user->id, 'max:50'),
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        // Need to check if the password and confirm_password are the same
        if($request->has('password') && $request->has('confirm_password') && $request->input('password') != $request->input('confirm_password')){
            return Redirect::back()->withInput()->withErrors('Password and confirm password do not match.');
        }else{
            if($request->has('password') && $request->has('confirm_password')){
                $request->merge(array('password' => Hash::make($request->password)));
                $input = $request->all();
            }else{
                $input = $request->except(array('password', 'confirm_password'));
            }

            //Updating the admin_user
            $user->update($input);
            return redirect('/admin/users/')->with('status', 'User Edited successfully.');
        }
    }

    /**
     * PAGE: Settings/{$user_id}
     * POST: Settings/{$user_id}
     * This method handles the editing of User Password
     * @param Request $request User $user
     * @return
     */
    public function settings(Request $request, User $user){
        if($user->id != Auth::id()){
            return redirect('/')->withErrors(['User does not match logged in user']);
        }

        $meta = array(
            'title' => 'User Edit Password',
            'description' => 'User edit password',
            'section' => 'User',
            'subSection' => 'Change Password'
        );

        if(isset($request->password) && !empty($request->password)){

            $this->validate($request, [
                'password' => array('required', 'max:50'),
                'new_password' => array('required', 'max:50', 'same:new_password'),
                'password_confirmation' => array('required', 'max:50', 'same:new_password'),
            ]);

            if(Hash::check($request->password, Auth::User()->password)){
                $user->update(array('password' => Hash::make($request->new_password)));
                return redirect()->back()->with('status', 'Password successfully updated.');

            }else{
                return redirect()->back()->withErrors(['Old Password is not correct']);
            }
        }

        return view('users/settings', compact('meta', 'user'));
    }

    /**
     * PAGE: Email/{$user_id}
     * POST: email/{$user_id}
     * This method handles the editing of User Email
     * @param Request $request User $user
     * @return
     */
    public function email(Request $request, User $user){
        $this->validate($request, [
            'email' => array('required', 'email', 'unique:users,email,'.$user->id),
        ]);
        $user->update($request->all());
        return redirect()->back()->with('status', 'Email successfully updated.');
    }

    /**
     * PAGE: cancel_newsletter
     * This method will cancel a user from recieving newsletters
     * @return
     */
    public function cancel_newsletter(Request $request){
        $meta = array(
            'title' => 'User Cancel Newsletter',
            'description' => 'User Cancel Newsletter',
            'section' => 'User',
            'subSection' => 'Cancel Newsletter'
        );

        if(isset($request->email) && !empty($request->email)) {
            $this->validate($request, [
                'email' => array('required', 'email'),
            ]);

            //Check if user matches email
            $user = User::where('email', '=', $request->email)->first();
            if (isset($user) && !empty($user)) {
                $user->update(array('notifications' => 0));
                return redirect('/cancel-newsletter')->with('status', 'Notification setting has been updated.');
            }

            //Check if query matches email
            $query = Query::where('email', '=', $request->email)->first();
            if (isset($query) && !empty($query)) {
                $query->update(array('notifications' => 0));
                return redirect('/cancel-newsletter')->with('status', 'Notification setting has been updated.');
            }

            //if we don't have a matching email then reject.
            return redirect('/cancel-newsletter')->withErrors(['No account matches email']);
        }

        return view('users/cancel_newsletter', compact('meta'));

    }
}
