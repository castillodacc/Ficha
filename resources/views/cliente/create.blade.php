@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">CREAR CLIENTE</div>
          <div class="panel-body">
            {!! Form::open(['url' => '/cliente', 'class' => 'form-inline', 'id' => 'cliente-form']) !!}
            <!-- Content form input -->
            <div class="form-group">
              {!! Form::label('nombre', 'Nombre:') !!}
              {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Crear', ["class" => "btn btn-success"]) !!}
            </div>
          </div>
          {!! Form::close() !!}
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function (){
      $("#cliente-form").submit("submit", function(e) {
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
            $("#cliente-form")[0].reset();
          },
          error: function()
          {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
            $("#cliente-form")[0].reset();
          }
        });
        e.preventDefault();
      });
    });
  </script>
@endsection
