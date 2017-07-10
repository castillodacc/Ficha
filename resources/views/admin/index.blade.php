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
                          {!! Form::open(
                              [
                                'url' => '/admin/'.$administrador->id.'/block',
                                'method' => 'post',
                                'style' => 'display: inline-block;'
                              ])
                          !!}
                          <a class="bloquear" id="{{$administrador->id}}" href="#" data-toggle="tooltip" data-placement="right" title="Bloquear">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                          </a>
                          {!! Form::close() !!}
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
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      $(".eliminar").on("click", function() {
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
              alert("Error al intentar eliminar el usuario");
            }
          },
          error: function()
          {
            alert("Error, en el servidor, al intentar eliminar la propiedad");
          }
        });
      });
      $(".bloquear").on("click", function() {
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
              alert("Error al intentar eliminar el usuario");
            }
          },
          error: function()
          {
            alert("Error, en el servidor, al intentar eliminar la propiedad");
          }
        });
      });
    });
  </script>
@endsection
