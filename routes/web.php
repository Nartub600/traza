<?php

Route::get('ingresar', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('ingresar', 'Auth\LoginController@login');
Route::post('salir', 'Auth\LoginController@logout')->name('logout');

Route::get('contrasenia/recuperar', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('contrasenia/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('contrasenia/recuperar/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('contrasenia/recuperar', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'AppController@index')->name('home')->middleware('auth');

Route::group([
    'middleware' => [
        'auth',
        // 'role:administrador'
    ]
], function () {
    Route::resources([
        'usuarios'     => 'UserController',
        'grupos'       => 'GroupController',
        'perfiles'     => 'RoleController',
        'productos'    => 'ProductController',
        'certificados' => 'CertificateController',
        'lcms'         => 'LCMController',
    ]);

    Route::get('/perfil', 'AccountController@index')->name('perfil.index');
    Route::put('/perfil/{usuario}', 'AccountController@update')->name('perfil.update');

    Route::get('/contrasenia/cambiar', 'PasswordController@index')->name('cambiarpassword.index');
    Route::put('/contrasenia/cambiar/{usuario}', 'PasswordController@update')->name('cambiarpassword.update');

    Route::post('/subir/imagenes', 'UploadController@store');
    Route::post('/importar/certificados', 'ImportController@certificates')->name('import.certificates');
    Route::post('/importar/autopartes', 'ImportController@autoparts')->name('import.autoparts');
});
