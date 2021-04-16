<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//Carregando as Models
use App\Usuarios;
use App\Lojas;

class ApiController extends Controller
{       
    //USUÁRIOS-----------------------------------------------------------------------------
    
    //Inclusão
    public function cadastro_usuarios_api(Request $request){       
        if( !Usuarios::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Usuarios::cadastro_usuarios_api();   
        }
    } 

    //Alteração
    public function alteracao_usuarios_api(Request $request){ 
        if( !Usuarios::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Usuarios::alteracao_usuarios_api($request->id);           
        }
    } 

     //Listagem
     public function listagem_usuarios_api(Request $request){ 
        if( !Usuarios::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Usuarios::listagem_usuarios_api();        
        }
    }

    //LOJAS--------------------------------------------------------------------------------
    
    //Inclusão
    public function cadastro_lojas_api(Request $request){       
        if( !Lojas::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Lojas::cadastro_lojas_api();   
        }
    } 

    //Alteração
    public function alteracao_lojas_api(Request $request){ 
        if( !Lojas::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Lojas::alteracao_lojas_api($request->id);           
        }
    } 

     //Listagem
     public function listagem_lojas_api(Request $request){ 
        if( !Lojas::validaToken() ){
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Token inválido' ]  );
        } else {
            return Lojas::listagem_lojas_api();        
        }
    }
}