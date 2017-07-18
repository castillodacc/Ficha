@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading">HORAS EXTRAS A TRABAJAR</div>
          <div class="panel-body">
            @can('horas_extras', Auth::user()->empleado)
            {!! Form::open(['url' => '/empleado/'.$empleado->id.'/jornada/extras/iniciar', 'class' => 'form-inline', 'id' => 'iniciar-horas-extras-form']) !!}
            <div class="form-group">
              {!! Form::label('horas_extras', 'Horas:') !!}
              {!! Form::number('horas_extras',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required',
                                 'min' => '1',
                                 'max' => '8'
                               ])
              !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Enviar', ["class" => "btn btn-success"]) !!}
            </div>
          </div>
          {!! Form::close() !!}
@else
          <div class="alert alert-danger" role="alert">
            <p>No tiene permisos para iniciar horas extras.</p>
          </div>
          @endcan
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#iniciar-horas-extras-form").submit("submit", function(e) {
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
