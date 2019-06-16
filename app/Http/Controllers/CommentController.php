<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        $comment = new Comment();

        $comment->ticket_id = $request->ticket_id;
        $comment->message = $request->message;
        $comment->user_id = $user->id;

        $comment->save();

        return response()->json([ 'message' => 'Successfully created'], 201);
    }

    public function listByTicket(Request $request,$id)
    {
        $comments = Comment::where('ticket_id',$id)->get();

        return response()->json([ 'comments' => $comments], 201);
    }
}
