@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">JORNADA DEL DÍA</div>
          <div class="panel-body">
            @if($clientes->isNotEmpty())
              {!! Form::open(['url' => '/empleado/'.$empleado->id.'/iniciar', 'class' => 'form-inline', 'id' => 'jornada-form']) !!}
              <div class="form-group">
                {!! Form::label('cliente', 'Cliente:') !!}
                <select id="cliente" name="cliente"'>
                  @foreach($clientes as $id => $nombre)
                    <option value="{{$id}}">{{$nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                {!! Form::submit('Iniciar Jornada', ["class" => "btn btn-success"]) !!}
              </div>
              {!! Form::close() !!}
            @else
              <div class="alert alert-danger" role="alert">
                <p>No hay clientes disponibles.</p>
              </div>
            @endif
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function (){
      $("#jornada-form").submit("submit", function(e) {
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
            $("#poblacion-form")[0].reset();
          },
          error: function()
          {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
            $("#poblacion-form")[0].reset();
          }
        });
        e.preventDefault();
        e.stopPropagation();
      });
    });
  </script>
@endsection
