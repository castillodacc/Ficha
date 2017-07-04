@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                  @if (Auth::user()->is_admin)
                    <ul class="list-inline">
                      <div class="row">
                        <div class="col-xs-4">
                          <li><a href="/empleado/create" class="btn">Crear empleado</a></li>
                        </div>
                        <div class="col-xs-4">
                          <li><a href="/admin/create" class="btn">Crear admin</a></li>
                        </div>
                        <div class="col-xs-4">
                          <li><a href="/jornada/create" class="btn">Crear Jornada</a></li>
                        </div>
                      </div>
                    </ul>
                  @else
                    <ul class="list-inline">
                      <div class="row">
                        <div class="col-xs-4">
                          <li><a href="#" class="btn">Jornada</a></li>
                        </div>
                        <div class="col-xs-4">
                          <li><a href="#" class="btn">Hora de descanso</a></li>
                        </div>
                        <div class="col-xs-4">
                          <li><a href="#" class="btn">Horas extras</a></li>
                        </div>
                      </div>
                    </ul>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
