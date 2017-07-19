@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">JORNADA DEL DÍA</div>
          <div class="panel-body">
            @can('usuario_activo', $empleado)
            @can('usuario_no_admin', $empleado)
            @can('jornada_asignada', $empleado)
            @can('jornada_cerrada', $empleado)
            @can('hora_rango_iniciar_jornada', $empleado)
            {!! Form::open(['url' => '/empleado/'.$empleado->id.'/jornada/iniciar', 'class' => 'form-inline', 'id' => 'jornada-form']) !!}
            <div class="form-group">
                        {!! Form::submit('Iniciar Jornada', ["class" => "btn btn-success"]) !!}
                      </div>
                      {!! Form::close() !!}
                    @else
                      <div class="alert alert-danger" role="alert">
                        <p>Faltan m&aacute;s de 30 minutos para el inicio de su jornada</p>
                      </div>
                    @endcan
                  @else
                    <div class="alert alert-danger" role="alert">
                      <p>Ya tiene una jornada abierta</p>
                    </div>
                    @endcan
                @else
                  <div class="alert alert-danger" role="alert">
                    <p>No tiene una jornada asignada</p>
                  </div>
                  @endcan
              @else
                <div class="alert alert-danger" role="alert">
                  <p>Un usuario administrador no puede iniciar una jornada</p>
                </div>
                @endcan
            @else
              <div class="alert alert-danger" role="alert">
                <p>Su usuario fue bloqueado por un administrador</p>
              </div>
            @endcan
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#jornada-form").submit("submit", function(e) {
        $("input[type='submit']", this)
          .val("Enviando...")
          .attr('disabled', 'disabled');
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
        e.stopPropagation();
      });
    });
  </script>
@endsection
