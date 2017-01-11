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

/**
 * Directory
 *  / = home
 *  /todos - all list
 *  /todos/1 - show
 *  /todos/1/edit - edit and update
 *  /todos/create - create new list
 */

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

    Route::post('create',[
        'uses' => 'QuotesController@postQuotes',
        'as' => 'create',
        ]);
    Route::get('/{author}',[
        'uses' => 'QuotesController@getIndex',
        'as' => 'index'
        ]);
    Route::get('delete/{quote_id}',[
        'uses' => 'QuotesController@getDeleteQuote',
        'as'=> 'delete'
        ]);
    Route::get('/',[
        'uses' => 'QuotesController@getIndex',
        'as' => 'index2'
        ]);
    Route::get('/admin/login',[
        'uses'=> 'AdminController@getLogin',
        'as'=> 'admin.login'
        ]);
     Route::post('/admin/login',[
        'uses'=> 'AdminController@postLogin',
        'as'=> 'admin.loginpost'
        ]);
     Route::get('/admin/dashboard',[
        'uses'=> 'AdminController@getDashboard',
        'as'=> 'admin.dashboard'
        ]);
     Route::get('/admin/logout',[
        'uses' => 'AdminController@getLogout',
        'as'=>'admin.logout'
        ]);

});



