<!DOCTYPE html>
<html>
    <head>
        <!-- Jquery -->
        <script src="//code.jquery.com/jquery.js"></script>

        <title>Newpost - Avaliação</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <!-- Datatables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> 
    </head>

    <style>
        td{
            vertical-align:middle !important;        
        }  

        #example td:first-child {text-align:center;}
    </style>

    <body style='overflow-x:hidden'>

        @if (strstr($_SERVER["REQUEST_URI"], 'alterar')) 
            <div align="center"><b><h2><img src="{{ asset('imagens/logo.png') }}"   width='65' height='50' />Newpost</h2></b></div>
        @else
            <div align="center"><b><h2><img src="{{ asset('imagens/logo.png') }}" width='65' height='50' />Newpost</h2></b></div>
        @endif

        <!--MENU FIXO -->
        <div class="row">
            <div class="panel panel-default">
                <div class="col-md-2" align='center'>

                </div>
                <div class="col-md-3 panel-default" align='center'>
                    <ul class="nav navbar-nav navbar-center bg-danger" id="lista1">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Usuários
                            </a>
                            <ul class="dropdown-menu" role="menu"  style='width:250px'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('cadastro_usuarios')}}"> <span class="glyphicon glyphicon-user">.</span>Cadastro de Usuários</a></div>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('listagem_usuarios')}}"><span class="glyphicon glyphicon-list">.</span>Listagem de Usuários</a></div>
                                </a>
                            </ul>               
                        <li>
                    </ul>

                    <ul class="nav navbar-nav navbar-center" id="lista2">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Lojas
                            </a>
                            <ul class="dropdown-menu" role="menu"  style='width:250px'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('cadastro_lojas')}}"><span class="glyphicon glyphicon-shopping-cart">.</span>Cadastro de Lojas</a></div>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('listagem_lojas')}}"><span class="glyphicon glyphicon-list">.</span>Listagem de Lojas</a></div>
                                </a>
                            </ul>               
                        <li>
                    </ul>
                </div>
            </div>
        </div>

        <!--FIM MENU FIXO -->
        
        @yield('content') <!-- Posiciona a section do doc --> 
        @stack('scripts') <!-- Scripts da página -->              
         
    </body>    
</html>