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
                {!! Form::label('username', 'Correo de usuario:', ['style' => 'display:block;']) !!}
                {!! Form::email('username',
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
                  @can('crear_admin', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_admin', 'Crea Administrador:') !!}
                      {!! Form::checkbox('crea_admin') !!}
                    </div>
                  </div>
                  @endcan
                  @can('crear_empleado', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_empleado', ' Crea Empleado:') !!}
                      {!! Form::checkbox('crea_empleado') !!}
                    </div>
                  </div>
                  @endcan
                  @can('crear_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_cliente', ' Crea Cliente:') !!}
                      {!! Form::checkbox('crea_cliente') !!}
                    </div>
                  </div>
                  @endcan
                </div>
                <div class="row">
                  @can('gestionar_admin', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_admin', 'Gestiona Administradores') !!}
                      {!! Form::checkbox('gestiona_admin') !!}
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_empleado', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_empleado', 'Gestiona Empleados:') !!}
                      {!! Form::checkbox('gestiona_empleado') !!}
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_cliente', 'Gestiona Clientes:') !!}
                      {!! Form::checkbox('gestiona_cliente') !!}
                    </div>
                  </div>
                  @endcan
                </div>
                <div class="row">
                  @can('crear_cliente', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('crea_jornada', 'Crea Jornadas:') !!}
                      {!! Form::checkbox('crea_jornada'); !!}
                    </div>
                  </div>
                  @endcan
                  @can('gestionar_jornada', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('gestiona_jornada', 'Gestiona Jornadas:') !!}
                      {!! Form::checkbox('gestiona_jornada') !!}
                    </div>
                  </div>
                  @endcan
                  @can('generar_reporte', Auth::user()->admin)
                  <div class="col-md-4">
                    <div class="input-group">
                      {!! Form::label('genera_reporte', 'Genera Reportes:') !!}
                      {!! Form::checkbox('genera_reporte') !!}
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
              <input type="submit" form="admin-form" class="btn btn-success btn-block" value="Crear Administrador"/>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#admin-form").submit("submit", function(e) {
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
              $("#admin-form")[0].reset();
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
