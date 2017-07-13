@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Listado de jornadas</h3>
          </div>
          <div class="panel-body">
            @if($jornadas->isNotEmpty())
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Horas laborales</th>
                      <th>Horas extras</th>
                      <th>Hora Jornada</th>
                      <th>Hora comida</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jornadas as $jornada)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$jornada->nombre}}</td>
                        <td>{{$jornada->tipo}}</td>
                        <td>{{$jornada->horas_laborales}}</td>
                        <td>{{($jornada->horas_extras) ? "Si" : "No"}}</td>
                        <td>{{$jornada->hora_inicio_jornada ." - ". $jornada->hora_fin_jornada}}</td>
                        <td>{{($jornada->hora_inicio_comida and $jornada->hora_fin_comida)
                              ? $jornada->hora_inicio_comida ." - ". $jornada->hora_fin_comida : "N/D" }}</td>
                        <td>
                          <a href="/jornada/{{$jornada->id}}/edit" data-toggle="tooltip" data-placement="left" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          {!! Form::open(
                              [
                                'url' => '/jornada/'.$jornada->id,
                                'method' => 'delete',
                                'style' => 'display: inline-block;'
                              ])
                          !!}
                          <a class="eliminar" id="{{$jornada->id}}" href="#" data-toggle="tooltip" data-placement="right" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          {!! Form::close() !!}
                          @if($jornada->activa)
                            {!! Form::open(
                                [
                                  'url' => '/jornada/'.$jornada->id.'/disable',
                                  'method' => 'post',
                                  'style' => 'display: inline-block;'
                                ])
                            !!}
                            <a class="bloquear" href="#" data-toggle="tooltip" data-placement="right" title="Bloquear">
                              <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            {!! Form::close() !!}
                          @else
                            {!! Form::open(
                                [
                                  'url' => '/jornada/'.$jornada->id.'/enable',
                                  'method' => 'post',
                                  'style' => 'display: inline-block;'
                                ])
                            !!}
                            <a class="desbloquear" href="#" data-toggle="tooltip" data-placement="right" title="Desbloquear">
                              <span class="glyphicon glyphicon-ok-circle"></span>
                            </a>
                            {!! Form::close() !!}
                          @endif
                          <a href="/jornada/{{$jornada->id}}/empleados" data-toggle="tooltip" data-placement="left" title="Agregar/Quitar Empleados">
                            <span class="glyphicon glyphicon-user"></span>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                  <p>No se encuentran jornadas. Por favor, <a href="/jornada/create">agregue</a> al menos una.</p>
                </div>
            @endif
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();

      $(".eliminar").on("click", function() {
        if(confirm("Presione Aceptar para eliminar la jornada")) {
          var parent = $(this).parent();
          var form = $(this).closest("form");

          $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: $(form).serialize(),
            dataType: 'json',
            success: function(respuesta)
            {
              if(!respuesta.error) {
                parent.slideUp(300, function () {
                  parent.closest("tr").remove();
                });
              } else {
                alert("Error al intentar eliminar la jornada");
              }
            },
            error: function()
            {
              alert("Error al eliminar la jornada");
            }
          });
        }
      });
      $(".bloquear").on("click", function() {
        if(confirm("Presione Aceptar para desactivar la jornada")) {
          var parent = $(this).parent();
          var form = $(this).closest("form");

          $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: $(form).serialize(),
            dataType: 'json',
            success: function(respuesta)
            {
              if(!respuesta.error) {
                location.reload();
              } else {
                alert("Error al intentar desactivar la jornada");
              }
            },
            error: function()
            {
              alert("Error al desactivar la jornada");
            }
          });
        }
      });

      $(".desbloquear").on("click", function() {
        if(confirm("Presione Aceptar para activar la jornada")) {
          var parent = $(this).parent();
          var form = $(this).closest("form");

          $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: $(form).serialize(),
            dataType: 'json',
            success: function(respuesta)
            {
              if(!respuesta.error) {
                location.reload();
              } else {
                alert("Error al intentar activar la jornada");
              }
            },
            error: function()
            {
              alert("Error al activar la jornada");
            }
          });
        }
      });

    });
  </script>
@endsection
