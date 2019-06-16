@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $empresa->id ? 'EDITAR' : 'CREAR' }} EMPRESA</div>
        <div class="panel-body">
          {!! Form::open(['url' => ($empresa->id ? '/empresa/' . $empresa->id : '/empresa'), 'id' => 'empresa-form', 'method' => $empresa->id ? 'PUT' : 'POST']) !!}
          <!-- Content form input -->
          <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', $empresa->nombre, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', $empresa->telefono, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('contacto', 'Nombre del Contacto') !!}
            {!! Form::text('contacto', $empresa->contacto, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('correo', 'Correo') !!}
            {!! Form::text('correo', $empresa->correo, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::textarea('direccion', $empresa->direccion, ['class' => 'form-control','rows' => '4']) !!}
          </div>
          <div class="form-group">
            {!! Form::submit($empresa->id ? 'Editar' : 'Crear', ["class" => "btn btn-success"]) !!}
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
    $("#empresa-form").submit("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: $(this).serialize(),
        beforeSend: function() {$(".panel-footer").empty();},
        success: function(respuesta) {
          var html = "<div class='alert alert-success'>";
          if ($(this).attr("method") == 'PUT') {
            html += "<p>Empresa Creada Correctamente</p>";
            $("#empresa-form")[0].reset();
          } else {
            html += "<p>Empresa Editada Correctamente</p>";
          }
          html += "</div>";
          $(".panel-footer").html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          if (jqXHR.status == 422) {
            for(let i in jqXHR.responseJSON) {
              var html = "<div class='alert alert-danger'>";
              html +="<p>" + jqXHR.responseJSON[i][0] + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
              return;
            }
          }
          if (jqXHR.status >= 500) {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
          }
        }
      });
    });
  });
</script>
@endsection
