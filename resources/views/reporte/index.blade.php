@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Reportes</div>
          <div class="panel-body">
            <ul class="list-inline">
              <div class="row">
                <div class="col-md-4">
                  <li><a href="/reporte/cliente" class="btn">Reporte de un cliente</a></li>
                </div>
                <div class="col-md-4">
                  <li><a href="/reporte/clientes" class="btn">Reporte de todos los clientes</a></li>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <li><a href="/reporte/empleado" class="btn">Reporte de un empleado</a></li>
                </div>
                <div class="col-md-4">
                  <li><a href="/reporte/empleados" class="btn">Reporte de todos los empleados</a></li>
                </div>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
