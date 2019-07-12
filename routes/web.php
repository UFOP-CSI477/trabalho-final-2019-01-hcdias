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


Route::get('/admin/login','Auth\LoginController@showLoginForm')->name('admin_login');
Route::post('/admin/login','Auth\LoginController@login')->name('admin_login_submit');
Route::post('/admin/logout','Auth\LoginController@logout')->name('admin_logout');

Route::get('/', 'HomeController@exibir')->name('index');
Route::post('/resultados', 'HomeController@pesquisar')->name('exibir_resultados');
Route::get('/resultados', 'HomeController@exibir');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', [
	'as'=>'login',
	'uses'=>'Auth\MinhaUfopLoginController@showLoginUfop'
]);
Route::post('/login', [
	'as'=>'minhaufop_login_submit',
	'uses'=>'Auth\MinhaUfopLoginController@login'
]);

Route::post('/logout', [
	'as'=>'minhaufop_logout_submit',
	'uses'=>'Auth\MinhaUfopLoginController@logout'
]);

Route::group(['prefix'=>'pesquisa'],function(){
	Route::get('/visualizar-pesquisa', [
		'as'=>'visualizar_pesquisas',
		'uses'=>'PesquisaController@index',
		'roles'=>['admin','professor','aluno'],
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
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/salvar-pesquisa', [
		'as'=>'salvar_pesquisa',
		'uses'=>'PesquisaController@store',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/editar-pesquisa/{id}', [
		'as'=>'editar_pesquisa',
		'uses'=>'PesquisaController@edit',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/atualizar-pesquisa/{id}', [
		'as'=>'atualizar_pesquisa',
		'uses'=>'PesquisaController@update',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/delete/{id}', [
		'as'=>'deletar_pesquisa',
		'uses'=>'PesquisaController@destroy',
		'roles'=>['admin','professor'],
		'middleware'=>'roles'
	]);
});

Route::group(['prefix'=>'tcc'],function(){
	Route::get('/visualizar-tcc', [
		'as'=>'visualizar_tcc',
		'uses'=>'TccController@index',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/visualizar-tcc-aluno', [
		'as'=>'visualizar_tcc_aluno',
		'uses'=>'TccController@showSingleTcc',
		'roles'=>['aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/criar-tcc', [
		'as'=>'criar_tcc',
		'uses'=>'TccController@create',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/detalhar-tcc/{id}',[
		'as'=>'detalhar_tcc',
		'uses'=> 'TccController@show',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/salvar-tcc', [
		'as'=>'salvar_tcc',
		'uses'=>'TccController@store',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/editar-tcc/{id}', [
		'as'=>'editar_tcc',
		'uses'=>'TccController@edit',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/atualizar-tcc/{id}', [
		'as'=>'atualizar_tcc',
		'uses'=>'TccController@update',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);
	Route::get('/delete/{id}', [
		'as'=>'deletar_tcc',
		'uses'=>'TccController@destroy',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);
});

Route::group(['prefix'=>'proposta-tcc'],function(){
	Route::get('/visualizar-proposta', [
		'as'=>'visualizar_proposta',
		'uses'=>'TccPropostaController@index',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);


	Route::get('/criar-proposta-tcc', [
		'as'=>'criar_proposta_tcc',
		'uses'=>'TccPropostaController@create',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);	

	Route::post('/salvar-proposta-tcc', [
		'as'=>'salvar_proposta_tcc',
		'uses'=>'TccPropostaController@store',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);		

	Route::get('/editar-proposta/{proposta}', [
		'as'=>'editar_proposta_tcc',
		'uses'=>'TccPropostaController@edit',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);	

	Route::get('/detalhar-proposta/{proposta}', [
		'as'=>'detalhar_proposta_tcc',
		'uses'=>'TccPropostaController@show',
		'roles'=>['admin','aluno','professor'],
		'middleware'=>'roles'
	]);	

	Route::get('/visualizar-proposta-professor', [
		'as'=>'visualizar_proposta_professor',
		'uses'=>'TccPropostaController@showPropostasProfessor',
		'roles'=>['admin','professor'],
		'middleware'=>'roles'
	]);	
	
	Route::post('/atualizar-proposta-professor/{proposta}', [
		'as'=>'atualizar_proposta_professor',
		'uses'=>'TccPropostaController@updatePropostaProfessor',
		'roles'=>['admin','professor'],
		'middleware'=>'roles'
	]);	

	Route::post('/atualizar-proposta-tcc/{proposta}', [
		'as'=>'atualizar_proposta_tcc',
		'uses'=>'TccPropostaController@update',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);		

	Route::get('/area-interesse-professor/{id}', [
		'as'=>'area_interesse_professor',
		'uses'=>'TccPropostaController@areaInteresseProfessor',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);		

	Route::get('/delete/{id}', [
		'as'=>'deletar_proposta_tcc',
		'uses'=>'TccPropostaController@destroy',
		'roles'=>['admin','aluno'],
		'middleware'=>'roles'
	]);		
});

Route::group(['prefix'=>'usuario'],function(){
	Route::get('/visualizar-usuario', [
		'as'=>'visualizar_usuario',
		'uses'=>'UserController@index',
		'roles'=>'admin',
		'middleware'=>'roles'
	]);

	Route::get('/criar-usuario', [
		'as'=>'criar_usuario',
		'uses'=>'UserController@create',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::post('/salvar-usuario', [
		'as'=>'salvar_usuario',
		'uses'=>'UserController@store',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::post('/salvar-perfil', [
		'as'=>'salvar_perfil',
		'uses'=>'UserController@storeProfilePicture',
		'roles'=>['admin','professor', 'aluno'],
		'middleware'=>'roles'
		]);

	Route::get('/editar-usuario/{id}', [
		'as'=>'editar_usuario',
		'uses'=>'UserController@edit',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::post('/alterar-usuario/{id}', [
		'as'=>'alterar_usuario',
		'uses'=>'UserController@update',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::get('/remover-usuario/{id}', [
		'as'=>'remover_usuario',
		'uses'=>'UserController@destroy',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::get('/vinculo-usuario/{id}', [
		'as'=>'vinculo_usuario',
		'uses'=>'UserController@listaAtores',
		'roles'=>'admin',
		'middleware'=>'roles'
		]);

	Route::get('/meu-perfil/', [
		'as'=>'meu_perfil',
		'uses'=>'UserController@show',
		'roles'=>['admin', 'professor', 'aluno'],
		'middleware'=>'roles'
		]);

	Route::post('/store-token', [
		'as'=>'store_token',
		'uses'=>'UserController@storeProfileToken',
		'roles'=>['admin','professor', 'aluno'],
		'middleware'=>'roles'
		]);	
});

Route::group(['prefix'=>'mestrado'],function(){
	Route::get('/visualizar-mestrado', [
		'as'=>'visualizar_mestrado',
		'uses'=>'MestradoController@index',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/criar-mestrado', [
		'as'=>'criar_mestrado',
		'uses'=>'MestradoController@create',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/detalhar-mestrado/{id}',[
		'as'=>'detalhar_mestrado',
		'uses'=> 'MestradoController@show',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/salvar-mestrado', [
		'as'=>'salvar_mestrado',
		'uses'=>'MestradoController@store',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/editar-mestrado/{id}', [
		'as'=>'editar_mestrado',
		'uses'=>'MestradoController@edit',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/atualizar-mestrado/{id}', [
		'as'=>'atualizar_mestrado',
		'uses'=>'MestradoController@update',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);
	Route::get('/delete/{id}', [
		'as'=>'deletar_tcc',
		'uses'=>'MestradoController@destroy',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);
});

Route::group(['prefix'=>'extensao'],function(){
	Route::get('/visualizar-extensao', [
		'as'=>'visualizar_extensao',
		'uses'=>'ExtensaoController@index',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/criar-extensao', [
		'as'=>'criar_extensao',
		'uses'=>'ExtensaoController@create',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/detalhar-extensao/{id}',[
		'as'=>'detalhar_extensao',
		'uses'=> 'ExtensaoController@show',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/salvar-extensao', [
		'as'=>'salvar_extensao',
		'uses'=>'ExtensaoController@store',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::get('/editar-extensao/{id}', [
		'as'=>'editar_extensao',
		'uses'=>'ExtensaoController@edit',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);

	Route::post('/atualizar-extensao/{id}', [
		'as'=>'atualizar_extensao',
		'uses'=>'ExtensaoController@update',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);
	Route::get('/delete/{id}', [
		'as'=>'deletar_tcc',
		'uses'=>'ExtensaoController@destroy',
		'roles'=>['admin','professor','aluno'],
		'middleware'=>'roles'
	]);
});


