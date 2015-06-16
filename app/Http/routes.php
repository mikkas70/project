<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');



Route::resource('projects', 'ProjectController');
Route::resource('users', 'UserController');
Route::resource('admin', 'AdminController');
Route::resource('editor', 'EditorController');
Route::resource('comments' , 'CommentController');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('user/changeFlag/{id}', array('as' => 'users.changeFlag', 'uses' => 'UserController@changeFlag'));
Route::any('user/filter/', array('as' => 'users.filter', 'uses' => 'UserController@filter'));
Route::post('comment/createComment/{id}', array('as' => 'comments.createComment', 'uses' => 'CommentController@createComment'));
Route::post('comment/sendRequest/{id}', array('as' => 'comments.sendRequest', 'uses' => 'CommentController@sendRequest'));
Route::post('comment/approveContent/{id}', array('as' => 'editor.approveContent', 'uses' => 'EditorController@approveContent'));



Route::any('comment/rejectComment/{id}', array('as' => 'editor.rejectComment', 'uses' => 'EditorController@rejectComment'));
Route::put('comment/refuse/{id}', array('as' => 'comments.refuse', 'uses' => 'CommentController@refuse'));


