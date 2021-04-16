@extends('layouts.estrutura')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><span class="glyphicon glyphicon-list">.</span>Listagem de Usuários</div>              
                   
                <div class="panel-body">              
                                       
                    <table id="example" class="table table-bordered table-hidaction table-hover" cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:2%; color:white; background-color:#1C1C1C;font-size:13px;'>Id</th>  
                                <th style='width:20%; color:white; background-color:#1C1C1C;font-size:13px'>Nome</th>  
                                <th style='width:10%; color:white; background-color:#1C1C1C;font-size:13px'>Telefone</th>  
                                <th style='width:25%; color:white; background-color:#1C1C1C;font-size:13px'>E-mail</th>  
                                <th style='width:23%; color:white; background-color:#1C1C1C;font-size:13px'>Loja</th>  
                                <th style='width:10%; color:white; background-color:#1C1C1C;font-size:13px'>Tipo</th>                                                   
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
            <img src='resources/assets/imagens/logo.png' width='50' height='35' />Deseja excluir este Usuário?
            <div class='col-md-12' style='margin-left:15px'>
                <button type="button" class="btn btn-success" onclick="excluir(id_usuario)">
                    &nbsp;Excluir&nbsp;
                </button>  
                <button type="button" class="btn btn-warning" onclick="document.getElementById('msgexc').style.display='none';">
                    Cancelar
                </button>  
            </div>
        </div>
    </div>  
@endsection

@if (strstr(session('message'), 'sucesso')) 
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:#98FB98;color:black;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='resources/assets/imagens/logo.png' width='50' height='35' />{{ session('message') }}
            <style>.table.dataTable {font-size: 14px;}</style>           
        </div>
    </div>    
@endif
@if (strstr(session('message'), 'Erro')) 
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:55%;left:59%;background-color:red;color:white;z-index:100;display:table;margin-top: -100px;margin-left: -250px;' align='center'>
        <div style='vertical-align:middle;display:table-cell;'>
            <img src='resources/assets/imagens/logo.png' width='50' height='35' />{{ session('message') }}
            <style>.table.dataTable {font-size: 14px;}</style>   
        </div>
    </div>  
@endif

@push ('scripts')
    <!-- DataTables -->    
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   
        
    <script>            

            source='{{ url('listar_usuarios_datatable') }}';
           
            $(function() {
                $('#example').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: source,
                    columns: [
                                { data: 'id', name: 'id' }, 
                                { data: 'user', name: 'user' }, 
                                { data: 'telefone', name: 'telefone' },    
                                { data: 'email', name: 'email' },    
                                { data: 'lojauser', name: 'lojauser' },                  
                                { data: 'classificacao', name: 'classificacao' },                                
                            
                                {
                                    "data": "action",
                                    "render": function(data, type, row, meta){
                                        return "<button type='button' class='btn-warning btn-xs' title='Alterar' onclick='alterar_id("+row.id+")'>Alterar</button> <button type='button' class='btn-danger btn-xs' title='Alterar' onclick='excluir_id("+row.id+")'>Excluir</button>";
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
            window.location='alterar_usuarios/'+id;  
        }
        function excluir_id(id){
            id_usuario=id;
            document.getElementById('msgexc').style.display='table';           
        }
        function excluir(id){
            window.location='excluir_usuarios/'+id;
        }
    </script>

    <script>
        $("#lista2").removeClass("bg-danger");
        $("#lista1").addClass("bg-danger");
        $("#msg").fadeTo(1000, 500).fadeOut(1500);
    </script>
   
@endpush