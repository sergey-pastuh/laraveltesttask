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

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/posts/','App\Http\Controllers\PostsController@getAll')->defaults('posts_limit', 3)->name('posts');

Route::get('/comments', 'App\Http\Controllers\CommentsController@getUsers')->name('comments');

Route::get('/comments/{id}', 'App\Http\Controllers\CommentsController@getCommentsByUser');
