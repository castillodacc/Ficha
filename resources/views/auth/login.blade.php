@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Iniciar sesi&oacute;n</div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input id="username" type="email" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required value="">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="type" type="checkbox" name="type" checked=""> <span id="tipe_span">Administrador</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if(env('APP_ENV') == 'local')
                        <script>
                            $('#username').val('admin@ficha.com');
                            $('#password').val('admin');
                            $('#type').change(function () {
                                if ($('#tipe_span').text() == 'Administrador') {
                                    $('#tipe_span').text('Empleado');
                                    $('#username').val('empleado1@ficha.com');
                                    $('#password').val('empleado');
                                } else {
                                    $('#tipe_span').text('Administrador');
                                    $('#username').val('admin@ficha.com');
                                    $('#password').val('admin');
                                }
                            });
                        </script>
                        @endif

                        {{-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Iniciar sesi&oacute;n
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvid&oacute; su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
