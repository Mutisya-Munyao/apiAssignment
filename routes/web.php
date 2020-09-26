<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
})->name('home');

Route::post('/signup', [
    'uses' => 'userController@postSignUp' ,
    'as' => 'signup'
]);

Route::post('login', [
    'uses' => 'userController@postLogIn' ,
    'as' => 'login'
]);

Route::get('/logout', [
    'uses' => 'userController@getLogout' ,
    'as' => 'logout'
]);

Route::get('/dashboard', [
    'user' => 'postController@getDashboard' ,
    'as' => 'dashboard' ,
    'middleware' => 'auth'
]);

Route::post('/createpost', [
    'user' => 'postController@postCreatePost' ,
    'as' => 'post.create' ,
    'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}', [
    'user' => 'postController@getDeletePost' ,
    'as' => 'post.delete' ,
    'middleware' => 'auth'
]);

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
]);

Route::get('/account', [
    'uses' => 'UserController@getAccount',
    'as' => 'account'
]);

Route::post('/upateaccount', [
    'uses' => 'UserController@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/userimage/{filename}', [
    'uses' => 'UserController@getUserImage',
    'as' => 'account.image'
]);
