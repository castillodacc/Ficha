@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Generar reporte de un cliente</div>
        <div class="panel-body">
          @if($clientes->isNotEmpty())
          {!! Form::open(['url' => '/reporte/cliente', 'id' => 'reporte-cliente-form', 'target' => '_blank']) !!}
          <div class="form-group">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group date">
                      {!! Form::label('fecha_inicio', 'Desde:') !!}
                      {!! Form::text('fecha_inicio', null, [
                       'class'               => 'form-control datepicker',
                       'data-provide'        => 'datepicker',
                       'data-date-format'    => 'yyyy-mm-dd',
                       'data-date-language'  => 'es',
                       'data-date-autoclose' => 'true',
                       'placeholder'         => 'Escoger fecha',
                       'autocomplete'        => 'off'
                       ]) !!}
                     </div>
                   </div>
                   <div class="col-md-4">
                    <div class="input-group date">
                      {!! Form::label('fecha_fin', 'Hasta:') !!}
                      {!! Form::text('fecha_fin', null, [
                       'required'            => 'required',
                       'class'               => 'form-control datepicker',
                       'data-provide'        => 'datepicker',
                       'data-date-format'    => 'yyyy-mm-dd',
                       'data-date-language'  => 'es',
                       'data-date-autoclose' => 'true',
                       'placeholder'         => 'Escoger fecha',
                       'autocomplete'        => 'off'
                       ]) !!}
                     </div>
                   </div>
                   <div class="col-md-4">
                    {!! Form::label('cliente', 'Cliente:') !!}
                    {!! Form::select('cliente', $clientes, null, ['required' => 'required', 'class'    => 'form-control']) !!}
                  </div>
                </div>
                <div class="form-group">
                  <br>
                  {!! Form::submit('Generar', ["class" => "btn btn-success btn-block"]) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
          @else
          <div class="alert alert-danger" role="alert">
            <p>No se encuentran clientes registrados</p>
          </div>
          @endif
        </div>
        <div class="panel-footer">
          @if($errors->any())
          <div class="alert alert-danger" role="alert">
            <p>{{$errors->first()}}</p>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker-1.6.4-dist/locales/bootstrap-datepicker.es.min.js') }}" charset="UTF-8"></script>
@endsection
