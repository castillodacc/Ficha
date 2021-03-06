@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
          @if(Auth::user()->is_admin)
          @if($empleados->isNotEmpty())
          <input type="text" id="buscar" placeholder="Buscar..."/>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Empleado</th>
                  <th>Cliente</th>
                  <th>Jornada</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                @foreach($empleados as $empleado)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
                  <td>{{$empleado->cliente->nombre ?: "N/D"}}</td>
                  <td>{{$empleado->jornada->nombre ?: "N/D"}}</td>
                  <td>{{$empleado->getEstadoFichaDiaActual()}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <div class="alert alert-danger" role="alert">
            <p>No se encuentran empleados con jornadas asignadas</p>
          </div>
          @endif
          @else
          @if(Auth::user()->empleado->jornada->activa)
          <ul class="list-inline">
            <div class="row">
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/iniciar" class="btn">Iniciar jornada</a></li>
              </div>
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/finalizar" class="btn">Finalizar jornada</a></li>
              </div>
            </div>
            @if(Auth::user()->empleado->jornada->hora_comida)
            <div class="row">
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/descanso/iniciar" class="btn">Iniciar descanso</a></li>
              </div>
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/descanso/finalizar" class="btn">Finalizar descanso</a></li>
              </div>
            </div>
            @endif
            @if(Auth::user()->empleado->jornada->horas_extras)
            <div class="row">
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/extras/iniciar" class="btn">Iniciar horas extras</a></li>
              </div>
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/extras/finalizar" class="btn">Finalizar horas extras</a></li>
              </div>
            </div>
            @endif
            <div class="row">
              <div class="col-md-4">
                <li><a href="/empleado/{{Auth::user()->empleado->id}}/historial" class="btn">Historial de jornadas</a></li>
              </div>
            </div>
          </ul>
          @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $("#buscar").keyup(function() {
      var texto = $(this).val().toLowerCase();
      $.each($("table tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf(texto) === -1) {
          $(this).hide();
        } else {
          $(this).show();
        }
      });
    });
  });
</script>
@endsection
