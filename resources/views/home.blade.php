@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>
          <div class="panel-body">
              @if (!$errors->has('inactivo'))
                @if (Auth::user()->is_admin)
                  <ul class="list-inline">
                    <div class="row">
                      @can('crear_empleado', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/empleado/create" class="btn">Crear Empleado</a></li>
                      </div>
                      @endcan
                      @can('crear_admin', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/admin/create" class="btn">Crear Administrador</a></li>
                      </div>
                      @endcan
                      @can('crear_jornada', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/jornada/create" class="btn">Crear Jornada</a></li>
                      </div>
                      @endcan
                      @can('crear_cliente', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/cliente/create" class="btn">Crear Cliente</a></li>
                      </div>
                      @endcan
                    </div>
                  </ul>
                  <ul class="list-inline">
                    <div class="row">
                      @can('gestionar_empleado', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/empleado" class="btn">Gestionar empleados</a></li>
                      </div>
                      @endcan
                      @can('gestionar_admin', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/admin" class="btn">Gestionar administradores</a></li>
                      </div>
                      @endcan
                      @can('gestionar_jornada', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/jornada" class="btn">Gestionar jornadas</a></li>
                      </div>
                      @endcan
                      @can('gestionar_cliente', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/cliente" class="btn">Gestionar clientes</a></li>
                      </div>
                      @endcan
                    </div>
                  </ul>
                  <ul class="list-inline">
                    <div class="row">
                      @can('generar_reporte', Auth::user()->admin)
                      <div class="col-md-3">
                        <li><a href="/reporte/create" class="btn">Generar Reporte</a></li>
                      </div>
                      @endcan
                    </div>
                  </ul>
                @else
                  <ul class="list-inline">
                    <div class="row">
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/iniciar" class="btn">Iniciar Jornada</a></li>
                      </div>
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/finalizar" class="btn">Finalizar Jornada</a></li>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/descanso/iniciar" class="btn">Iniciar descanso</a></li>
                      </div>
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/descanso/finalizar" class="btn">Finalizar descanso</a></li>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/extras/iniciar" class="btn">Horas extras</a></li>
                      </div>
                      <div class="col-md-4">
                        <li><a href="/empleado/{{Auth::user()->empleado->id}}/historial" class="btn">Historial de jornadas</a></li>
                      </div>
                    </div>
                  </ul>
                @endif
              @else
                <div class="alert alert-danger" role="alert">
                  <p>Su usuario fue bloqueado por un administrador.</p>
                </div>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
