<?php

use App\Autopart;
use App\LCM;

Route::get('ingresar', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('ingresar', 'Auth\LoginController@login');
Route::post('salir', 'Auth\LoginController@logout')->name('logout');

Route::get('contrasenia/recuperar', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('contrasenia/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('contrasenia/recuperar/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('contrasenia/recuperar', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'AppController@index')->name('home')->middleware('auth');

Route::post('/homologar/empezar', 'HomologarController@empezar');
Route::post('/homologar/finalizar', 'HomologarController@finalizar');

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
        'licencias'    => 'CertificateController',
        'lcms'         => 'LCMController',
        'ncm'          => 'NCMController',
    ]);

    Route::get('/trazas/crear/{tipo}', 'TrazaController@create');
    Route::get('/trazas/{id}/exportar', 'TrazaController@export')->name('trazas.export');
    Route::resource('trazas', 'TrazaController')->except(['create']);

    Route::get('/perfil', 'AccountController@index')->name('perfil.index');
    Route::put('/perfil/{usuario}', 'AccountController@update')->name('perfil.update');

    Route::get('/contrasenia/cambiar', 'PasswordController@index')->name('cambiarpassword.index');
    Route::put('/contrasenia/cambiar/{usuario}', 'PasswordController@update')->name('cambiarpassword.update');

    Route::post('/subir/imagenes', 'UploadController@store');
    // Route::post('/importar/licencias', 'ImportController@certificates')->name('import.certificates');
    Route::post('/importar/autopartes', 'ImportController@autoparts')->name('import.autoparts');
    // Route::post('/importar/licencias', 'CertificatesImportController')->name('import.certificates');
    // Route::post('/importar/autopartes', 'AutopartsImportController')->name('import.autoparts');

    Route::post('/importar/cape', 'CAPEImportController')->name('import.cape');
    Route::post('/importar/chas-nacional', 'CHASNacionalImportController')->name('import.chas-nacional');
    Route::post('/importar/chas-extranjera', 'CHASExtranjeraImportController')->name('import.chas-extranjera');
    Route::post('/importar/excepcion-chas', 'ExcepcionCHASImportController')->name('import.excepcion-chas');
    Route::post('/importar/aprobar-extranjera', 'AprobarExtranjeraController')->name('import.aprobar-extranjera');
});

// esto provisoriamente acá
Route::get('{qr}', function ($qr) {
    $lcm = LCM::findByCAPE($qr);
    if ($lcm) return $lcm;

    $autopart = Autopart::findByCHAS($qr);
    if ($autopart) return $autopart;

    abort(404);
});
