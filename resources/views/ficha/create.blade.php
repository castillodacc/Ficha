@extends('layouts.app')

@section('content')

  {!! Form::open(['url' => '#', 'id' => 'ficha-form']) !!}
  <div class="form-group">
    <div class="panel panel-default">
      <div class="panel-body">
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
        <br>
      </div>
    </div>
    {!! Form::close() !!}
    <div class="form-group">
      <br>
      <input type="submit" form="propiedad-form" class="btn btn-success btn-block" value="Insertar Inmueble"/>
    </div>
  </div>
@endsection
