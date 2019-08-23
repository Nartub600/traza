<?php

Auth::routes();

Route::get('/', 'AppController@index')->name('home')->middleware('auth');

Route::group([
    'middleware' => [
        'auth',
        'role:administrador'
    ]
], function () {
    Route::resources([
        'usuarios'     => 'UserController',
        'grupos'       => 'GroupController',
        'perfiles'     => 'RoleController',
        'productos'    => 'ProductController',
        'autopartes'   => 'AutopartController',
        'certificados' => 'CertificateController',
        'uploads'      => 'UploadController'
    ]);
});
