<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sigtma') }}</title>

    <!-- Styles -->    

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">       
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    
    <link href="css/plantilla.css" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css"> 
    <link rel="stylesheet" type="text/css" href="css/boxicons-2.0.5/css/boxicons.min.css">
    
</head>

<body class="app">
    <div id="app">
        <header class="app-header border-bottom-0 navbar menu-superior">             
            <ul class="nav navbar-nav col-md-10 texto-titulo">
                <li class="nav-item" style="font-family: arial;">
                    <span class="" href="#"><b>Sistema Integrado de Gestion Tributaria Municipal Avanzada</b></span> <br>
                    <span class="" href="#"><b>(SIGTMA)</b></span>
                </li>           
            </ul>
            <ul class="nav navbar-nav">
                <li>
                    <div class="navbar-nav ml-auto">
                        <div class="hour-text">
                         <span>{{ now()->format('d-m-Y') }}</span>
                         <span id="clock" class="clock"></span>
                         <span id="meridian" class="meridian"></span>
                        </div>                     
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="d-md-down-none user-text"> {{ Auth::user()->name }}</span>
                        <img src="img/usuario/user.jpg" class="img-avatar" alt="">                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow" style="position: absolute;" aria-labelledby="exampleModalLabel">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                          <i class="fa fa-sign-out fa-lg border-0 ml-2"></i> <span class="user-text">  Cerrar sesión</span> 
                        </a>
                    </div>
                </li>
            </ul>            
        </header>
            <!-- Modal de cierre de sesión -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro de cerrar sesión?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Seleccioné "Cerrar sesión" si esta seguro de terminar la sesión.</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                      <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">Cerrar sesión</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </div>
                </div>
            </div>        
    
        <div class="app-body">

        @if(Auth::user()->roles->first()->rol == 'admin')
            @include('plantilla.sidebarAdministrador')
        @endif
        @if(Auth::user()->roles->first()->rol == 'gerente')
            @include('plantilla.sidebarGerente')
        @endif
        @if(Auth::user()->roles->first()->rol == 'agente')
            @include('plantilla.sidebarAgente')
        @endif
        <!-- Contenido Principal -->

        <div>        
            <main class="py-4">
               @yield('contenido')
            </main>
        </div>
        
        <!-- /Fin del contenido principal -->
        </div>       
    </div>        
        
    <!-- Fin app -->
        <!--<footer class="app-footer"> 
            <span><a><b><i>SIRHTUR</i></b></a> &copy; 2019</span>        
        </footer>-->

        <!-- Bootstrap and necessary plugins -->
        <script src="js/app.js"></script> 
        <script src="js/plantilla.js"></script>
        <script src="js/clock.js"></script>    
        <script src="js/menu.js"></script>
       <!-- <script type="text/javascript" src="DataTables/datatables.min.js"></script> -->
       
</body>
</html>
