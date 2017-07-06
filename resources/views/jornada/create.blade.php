@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            CREAR JORNADA
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => '/jornada', 'id' => 'jornada-form']) !!}
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
                {!! Form::label('horas_laborales', 'Horas Laborales:', ['style' => 'display:block;']) !!}
                {!! Form::number('horas_laborales',
                               null,
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
                                 ['diurno' => 'Diurno','nocturno' => 'Nocturno'],
                                 null,
                                 [
                                   'required' => 'required',
                                   'class'      => 'form-control',
                                 ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  {!! Form::label('horas_extras', 'Horas extras:') !!}
                  {!! Form::checkbox('horas_extras') !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  {!! Form::label('hora_comida', 'Hora comida:') !!}
                  {!! Form::checkbox('hora_comida') !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <div id="horas-comida" class="hidden">
                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::label('inicio_comida', 'Inicio Comida:') !!}
                        {!! Form::text('inicio_comida',
                                       null,
                                       [
                                         'class' => 'form-control time start',
                                       ])
                        !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::label('fin_comida', 'Fin Comida:') !!}
                        {!! Form::text('fin_comida',
                                       null,
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
              <input type="submit" form="jornada-form" class="btn btn-success btn-block" value="Crear Jornada" disabled/>
            </div>
          </div>
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
      $('#inicio_comida').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
      });
      $('#fin_comida').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
      });

      // initialize datepair
      $('#horas-comida').datepair();

      $("#hora_comida").on("change", function(){
        if($(this).is(":checked")) {
          $("#horas-comida").removeClass("hidden");
          $("#inicio_comida").prop("required",true);
          $("#fin_comida").prop("required",true);
        } else {
          $("#horas-comida").addClass("hidden");
          $("#inicio_comida").prop("required",false);
          $("#fin_comida").prop("required",false);
        }
      });
    });
  </script>

@endsection
