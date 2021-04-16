<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//Datatables
use Yajra\Datatables\Datatables;

/*Datatables
   composer require yajra/laravel-datatables-oracle:"~7.0"
   composer require yajra/laravel-datatables-oracle:"~6.0"

   config / app.php

   'providers' => [  
      ....
      Yajra \ DataTables \ DataTablesServiceProvider :: class ,
   ]
   'aliases' => [  
      ....
      'DataTables' => Yajra 
*/

//Carregando as Models
use App\Usuarios;
use App\Lojas;
use DB;

class MenuController extends Controller
{
    //Controller responsável por Inserções e Listagens
    //Usuários
    public function cadastro_usuarios(){
        $lista_de_lojas = Lojas::select ('id','nome')->get();
        return view('cadastro_usuarios', compact('lista_de_lojas')); 
    } 

    public function incluir_usuarios(Request $request){
        $retorno = Usuarios::cadastro_usuarios();       
        if($retorno){
            return redirect()->route('cadastro_usuarios')->with('message', "Usuário cadastrado com sucesso!"); 
        }else{
            return redirect()->route('cadastro_usuarios')->with('message', "Erro ao cadastrar o Usuário!");
        } 
    } 

    public function alterar_usuarios($id){
        $lista_de_lojas = Lojas::select ('id','nome')->get();
        $response = Usuarios::where('id', '=', $id)->get();   //Id específico [Retorna todos os dados do id especifico]
        return view('cadastro_usuarios', compact('response','lista_de_lojas'));
    }


    public function editar_usuarios(Request $request){
        $retorno = Usuarios::editar_usuarios();       
        if($retorno){
            return redirect()->route('listagem_usuarios')->with('message', "Usuário alterado com sucesso!"); 
        }else{
            return redirect()->route('listagem_usuarios')->with('message', "Erro ao alterar o Usuário!");
        }    
    }


    //Listagem
    public function listagem_usuarios(){
        return view ('listagem_usuarios');     
    }

    public function listar_usuarios_datatable(){
        //Carrega uma lista de todos os Usuários
        return Datatables::of(Usuarios::select ('usuarios.id', 'usuarios.nome AS user','telefone', 'email', 'lojas.nome AS lojauser', 'classificacao')
                                        ->leftjoin('lojas', 'lojas.id', '=', 'usuarios.loja')       
                                        ->get())->make(true);    
    }

    //Exclusão
    public function excluir_usuarios($id){
        $retorno = Usuarios::deletar_usuarios($id);       
        if($retorno){
            return redirect()->route('listagem_usuarios')->with('message', "Usuário excluído com sucesso!"); 
        }else{
            return redirect()->route('listagem_usuarios')->with('message', "Erro ao excluir o Usuário!");
        } 
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------

    //Lojas
    public function cadastro_lojas(){
        return view('cadastro_lojas');
    } 

    public function incluir_lojas(Request $request){
        $retorno = Lojas::cadastro_lojas();       
        if($retorno){
            return redirect()->route('cadastro_lojas')->with('message', "Loja cadastrada com sucesso!"); 
        }else{
            return redirect()->route('cadastro_lojas')->with('message', "Erro ao cadastrar a loja!");
        } 
    } 

    public function alterar_lojas($id){
        $response = Lojas::where('id', '=', $id)->get();   //Id específico [Retorna todos os dados do id especifico]
        return view('cadastro_lojas', compact('response'));
    }

    public function editar_lojas(Request $request){
        $retorno = Lojas::editar_lojas();       
        if($retorno){
            return redirect()->route('listagem_lojas')->with('message', "Loja alterada com sucesso!"); 
        }else{
            return redirect()->route('listagem_lojas')->with('message', "Erro ao alterar a Loja!");
        }    
    }

    
    //Listagem
    public function listagem_lojas(){
        return view ('listagem_lojas');     
    }

    public function listar_lojas_datatable(){
        //Carrega uma lista de todas as Lojas
        return Datatables::of(Lojas::select ('id', 'nome','cnpj', 'endereco', 'bairro', 'cidade', (DB::raw("(SELECT distinct loja FROM usuarios WHERE usuarios.loja = lojas.id) AS vinculo")))
        ->get())->make(true); 
    }

    //Exclusão
    public function excluir_lojas($id){
        $retorno = Lojas::deletar_lojas($id);       
        if($retorno){
            return redirect()->route('listagem_lojas')->with('message', "Loja excluída com sucesso!"); 
        }else{
            return redirect()->route('listagem_lojas')->with('message', "Erro ao excluir a Loja!");
        } 
    }

    //Cnpj
    public function verifica_cnpj($cnpj){
        $newcnpj=substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);
        $busca = Lojas::where('cnpj', '=', $newcnpj)->get();
      
        if($busca->count()>0){
            return response()->json(  ['status' => '1' ]  );
        }else{
            return response()->json(  [ 'status' => '0' ]  );
        }
    }

}