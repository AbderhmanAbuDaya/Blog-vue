<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts=Post::with(['user'=>function ($q){
           $q->select('id','name');
       }])->latest()->paginate(5);
         foreach ($posts as $post){
             $post->numComments=$post->numComments();
         }
    return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
     return    response()->json([
            'id'=>$post->id,
            'slug'=>$post->slug,
            'body'=>$post->body,
            'created_at'=>$post->created_at,
            'numComments'=>$post->comments->count(),
            'image'=>$post->image,
            'user'=>$post->user,
            'title'=>$post->title,
            'category'=>$post->category,
            'comments'=> $this->commentsFormatted($post->comments)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function getPost($slug){
//        $post = Post::with(['comments','user'])->whereSlug($slug)->first();
//         return view('blog_posts',compact('post'));
    }

    public function commentsFormatted($comments){
        $new_commetns=[];
        foreach ($comments as $comment){
            array_push($new_commetns,[
                'id'=>$comment->id,
                'body'=>$comment->body,
                'user'=>$comment->user,
                'added_at'=>$comment->created_at
            ]);
        }
        return $new_commetns;

    }
}
