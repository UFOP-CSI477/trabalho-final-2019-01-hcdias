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


Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/visualizar-pesquisa', [
	'as'=>'visualizar_pesquisas',
	'uses'=>'PesquisaController@index',
	'roles'=>'admin',
	'middleware'=>'roles'
	]);

Route::get('/criar-pesquisa', [
	'as'=>'criar_pesquisa',
	'uses'=>'PesquisaController@create',
	'roles'=>['admin','professor'],
	'middleware'=>'roles'
	]);

Route::get('/detalhar-pesquisa/{id}',[
	'as'=>'detalhar_pesquisa',
	'uses'=> 'PesquisaController@show',
	'roles'=>['admin','professor'],
	'middleware'=>'roles'
	]);

Route::post('/salvar-pesquisa', [
	'as'=>'salvar_pesquisa',
	'uses'=>'PesquisaController@store',
	'roles'=>['admin','professor'],
	'middleware'=>'roles'
	]);

Route::get('/editar-pesquisa/{id}', [
	'as'=>'editar_pesquisa',
	'uses'=>'PesquisaController@edit',
	'roles'=>['admin','professor'],
	'middleware'=>'roles'
	]);

Route::get('/visualizar-usuario', [
	'as'=>'visualizar_usuario',
	'uses'=>'UserController@index',
	'roles'=>'admin',
	'middleware'=>'roles'
	]);