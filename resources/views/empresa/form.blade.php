@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $empresa->id ? 'EDITAR' : 'CREAR' }} EMPRESA</div>
        <div class="panel-body">
          {!! Form::open(['url' => ($empresa->id ? '/empresa/' . $empresa->id : '/empresa'), 'id' => 'empresa-form', 'method' => $empresa->id ? 'PUT' : 'POST']) !!}
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('nombre', 'Nombre de Empresa:') !!}
              {!! Form::text('nombre', $empresa->nombre, ['class' => 'form-control', 'required' => 'required' ]) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('detalles', 'Detalles:') !!}
              {!! Form::text('detalles', $empresa->detalles, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('cif', 'C.I.F:', ['style' => 'display:block;']) !!}
              {!! Form::text('cif', $empresa->cif, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('telefono', 'Teléfono:') !!}
              {!! Form::text('telefono', $empresa->telefono, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('correo', 'Correo:') !!}
              {!! Form::text('correo', $empresa->correo, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('razon_social', 'Razón Social:', ['style' => 'display:block;']) !!}
              {!! Form::text('razon_social', $empresa->razon_social, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="provincia_id" style="display:block;">Provincia:</label>
              <select id="provincia_id" class="form-control" name="provincia_id" required="">
                <option value="" selected="">Seleccione una Provincia</option>
                @foreach($provincias as $key => $p)
                <option value="{{ $key }}" {{ ($empresa->provincia_id == $key) ? 'selected=""' : '' }}>{{ $p }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="poblacion_id" style="display:block;">Localidad:</label>
              <select id="poblacion_id" class="form-control" name="poblacion_id" required="">
                <option value="" selected="">Seleccione una Localidad</option>
                @if(count($poblaciones))
                @foreach($poblaciones as $key => $p)
                <option value="{{ $key }}" {{ ($empresa->poblacion_id == $key) ? 'selected=""' : '' }}>{{ $p }}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('direccion', 'Dirección') !!}
              {!! Form::textarea('direccion', $empresa->direccion, ['class' => 'form-control', 'rows' => '2', 'required' => 'required']) !!}
            </div>
          </div>
          <div class="col-md-12 text-center">
            <div class="form-group">
              {!! Form::submit($empresa->id ? 'Editar' : 'Crear', ["class" => "btn btn-success"]) !!}
            </div>
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
    $('#provincia_id').change(function () {
      $.ajax({
        type: "POST",
        url: '/empleado/' + $(this).val() + '/poblacion',
        data: {
          '_token': $('meta[name="csrf-token"]')[0].content
        },
        dataType: 'json', 
        success: function(response) {
          $('select#poblacion_id').html('<option value="" selected="">Seleccione una Localidad</option>');
          for(let i in response) {
            element = document.createElement('option');
            element.value = response[i].id;
            element.text = response[i].nombre;
            $('select#poblacion_id').append(element);
          }
        }
      });
    });
    $("#empresa-form").submit("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: $(this).serialize(),
        beforeSend: function() {$(".panel-footer").empty();},
        success: function(respuesta) {
          var html = "<div class='alert alert-success'>";
          console.log($(this).attr("method"))
          if ($('input[name="_method"]').attr("value") == 'PUT') {
            html += "<p>Empresa Editada Correctamente</p>";
          } else {
            html += "<p>Empresa Creada Correctamente</p>";
            $("#empresa-form")[0].reset();
            $('#poblacion_id').html('<option value="" selected="">Seleccione una Población</option>')
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
