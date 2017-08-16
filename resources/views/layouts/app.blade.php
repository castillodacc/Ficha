<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Ficha') }}</title --}}
    <title>Ficha</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
              @if(Route::currentRouteName() != 'login' and !Request::is('/'))
                <a class="navbar-brand" href="{{ url('/home') }}">
                  {{--               {{ config('app.name', 'Ficha') }} --}}
                  Ficha
                </a>
              @endif
          </div>
          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-nav-center">
              &nbsp;
              @if(Auth::check() and Auth::user()->is_admin)
                <li class="dropdown col-xs-12 col-md-auto">
                  <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empleados<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/empleado">Listado</a></li>
                    <li><a href="/empleado/create">Crear</a></li>
                  </ul>
                </li>
                <li class="dropdown col-xs-12 col-md-auto">
                  <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administradores<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/admin">Listado</a></li>
                    <li><a href="/admin/create">Crear</a></li>
                  </ul>
                </li>
                <li class="dropdown col-xs-12 col-md-auto">
                  <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jornadas<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/jornada">Listado</a></li>
                    <li><a href="/jornada/create">Crear</a></li>
                  </ul>
                </li>
                <li class="dropdown col-xs-12 col-md-auto">
                  <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/cliente">Listado</a></li>
                    <li><a href="/cliente/create">Crear</a></li>
                  </ul>
                </li>
                <li class="dropdown col-xs-12 col-md-auto">
                  <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-header">Clientes</li>
                    <li><a href="/reporte/cliente">De un cliente</a></li>
                    <li><a href="/reporte/clientes">Todos los clientes</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Empleados</li>
                    <li><a href="/reporte/empleado">De un empleado</a></li>
                    <li><a href="/reporte/empleados">Todos los empleados</a></li>
                  </ul>
                </li>
              @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right left-force">
              <!-- Authentication Links -->
              @if (Auth::guest())
                @if(Route::currentRouteName() != 'login' and !Request::is('/'))
                  <li><a href="{{ route('login') }}">Iniciar sesi&oacute;n</a></li>
                @endif
              @else
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">&nbsp;&nbsp;&nbsp;&nbsp;{{ Auth::user()->username }} <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                      <li>
                        <a href="{{ url('/password/update') }}">
                          Cambiar contraseña
                        </a>
                      </li>
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
                        Cerrar sesi&oacute;n
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </nav>
      @yield('content')
    </div>
  </body>
</html>
