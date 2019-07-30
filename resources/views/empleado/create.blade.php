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
                <div class="form-group">
                  <label for="password" style="display:block;">Contraseña:</label>
                  <input class="form-control" required="required" name="password" type="password" id="password">
                </div>
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
                {!! Form::label('dni', 'DNI/NIE:', ['style' => 'display:block;']) !!}
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
                <div class="form-group" style="margin:0">
                {!! Form::label('vacaciones', 'Vacaciones:', ['style' => 'display:block;']) !!}
                  <div class="input-group">
                    <label for="vacaciones" class="input-group-addon control-label">
                      <input type="checkbox" id="activar_vacaciones" name="activar_vacaciones" data-tooltip="tooltip" title="Sin Determinar">
                    </label>
                    <input id="vacaciones" type="text" name="vacaciones" class="form-control datemulti" placeholder="Seleccionar fecha" value="Sin Determinar" autocomplete="off" readonly="" disabled="">
                  </div>
                </div>
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
              <div class="col-md-6 col-md-offset-3">
                <label for="tipo_contrato_id" style="display:block;">Tipo contrato:</label>
                <select id="tipo_contrato_id" required="required" class="form-control" name="tipo_contrato_id">
                  <option value="1">Sin Determinar</option>
                  <option value="2">Contrato Indefinido</option>
                  <option value="3">Contrato Fin de Obra</option>
                  <option value="4">Contrato Servicio</option>
                </select>
              </div>
              <div class="col-md-6">
                {!! Form::label('contrato_start', 'Fecha alta:', ['style' => 'display:block;']) !!}
                {!! Form::text('contrato_start',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
                               'autocomplete'        => 'off'
                               ]
                    )
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('contrato_end', 'Fecha fin:', ['style' => 'display:block;']) !!}
                {!! Form::text('contrato_end',
                               null,
                               [
                               'class' => 'form-control',
                               'data-provide'        => 'datepicker',
                               'data-date-format'    => 'yyyy-mm-dd',
                               'data-date-language'  => 'es',
                               'data-date-autoclose' => 'true',
                               'placeholder'         => 'Seleccionar fecha',
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
              <div class="col-md-12">
                {!! Form::label('direccion', 'Direcci&oacute;n:', ['style' => 'display:block;']) !!}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                  {!! Form::checkbox('libre', 1, null) !!}
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
      $('[data-tooltip="tooltip"]').tooltip();
      $('.datemulti').datepicker({
        multidate: true,
        format: 'yyyy-mm-dd',
        language: 'es',
      });
      $('#activar_vacaciones').click(function (el) {
        if (el.target.checked) {
          $('#vacaciones')
          .removeAttr('readonly')
          .removeAttr('disabled')
          .attr('title', 'Activo')
          .val('');
        } else {
          $('#vacaciones')
          .attr('readonly', 'readonly')
          .attr('disabled', 'disabled')
          .attr('title', 'Sin Determinar')
          .val('Sin Determinar');
        }
        $('[data-tooltip="tooltip"]').tooltip();
      });
      $("#empleado-form").submit("submit", function(e) {
        $.ajax({
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $(".panel-footer").empty();
          },
          success: function(respuesta) {
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
          error: function() {
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
