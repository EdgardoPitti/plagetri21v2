<!DOCTYPE html>
<html lang="es-ES">
<head>
    <title>Citas Médicas</title>
    <meta charset="UTF-8">
    <style type="text/css">
    	html, body{
			height:100%;    	
    	}
    	body{
			margin:-30px;			
			padding: 20px;
			border:1px solid #000;
			border-radius:6px;    	
    	}    	
    	h1, h2,h3,h4,h5,h6,p{
			margin: 0px;    	
    	}
    	h4{
    		padding-left: 23px;
    	}
    	div .texto{
    		position:absolute;
    		top:25%;
    		left:10%;
    		font-size:14px;
    		font-weight:bold;    	
    	}
    	.resultados{
		   width:40%;	    
    	}
    </style>
</head>
<body>
	<div>
		<div style="position:absolute;top:20px;left:20px;right:0px;">
			<img src="imgs/logoch.png">		
		</div>	
		<div sty le="position:relative;">
			<center>
				<h1>HOSPITAL CHIRIQUÍ</h1>
				<h2>LABORATORIO</h2>
				<h3 style="font-style:italic;">Atención 24 horas</h3>
		    </center>
		</div>
	    <div style="position:absolute; top:80px;le ft:400px;font-size:12px;">
	    	APDO. 0426-01141 DAVID - CHIRIQUI<br>
	    	e-mail: laboratorio@hospitalchiriqui.com<br>
	      www.hospitalchiriqui.com
	    </div>
	</div>
    <br>
    {{-- función que permite cambiar el idioma a las fechas--}}
    {{--*/ setlocale(LC_TIME, 'Spanish'); /*--}}
    <div style="height: 250px;">
    	<div class="texto">
    		<h3>Triple Marcador Maternal</h3>
    	</div>
    	<div style="position:absolute;right:20px;font-size:12px;">
			<b>INFORMACIÓN DE LA PACIENTE</b><br>
			Nombre: {{ $datos[0]->apellido_paterno.' '.$datos[0]->apellido_materno.', '.$datos[0]->primer_nombre.' '.$datos[0]->segundo_nombre }}.<br>
			ID de Paciente: {{ $datos[0]->cedula }}.<br>
			FN: {{ Carbon::parse($datos[0]->fecha_nacimiento)->formatLocalized('%d %b %Y') }}.<br>
			FUR: {{ Carbon::parse($cita->fur)->formatLocalized('%d %b %Y') }}.<br>
			Lugar: {{ $institucion->denominacion }}.<br>
			Doctor: {{ $medico->primer_nombre.' '.$medico->apellido_paterno }}.
			
			<br><br><br>
			<b>LA INFORMACIÓN CLÍNICA</b><br>
			Edad Gestacional: {{ $cita->edad_gestacional_fur }} semanas usando FUR  {{ Carbon::parse($cita->fur)->formatLocalized('%d %b %Y') }}.<br>
			Edad Materna: {{ $cita->edad_materna }} años.<br>
			Peso Materno: {{ $cita->peso }} kg.<br>
			Raza Materna: {{ $datos[0]->raza }}.<br>
			Etnia Materna: {{ $datos[0]->etnia }}.<br>
			Gestación: {{ $cita->hijos_embarazo }}.<br>
		</div> 
    </div>
    <div style="height:250px;position:relative;">
	 	<h4>RESULTADOS DE LA PRUEBA</h4>
	 	
		@if(!empty($cantidad))		
		<table class="resultados" cellspacing="0px" border="1" style="font-size:12px;">			
			<tr>
				<th width="50px">Ensayo</th>
				<th width="80px">Resultados</th>
				<th width="50px">MoM</th>
				<th width="80px">Corr. Lineal</th>
				<th width="80px">Corr. Exp.</th>
				<th width="50px">Limite</th>				
			</tr>
			@foreach($marcadores as $marcador)
			@if($marcador->positivo == 0) {{--*/$color = '#5cb85c';/*--}} @elseif($marcador->positivo == -1){{--*/$color = '#d9534f';/*--}} @elseif($marcador->positivo == -2) {{--*/$color = 'white';/*--}} @else {{--*/$color = '#f0ad4e';/*--}}	@endif
			<tr align="center" style="background:{{$color}};">
				<td>{{ Marcador::where('id', $marcador->id_marcador)->first()->marcador }}</td>
				<td>{{ $marcador->valor }} @if(!empty(Unidad::where('id', $marcador->id_unidad)->first()->unidad))<p style="font-size:10px;font-style:italic;">{{  Unidad::where('id', $marcador->id_unidad)->first()->unidad }}</p>@endif</td>
				<td>{{ $marcador->mom }}</td>
				<td>{{ $marcador->corr_peso_lineal }}</td>
				<td>{{ $marcador->corr_peso_exponencial }}</td>
				<td>@if($marcador->positivo == 0) Normal @elseif($marcador->positivo == -1)	Bajo @elseif($marcador->positivo == -2) No Definido @else Alto	@endif</td>
			</tr>
			@endforeach
		</table>
		@else
			<p style="color:red;">No tiene marcadores registrados</p>
		@endif
		<div style="position:absolute; top:0px; right:-20px;"> <img src="{{URL::to('grafica/pintargrafica/'.$cita->riesgo)}}" alt=""> </div>
	</div>
	<div style="position:relative;bottom:0px;font-size:12px;">			
      <h4 style="padding:8px 0px 0px 8px;">Evaluación del Riesgo (a término)</h4>
		<table style="padding-left:10px;width:40%;">
			<tr>
				<td>Edad Solamente</td>
				<td>{{ '1:'.number_format($cita->riesgo, 0, '', '') }}</td>			
			</tr>		
		</table><br>		
		<b>Interpretación* basado en la información suministrada:</b><br>
		<table style="width:100%;">
			@foreach($resultados as $resultado)
				<tr>
						<td width="25%"><b>{{ $resultado->enfermedad }}</b></td>
						<td align="justify">
							{{ $resultado->resultado }}<br>
							{{ $resultado->mensaje }}
						</td>
				</tr>
				<tr>	
					<td colspan="2"></td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
</html>

