@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Listado de administradores</h3>
          </div>
          <div class="panel-body">
            @if($administradores->isNotEmpty())
              <input type="text" id="buscar" placeholder="Buscar..."/>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($administradores as $administrador)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$administrador->nombre}}</td>
                        <td>
                          <a href="/admin/{{$administrador->id}}/edit" data-toggle="tooltip" data-placement="left" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          {!! Form::open(
                              [
                                'url' => '/admin/'.$administrador->id,
                                'method' => 'delete',
                                'style' => 'display: inline-block;'
                              ])
                          !!}
                          <a class="eliminar" id="{{$administrador->id}}" href="#" data-toggle="tooltip" data-placement="right" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          {!! Form::close() !!}
                          @if($administrador->user->activo)
                            {!! Form::open(
                                [
                                  'url' => '/admin/'.$administrador->id.'/disable',
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
                                  'url' => '/admin/'.$administrador->id.'/enable',
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
                  <p>No se encuentran administradores. Por favor, <a href="/admin/create">agregue</a> al menos uno.</p>
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

      $(".eliminar").on("click", function() {
        if(confirm("Presione Aceptar para eliminar administrador")) {
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
                alert("Error al intentar eliminar administrador");
              }
            },
            error: function()
            {
              alert("Error al eliminar administrador");
            }
          });
        }
      });
      $(".bloquear").on("click", function() {
        if(confirm("Presione Aceptar para desactivar administrador")) {
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
                alert("Error al intentar desactivar administrador");
              }
            },
            error: function()
            {
              alert("Error al desactivar administrador");
            }
          });
        }
      });

      $(".desbloquear").on("click", function() {
        if(confirm("Presione Aceptar para activar administrador")) {
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
                alert("Error al intentar activar administrador");
              }
            },
            error: function()
            {
              alert("Error al activar administrador");
            }
          });
        }
      });

    });
  </script>
@endsection
