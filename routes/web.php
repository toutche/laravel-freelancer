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


Route::get('/', 'Site\User\UserController@login');


Route::group(['namespace' => 'Site'], function(){
	Route::get('/login/{token?}', 'User\UserController@login');
	Route::post('/login/{token?}', 'User\UserController@postLogin');
	Route::get('/perfil/logout', 'User\UserController@logout');

	Route::post('/perfil/resetar/senha', 'User\PasswordResetController@resetPassword');
	Route::get('/perfil/resetar/senha/{token}', 'User\PasswordResetController@getResetPassword');
	Route::post('/perfil/resetar/senha/{token}', 'User\PasswordResetController@postResetPassword');

	Route::post('/perfil/registrar', 'User\UserController@postRegister');
	Route::get('/perfil/complemento-perfil', 'User\ComplementInformations\ComplementInformationsController@complementRegisterPerfil');
	Route::post('/perfil/complemento-perfil/envio', 'User\ComplementInformations\ComplementInformationsController@postComplementRegisterPerfil');
});

Route::group(['namespace' => 'Ajax'], function(){
	Route::post('/session/get', 'SessionController@getSessionValueByName');
	Route::post('/session/set', 'SessionController@setSessionValueByName');
	Route::post('/cursos', 'CourseController@index'); 
});