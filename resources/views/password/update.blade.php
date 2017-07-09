@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Cambiar Contraseña</div>
          <div class="panel-body">
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            <form name="updated-password-form" id="updated-password-form" class="form-horizontal" role="form" method="POST" action="{{ url('/password/save') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('password_actual') ? ' has-error' : '' }}">
                <label for="current-password" class="col-md-4 control-label">Contraseña Actual</label>
                <div class="col-md-6">
                  <input name="current_password" id="current_password" type="password" class="form-control" required autofocus>
                  @if ($errors->has('password_actual'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password_actual') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Nueva Contraseña</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="col-md-4 control-label">Confirmar Contraseña</label>
                <div class="col-md-6">
                  <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Cambiar Contraseña
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function (){
      $("#updated-password-form").submit("submit", function(e) {
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
              $("#updated-password-form")[0].reset();
            } else {
              var html = "<div class='alert alert-danger'>";
              html +="<p>" + respuesta.mensaje + "</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            }
          },
          error: function(respuesta)
          {
            console.log(respuesta);
            if(respuesta.status  == 422) {
              var html = "<div class='alert alert-danger'>";
              html +="<p>Por favor, verifique que los datos ingresados sean correctos.</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            } else {
              var html = "<div class='alert alert-danger'>";
              html +="<p>Error en el servidor. Por favor, recargue la p&aacute;gina, si el problema persiste contacte al administrador del sitio.</p>";
              html += "</div>";
              $(".panel-footer").html(html);
            }
          }
        });
        e.preventDefault();
      });

    });
  </script>
@endsection
