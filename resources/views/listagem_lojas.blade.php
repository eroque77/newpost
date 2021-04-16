@extends('layouts.estrutura')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><span class="glyphicon glyphicon-list">.</span>Listagem de Lojas</div>              
                   
                <div class="panel-body">              
                                       
                    <table id="example" class="table table-bordered table-hidaction table-hover" cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:1%; color:white; background-color:#1C1C1C;font-size:13px;'>Id</th>  
                                <th style='width:21%; color:white; background-color:#1C1C1C;font-size:13px'>Nome</th>  
                                <th style='width:12%; color:white; background-color:#1C1C1C;font-size:13px'>Cnpj</th>  
                                <th style='width:25%; color:white; background-color:#1C1C1C;font-size:13px'>Endereço</th>  
                                <th style='width:16%; color:white; background-color:#1C1C1C;font-size:13px'>Bairro</th>  
                                <th style='width:15%; color:white; background-color:#1C1C1C;font-size:13px'>Cidade</th>                                                                     
                                <th style='width:15%; color:white; background-color:#1C1C1C;font-size:13px'>Ações</th>                                                        
                            </tr>  
                       </thead>                                                          
                    </table>               

                </div>
            </div>
          
            <div class="form-group">
                <div class="col-md-12" align='center'>
                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('start') }}';">
                        Retornar
                    </button>                     
                </div>
            </div>  
      
        </div>
        
    </div>

    <div class="alert alert-success alert-dismissible col-md-12" id='msgexc' style='width:290px;height:50px;position:fixed;top:55%;left:59%;background-color:red;color:white;z-index:100;display:none;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;text-align:center' >
            <img src='public/imagens/logo.png' width='50' height='35' />Deseja excluir esta Loja?
            <div class='col-md-12' style='margin-left:15px'>
                <button type="button" class="btn btn-success" onclick="excluir(id_loja)">
                    &nbsp;Excluir&nbsp;
                </button>  
                <button type="button" class="btn btn-warning" onclick="document.getElementById('msgexc').style.display='none';">
                    Cancelar
                </button>  
            </div>
        </div>
    </div>  

    <div class="alert alert-success alert-dismissible col-md-12" id='msgvinc' style='width:290px;height:50px;position:fixed;top:55%;left:59%;background-color:#EEDD82;color:black;z-index:100;display:none;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;text-align:center' >
            <img src='public/imagens/logo.png' width='50' height='35' />Esta Loja já possui vínculos!
            <div class='col-md-12' style='margin-left:15px'>
                <button type="button" class="btn btn-warning" onclick="document.getElementById('msgvinc').style.display='none';">
                    Retornar
                </button>  
            </div>
        </div>
    </div>  
@endsection

@if (strstr(session('message'), 'sucesso')) 
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:#98FB98;color:black;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='public/imagens/logo.png' width='50' height='35' />{{ session('message') }}
            <style>.table.dataTable {font-size: 14px;}</style>           
        </div>
    </div>    
@endif
@if (strstr(session('message'), 'Erro')) 
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:red;color:white;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='public/imagens/logo.png' width='50' height='35' />{{ session('message') }}
            <style>.table.dataTable {font-size: 14px;}</style>   
        </div>
    </div>  
@endif

@push ('scripts')
    <!-- DataTables -->    
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   
        
    <script>            

            source='{{ url('listar_lojas_datatable') }}';
           
            $(function() {
                $('#example').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: source,
                    columns: [
                                { data: 'id', name: 'id' }, 
                                { data: 'nome', name: 'nome' }, 
                                { data: 'cnpj', name: 'cnpj' },    
                                { data: 'endereco', name: 'endereco' },    
                                { data: 'bairro', name: 'bairro' },                     
                                { data: 'cidade', name: 'cidade' },                                                  
                            
                                {
                                    "data": "action",
                                    "render": function(data, type, row, meta){
                                        return "<button type='button' class='btn-warning btn-xs' title='Alterar' onclick='alterar_id("+row.id+")'>Alterar</button> <button type='button' class='btn-danger btn-xs' title='Alterar' onclick='excluir_id("+row.id+","+row.vinculo+")'>Excluir</button>";
                                    }
                                }   
                            ],
                    
                    language: {                    
                        lengthMenu: "Mostrar _MENU_ registros por página",
                        search: "Pesquisar:",
                        info: "Mostrando (_START_ de _END_), de um total de _TOTAL_, registros",
                        ZeroRecords:    "Não foi encontrado registros",
                        EmptyTable:     "Nenhum dado disponível nessa tabela",
                        paginate: {                     
                        previous: "Anterior",
                        next:     "Próximo",                     
                    }
                    }

                });
            });

    </script>

    <script>
        function alterar_id(id){
            window.location='alterar_lojas/'+id;  
        }
        function excluir_id(id,vinculo){
            id_loja=id;
            vinculo1=vinculo;
            if(!vinculo){
                document.getElementById('msgexc').style.display='table';
            }else{
                document.getElementById('msgvinc').style.display='table';                
            }          
        }
        function excluir(id){
            window.location='excluir_lojas/'+id;
        }
    </script>


    <script>
        $("#lista1").removeClass("bg-danger");
        $("#lista2").addClass("bg-danger");
        $("#msg").fadeTo(1000, 500).fadeOut(1500);
    </script>
   
@endpush