<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sigtma') }}</title>

    <!-- Styles -->    

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">        
    <link href="css/plantilla.css" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">
    
</head>

<body class="color-body">
    <div class="container-fluid" id="app">
        <header class="app-header border-bottom-0 navbar menu-superior">             
            <ul class="nav navbar-nav d-md-down-none texto-titulo">
                <li class="nav-item">
                    <a class="nav-link" href="#">Sistema Integrado de Gestion Tributaria Municipal Avanzada</a>
                </li>           
            </ul>
            <ul class="nav navbar-nav ml-auto d-md-down-none">
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
                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="exampleModalLabel">               
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                          <i class="fa fa-sign-out fa-lg border-0 ml-2"></i> <span class="user-text">  Cerrar sesión</span> 
                        </a>
                    </div>
                </li>
            </ul>

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
        </header>   
    

        <div class="d-flex flex-row" id="wrapper">

            <div style="z-index: 4">
                @if(Auth::user()->roles->first()->rol == 'admin')
                    @include('plantilla.sidebarAdministrador')
                @endif 
            </div>
            
            <div>
                @if(Auth::user()->roles->first()->rol == 'admin')
                    @include('plantilla.sidebarAdministrador')
                @endif 
            </div>
                           
            
        </div>        
    
    </div>
    

        
            <!-- Contenido Principal -->                      
                

            <!-- /Fin del contenido principal -->
        
    <!-- Fin app -->
        <!--<footer class="app-footer"> 
            <span><a><b><i>SIRHTUR</i></b></a> &copy; 2019</span>        
        </footer>-->

        <!-- Bootstrap and necessary plugins -->
        <script src="js/app.js"></script> 
        <script src="js/plantilla.js"></script>
        <script src="js/clock.js"></script>    
        <script src="js/menu.js"></script>
</body>
</html>
