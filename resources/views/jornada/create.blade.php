@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            INSERTAR JORNADA
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
            <br/>
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
            <br/>
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  {!! Form::label('horas_extras', 'Horas extras:') !!}
                  {!! Form::checkbox('horas_extras') !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="jornada-form" class="btn btn-success btn-block" value="Insertar Jornada" disabled/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
