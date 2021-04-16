@extends ('layouts.estrutura')

<!-- Cadastro de Lojas -->

@section ('content')
    <div class='row'>
        <div class="col-md-8 col-md-offset-2" align="center">
            <div class="panel panel-default"> 
                @if (@!$response[0]['id'])
                    <div class="panel-heading" align='center'><b>Cadastro de Lojas</b></div>
                    @php ($rota = 'incluir_lojas')
                @else
                    <div class="panel-heading" align='center'><b>Alteração de Lojas</b></div>
                    @php ($rota = 'editar_lojas')
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
                                    <label class="col-md-2 control-label">* Cnpj</label>
                                    <div class="col-md-2">                                       
                                        <input id="cnpj" type="text"  onkeypress="formatcnpj(this.value,this.id);" onchange="formatcnpj(this.value,this.id);verifica_cnpj(this.value)" onblur="validarCNPJ(this.value,this.id);" placeholder="Somente Números" class="form-control" name="cnpj" required autofocus maxlength="18" autocomplete="nope" value="{{@$response[0]['cnpj']}}" >
                                    </div>  
                                    <div class="col-md-2" align='left' style='padding-top:10px'><span id='errocnpj' style='color:red'><b></b></span></div>
                                </div>

                                <div class='row'>
                                    <label class="col-md-2 control-label text-danger">*Cep</label>
                                    <div class="col-md-2">
                                        <input id="cep" type="text" style='color:red;border:1px solid red;' class="form-control" name="cep" required autofocus maxlength="10" autocomplete="nope" value="{{@$response[0]['cep']}}">
                                    </div> 
                                    <div class="col-md-2" align='left' style='padding-top:10px'><span id='errocep' style='color:red'><b></b></span></div>
                                </div>

                                <div class='row'>
                                    <label class="col-md-2 control-label">*Endereço</label>
                                    <div class="col-md-5">
                                        <input id="endereco" type="text" class="form-control" name="endereco" required autofocus maxlength="65" autocomplete="nope" value="{{@$response[0]['endereco']}}">
                                    </div> 
                                </div>

                                <div class='row'>
                                    <label class="col-md-2 control-label">*Bairro</label>
                                    <div class="col-md-3">
                                        <input id="bairro" type="text" class="form-control" name="bairro" required autofocus maxlength="35" autocomplete="nope" value="{{@$response[0]['bairro']}}">
                                    </div> 
                                </div>                               

                                <div class='row'>
                                    <label class="col-md-2 control-label">*Cidade</label>
                                    <div class="col-md-2">
                                        <input id="cidade" type="text" class="form-control" name="cidade" required autofocus maxlength="45" autocomplete="nope" style='width:200px' value="{{@$response[0]['cidade']}}">
                                    </div> 

                                    <label class="col-md-1 control-label">*Estado</label>
                                    <div class="col-md-2">                                      
                                        <select class="form-control" id="estado" name="estado" autofocus > 
                                            <option value=""></option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>   

                                         @if(@$response[0]['estado'])                                           
                                            <script>
                                                document.getElementById('estado').value="{{@$response[0]['estado']}}";
                                            </script>      
                                        @endif                               
                                    </div>  
                                </div>

                                <input id="id" name="id" type="hidden" value="{{@$response[0]['id']}}"> 
                                <br>
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
                <img src="{{ asset('../public/imagens/loading.gif') }}" width='55' height='20' />
            @else
                <img src="{{ asset('public/imagens/loading.gif') }}" width='55' height='20' />
            @endif
        </div>
    </div>   
@endsection

@if (strstr(session('message'), 'sucesso'))
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:#98FB98;color:black;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src="{{ asset('public/imagens/logo.png') }}" width='50' height='35' />{{ session('message') }}
        </div>
    </div>    
@endif
@if (strstr(session('message'), 'Erro'))
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:red;color:white;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src="{{ asset('public/imagens/logo.png') }}" width='50' height='35' />{{ session('message') }}
        </div>
    </div>  
@endif

@push ('scripts')
    <script type="text/javascript" src="public/js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="public/js/jquery.maskedinput-1.1.4.pack.js"></script>
    
    <script>        
        $("#cep").mask("99999-999");       
        function retornar(){
            if($('#tipo').val()=='alt'){
                window.location="{{ route('listagem_lojas') }}";
                return false;
            }else{
                window.location="{{ route('start') }}";       
            }
        }      
        
        function validarCNPJ(c,id){
            c = c.replace(/[^\d]+/g,'');
            cnpj=c;
            
            if (cnpj == '') {return false;}

            if (cnpj.length != 14){
                document.getElementById('errocnpj').innerHTML='Cnpj Inválido!';
                document.getElementById(id).value='';
                document.getElementById(id).focus();
                return false;}
        
            if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999"){
                document.getElementById('errocnpj').innerHTML='Cnpj Inválido!';
                document.getElementById(id).value='';
                document.getElementById(id).focus();
                return false;}
        
            tamanho = cnpj.length - 2;
            numeros = cnpj.substring(0, tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2){
                    pos = 9;}
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)) {document.getElementById('errocnpj').innerHTML='Cnpj Inválido!';document.getElementById(id).value='';document.getElementById(id).focus();return false;}
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2){
                    pos = 9;}
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1)){
                document.getElementById('errocnpj').innerHTML='Cnpj Inválido!';document.getElementById(id).value='';document.getElementById(id).focus();return false;}

            document.getElementById('errocnpj').innerHTML='';           
            return true;            
        }


    function formatcnpj(cnpj,id){       
        cnpj = cnpj.replace(/[^\d]+/g,'');
        $('#cnpj').val(cnpj.replace(/\D/g, ''));
        if(cnpj.length>0){
            document.getElementById(id).value=cnpj.substr(0, 2)+'.'+cnpj.substr(2, 3)+'.'+cnpj.substr(5, 3)+'/'+cnpj.substr(8, 4)+'-'+cnpj.substr(12, 2);           
        }      
    }

    $("#lista1").removeClass("bg-danger");
    $("#lista2").addClass("bg-danger");

    $("#msg").fadeTo(1000, 500).fadeOut(1500);


    function verifica_cnpj(cnpj){
        ccnpj = cnpj.replace(/[^\d]+/g,'');
        $.ajax({           
            type: "GET",           
            url: 'verifica_cnpj/'+ccnpj,
            datatype: 'json',
            success: function(data){
                var obj = JSON.parse(data);                                     
                if(obj.status==1){                   
                    document.getElementById('errocnpj').innerHTML='Cnpj já existente!';document.getElementById('cnpj').value='';document.getElementById('cnpj').focus();
                    $("#errocnpj").fadeTo(3000, 500, function(){document.getElementById('errocnpj').innerHTML=''});
                }               
            },            
        });
    }      
    </script>
@endpush



<script src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/cep.js') }}"></script>