<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/contact','HomeController@getContact')->name('contact');
//Route::get('/blogs','HomeController@getBlogs')->name('blogs');
//Route::get('/post/{slug}','PostController@getPost');
//Route::get('{any}',function (){
//    return view('layouts.app');
//})->where('any','.*');
//Auth::routes();
//Route::get('passport',function (){
//    return view('welcome');
//});

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('send',function (){
    broadcast(new \App\Events\NewComment(auth()->user(),'aa'));
    return "d";
});
