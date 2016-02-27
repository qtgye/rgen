<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



// Front End

Route::get('/','PagesController@home');
Route::get('about','PagesController@about');
Route::get('services','PagesController@services');
Route::get('technologies','PagesController@technologies');
Route::get('projects','PagesController@projects');
Route::get('news','PagesController@news');


// Auth

Route::group(['prefix'=>'auth'],function ()
{
    // Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    // Route::get('register', 'Auth\AuthController@getRegister');
    // Route::post('register', 'Auth\AuthController@postRegister');
});


// Admin Pages

Route::group( ['prefix'=>'admin', 'middleware' => ['web','auth']], function ()
{
    // specific routes
    Route::get('info','AdminPagesController@info');

    // common routes
	Route::get('/','AdminPagesController@home');
	Route::get('{model_name}','AdminPagesController@index');
    Route::get('{model_name}/new','AdminPagesController@create');
    Route::get('{model_name}/{id}','AdminPagesController@show');

    Route::post('{model_name}/{id}','AdminPagesController@update');

    // store
    Route::post('media','MediaController@store');    
    Route::post('product','ProductsController@store');
    Route::post('partner','PartnersController@store');
    Route::post('faq','FAQsController@store');
    Route::post('news','NewsController@store');
    Route::post('project','ProjectsController@store');
    Route::post('info','InfosController@update');
});


// AJAX endpoints

Route::group( ['prefix'=>'api', 'middleware' => ['web']], function ()
{
    Route::resource('media', 'MediaController');
    Route::resource('product', 'ProductsController');
    Route::resource('partner', 'PartnersController');
    Route::resource('faq', 'FAQsController');
    Route::resource('news', 'NewsController');
    Route::resource('project', 'ProjectsController');
    Route::resource('info', 'InfosController');
    Route::post('get_upload_limit', 'AdminPagesController@get_upload_limit');
});








/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
});
