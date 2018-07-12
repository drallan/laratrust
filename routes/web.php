<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth:web'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('clients', 'ClientController');
});
