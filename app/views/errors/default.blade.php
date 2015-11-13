<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8" >
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>{{$title}}</title>    
    {{-- Bootstrap --}}
    {{ HTML::style('assets/css/bootstrap.css', array('media' => 'screen')) }}
    {{ HTML::style('assets/css/style.css', array('media' => 'screen', 'rel' => 'stylesheet')) }}
    {{ HTML::style('assets/css/font-awesome.min.css', array('media' => 'screen')) }}
</head>
<body sty le="background:#4994D4;">
	<div class="errors">
		<h1 class="text-center"><i class="fa fa-flash"></i> Error {{ $code }}</h1>
		<h3 class="text-center">{{ $message }}</h3>
		<br>
		<center>
			<a href="{{URL::to('/')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Regresar</a>
		</center>
	</div>
</body>
</html>