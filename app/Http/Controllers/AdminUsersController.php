<?php

namespace App\Http\Controllers;

use DB;
use App\AdminUser;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AdminUsersController extends Controller
{

    /**
     * PAGE: Admin/AdminUsers/Index
     * GET: /admin/admin-users/
     * This method handles the index view of AdminUser
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Admin User Index',
            'description' => 'Admin User index',
            'section' => 'Admin Users',
            'subSection' => 'Index'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $admin_users = AdminUser::where('username', 'like', '%'.$_GET['keywords'].'%')
                                        ->orWhere('email', 'like', '%'.$_GET['keywords'].'%')
                                        ->orWhere('display_name', 'like', '%'.$_GET['keywords'].'%')
                                        ->orderBy('created_at', 'ASC')
                                        ->paginate(20);
        }else{
            $admin_users = AdminUser::paginate(20);
        }
        return view('admin_users/admin/index', compact('admin_users', 'meta'));
    }

    /**
     * PAGE: Admin/AdminUsers/Create
     * GET: /admin/admin-users/create
     * This method handles the creation view of AdminUser
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Admin User Create',
            'description' => 'Admin User create',
            'section' => 'Admin Users',
            'subSection' => 'Create'
        );
        return view('admin_users/admin/create', compact('meta'));
    }

    /**
     * PAGE: Admin/AdminUsers/Create
     * POST: /admin/admin-users/create
     * This method handles the creation of AdminUser
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'username' => array('required','unique:admin_users', 'max:50'),
            'display_name' => 'required',
            'email' => 'required|email|unique:admin_users',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        // Need to check if the password and confirm_password are the same
        if($request->input('password') != $request->input('confirm_password')){
            return Redirect::back()->withInput()->withErrors('Password and confirm password do not match.');
        }else{
            // replacing / adding salt and hashed password to our request
            $hash = $this->password_hash($request->input('password'));
            $request->merge(array('password' => $hash[1]));
            $request->merge(array( 'salt' => $hash[2]));

            //Creating the admin_user
            AdminUser::create(array(
                    'username' => $request->username,
                    'password' => $request->password,
                    'email' => $request->email,
                    'salt' => $request->salt,
                    'display_name' => $request->display_name
                )
            );
            return redirect('/admin/admin-users/')->with('status', 'Admin User added successfully.');
        }
    }

    /**
     * PAGE: Admin/AdminUsers/Delete
     * GET: /admin/admin-users/delete:admin
     * This method handles the deletion view of AdminUser
     * @param AdminUser $admin
     * @return
     */
    public function admin_deleteShow(AdminUser $admin){
        $meta = array(
            'title' => 'Admin User Delete',
            'description' => 'Admin User Delete',
            'section' => 'Admin Users',
            'subSection' => 'Delete'
        );

        return view('admin_users/admin/delete', compact('meta', 'admin'));
    }

    /**
     * PAGE: Admin/AdminUsers/Delete
     * POST: /admin/admin-users/delete:admin
     * This method handles the deletion of Admin-Users
     * @param AdminUser $admin
     * @return
     */
    public function admin_delete(AdminUser $admin){
        $admin->delete();

        return redirect('/admin/admin-users/')->with('status', 'Admin user deleted successfully.');
    }


    /**
     * PAGE: Admin/AdminUsers/Edit
     * GET: /admin/admin-users/edit:admin
     * This method handles the editing view of AdminUser
     * @param AdminUser $admin
     * @return
     */
    public function admin_editShow(AdminUser $admin){
        $meta = array(
            'title' => 'Admin User Edit',
            'description' => 'Admin User edit',
            'section' => 'Admin Users',
            'subSection' => 'Edit'
        );

        return view('admin_users/admin/create', compact('meta', 'admin'));
    }


    /**
     * PAGE: Admin/AdminUsers/Edit
     * POST: /admin/admin-users/edit:admin
     * This method handles the editing of AdminUser
     * @param AdminUser $admin Request $request
     * @return
     */
    public function admin_edit(Request $request, AdminUser $admin){
        $this->validate($request, [
            'username' => array('required','unique:admin_users,username,'.$admin->id, 'max:50'),
            'display_name' => 'required',
            'email' => 'required|email|unique:admin_users,email,'.$admin->id
        ]);

        // Need to check if the password and confirm_password are the same
        if($request->has('password') && $request->has('confirm_password') && $request->input('password') != $request->input('confirm_password')){
            return Redirect::back()->withInput()->withErrors('Password and confirm password do not match.');
        }else{
            if($request->has('password') && $request->has('confirm_password')){
                $hash = $this->password_hash($request->input('password'));
                $request->merge(array('password' => $hash[1]));
                $request->merge(array( 'salt' => $hash[2]));
                $input = $request->all();
            }else{
                $input = $request->except(array('password', 'confirm_password'));
            }

            //Updating the admin_user
            $admin->update($input);
            return redirect('/admin/admin-users/')->with('status', 'Admin User Edited successfully.');
        }
    }


    /**
     * PAGE: Admin/Login
     * GET: /admin/login/
     * This method handles the login show for AdminUser
     * @return
     */
    public function admin_login(){
        $meta = array(
            'title' => 'Login',
            'description' => 'Admin User Login',
            'section' => 'Login',
            'subSection' => 'Login'
        );
        return view('admin_users/admin/login', compact('meta'));
    }

    /**
     * PAGE: Admin/login
     * POST: /admin/login/
     * This method handles the login of AdminUser
     * @param Request $request
     * @return
     */
    public function admin_loginPost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
        $checkUser = AdminUser::where('username', $request->input('username'))->first();

        //if post username matches a record then proceed. Else bounce them back with error.
        if (!empty($checkUser)) {
            //Need to check the users password and salt vs the post password.
            $verify = $this->password_verify($checkUser->password, $checkUser->salt, $request->input('password'));
            // If true comtinue with login
            if ($verify[0] == true) {
                // Set User Sessions
                Session::put('AdminLoggedIn', true);
                Session::put('AdminCurrentUserID', $checkUser->id);
                Session::put('AdminCurrentUserName', $checkUser->display_name);
                Session::save();

                return redirect('/admin/admin-users/');

            } else {
                return redirect('/admin/login/')->withErrors('Invalid password or username.');
            }
        } else {
            return redirect('/admin/login/')->withErrors('Invalid password or username.');
        }
    }

    /**
     * PAGE: Admin logout
     * GET: /admin/logout/
     * This method handles the logging out of AdminUser
     * @return
     */
    public function admin_logout(){
        if(!Session::get('AdminLoggedIn')){
            return redirect('/admin/login/')->withErrors('You are not logged in.');
        }
        Session::flush();
        return redirect('/admin/login/')->with('status', 'You have successfully logged out.');
    }


    /**
     * Verify a password
     *
     * @param string $storedPassword	The password to verify
     * @param int $storedSalt 			The salt to verify
     * @param string $storedSalt     	The hash to verify against
     *
     * @return boolean If the password matches the hash
     */
    static public function password_verify($storedPassword, $storedSalt, $password) {
        $result[0] = false;
        if(hash('sha256', $password.$storedSalt) != $storedPassword) {
            $result[1] = "Invalid password. Why not try our forgot password option?";
        }else{
            $result[0] = true;
        }
        return $result;
    }

    /**
     * Hash the password using the specified algorithm
     *
     * @param string $password The password to hash
     *
     * @return string The hashed password
     */
    static public function password_hash($password) {
        $result[0] = false;
        if (!is_string($password)) {
            $result[1] = "Password must be a string";
        }else{
            $salt = time();
            $result[0] = true;
            $result[1] = hash('sha256', $password.$salt);
            $result[2] = $salt;
        }
        return $result;
    }

    /**
     * generatePassword
     *
     * @return html with random password
     */
    public function generatePassword(){
        $new_password = Str::random(8);
        if(!empty($new_password)){
            return '<input id="new_pw" value="'.$new_password.'" class="form-control" readonly/>';
        }
    }
}
