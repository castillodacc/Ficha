@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Generar reporte de un cliente</div>
          <div class="panel-body">
            @if($empleados->isNotEmpty())
              {!! Form::open(['url' => '/reporte/empleado', 'id' => 'reporte-empleado-form']) !!}
              <div class="form-group">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="input-group date">
                          {!! Form::label('fecha_inicio', 'Desde:') !!}
                          {!! Form::text('fecha_inicio',
                                         null,
                                         [
                                           'class'               => 'form-control datepicker',
                                           'data-provide'        => 'datepicker',
                                           'data-date-format'    => 'yyyy-mm-dd',
                                           'data-date-language'  => 'es',
                                           'data-date-autoclose' => 'true',
                                           'placeholder'         => 'Escoger fecha'
                                         ])
                          !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-group date">
                          {!! Form::label('fecha_fin', 'Hasta:') !!}
                          {!! Form::text('fecha_fin',
                                         null,
                                         [
                                           'required'            => 'required',
                                           'class'               => 'form-control datepicker',
                                           'data-provide'        => 'datepicker',
                                           'data-date-format'    => 'yyyy-mm-dd',
                                           'data-date-language'  => 'es',
                                           'data-date-autoclose' => 'true',
                                           'placeholder'         => 'Escoger fecha'
                                         ])
                          !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        {!! Form::label('empleado', 'Empleado:') !!}
                        {!! Form::select('empledo',
                                         $empleados,
                                         null,
                                         [
                                           'required' => 'required',
                                           'class'    => 'form-control'
                                         ])
                        !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <br>
                      {!! Form::submit('Generar', ["class" => "btn btn-success btn-block", "disabled" => "disabled"]) !!}
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            @else
              <div class="alert alert-danger" role="alert">
                <p>No se encuentran empleados registrados</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/locales/bootstrap-datepicker.es.min.js') }}" charset="UTF-8"></script>
  <script>
    $(document).ready(function() {
      $("#reporte-empleado-form").submit("submit", function(e) {
        $.ajax({
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: 'json',
          success: function(respuesta)
          {
            if(!respuesta.error) {
              var html = "<div class='alert alert-success'>";
              html += "<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
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
    });
  </script>
@endsection
