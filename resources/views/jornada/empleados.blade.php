@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">AÑADIR EMPLEADOS A JORNADA</div>
          <div class="panel-body">
            @if($empleados_por_asignar->isNotEmpty())
              {!! Form::open(['url' => '/jornada/'.$jornada->id.'/empleados', 'class' => 'form-inline', 'id' => 'agregar-empleados-form']) !!}
            <!-- Content form input -->
            <div class="form-group">
              {!! Form::label('empleado', 'Empleados:') !!}
              <select id="empleado" name="empleado">
                @foreach($empleados_por_asignar as $id => $nombre)
                  <option value="{{$id}}">{{$nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::submit('Añadir', ["class" => "btn btn-success"]) !!}
            </div>
            @else
            <div class="alert alert-warning" role="alert">
              <p>No hay empleados disponibles para asignar a la jornada.</p>
            </div>
            @endif
          </div>
          {!! Form::close() !!}
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">EMPLEADOS ASIGNADOS</div>
          <div class="panel-body">
            @if($empleados_asignados->isNotEmpty())
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Dni</th>
                      <th>Remover</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($empleados_asignados as $empleado)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->apellido}}</td>
                        <td>{{$empleado->dni}}</td>
                        <td>
                          {!! Form::open(
                              [
                                'url' => '/jornada/'.$jornada->id.'/empleados',
                                'method' => 'delete',
                                'style' => 'display: inline-block;'
                              ])
                          !!}
                          <a class="remover" id="{{$empleado->id}}" href="#" data-toggle="tooltip" data-placement="right" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          {!! Form::hidden('empleado', $empleado->id) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            @else
                <div class="alert alert-warning" role="alert">
                  <p>No hay empleados asignados a la jornada.</p>
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

      $("#agregar-empleados-form").submit("submit", function(e) {
        $.ajax({
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function()
          {
            $(".panel-footer").empty();
          },
          success: function(respuesta)
          {
            if(!respuesta.error) {
              var html = "<div class='alert alert-success'>";
              html += "<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
              location.reload();
            } else {
              var html = "<div class='alert alert-danger'>";
              html +="<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            }
          },
          error: function()
          {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
          }
        });
        e.preventDefault();
      });


      $(".remover").on("click", function() {
        if(confirm("Presione Aceptar para remover empleado")) {
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
                location.reload();
              } else {
                alert("Error al intentar remover empleado");
              }
            },
            error: function()
            {
              alert("Error al remover empleado");
            }
          });
        }
      });

    });
  </script>
@endsection
