<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/report.css') }}">
  <title>REPORTE DEL CLIENTE: {{ strtoupper($cliente->nombre) }}.</title>
</head>
<body>
  <div class="row text-center">
    <img src="{{ asset('/imgs/logo.png') }}">
  </div>
  <div class="row">
    <h3 class="text-center">Reporte del Cliente: {{ $cliente->nombre }}.</h3>
  </div>
  <div class="row">
    <div class="col-md-6">Rango de fecha Consultado: {{ $request->fecha_inicio }} - {{ $request->fecha_fin }}.</div>
    <div class="col-md-6">Correo: {{ $cliente->correo }}.</div>
  </div>
  <div class="row">
    <div class="col-md-6">Teléfono: {{ $cliente->telefono }}.</div>
    <div class="col-md-6">Dirección: {{ $cliente->direccion }}.</div>
  </div>
  @if($fichas->isNotEmpty())
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>FECHA</th>
            <th>EMPLEADO</th>
            <th>DNI</th>
            <th>H. TRABAJADAS</th>
            <th>H. EXTRAS</th>
          </tr>
        </thead>
        <tbody>
          <?php $n = 1; $used = []; ?>
          @foreach($fichas as $ficha)
          <?php
          $fecha_i = (!isset($fecha_i)) ? request()->fecha_inicio : $fecha_f; 
          $fecha_f = $ficha->fecha;
          ?>
          @foreach(\App\Empleado::fechasParaReporte($fecha_i, $fecha_f, $used, null, $cliente) as $f)
          <?php $used[] = $f ?>
          <tr style="background: #eee">
            <th>{{ $n++ }}</th>
            <td>{{ $f['fecha'] }}</td>
            <td>{{ $f['nombre'] }}</td>
            <td class="text-right">{{ number_format($f['dni'], 0, '', '.') }}</td>
            <td colspan="2" class="text-center"><b>{{ $f['tipo'] }}</b></td>
          </tr>
          @endforeach
          <tr>
            <th>{{ $n++ }}</th>
            <td>{{ \Carbon::parse($ficha->fecha)->format('d/m/Y') }}</td>
            <td>{{ $ficha->empleado->nombre.' '.$ficha->empleado->apellido }}</td>
            <td class="text-right">{{ number_format($ficha->empleado->dni, 0, '', '.') }}</td>
            <td class="text-right">{{ $ficha->getTotalHorasTrabajadas() }}</td>
            <td class="text-right">{{ $ficha->getTotalHorasExtras() }}</td>
          </tr>
          @endforeach
          @foreach(\App\Empleado::fechasParaReporte($fecha_f, request()->fecha_fin, $used, null, $cliente) as $f)
          <?php $used[] = $f ?>
          <tr style="background: #eee">
            <th>{{ $n++ }}</th>
            <td>{{ $f['fecha'] }}</td>
            <td>{{ $f['nombre'] }}</td>
            <td class="text-right">{{ number_format($f['dni'], 0, '', '.') }}</td>
            <td colspan="2" class="text-center"><b>{{ $f['tipo'] }}</b></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"><strong>TOTALES</strong></td>
            <td class="text-right">{{ $horas_trabajadas }}</td>
            <td class="text-right">{{ $horas_extras }}</td>
          </tr>
          <tr>
            <td colspan="5"><strong>JORNADAS CUMPLIDAS</strong></td>
            <td><strong>{{ $porcentaje_jornada }}</strong> Jornadas</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  @else
  <div class="row">
    <p class="text-center">No se encuentran datos en la fecha seleccionada</p>
  </div>
  @endif
</body>
</html>
