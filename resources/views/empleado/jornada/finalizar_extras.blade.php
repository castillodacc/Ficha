@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading">FINALIZAR HORAS EXTRAS</div>
          <div class="panel-body">
            @can('usuario_activo', $empleado)
            @can('usuario_no_admin', $empleado)
            @can('jornada_asignada', $empleado)
            @can('jornada_abierta', $empleado)
            @can('horas_extras', $empleado)
            @can('horas_extras_iniciadas', $empleado)
            @can('hora_rango_fin_horas_extras', $empleado)
            @cannot('horas_extras_finalizadas', $empleado)
            {!! Form::open(['url' => '/empleado/'.$empleado->id.'/jornada/extras/finalizar', 'class' => 'form-inline', 'id' => 'finalizar-horas-extras-form']) !!}
            <div class="form-group">
              {!! Form::submit('Finalizar', ["class" => "btn btn-success"]) !!}
            </div>
          </div>
          {!! Form::close() !!}
          @else
          <div class="alert alert-danger" role="alert">
            <p>Ya finaliz&oacute; las horas extras en esta jornada</p>
          </div>
          @endcan
                    @else
          <div class="alert alert-danger" role="alert">
            <p>Han pasado m&aacute;s de 8 horas desde que inci&oacute; las horas extras</p>
          </div>
          @endcan
          @else
          <div class="alert alert-danger" role="alert">
            <p>No  inici&oacute; las horas extras en esta jornada</p>
          </div>
          @endcan
                          @else
          <div class="alert alert-danger" role="alert">
            <p>Su jornada no admite horas extras</p>
          </div>
          @endcan
                        @else
          <div class="alert alert-danger" role="alert">
            <p>No tiene una jornada abierta</p>
          </div>
          @endcan
                  @else
          <div class="alert alert-danger" role="alert">
            <p>No tiene una jornada asignada</p>
          </div>
          @endcan
              @else
          <div class="alert alert-danger" role="alert">
            <p>Un usuario administrador no puede iniciar horas extras</p>
          </div>
          @endcan
            @else
          <div class="alert alert-danger" role="alert">
            <p>Su usuario fue bloqueado por un administrador</p>
          </div>
          @endcan
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#finalizar-horas-extras-form").submit("submit", function(e) {
        var my_this = this;
        var boton_sub = $("input[type='submit']", this)
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
              $(boton_sub, my_this)
                .attr('disabled', false);
            }
          },
          error: function()
          {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
            $(boton_sub, my_this)
              .attr('disabled', false);
          }
        });
        e.preventDefault();
      });
    });
  </script>
@endsection
