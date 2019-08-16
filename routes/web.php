<?php

Auth::routes();

Route::get('/', 'AppController@index')->name('home');

Route::group([
    'middleware' => ['auth', 'role:administrador']
], function () {
    Route::resources([
        'usuarios' => 'UserController',
        'grupos' => 'GroupController',
        'perfiles' => 'RoleController'
    ]);
});

// Route::get('/home', 'HomeController@index')->name('home');
