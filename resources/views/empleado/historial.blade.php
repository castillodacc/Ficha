@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">HISTORIAL DE EMPLEADO</div>
          <div class="panel-body">
            @if($fichas->isNotEmpty())
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fecha</th>
                      <th>Horas extras</th>
                      <th>Hora inicio</th>
                      <th>Hora fin</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($fichas as $ficha)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$ficha->fecha}}</td>
                        <td>{{$ficha->horas_extras ?: 0}}</td>
                        <td>{{$ficha->hora_inicio}}</td>
                        <td>{{$ficha->hora_fin}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                  <p>No se encuentran datos en su historial.</p>
                </div>
            @endif
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
