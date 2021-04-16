<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Lojas extends Model
{
    protected $fillable = ['nome','cnpj','endereco','bairro','cidade','estado'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'lojas';

    public static function cadastro_lojas(){
        //Inclui uma Loja no Banco de Dados

        $loja = new Lojas; //Usando a model Lojas
        $loja->nome = request('nome');
        $loja->cnpj = request('cnpj');
        $loja->endereco = request('endereco');
        $loja->bairro = request('bairro');
        $loja->cidade = request('cidade');
        $loja->cep = request('cep');
        $loja->estado = request('estado');
        $salvar=$loja->save();
           
        if($salvar){
            return true;                 
        }else{
            return false; 
        }
        
    }

    public static function editar_lojas(){
        //Altera uma Loja no Banco de Dados

        $loja  = new Lojas;
		$editar = $loja->find(request('id'));      

        if($editar){
            //Alterando
            $editar->nome = request('nome');
            $editar->cnpj = request('cnpj');  
            $editar->endereco = request('endereco');
            $editar->bairro = request('bairro'); 
            $editar->cidade = request('cidade');
            $editar->cep = request('cep');   
            $editar->estado = request('estado');
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

    public static function deletar_lojas($id){
        $loja  = new Lojas;
		$excluir = $loja->find($id);      
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

    public static function cadastro_lojas_api(){
        //Inclui uma Loja no Banco de Dados [API]
              
        //Verificação de dados
        //Todos os dados
        if(!request('cep') || !request('nome') || !request('cnpj') || !request('endereco') || !request('bairro')  || !request('cidade') || !request('estado')){
            return response()->json([ 'status' => 0, 'mensagem' => 'O formul&aacute;rio n&atilde;o est&aacute; preenchido por completo para o cadastro!' ]); 
        }

        if(strlen(request('cep'))>9){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cep] muito extenso' ]); }
        if(strlen(request('cep'))<9){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cep] inv&aacute;lido' ]); }
        if(strlen(request('nome'))>49){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [nome] muito extenso' ]); }
        if(strlen(request('endereco'))>65){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [endereco] muito extenso' ]); }
        if(strlen(request('bairro'))>35){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [bairro] muito extenso' ]); }
        if(strlen(request('cidade'))>45){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cidade] muito extenso' ]); }

        //Estado - Sigla
        if(request('estado')!='AC' && request('estado')!='AL' && request('estado')!='AP' && request('estado')!='AM' && request('estado')!='BA' && request('estado')!='CE' && request('estado')!='DF' && request('estado')!='ES' && request('estado')!='GO' && request('estado')!='MA' && request('estado')!='MT' && request('estado')!='MS' && request('estado')!='MG' && request('estado')!='PA' && request('estado')!='PB' && request('estado')!='PR' && request('estado')!='AC' && request('estado')!='PE' && request('estado')!='PI' && request('estado')!='RJ' && request('estado')!='RN' && request('estado')!='RS' && request('estado')!='RO' && request('estado')!='RR' && request('estado')!='SC' && request('estado')!='SP' && request('estado')!='SE' && request('estado')!='TO'){
            return response()->json([ 'status' => 0, 'mensagem' => 'Sigla de estado Inv&aacute;lida!' ]);
        }

        //CNPJ - Só Números
        if(strlen(request('cnpj'))>14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cnpj] inv&aacute;lido - muito extenso' ]); }
        if(strlen(request('cnpj'))<14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cnpj] inv&aacute;lido' ]); }
        $newcnpj=substr(request('cnpj'),0,2).'.'.substr(request('cnpj'),2,3).'.'.substr(request('cnpj'),5,3).'/'.substr(request('cnpj'),8,4).'-'.substr(request('cnpj'),12,2);

        //Verificando se já existe esse cnpj        
        $ncnpj  = new Lojas;
        $cnpj_res = $ncnpj->where('cnpj', '=', $newcnpj)->get();
        if($cnpj_res->count()>0){
            return response()->json([ 'status' => 0, 'mensagem' => 'Cnpj j&aacute; existente!' ]);
        }

        $loja = new Lojas; //Usando a model Lojas
        $loja->nome = request('nome');
        $loja->cnpj = $newcnpj;
        $loja->endereco = request('endereco');
        $loja->bairro = request('bairro');
        $loja->cidade = request('cidade');
        $loja->cep = request('cep');
        $loja->estado = request('estado');
        $salvar=$loja->save();
                   
        if($salvar){
            return response()->json(  [ 'status' => 1, 'mensagem' => 'Loja cadastrada com sucesso' ]  );                 
        }else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Erro ao cadastrar a loja' ]  );   
        }
    }

    
    public static function alteracao_lojas_api($id){
        //Altera uma Loja no Banco de Dados [API]

        //Verificação de dados

        //Todos os dados
        if(!request('cep') && !request('nome') && !request('cnpj') && !request('endereco') && !request('bairro') && !request('cidade') && !request('estado')){
            return response()->json([ 'status' => 0, 'mensagem' => 'Nenhum dado foi alterado!' ]);
        }

        if(request('cep')){
            if(strlen(request('cep'))>9){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cep] muito extenso' ]); }
            if(strlen(request('cep'))<9){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cep] inv&aacute;lido' ]); }
        }
        if(strlen(request('nome'))>49){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [nome] muito extenso' ]); }       
        if(strlen(request('endereco'))>65){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [endereco] muito extenso' ]); }
        if(strlen(request('bairro'))>35){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [bairro] muito extenso' ]); }
        if(strlen(request('cidade'))>45){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cidade] muito extenso' ]); }

        //Estado - Sigla
        if(request('estado')){
            if(request('estado')!='AC' && request('estado')!='AL' && request('estado')!='AP' && request('estado')!='AM' && request('estado')!='BA' && request('estado')!='CE' && request('estado')!='DF' && request('estado')!='ES' && request('estado')!='GO' && request('estado')!='MA' && request('estado')!='MT' && request('estado')!='MS' && request('estado')!='MG' && request('estado')!='PA' && request('estado')!='PB' && request('estado')!='PR' && request('estado')!='AC' && request('estado')!='PE' && request('estado')!='PI' && request('estado')!='RJ' && request('estado')!='RN' && request('estado')!='RS' && request('estado')!='RO' && request('estado')!='RR' && request('estado')!='SC' && request('estado')!='SP' && request('estado')!='SE' && request('estado')!='TO'){
                return response()->json([ 'status' => 0, 'mensagem' => 'Sigla de estado Inv&aacute;lida!' ]);
            }
        }

        //CNPJ - Só Números
        if(request('cnpj')){
            if(strlen(request('cnpj'))>14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cnpj] inv&aacute;lido - muito extenso' ]); }
            if(strlen(request('cnpj'))<14){ return response()->json([ 'status' => 0, 'mensagem' => 'Campo [cnpj] inv&aacute;lido' ]); }
        }
       
        $loja  = new Lojas;

       
		$editar = $loja->find($id);  
      
        if($editar){
            //Alterando           
            $input = Input::all(); //Retorna um array tudo que foi enviado
            $editar->fill($input);  //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
         
            $salvar=$editar->save();
            if($salvar){
                return response()->json(  [ 'status' => 1, 'mensagem' => 'Loja alterada com sucesso' ]  );                 
            }else{
                return response()->json(  [ 'status' => 0, 'mensagem' => 'Erro ao alterar a loja' ]  );  
            }
        }else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'Id não encontrado ou inválido!' ]  );
        }     
            
    }

    public static function listagem_lojas_api(){
        //Lista as lojas do Banco de Dados [API]

        $loja  = new Lojas;
		$todas_lojas =  $loja->all();
        if($todas_lojas->count()>0){
            return response()->json(  [ 'status' => 1, 'lista' => $todas_lojas ]  );        
        }else{
            return response()->json(  [ 'status' => 0, 'mensagem' => 'N&atilde;o existe lojas cadastrados nesta tabela!' ]  );        
        }      
        
    }
}