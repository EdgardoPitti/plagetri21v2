@extends ('layout')

@section('title')
	Men&uacute; Principal
@stop
@section ('content')
	
		<center>
			<h1><strong>Menú Principal</strong></h1><hr>
		</center>
		{{--*/$n=1;/*--}}
		<div class="row nav-row panel-margin">
			@foreach(ModuloUsuario::where('id_grupo_usuario', Auth::user()->id_grupo_usuario)->where('inactivo', '0')->get() as $modulos)
				<a href="{{ route(''.Modulo::where('id', $modulos->id_modulo)->first()->ruta.'') }}">
					<div class="col-sm-3 col-md-3 col-lg-3">
						<img src="imgs/{{ Modulo::where('id', $modulos->id_modulo)->first()->imagen }}" style="width:50px;height:59px;padding-top:9px">
						<p>{{ Modulo::where('id', $modulos->id_modulo)->first()->modulo }}</p>
					</div>
				</a>
				@if($n == 4)
					</div>
					<div class="row nav-row panel-margin menu-margen">
				@elseif($n == 8)
					</div>
					<div class="row nav-row panel-margin menu-margen" style="padding-bottom:15px;">
				@endif
				{{--*/$n++;/*--}}
			@endforeach
		</div>	
@stop
