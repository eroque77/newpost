@extends ('layouts.estrutura')

<!-- Cadastro de Usuários -->

@section ('content')
    <div class='row'>
        <div class="col-md-8 col-md-offset-2" align="center">
            <div class="panel panel-default"> 
                @if (@!$response[0]['id'])
                    <div class="panel-heading" align='center'><b>Cadastro de Usuários</b></div>
                    @php ($rota = 'incluir_usuarios')
                @else
                    <div class="panel-heading" align='center'><b>Alteração de Usuários</b></div>
                    @php ($rota = 'editar_usuarios')
                @endif

                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route($rota)}}" onsubmit="document.getElementById('loading').style.display='inline'">
                        {{ csrf_field() }}

                        <div class="container">
                            <div class="row">
                                <div class='row'>
                                    <label class="col-md-2 control-label">*Nome</label>
                                    <div class="col-md-5">                                       
                                        <input id="nome" type="text" class="form-control" name="nome" required autofocus maxlength="49" autocomplete="nope" value="{{@$response[0]['nome']}}">
                                    </div>  
                                </div>

                                <div class='row'>
                                    <label class="col-md-2 control-label">*Telefone(Cel.)</label>
                                    <div class="col-md-2">
                                        <input id="telefone" type="text" onkeypress="MaskFoneCel(this)" onchange='checkcel(this)' class="form-control phone" placeholder='(XX)99999-9999' name="telefone" required autofocus maxlength="15" autocomplete="nope" value="{{@$response[0]['telefone']}}">                                       
                                    </div> 
                                    <div class="col-md-2" align='left' style='padding-top:10px'><span id='errotel' style='color:red'><b></b></span></div>
                                </div>
 
                                <div class='row'>
                                    <label class="col-md-2 control-label">*E-mail</label>
                                    <div class="col-md-4">
                                        <input id="email" type="text" onchange="validaEmail(this.value,this.id)" class="form-control" name="email" required autofocus maxlength="37" autocomplete="nope" value="{{@$response[0]['email']}}">
                                    </div> 
                                    <div class="col-md-2" align='left' style='padding-top:10px'><span id='erromail' style='color:red'><b></b></span></div>
                                </div>

                                <div class='row'>
                                    <label class="col-md-2 control-label">*Senha</label>
                                    <div class="col-md-2">
                                        <input id="senha" type="password" class="form-control" name="senha" required autofocus maxlength="10" autocomplete="nope" value="{{@$response[0]['senha']}}">
                                    </div> 
                                </div>

                                <div class='row'>                                 
                                    <label class="col-md-2 control-label">*Loja</label>
                                    <div class="col-md-4">                                       
                                        <select class="form-control" id="loja" name="loja" autofocus required > 
                                            <option value=''></option> 
                                            @foreach($lista_de_lojas as $lojas)                                                  
                                                <option {{@$response[0]['loja'] == $lojas->id ? 'selected' : '' }}  value="{{$lojas->id}}">{{$lojas->nome}}</option>
                                            @endforeach       
                                        </select>                                      
                                    </div>                               
                                </div>

                                <div class='row'>                                 
                                    <label class="col-md-2 control-label">*Classificação</label>
                                    <div class="col-md-2">                                         
                                        <select class="form-control" id="classificacao" name="classificacao" autofocus required>  
                                            <option value=''></option>
                                            <option value="Administrador">Administrador</option>   
                                            <option value="Gerente">Gerente</option> 
                                            <option value="Comum">Usuário Comum</option>                                        
                                        </select>    

                                        @if(@$response[0]['classificacao'])                                           
                                            <script>
                                                document.getElementById('classificacao').value="{{@$response[0]['classificacao']}}";
                                            </script>      
                                        @endif                              
                                    </div>                               
                                </div>
                        
                                <input id="id" name="id" type="hidden" value="{{@$response[0]['id']}}"> 

                                <div class="row">                         
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-warning" onclick="retornar()">
                                                Retornar
                                            </button>  
                                            
                                            <button type="submit" class="btn btn-success">
                                                @if(!@$response)                                               
                                                    Cadastrar                                                
                                                @else
                                                    Alterar
                                                    <input type='hidden' value='alt' name='tipo' id='tipo'>
                                                @endif
                                            </button>
                                        </div>
                                    </div>  
                                </div>                                   
                            </div>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-md-12' align='center' id='loading' style='display:none'> 
            @if (strstr($_SERVER["REQUEST_URI"], 'alterar'))
                <img src='../resources/assets/imagens/loading.gif' width='55' height='20' />
            @else
                <img src='resources/assets/imagens/loading.gif' width='55' height='20' />
            @endif
        </div>
    </div>   
@endsection

@if (strstr(session('message'), 'sucesso'))
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:#98FB98;color:black;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='resources/assets/imagens/logo.png' width='50' height='35' />{{ session('message') }}
        </div>
    </div>    
@endif
@if (strstr(session('message'), 'Erro'))
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:red;color:white;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='resources/assets/imagens/logo.png' width='50' height='35' />{{ session('message') }}
        </div>
    </div>  
@endif

@push ('scripts')
    <script>        
        function retornar(){
            if($('#tipo').val()=='alt'){
                window.location="{{ route('listagem_usuarios') }}";
                return false;
            }else{
                window.location="{{ route('start') }}";       
            }
        }

        function validaEmail(email,id){
            x=email;
            var atpos=x.indexOf("@");
            var dotpos=x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
            {
                document.getElementById('erromail').innerHTML='Inválido!';
                document.getElementById(id).value='';
                document.getElementById(id).focus();     
            }else{
                document.getElementById('erromail').innerHTML='';
                return true;   
            }
        }  

        function MaskFoneCel(campo){		
            var fone = campo.value+'';
            fone = fone.replaceAll(' ','');
            var cont = 0;
            var teste='';
            while(cont < fone.length) {			
                if(!(fone.charAt(cont)>=0 && fone.charAt(cont)<=9)){
                    teste+='';					
                }
                else
                {
                    teste+=fone.charAt(cont);			 
                }
                cont++;
            }
            fone = teste;				
            var tam = fone.length;
            if ( tam >= 3 && tam <= 6)
                campo.value = '('+fone.substring(0,2)+') '+fone.substring(2);
            else if ( tam >= 7)
                campo.value = '('+fone.substring(0,2)+') '+fone.substring(2,7)+'-'+fone.substring(7,11);
            else if ( tam == 0)
                campo.value = ''; 
            else
                campo.value = '('+fone;           
        }

        function checkcel(campo){
            res=campo.value;
            if(res.length<15){
                document.getElementById('errotel').innerHTML='Telefone Inválido!';
                campo.value='';
                campo.focus();
            }else{
                document.getElementById('errotel').innerHTML='';
            }   

        }
    
    $("#lista2").removeClass("bg-danger");
    $("#lista1").addClass("bg-danger");

    $("#msg").fadeTo(1000, 500).fadeOut(1500);
               
    </script>
@endpush