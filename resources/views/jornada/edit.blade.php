@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            EDITAR JORNADA
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => '/jornada/'.$jornada->id, 'method' => 'put', 'id' => 'update-jornada-form']) !!}
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('nombre', 'Nombre:', ['style' => 'display:block;']) !!}
                {!! Form::text('nombre',
                               $jornada->nombre,
                               [
                                 'class' => 'form-control',
                                 'required' => 'required'
                               ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('horas_laborales', 'Horas Laborales:', ['style' => 'display:block;']) !!}
                {!! Form::number('horas_laborales',
                                 $jornada->horas_laborales,
                                 [
                                   'class' => 'form-control',
                                   'required' => 'required',
                                   'min' => '1',
                                   'max' => '8'
                                 ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('tipo', 'Tipo:',['style' => 'display:block;']) !!}
                {!! Form::select('tipo',
                                 ['diurna' => 'Diurna','nocturna' => 'Nocturna'],
                                 $jornada->tipo,
                                 [
                                   'required' => 'required',
                                   'class'      => 'form-control',
                                 ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <div id="horas-jornada">
                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::label('hora_inicio_jornada', 'Inicio Jornada:') !!}
                        {!! Form::text('hora_inicio_jornada',
                                       $jornada->hora_inicio_jornada,
                                       [
                                         'class' => 'form-control time start',
                                       ])
                        !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::label('hora_fin_jornada', 'Fin Jornada:') !!}
                        {!! Form::text('hora_fin_jornada',
                                       $jornada->hora_fin_jornada,
                                       [
                                         'class' => 'form-control time end',
                                       ]
                            )
                        !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  {!! Form::label('horas_extras', 'Horas extras:') !!}
                  {!! Form::checkbox('horas_extras', $jornada->horas_extras) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  {!! Form::label('hora_comida', 'Hora comida:') !!}
                  @if($jornada->hora_inicio_comida and $jornada->hora_fin_comida)
                    {!! Form::checkbox('hora_comida', true, true) !!}
                  @else
                    {!! Form::checkbox('hora_comida') !!}
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  @if($jornada->hora_inicio_comida and $jornada->hora_fin_comida)
                    <div id="horas-comida">
                  @else
                      <div id="horas-comida" class="hidden">
                  @endif
                      <div class="row">
                        <div class="col-md-12">
                        {!! Form::label('hora_inicio_comida', 'Inicio Comida:') !!}
                        {!! Form::text('hora_inicio_comida',
                                       $jornada->hora_inicio_comida,
                                       [
                                         'class' => 'form-control time start',
                                       ])
                        !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::label('hora_fin_comida', 'Fin Comida:') !!}
                        {!! Form::text('hora_fin_comida',
                                       $jornada->hora_fin_comida,
                                       [
                                         'class' => 'form-control time end',
                                       ]
                            )
                        !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="update-jornada-form" class="btn btn-success btn-block" value="Actualizar Jornada"/>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
  <link href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet">
  <script src="{{ asset('js/datepair.js') }}"></script>
  <script src="{{ asset('js/jquery.datepair.js') }}"></script>
  <script>
    $(document).ready(function (){
      // initialize input widgets first
      $('#hora_inicio_jornada').timepicker({
        'showDuration': true,
        'timeFormat': 'G:i'
      });
      $('#hora_fin_jornada').timepicker({
        'showDuration': true,
        'timeFormat': 'G:i'
      });
      // initialize datepair
      $('#horas-jornada').datepair();

      // initialize input widgets first
      $('#hora_inicio_comida').timepicker({
        'showDuration': true,
        'timeFormat': 'G:i'
      });
      $('#hora_fin_comida').timepicker({
        'showDuration': true,
        'timeFormat': 'G:i'
      });

      // initialize datepair
      $('#horas-comida').datepair();

      $("#hora_comida").on("change", function(){
        if($(this).is(":checked")) {
          $("#horas-comida").removeClass("hidden");
          $("#hora_inicio_comida").prop("required",true);
          $("#hora_fin_comida").prop("required",true);
        } else {
          $("#horas-comida").addClass("hidden");
          $("#hora_inicio_comida").prop("required",false);
          $("#hora_fin_comida").prop("required",false);
        }
      });

      $("#update-jornada-form").submit("submit", function(e) {
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
