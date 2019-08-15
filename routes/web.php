<?php

Auth::routes();

Route::get('/', 'AppController@index');

Route::group([
    'middleware' => ['auth', 'role:administrador']
], function () {
    Route::post('/user', 'UserController@store');
    Route::post('/group', 'GroupController@store');
    Route::post('/role', 'RoleController@store');
});

Route::get('/home', 'HomeController@index')->name('home');
