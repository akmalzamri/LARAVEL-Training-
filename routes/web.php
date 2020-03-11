<?php

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
});

Auth::routes();


Route::group(['middleware' => 'auth:web'], function () {

    
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('tasks', 'TaskController@getlist');
        Route::get('tasks/create', 'TaskController@createform');
        Route::post('tasks/create', 'TaskController@create');
        Route::get('tasks/excel', 'TaskController@getListExcel');

        // id kne letak di bawah supaya die baca tempat kite nk pergi tu melalui id lu
        Route::get('tasks/{id}', 'TaskController@ViewTask');
        Route::delete('tasks/{id}', 'TaskController@DeleteTask');        
        Route::get('tasks/{id}/view-pdf', 'TaskController@getViewTaskPdf');        

        Route::get('user/profile', 'ProfileController@Profile');
        Route::post('user/profile', 'ProfileController@UpdateProfile');




});