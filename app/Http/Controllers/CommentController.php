<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewComment;
use App\Notifications\NotifyOwner;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $comments=Comment::with(['user','post'])->wherePostId($post_id)->get();
        return response()->json([
            'comments'=>$comments,
            'status'=>200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
             'post_id'=>'required|exists:posts,id',
             'body'=>'required'
         ]);

         $comment= Comment::create([
             'body'=>$request->body,
             'user_id'=>Auth::user()->id,
             'post_id'=>$request->post_id
         ]);
         broadcast(new NewComment($comment->user,$comment))->toOthers() ;
         $post=Post::with('user')->find($comment->post_id);
          $user=$post->user;
         if ($user->id != $comment->user_id)
        $user->notify(new NotifyOwner($comment,$post));

         return response()->json([
             'id'=>$comment->id,
             'body'=>$comment->body,
             'user'=>$comment->user,
             'created_at'=>$comment->created_at,
             'status'=>201
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment::destroy();
        return response()->json([
            'message'=>'successful to delete comment',
            'status'=>200
        ]);
    }
}
