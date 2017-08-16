@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">JORNADA DEL DÍA - DESCANSO</div>
          <div class="panel-body">
            @can('usuario_activo', $empleado)
            @can('usuario_no_admin', $empleado)
            @can('jornada_admite_tiempo_descanso', $empleado)
            @can('jornada_asignada', $empleado)
            @can('jornada_abierta', $empleado)
            @can('tiempo_descanso_iniciado', $empleado)
            @cannot('tiempo_descanso_finalizado', $empleado)
            {!! Form::open(['url' => '/empleado/'.$empleado->id.'/jornada/descanso/finalizar', 'class' => 'form-inline', 'id' => 'descanso-form']) !!}
            <div class="form-group">
              {!! Form::submit('Finalizar Descanso', ["class" => "btn btn-block btn-success"]) !!}
            </div>
            {!! Form::close() !!}
                        @else
            <div class="alert alert-danger" role="alert">
              <p>Ya finaliz&oacute; el tiempo de descanso en esta jornada</p>
            </div>
            @endcannot
                                  @else
            <div class="alert alert-danger" role="alert">
              <p>No ha iniciado el tiempo de descanso</p>
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
              <p>Su jornada no admite tiempo de descanso</p>
            </div>
            @endcan
              @else
            <div class="alert alert-danger" role="alert">
              <p>Un usuario administrador no puede finalizar una jornada</p>
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
      $("#descanso-form").submit("submit", function(e) {
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
