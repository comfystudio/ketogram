<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use DB;
use Carbon\Carbon;
use Mail;
use App\User;
use App\Query;

class EmailsController extends Controller
{
    /**
     * PAGE: Admin/Email/
     * GET: /admin/email/
     * This method handles the index view of Email
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Email Index',
            'description' => 'Email index',
            'section' => 'Email',
            'subSection' => 'Email'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $emails = Email::where('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        }else{
            $emails = Email::orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('email_view/admin/index', compact('emails', 'meta'));
    }

    /**
     * PAGE: Admin/Email/Create
     * GET: /admin/email/create
     * This method handles the creation view of Email
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Email Index',
            'description' => 'Email index',
            'section' => 'Email',
            'subSection' => 'Email'
        );

        return view('email_view/admin/create', compact('meta'));
    }

    /**
     * PAGE: Admin/Email/Create
     * POST: /admin/email/create
     * This method handles the creation of Email
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'title' => array('required','max:255'),
            'subject' => array('required','max:255'),
            'text' => 'required',
        ]);

        Email::create($request->except(array('save')));

        return redirect('/admin/emails/')->with('status', 'Email added successfully.');
    }

    /**
     * PAGE: Admin/Email/Delete
     * GET: /admin/email/delete
     * This method handles the deletion view of Email
     * @param Email $email
     * @return
     */
    public function admin_deleteShow(Email $emails){
        $meta = array(
            'title' => 'Email Delete',
            'description' => 'Email Delete',
            'section' => 'Email',
            'subSection' => 'Email'
        );


        return view('email_view/admin/delete', compact('meta', 'emails'));
    }

    /**
     * PAGE: Admin/Email/Delete
     * POST: /admin/email/delete
     * This method handles the deletion view of Email
     * @param Email $email
     * @return
     */
    public function admin_delete(Email $emails){
        $emails->delete();

        return redirect('/admin/emails/')->with('status', 'Email deleted successfully.');
    }

    /**
     * PAGE: Admin/Email/edit
     * GET: /admin/email/edit
     * This method handles the edit view of Email
     * @param Email $email
     * @return
     */
    public function admin_editShow(Email $emails){
        $meta = array(
            'title' => 'Email Edit',
            'description' => 'Email edit',
            'section' => 'Email',
            'subSection' => 'Email'
        );

        return view('email_view/admin/create', compact('meta', 'emails'));
    }

    /**
     * PAGE: Admin/Email/edit
     * POST: /admin/email/edit
     * This method handles the editing of Email
     * @param Request $request Email $email
     * @return
     */
    public function admin_edit(Request $request, Email $emails){
        $this->validate($request, [
            'title' => array('required','max:255'),
            'subject' => array('required','max:255'),
            'text' => 'required',
        ]);

        $emails->update(array(
            'title' => $request->title,
            'subject' => $request->subject,
            'text' => $request->text,
            )
        );

        return redirect('/admin/emails/')->with('status', 'Email Edited successfully.');
    }

    /**
     * PAGE: Admin/Email/test
     * POST: /admin/email/test
     * This method handles the testing of an Email
     * @param Email $emails
     * @return
     */
    public function admin_test(Email $emails){
        $data = $emails['attributes'];
        $subject = $emails->subject;

        Mail::queue('emails.template', $data, function($message) use ($subject){
            $message->subject($subject);
            $message->from('hello@ketogram.co.uk');
            $message->to('hello@ketogram.co.uk');
        });

        return redirect('/admin/emails/')->with('status', 'Email Sent successfully.');
    }

    /**
     * PAGE: Admin/Email/send
     * POST: /admin/email/send
     * This method handles the editing of Email
     * @param Email $emails, Request $request
     * @return
     */
    public function admin_send(Email $emails, Request $request){
        $meta = array(
            'title' => 'Email Delete',
            'description' => 'Email Send',
            'section' => 'Email',
            'subSection' => 'Email'
        );

        $choiceArray = array('All Emails', 'Users', 'Queries');

        if(isset($request->save) && !empty($request->save)) {
            //0 = all emails
            //1 = frontend users
            //2 = queries emails

            if($request->option == 0){
                $emailList = DB::table('users')->where('notifications', 1)->pluck('email')->toArray();
                $emailList2 = DB::table('queries')->where('notifications', 1)->pluck('email')->toArray();

                //Getting only unqiue emails
                $emailList = array_unique( array_merge($emailList, $emailList2) );
            }elseif($request->option == 1){
                $emailList = DB::table('users')->where('notifications', 1)->pluck('email')->toArray();
            }elseif($request->option == 2){
                $emailList = DB::table('queries')->where('notifications', 1)->pluck('email')->toArray();
            }

            $data = $emails['attributes'];
            $subject = $emails->subject;

            Mail::queue('emails.template', $data, function($message) use ($emailList, $subject){
                $message->subject($subject);
                $message->from('hello@ketogram.co.uk');
                $message->to('hello@ketogram.co.uk');
                $message->bcc($emailList);
            });

            $emails->touch();

            return redirect('/admin/emails/')->with('status', 'Emails Sent successfully.');
        }

        return view('email_view/admin/send', compact('meta', 'emails', 'choiceArray'));



    }
    
}
