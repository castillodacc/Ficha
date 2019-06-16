@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Listado de Empresas</h3>
        </div>
        <div class="panel-body">
          @if($empresa->isNotEmpty())
          <input type="text" id="buscar" placeholder="Buscar..."/>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Contacto</th>
                  <th>Correo</th>
                  <th>Direccion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($empresa as $empresa)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $empresa->nombre }}</td>
                  <td>{{ $empresa->telefono }}</td>
                  <td>{{ $empresa->contacto }}</td>
                  <td>{{ $empresa->correo }}</td>
                  <td>{{ $empresa->direccion }}</td>
                  <td>
                    <a href="/empresa/{{ $empresa->id }}/edit" data-toggle="tooltip" data-placement="left" title="Editar">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    {!! Form::open(['url' => '/empresa/' . $empresa->id, 'method' => 'DELETE', 'style' => 'display: inline-block;']) !!}
                    <a class="eliminar" id="{{ $empresa->id }}" href="#" data-toggle="tooltip" data-placement="right" title="Eliminar">
                      <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    {!! Form::close() !!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <div class="alert alert-danger" role="alert">
              <p>No se encuentran Empresas. Por favor, <a href="/empresa/create">agregue</a> al menos uno.</p>
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
      if(confirm("Presione Aceptar para eliminar a la Empresa")) {
        var parent = $(this).parent();
        var form = $(this).closest("form");
        $.ajax({
          url: $(form).attr("action"),
          method: $(form).attr("method"),
          data: $(form).serialize(),
          success: function(respuesta) {
            parent.slideUp(300, function () {
              parent.closest("tr").remove();
            });
          },
          error: function() {
            alert("Error al intentar eliminar a la Empresa");
          }
        });
      }
    });
  });
</script>
@endsection
