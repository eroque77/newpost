<?php

use Illuminate\Http\Request;

//Usuários
Route:: post('/cadastro_usuarios_api','ApiController@cadastro_usuarios_api')->name('cadastro_usuarios_api'); 
Route:: put('/alteracao_usuarios_api/{id}','ApiController@alteracao_usuarios_api')->name('alteracao_usuarios_api'); 
Route:: get('/listagem_usuarios_api','ApiController@listagem_usuarios_api')->name('listagem_usuarios_api'); 

//Lojas
Route:: post('/cadastro_lojas_api','ApiController@cadastro_lojas_api')->name('cadastro_lojas_api'); 
Route:: put('/alteracao_lojas_api/{id}','ApiController@alteracao_lojas_api')->name('alteracao_lojas_api'); 
Route:: get('/listagem_lojas_api','ApiController@listagem_lojas_api')->name('listagem_lojas_api'); 