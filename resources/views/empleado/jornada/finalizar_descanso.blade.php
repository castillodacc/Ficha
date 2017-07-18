@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">JORNADA DEL DÍA - DESCANSO</div>
          <div class="panel-body">
            @can('finalizar_descanso', Auth::user()->empleado)
            {!! Form::open(['url' => '/empleado/'.$empleado->id.'/jornada/descanso/finalizar', 'class' => 'form-inline', 'id' => 'descanso-form']) !!}
            <div class="form-group">
              {!! Form::submit('Finalizar Descanso', ["class" => "btn btn-block btn-success"]) !!}
            </div>
            {!! Form::close() !!}
            @else
            <div class="alert alert-danger" role="alert">
              <p>No tiene permisos para finalizar el tiempo de descanso.</p>
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
      });
    });
  </script>
@endsection
