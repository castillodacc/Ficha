@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Listado de empleados</h3>
          </div>
          <div class="panel-body">
            @if($empleados->isNotEmpty())
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Dni</th>
                      <th>Correo</th>
                      <th>Tel&eacute;fono</th>
                      <th>Tel&eacute;fono movil</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($empleados as $empleado)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->apellido}}</td>
                        <td>{{$empleado->dni}}</td>
                        <td>{{$empleado->correo}}</td>
                        <td>{{($empleado->telefono) ? $empleado->telefono : "N/D"}}</td>
                        <td>{{$empleado->telefono_movil}}</td>
                        <td>
                          <a href="/empleado/{{$empleado->id}}/edit" data-toggle="tooltip" data-placement="left" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          {!! Form::open(
                              [
                                'url' => '/empleado/'.$empleado->id,
                                'method' => 'delete',
                                'style' => 'display: inline-block;'
                              ])
                          !!}
                          <a class="eliminar" id="{{$empleado->id}}" href="#" data-toggle="tooltip" data-placement="right" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          {!! Form::close() !!}
                          @if($empleado->user->activo)
                            {!! Form::open(
                                [
                                  'url' => '/empleado/'.$empleado->id.'/disable',
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
                                  'url' => '/empleado/'.$empleado->id.'/enable',
                                  'method' => 'post',
                                  'style' => 'display: inline-block;'
                                ])
                            !!}
                            <a class="desbloquear" href="#" data-toggle="tooltip" data-placement="right" title="Desbloquear">
                              <span class="glyphicon glyphicon-ok-circle"></span>
                            </a>
                            {!! Form::close() !!}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                  <p>No se encuentran empleados. Por favor, <a href="/empleado/create">agregue</a> al menos uno.</p>
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
        if(confirm("Presione Aceptar para eliminar empleado")) {
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
                alert("Error al intentar eliminar empleado");
              }
            },
            error: function()
            {
              alert("Error al eliminar empleado");
            }
          });
        }
      });
      $(".bloquear").on("click", function() {
        if(confirm("Presione Aceptar para desactivar empleado")) {
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
                alert("Error al intentar desactivar empleado");
              }
            },
            error: function()
            {
              alert("Error al desactivar empleado");
            }
          });
        }
      });

      $(".desbloquear").on("click", function() {
        if(confirm("Presione Aceptar para activar empleado")) {
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
                alert("Error al intentar activar empleado");
              }
            },
            error: function()
            {
              alert("Error al activar empleado");
            }
          });
        }
      });
    });
  </script>
@endsection
