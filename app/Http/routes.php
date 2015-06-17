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
Route::resource('author', 'AuthorController');
Route::resource('comments' , 'CommentController');
Route::resource('project_tag' , 'ProjectTagController');
Route::resource('media' , 'MediaController');



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('user/changeFlag/{id}', array('as' => 'users.changeFlag', 'uses' => 'UserController@changeFlag'));
Route::any('user/filter/', array('as' => 'users.filter', 'uses' => 'UserController@filter'));

//comments
Route::post('comment/createComment/{id}', array('as' => 'comments.createComment', 'uses' => 'CommentController@createComment'));
Route::post('comment/sendRequest/{id}', array('as' => 'comments.sendRequest', 'uses' => 'CommentController@sendRequest'));
Route::post('comment/approveContent/{id}', array('as' => 'editor.approveContent', 'uses' => 'EditorController@approveContent'));
Route::any('comment/rejectComment/{id}', array('as' => 'editor.rejectComment', 'uses' => 'EditorController@rejectComment'));
Route::any('comment/deleteComment/{id}', array('as' => 'editor.deleteComment', 'uses' => 'EditorController@deleteComment'));
Route::put('comment/refuse/{id}', array('as' => 'comments.refuse', 'uses' => 'CommentController@refuse'));

// Projectos
Route::get('projects/delete/{id}', array('as' => 'projects.delete', 'uses' => 'ProjectController@delete'));
Route::get('projects/review/{id}', array('as' => 'projects.review', 'uses' => 'ProjectController@review'));
Route::get('projects/approve/{id}', array('as' => 'projects.approve', 'uses' => 'ProjectController@approve'));


//media
Route::get('media/approve/{id}', array('as' => 'media.approve', 'uses' => 'MediaController@approve'));
Route::any('media/refuse/{id}', array('as' => 'media.refuse', 'uses' => 'MediaController@refuse'));
Route::get('media/submit/{id}', array('as' => 'media.submit', 'uses' => 'MediaController@submit'));
Route::get('media/createMedia/{id}', array('as' => 'media.createMedia', 'uses' => 'MediaController@createMedia'));

//editor
Route::post('editor/tagsPanel/', array('as' => 'editor.tagsPanel', 'uses' => 'EditorController@tagsPanel'));
Route::post('editor/projectsPanel/', array('as' => 'editor.projectsPanel', 'uses' => 'EditorController@projectsPanel'));





