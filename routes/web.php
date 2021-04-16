<?php

//Rota: Menu Principal
Route::get('/', 'StartController@manager')->name('start');

//Menus
    //Usuários:
    Route:: get('/cadastro_usuarios', 'MenuController@cadastro_usuarios')->name('cadastro_usuarios'); 
    Route:: get('/listagem_usuarios','MenuController@listagem_usuarios')->name('listagem_usuarios'); 
    Route:: post('/incluir_usuarios', 'MenuController@incluir_usuarios')->name('incluir_usuarios'); 
    Route:: get('/alterar_usuarios/{id}','MenuController@alterar_usuarios')->name('alterar_usuarios'); 
    Route:: post('/editar_usuarios','MenuController@editar_usuarios')->name('editar_usuarios');
    Route:: get('/excluir_usuarios/{id}','MenuController@excluir_usuarios')->name('excluir_usuarios'); 

    //Datatables
    Route:: get('/listar_usuarios_datatable','MenuController@listar_usuarios_datatable')->name('listar_usuarios_datatable'); 
    Route:: get('/listar_lojas_datatable','MenuController@listar_lojas_datatable')->name('listar_lojas_datatable'); 

    //Lojas:
    Route:: get('/cadastro_lojas','MenuController@cadastro_lojas')->name('cadastro_lojas'); 
    Route:: get('/listagem_lojas','MenuController@listagem_lojas')->name('listagem_lojas'); 
    Route:: post('/incluir_lojas', 'MenuController@incluir_lojas')->name('incluir_lojas'); 
    Route:: get('/alterar_lojas/{id}','MenuController@alterar_lojas')->name('alterar_lojas'); 
    Route:: post('/editar_lojas','MenuController@editar_lojas')->name('editar_lojas');
    Route:: get('/excluir_lojas/{id}','MenuController@excluir_lojas')->name('excluir_lojas'); 

    //Ajax:
    Route:: get('/verifica_cnpj/{id}','MenuController@verifica_cnpj')->name('verifica_cnpj');