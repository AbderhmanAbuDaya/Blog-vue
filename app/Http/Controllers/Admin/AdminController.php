<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function getPosts(){
      $posts=Post::with(['user'=>function($q){
          $q->select('id','name');
      },
       'category'=>function($qq){
        $qq->select('id','name');
       }])->orderByDesc('created_at')->paginate(5);
      return response()->json([
          'posts'=>$posts,
          'status'=>200
      ]);
  }
  public function getCategory(){
      $categories=Category::all();
      return response()->json($categories);
  }
  public function addPost(Request $request){

      $imageName='';
      if ($request->hasFile('image')){
          $imageName=uploadImage('posts',$request->image);
      }
      $post=Post::create([
          'title'=>$request->title,
          'body'=>$request->body,
          'slug'=>$request->title,
          'category_id'=>$request->category,
          'image'=>$imageName,
           'user_id'=>Auth::user()->id
      ]);

      if ($post)
          return response()->json([
              'msg'=>'successful created post ',
              'status'=>201,
              'post'=>$post->with(['user'=>function($q){
                  $q->select('id','name');
              },
                  'category'=>function($qq){
                      $qq->select('id','name');
                  }])->first()
          ]);

  }
    public function updatePost(Request $request){
        $post= Post::where('id',$request->id)->first();

        $imageName=$post->image;
        if ($request->hasFile('image')){
            $imageName=uploadImage('posts',$request->image);

        }
            $post->update([
               'title'=>$request->title,
                'body'=>$request->body,
                'category_id'=>$request->category,
                'image'=>$imageName
            ]);
            $post->save();
            return response()->json([
                'post'=>$post,
                'msg'=>'done update',
                'status'=>200
            ]);
    }
    public function deletePost(Request $request){

        $post=Post::where('id',$request->id)->first();
        if ($post) {
            $post->comments()->delete();
            $post->delete();
        }
       return response()->json([
          'msg'=>'delete post is done',
          'status'=>200
       ]);


    }

    public function deleteSomePost(Request $request){

        $posts=Post::whereIn('id',$request->ids)->get();
        if ($posts) {
            foreach ($posts as $post) {
                $post->comments()->delete();
                $post->delete();
            }
        }
        return response()->json([
            'msg'=>'delete post is done',
            'status'=>200
        ]);


    }
}
