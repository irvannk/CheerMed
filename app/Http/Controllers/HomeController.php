<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;
use App\Posting;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posting::orderBy('id', 'DESC')->get();
        $count_comment = Comment::get()->count();
        return view('home', ['post' => $post, 'comment' => $count_comment]);
    }

    public function email()
    {
        $data = array('name'=>"CheerMedia");
        // Path or name to the blade template to be rendered
        $template_path = 'emails.email';
        
        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('irvanlaw45@gmail.com', 'Receiver Name')->subject('Mail from CheerMedia');
            // Set the sender
            $message->from('irvanlaw45@gmail.com','CheerMedia');
        });

        return "Basic email sent, check your inbox.";
    }
    public function upload(Request $request)
    {
        $id     = $request->user_session;
        $upload = User::find($id);
        $file       = $request->file('picture');
        $fileName   = $file->getClientOriginalName();
        $request->file('picture')->move("img/", $fileName);
        $upload->picture = $fileName;
        $upload->save();

        return back();
    }
}
