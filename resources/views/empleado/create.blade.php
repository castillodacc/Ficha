@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            CREAR EMPLEADO
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => '/empleado', 'id' => 'empleado-form']) !!}
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('username', 'Nombre de usuario:', ['style' => 'display:block;']) !!}
                {!! Form::email('username',
                                null,
                                [
                                  'class' => 'form-control',
                                  'required' => 'required'
                                ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('password', 'Contraseña:', ['style' => 'display:block;']) !!}
                  {!! Form::text('password',
                                     null,
                                     [
                                       'class' => 'form-control',
                                       'required' => 'required'
                                     ])
                  !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('correo', 'Correo:', ['style' => 'display:block;']) !!}
                {!! Form::email('correo',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('nombre', 'Nombre:', ['style' => 'display:block;']) !!}
                {!! Form::text('nombre',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('apellido', 'Apellido:', ['style' => 'display:block;']) !!}
                {!! Form::text('Apellido',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('dni', 'DNI:', ['style' => 'display:block;']) !!}
                {!! Form::text('dni',
                                 null,
                                 [
                                   'class' => 'form-control',
                                   'required' => 'required'
                                 ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('telefono', 'Tel&eacute;fono:', ['style' => 'display:block;']) !!}
                {!! Form::text('telefono',
                               null,
                               [
                                 'class' => 'form-control',
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('telefono_movil', 'Tel&eacute;fono M&oacute;vil:', ['style' => 'display:block;']) !!}
                {!! Form::text('telefono_movil',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('vacaciones', 'Vacaciones:', ['style' => 'display:block;']) !!}
                {!! Form::text('vacaciones',
                               null,
                               [
                               'class' => 'form-control datemulti',
                               'placeholder'         => 'Seleccionar fecha',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('festivos', 'Festivos:', ['style' => 'display:block;']) !!}
                {!! Form::text('festivos',
                               null,
                               [
                               'class' => 'form-control datemulti',
                               'placeholder'         => 'Seleccionar fecha',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('bajas_ausencias', 'Bajas o Ausencias:', ['style' => 'display:block;']) !!}
                {!! Form::text('bajas_ausencias',
                               null,
                               [
                               'class' => 'form-control datemulti',
                               'placeholder'         => 'Seleccionar fecha',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                <label for="jornada_id" style="display:block;">Jornada Laboral:</label>
                <select id="jornada_id" required="required" class="form-control" name="jornada_id">
                  <option value="" selected="">Seleccione una Jornada Laboral</option>
                  @foreach($jornadas as $key => $j)
                  <option value="{{ $key }}">{{ $j }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('contrato_start', 'Inicio de Contrato:', ['style' => 'display:block;']) !!}
                {!! Form::text('contrato_start',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
                               'required'            => 'required',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('contrato_end', 'Fin de Contrato:', ['style' => 'display:block;']) !!}
                {!! Form::text('contrato_end',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
                               'required'            => 'required',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('vacaciones_start', 'Inicio de Vacaciones:', ['style' => 'display:block;']) !!}
                {!! Form::text('vacaciones_start',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
                               'required'            => 'required',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('vacaciones_end', 'Fin de Vacaciones:', ['style' => 'display:block;']) !!}
                {!! Form::text('vacaciones_end',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
                               'required'            => 'required',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="empresa_id" style="display:block;">Empresa:</label>
                <select id="empresa_id" required="required" class="form-control" name="empresa_id">
                  <option value="" selected="">Seleccione una Empresa</option>
                  @foreach($empresas as $key => $e)
                  <option value="{{ $key }}">{{ $e }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                {!! Form::label('horas_dias_contratado', 'Número de horas/días Contratado:', ['style' => 'display:block;']) !!}
                {!! Form::text('horas_dias_contratado',
                               null,
                               [
                               'class' => 'form-control',
                               'required' => 'required',
                               ]
                    )
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('razon_social', 'Razón Social:', ['style' => 'display:block;']) !!}
                {!! Form::text('razon_social',
                               null,
                               [
                               'class' => 'form-control',
                               'required' => 'required',
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('cif', 'C.I.F:', ['style' => 'display:block;']) !!}
                {!! Form::text('cif',
                               null,
                               [
                               'class' => 'form-control',
                               'required' => 'required',
                               ]
                    )
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="provincia_id" style="display:block;">Provincia:</label>
                <select id="provincia_id" required="required" class="form-control" name="provincia_id">
                  <option value="" selected="">Seleccione una Provincia</option>
                  @foreach($provincias as $key => $p)
                  <option value="{{ $key }}">{{ $p }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="poblacion_id" style="display:block;">Población:</label>
                <select id="poblacion_id" required="required" class="form-control" name="poblacion_id">
                  <option value="" selected="">Seleccione una Población</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                {!! Form::label('direccion', 'Direcci&oacute;n:', ['style' => 'display:block;']) !!}
                {!! Form::text('direccion',
                               null,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            @if($clientes->isNotEmpty())
              <div class="row">
                <div class="col-md-6">
                  {!! Form::label('cliente_id', 'Cliente:', ['style' => 'display:block;']) !!}
                  {!! Form::select('cliente_id',
                                   $clientes,
                                   null,
                                   [
                                     'id' => 'cliente_id',
                                     'required' => 'required',
                                     'class' => 'form-control'
                                   ]
                      )
                  !!}
                </div>
                <div class="col-md-6" style="margin-top: 30px;">
                  {!! Form::label('libre', 'Fichaje Libre:', ['style' => 'margin-right: 15px ']) !!}
                  {!! Form::checkbox('libre', 1, $empleado->libre) !!}
                </div>
              </div>
            @else
              <br>
              <div class="alert alert-warning" role="alert">
                <p>No hay clientes disponibles. Por favor, <a href="/cliente/create">agregue</a> al menos uno.</p>
              </div>
            @endif
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="empleado-form" class="btn btn-success btn-block" value="Crear Empleado"/>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/locales/bootstrap-datepicker.es.min.js') }}" charset="UTF-8"></script>
  <script>
    $(document).ready(function (){
      $('.datemulti').datepicker({
        multidate: true,
        format: 'yyyy-mm-dd',
        language: 'es',
      });
      $('#provincia_id').change(function () {
        $.ajax({
          type: "POST",
          url: '/empleado/' + $(this).val() + '/poblacion',
          data: {
            '_token': $('meta[name="csrf-token"]')[0].content
          },
          dataType: 'json', 
          success: function(response) {
            $('select#poblacion_id').html('<option value="" selected="">Seleccione una Población</option>');
            for(let i in response) {
              element = document.createElement('option');
              element.value = response[i].id;
              element.text = response[i].nombre;
              $('select#poblacion_id').append(element);
            }
          }
        });
      });
      $("#empleado-form").submit("submit", function(e) {
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
              $("#empleado-form")[0].reset();
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
