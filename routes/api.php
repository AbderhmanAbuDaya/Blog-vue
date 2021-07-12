<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test','UserController@details');
Route::middleware('auth:api')->get('u','UserController@details');
//Route::get('category/{slug}','CategoryController@show');
//Route::get('posts','PostController@index')->name('posts');
//Route::get('postDetails','PostController@show')->name('posts');
Route::apiResource('post','PostController');
Route::apiResource('category','CategoryController');

Route::get('postCategory/{slug}/posts','CategoryController@getPostCategory');
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserController@details');
    ####################Notifications #############
    Route::get('getUnreadNotifications', 'UserController@getUnreadNotifications');
    Route::get('getAllNotifications', 'UserController@getAllNotifications');
    Route::put('markNotificationAsRead', 'UserController@markNotificationAsRead');

    ####################comments###################
    Route::post('comment/create','CommentController@store');
    ####################Send Email###################
    Route::post('sendEmail','UserController@sendEmail');

});

Route::group(['prefix'=>'admin','middleware'=>['auth:api'],'namespace'=>'Admin'],function (){
    Route::get('posts','AdminController@getPosts');
    Route::get('categories','AdminController@getCategory');
    Route::post('addPost','AdminController@addPost');
    Route::post('updatePost','AdminController@updatePost');
    Route::post('deletePost','AdminController@deletePost');
    Route::post('deleteSomePost','AdminController@deleteSomePost');
});
