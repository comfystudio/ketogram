<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Query;
use Illuminate\Bus\Queueable;
use Mail;
use App\Http\Controllers\CouponsController as Coupons;
use App\Coupon;

class QueriesController extends Controller
{
    /**
     * PAGE: Admin/Query/
     * GET: /admin/queries/
     * This method handles the index view of Query
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Query Index',
            'description' => 'Query index',
            'section' => 'Query',
            'subSection' => 'Query'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $queries = Query::where('name', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('subject', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('email', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        }else{
            $queries = Query::orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('queries/admin/index', compact('queries', 'meta'));
    }

    /**
     * PAGE: Admin/Query/Delete
     * GET: /admin/queries/delete
     * This method handles the deletion view of Query
     * @param Query $queries
     * @return
     */
    public function admin_deleteShow(Query $queries){
        $meta = array(
            'title' => 'Query Delete',
            'description' => 'Query Delete',
            'section' => 'Query',
            'subSection' => 'Query'
        );

        return view('queries/admin/delete', compact('meta', 'queries'));
    }

    /**
     * PAGE: Admin/Query/Delete
     * POST: /admin/queries/delete
     * This method handles the deletion view of Query
     * @param Query $queries
     * @return
     */
    public function admin_delete(Query $queries){
        $queries->delete();

        return redirect('/admin/queries/')->with('status', 'Query deleted successfully.');
    }

    /**
     * PAGE: /Query/Create
     * POST: /queries/create
     * This method handles the creation of Query
     * @param Request $request
     * @return
     */
    public function create(Request $request){
        if(isset($request->birthday) && !empty($request->birthday)){
            die;
        }

        # Verify captcha
        $post_data = http_build_query(
            array(
                'secret' => '6LeFzVoUAAAAANPeQ9Bb2u-5WGnlcWoJH8PkgojE',
                'response' => $_POST['g-recaptcha-response']
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            )
        );
        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);
        if (!$result->success) {
            die;
        }

        $this->validate($request, [
            'email' => array('required', 'email', 'unique:queries')
        ]);

        Query::create(array(
                'email' => $request->email
            )
        );

//        $this->validate($request, [
//            'name' => array('required','max:255'),
//            'email' => array('required', 'email'),
//            'subject' => 'required|max:255',
//            'message' => 'required|max:1000',
//        ]);
//
//        Query::create(array(
//                'name' => $request->name,
//                'email' => $request->email,
//                'subject' => $request->subject,
//                'message' => $request->message,
//            )
//        );

        //Need to create a Coupon for the email
        $code = (new Coupons)->generateCode();
        Coupon::create(array(
            'user_email' => $request->email,
            'valid_to' => date('Y-m-d', strtotime('+5 years')),
            'valid_from' => date('Y-m-d'),
            'count' => 1,
            'percentage' => 15,
            'code' => $code,
            'is_subscription' => 0
            )
        );

        $data = array('name' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'emailMessage' => $request->message, 'code' => $code);

        Mail::queue('emails.query', $data, function($message) {
            $message->subject("Someone has added a query to the ketogram.co.uk site.");
            $message->from('hello@ketogram.co.uk');
            $message->to('hello@ketogram.co.uk');
        });

        $email = $request->email;
        //Email the user with the code.
        Mail::queue('emails.early', $data, function($message) use ($email){
            $message->subject("Keteogram: Welcome! ");
            $message->from('hello@ketogram.co.uk');
            $message->to($email);
        });



        return redirect()->back()->with('status', 'Keep an eye on your inbox for more details soon.');
    }


    /**
     * PAGE: /ADMIN/Query/Download
     * POST: /admin/queries/download
     * This method handles downloading of a list of ; seprated email address
     * @return
     */
    public function admin_download(){
        $emails = Query::pluck('email', 'id')->toArray();

        $content="";
        foreach($emails as $email){
            $content .= $email.';';
        }

        header('Content-type: text/plain');
        header('Content-Disposition: attachment;filename="emails.txt"');
        print $content;
    }


    /**
     * PAGE: Queries
     * GET: /queries
     * This method handles the view of Queries
     * @return
     */
    public function view(){
        $meta = array(
            'title' => 'Ketogram Newsletter',
            'description' => 'Ketogram Newsletter, Keto, Ketosis, low carb, UK, Belfast, Blog',
            'section' => 'Queries',
            'subSection' => 'Query'
        );

        return view('queries/view', compact('meta'));
    }


}
