@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            CREAR ADMINISTRADOR
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => '/admin', 'id' => 'admin-form']) !!}
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
            <div class="panel panel-default">
              <div class="panel-heading">
                PERMISOS
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_admin', 'Crea Administrador:') !!}
                      {!! Form::checkbox('crea_admin') !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_empleado', ' Crea Empleado:') !!}
                      {!! Form::checkbox('crea_empleado') !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_cliente', ' Crea Cliente:') !!}
                      {!! Form::checkbox('crea_cliente') !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_admin', 'Gestiona Administradores') !!}
                      {!! Form::checkbox('gestiona_admin') !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_empleados', 'Gestiona Empleados:') !!}
                      {!! Form::checkbox('gestiona_empleados') !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_cliente', 'Gestiona Cliente:') !!}
                      {!! Form::checkbox('gestiona_cliente') !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_jornada', 'Crea Jornada:') !!}
                      {!! Form::checkbox('crea_jornada'); !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_jornada', 'Gestiona Jornada:') !!}
                      {!! Form::checkbox('gestiona_jornada') !!}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('genera_reporte', 'Genera Reporte:') !!}
                      {!! Form::checkbox('genera_reporte') !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('hereda_permisos', 'Hereda Permisos:') !!}
                      {!! Form::checkbox('hereda_permisos'); !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="admin-form" class="btn btn-success btn-block" value="Crear Administrador" disabled/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
