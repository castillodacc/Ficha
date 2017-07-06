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
            {!! Form::open(['url' => '/empleado', 'id' => 'propiedad-form']) !!}
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('usuario', 'Nombre de usuario:', ['style' => 'display:block;']) !!}
                {!! Form::text('usuario',
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
                {!! Form::number('dni',
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
                                 'required' => 'required'
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
                               ])
                !!}
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
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="empleado-form" class="btn btn-success btn-block" value="Crear Empleado" disabled/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
