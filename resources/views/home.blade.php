@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>
          <div class="panel-body">
            @if(Auth::user()->is_admin)
              @if($fichas->isNotEmpty())
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
                      @foreach($fichas as $ficha)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$ficha->empleado->nombre." ".$ficha->empleado->apellido}}</td>
                          <td>{{$ficha->empleado->cliente->nombre ?: "N/D"}}</td>
                          <td>{{$ficha->empleado->jornada->nombre ?: "N/D"}}</td>
                          <td>{{$ficha->estado}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="alert alert-danger" role="alert">
                  <p>No se encuentran fichas para el d&iacute;a</p>
                </div>
              @endif
            @else
              <ul class="list-inline">
                <div class="row">
                  <div class="col-md-4">
                    <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/iniciar" class="btn">Iniciar jornada</a></li>
                  </div>
                  <div class="col-md-4">
                    <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/finalizar" class="btn">Finalizar jornada</a></li>
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
                    <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/extras/iniciar" class="btn">Iniciar horas extras</a></li>
                  </div>
                  <div class="col-md-4">
                    <li><a href="/empleado/{{Auth::user()->empleado->id}}/jornada/extras/finalizar" class="btn">Finalizar horas extras</a></li>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <li><a href="/empleado/{{Auth::user()->empleado->id}}/historial" class="btn">Historial de jornadas</a></li>
                  </div>
                </div>
              </ul>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
