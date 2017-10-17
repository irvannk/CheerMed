<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posting;
use App\Comment;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
    	$send = new Posting;
    	$send->posting = $request->message;
    	$send->user_id = $request->user_id;
        $file       = $request->file('photo');
        if ($file != NULL) {
            $fileName   = $file->getClientOriginalName();
            $request->file('photo')->move("img/", $fileName);
            $send->photo = $fileName;
        }
    	$send->save();

    	return back();
    }

    public function batal($id)
    {
    	$batal = Posting::find($id);
    	$batal->delete();

    	return back();
    }
    public function comment(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $comment = new Comment;
        $comment->user_id = $request->user_id;
        $comment->posting_id = $request->posting_id;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }
    public function cancel_comment($id)
    {
        $cancel = Comment::find($id);
        $cancel->delete();

        return back();
    }
}
