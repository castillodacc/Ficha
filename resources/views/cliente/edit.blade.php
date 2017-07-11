@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">EDITAR CLIENTE</div>
          <div class="panel-body">
            {!! Form::open(['url' => '/cliente/'.$cliente->id, 'method' => 'put', 'class' => 'form-inline', 'id' => 'update-cliente-form']) !!}
            <!-- Content form input -->
            <div class="form-group">
              {!! Form::label('nombre', 'Nombre y apellido:') !!}
              {!! Form::text('nombre', $cliente->nombre, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Actualizar Cliente', ["class" => "btn btn-success"]) !!}
            </div>
          </div>
          {!! Form::close() !!}
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#update-cliente-form").submit("submit", function(e) {
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
              $("#nombre").val("");
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
