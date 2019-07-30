@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            EDITAR ADMINISTRADOR
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => '/admin/'.$admin->id, 'method' => 'put', 'id' => 'update-admin-form']) !!}
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('username', 'Correo de usuario:', ['style' => 'display:block;']) !!}
                {!! Form::email('username',
                               $admin->user->username,
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
                               $admin->nombre,
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
                  @can('crear_admin', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_admin', 'Crea Administrador:') !!}
                      @if($admin->crea_admin)
                        {!! Form::checkbox('crea_admin', true, true) !!}
                      @else
                        {!! Form::checkbox('crea_admin') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('crear_empleado', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_empleado', ' Crea Empleado:') !!}
                      @if($admin->crea_empleado)
                        {!! Form::checkbox('crea_empleado', true, true) !!}
                      @else
                        {!! Form::checkbox('crea_empleado') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('crear_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_cliente', ' Crea Cliente:') !!}
                      @if($admin->crea_cliente)
                        {!! Form::checkbox('crea_cliente', true, true) !!}
                      @else
                        {!! Form::checkbox('crea_cliente') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                </div>
                <div class="row">
                  @can('gestionar_admin', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_admin', 'Gestiona Administradores') !!}
                      @if($admin->gestiona_admin)
                        {!! Form::checkbox('gestiona_admin', true, true) !!}
                      @else
                        {!! Form::checkbox('gestiona_admin') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_empleado', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_empleado', 'Gestiona Empleados:') !!}
                      @if($admin->gestiona_empleado)
                        {!! Form::checkbox('gestiona_empleado', true, true) !!}
                      @else
                        {!! Form::checkbox('gestiona_empleado') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_cliente', 'Gestiona Clientes:') !!}
                      @if($admin->gestiona_cliente)
                        {!! Form::checkbox('gestiona_cliente', true, true) !!}
                      @else
                        {!! Form::checkbox('gestiona_cliente') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                </div>
                <div class="row">
                  @can('crear_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_jornada', 'Crea Jornadas:') !!}
                      @if($admin->crea_jornada)
                        {!! Form::checkbox('crea_jornada', true, true) !!}
                      @else
                        {!! Form::checkbox('crea_jornada') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_jornada', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_jornada', 'Gestiona Jornadas:') !!}
                      @if($admin->gestiona_jornada)
                        {!! Form::checkbox('gestiona_jornada', true, true) !!}
                      @else
                        {!! Form::checkbox('gestiona_jornada') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                  @can('generar_reporte', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('genera_reporte', 'Genera Reportes:') !!}
                      @if($admin->genera_reporte)
                        {!! Form::checkbox('genera_reporte', true, true) !!}
                      @else
                        {!! Form::checkbox('genera_reporte') !!}
                      @endif
                    </div>
                  </div>
                  @endcan
                </div>

                {{-- <div class="row">
                <div class="col-md-4">
                <div class="input-group">
                {!! Form::label('hereda_permisos', 'Hereda Permisos:') !!}
                {!! Form::checkbox('hereda_permisos'); !!}
                </div>
                </div>
                </div> --}}

              </div>
            </div>
            {!! Form::close() !!}
            <div class="form-group">
              <br>
              <input type="submit" form="update-admin-form" class="btn btn-success btn-block" value="Actualizar Administrador"/>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#update-admin-form").submit("submit", function(e) {
        $.ajax({
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function()
          {
            $(".panel-footer").empty();
          },
          success: function(respuesta)
          {
            if(!respuesta.error) {
              var html = "<div class='alert alert-success'>";
              html += "<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            } else {
              var html = "<div class='alert alert-danger'>";
              html +="<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            }
          },
          error: function()
          {
            var html = "<div class='alert alert-danger'>";
            html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
            html += "</div>";
            $(".panel-footer").html(html);
          }
        });
        e.preventDefault();
      });
    });
  </script>
@endsection
