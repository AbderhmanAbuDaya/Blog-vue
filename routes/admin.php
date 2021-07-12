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



Route::group(['prefix'=>'admin','namespace'=>'admin'],function (){
    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('newBlog', 'AdminController@newBlog')->name('admin.newBlog');
    Route::get('settings', 'AdminController@setting')->name('admin.setting');

});

