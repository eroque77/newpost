<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Usuarios extends Model
{    
    protected $fillable = ['nome','telefone','email','senha','loja','classificacao'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'usuarios';

    public static function cadastro_usuarios(){
        //Inclui um Usuário no Banco de Dados
        
        $usuario = new Usuarios; //Usando a model Usuarios
        $usuario->nome = request('nome');
        $usuario->telefone = request('telefone');
        $usuario->email = request('email');
        $usuario->senha = Hash::make(request('senha')); 
        $usuario->classificacao = request('classificacao');
        $usuario->loja = request('loja');        
        $salvar=$usuario->save();
           
        if($salvar){
            return true;                 
        }else{
            return false; 
        }
    }

    public static function editar_usuarios(){
        //Altera um Usuário no Banco de Dados

        $usuario  = new Usuarios;
		$editar = $usuario->find(request('id'));      

        if($editar){
            //Alterando
            $editar->nome = request('nome');
            $editar->telefone = request('telefone');  
            $editar->email = request('email');
            $editar->senha = Hash::make(request('senha')); 
            $editar->classificacao = request('classificacao');
            $editar->loja = request('loja');        
            $salvar=$editar->save();
            if($salvar){
                return true;                 
            }else{
                return false; 
            }
        }else{
            return false;
        }        
    }

    public static function deletar_usuarios($id){
        $usuario  = new Usuarios;
		$excluir = $usuario->find($id);      
        if($excluir){
            $deletar=$excluir->delete();
            if($deletar){
                return true;                 
            }else{
                return false; 
            }
        }else{
            return false;
        } 
    }


    //------------------------------------------------------------------------------
    //API

    //Token
    public static function validaToken()
    {
        $token = '03fc543b64b6d346f07944515b1035f15c7f20fc6b034b9858d3464dd6a2423e';
        if(request('token') == $token){
            return true;
        } else{
            return false;
        }
    }

    public static function cadastro_usuarios_api(){
        //Inclui um Usuário no Banco de Dados [API]
        
        //Verificação de dados
        //Todos os dados
        if(!request('nome') || !request('telefone') || !request('email') || !request('senha') || !request('loja') || !request('classificacao')){
            return response()->json([ 'status' => 0, 'mensagem' => 'O formulário não está preenchido por completo para o cadastro!' ]); 
        }

        if(strlen(request('nome'))>80){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [nome] muito extenso' ]); }
        if(strlen(request('telefone'))>14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [telefone] muito extenso' ]); }
        if(strlen(request('telefone'))<14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [telefone] inválido' ]); }
        if(strlen(request('email'))>80){          
            return response()->json([ 'status' => 0, 'mensagem' => 'Campo [e-mail] muito extenso' ]);         
        }
        //Validando E-mail        
        if(filter_var(request('email'), FILTER_VALIDATE_EMAIL)){}else{return response()->json([ 'status' => 0, 'mensagem' => 'Campo [e-mail] inválido!' ]);}
        if(strlen(request('senha'))>10){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [senha] muito extenso' ]); }

        //Lojas
        $loja  = new Lojas;
        $loja_res = $loja->where('id', '=', request('loja'))->get();
        if($loja_res->count()==0){
            return response()->json([ 'status' => 0, 'mensagem' => 'Loja não encontrada na tabela: Lojas' ]);
        }

        //Classificação
        if(request('classificacao')!='Gerente' && request('classificacao')!='Administrador' && request('classificacao')!='Usuário Comum'){
            return response()->json([ 'status' => 0, 'mensagem' => 'Tipo de Usuário Inválido! [Classificação]' ]);
        }
        
        $usuario = new Usuarios; //Usando a model Usuarios
        $usuario->nome = request('nome');
        $usuario->telefone = request('telefone');
        $usuario->email = request('email');
        $usuario->senha = Hash::make(request('senha')); 
        $usuario->classificacao = request('classificacao');
        $usuario->loja = request('loja');        
        $salvar=$usuario->save();
           
        if($salvar){
            return response()->json(  [ 'status' => 1, 'mensagem' => 'Usuário cadastrado com sucesso' ]  );                 
        }else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Erro ao cadastrar o usuário' ]  );   
        }
    }

    
    public static function alteracao_usuarios_api($id){
        //Altera um Usuário no Banco de Dados [API]

         //Verificação de dados

        //Todos os dados
        if(!request('nome') && !request('telefone') && !request('email') && !request('senha') && !request('loja') && !request('classificacao')){
            return response()->json([ 'status' => 0, 'mensagem' => 'Nenhum dado foi alterado!' ]); 
        }

         if(strlen(request('nome'))>80){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [nome] muito extenso' ]); }
         
         if(request('telefone')){ 
            if(strlen(request('telefone'))>14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [telefone] muito extenso' ]); }
            if(strlen(request('telefone'))<14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [telefone] inválido' ]); }
         }
         if(strlen(request('email'))>80){          
             return response()->json([ 'status' => 0, 'mensagem' => 'Campo [e-mail] muito extenso' ]);         
         }
         //Validando E-mail     
         if(request('email')){ 
            if(filter_var(request('email'), FILTER_VALIDATE_EMAIL)){}else{return response()->json([ 'status' => 0, 'mensagem' => 'Campo [e-mail] inválido!' ]);}
         }
         if(strlen(request('senha'))>10){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [senha] muito extenso' ]); }
 
         //Lojas
         if(request('loja')){ 
            $loja  = new Lojas;
            $loja_res = $loja->where('id', '=', request('loja'))->get();
            if($loja_res->count()==0){
                return response()->json([ 'status' => 0, 'mensagem' => 'Loja não encontrada na tabela: Lojas' ]);
            }
         }
 
         //Classificação
         if(request('classificacao')){ 
            if(request('classificacao')!='Gerente' && request('classificacao')!='Administrador' && request('classificacao')!='Usuário Comum'){
                return response()->json([ 'status' => 0, 'mensagem' => 'Tipo de Usuário Inválido! [Classificação]' ]);
            }
         }     

        $usuario  = new Usuarios;
		$editar = $usuario->find($id);     
      
        if($editar){
            //Alterando           
            $input = Input::all(); //Retorna um array tudo que foi enviado
            $editar->fill($input);  //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
         
            $salvar=$editar->save();
            if($salvar){
                return response()->json(  [ 'status' => 1, 'mensagem' => 'Usuário alterado com sucesso' ]  );                 
            }else{
                return response()->json(  [ 'status' => 0, 'mensagem' => 'Erro ao alterar o usuário' ]  );  
            }
        }      
        else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Id não encontrado ou inválido!' ]  );
        }       
    }

    public static function listagem_usuarios_api(){
        //Lista os usuários Banco de Dados [API]

        $usuario  = new Usuarios;
		$todos_usuarios =  $usuario->all();
        if($todos_usuarios->count()>0){
            return response()->json(  [ 'status' => 1, 'lista' => $todos_usuarios ]  );        
        }else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Não existe usuários cadastrados nesta tabela!' ]  );        
        }      
        
    }
}