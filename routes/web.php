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

Route::group(['namespace' => 'Site'], function(){
	Route::get('/login', 'UserController@login');
	Route::post('/login', 'UserController@postLogin');
	Route::get('/perfil/logout', 'UserController@logout');

	Route::post('/perfil/resetar/senha', 'User\PasswordResetController@resetPassword');
	Route::get('/perfil/resetar/senha/{token}', 'User\PasswordResetController@getResetPassword');
	Route::post('/perfil/resetar/senha/{token}', 'User\PasswordResetController@postResetPassword');

	Route::post('/perfil/registrar', 'UserController@postRegister');
	Route::get('/perfil/complemento-perfil', 'UserController@complementRegisterPerfil');
	Route::post('/perfil/complemento-perfil/envio', 'UserController@postComplementRegisterPerfil');
});