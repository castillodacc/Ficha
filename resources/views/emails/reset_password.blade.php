<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Restablecer la Contraseña</title>
	<style>
		* {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		html, body {
			background-color: #f5f8fa;
			color: #636b6f;
			font-family: 'Raleway', sans-serif;
			line-height: 1.6;
			font-size: 14px;
			margin: 0;
		}

		.full-height {
			height: 100vh;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.position-ref {
			position: relative;
		}

		.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
		}

		.text-center {
			text-align: center;
		}

		.links > a {
			color: #636b6f;
			padding: 0 25px;
			font-size: 12px;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
		}

		.m-b-md {
			margin-bottom: 30px;
		}

		.row {
			margin-left: -15px;
			margin-right: -15px;
		}

		.btn {
			display: inline-block;
			margin-bottom: 0;
			font-weight: normal;
			text-align: center;
			vertical-align: middle;
			-ms-touch-action: manipulation;
			touch-action: manipulation;
			cursor: pointer;
			background-image: none;
			border: 1px solid transparent;
			white-space: nowrap;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.6;
			border-radius: 4px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			color: #fff;
		}

		.btn-primary {
			background-color: #3097D1;
			border-color: #2a88bd;
			color: #fff;
		}

		.panel {
			margin-bottom: 22px;
			background-color: #fff;
			border: 1px solid transparent;
			border-radius: 4px;
			-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		}

		.panel-default {
			border-color: #d3e0e9;
		}

		div {
			display: block;
		}

		.panel-default > .panel-heading {
			color: #333333;
			background-color: #fff;
			border-color: #d3e0e9;
		}

		.panel-heading {
			padding: 10px 15px;
			border-bottom: 1px solid transparent;
			border-top-right-radius: 3px;
			border-top-left-radius: 3px;
		}

		.panel-body {
			padding: 15px;
		}

		.panel-footer {
			padding: 10px 15px;
			background-color: #f5f5f5;
			border-top: 1px solid #d3e0e9;
			border-bottom-right-radius: 3px;
			border-bottom-left-radius: 3px;
		}

		a {
			text-decoration: none;
		}

		h4, .h4 {
			font-size: 18px;
		}

		h4, .h4, h5, .h5, h6, .h6 {
			margin-top: 11px;
			margin-bottom: 11px;
		}

		h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
			font-family: inherit;
			font-weight: 500;
			line-height: 1.1;
			color: inherit;
		}

		h4 {
			display: block;
			margin-block-start: 1.33em;
			margin-block-end: 1.33em;
			margin-inline-start: 0px;
			margin-inline-end: 0px;
			font-weight: bold;
		}

		.col-md-8 {
			width: 66.66666667%;
		}

		.col-md-offset-2 {
			margin-left: 16.66666667%;
		}

		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
			float: left;
		}

		.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
			position: relative;
			min-height: 1px;
			padding-left: 15px;
			padding-right: 15px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 class="text-center">Restablecer la Contraseña</h4></div>

			<div class="panel-body">
				<h4><b>¡Hola!</b></h4>

				<p>A recibido este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.</p>

				<p class="text-center"><a href="{{ route('password.reset', $resetPassword->token) }}" class="btn btn-primary" target="_blank" style="color: #fff !important">Restablecer Contraseña</a></p>

				<p>Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.</p>

				<p>Saludos, <a href="{{ url('/') }}" target="_blank">{{ str_replace(['http://', 'https://'], 'www.', url('/')) }}</a>. </p>

			</div>
			<div class="panel-footer">
				<p>Si tiene problemas para hacer clic en el botón "Restablecer Contraseña", haga click ó copie y pegue la URL a continuación en su navegador web:</p>
				<p><a href="{{ route('password.reset', $resetPassword->token) }}" target="_blank">{{ route('password.reset', $resetPassword->token) }}</a></p>
			</div>
		</div>
	</div>
</body>
</html>
