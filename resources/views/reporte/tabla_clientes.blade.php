<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        {{-- <div class="panel-heading">REPORTE CLIENTE</div> --}}
        <div class="panel-body">
          @if($fichas->isNotEmpty())
            <div class="table-responsive">
              <table class="table table-striped" border="1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th>EMPLEADO</th>
                    <th>TOTAL HORAS TRABAJADAS</th>
                    <th>TOTAL HORAS EXTRAS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fichas as $ficha)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$ficha->fecha}}</td>
                      <td>{{$ficha->cliente->nombre}}</td>
                      <td>{{$ficha->empleado->nombre}}</td>
                      <td>{{$ficha->getTotalHorasTrabajadas()}}</td>
                      <td>{{$ficha->getTotalHorasExtras()}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          @else
              <div class="alert alert-danger" role="alert">
                <p>No se encuentran datos en la fecha seleccionada</p>
              </div>
          @endif
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
