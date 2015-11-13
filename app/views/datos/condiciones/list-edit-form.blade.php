@extends ('layout')

@section('title')
	Enfermedades
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Enfermedades</center>
		 </h1>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
		    	<div class="panel panel-primary">
		      		<div class="panel-heading">
		        		<h3 class="panel-title">Lista de Enfermedades</h3>
	        			<div class="pull-right">
		          			<span class="clickable filter" data-toggle="tooltip" title="Buscar Enfermedad" data-container="body">
			            		<i class="glyphicon glyphicon-filter"></i>
		          			</span>
		        		</div>
		      		</div>
			    	<div class="panel-body" style="display:block">
				       <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#condiciones" placeholder="Filtrar Enfermedades" /><br>
					    <div class="overthrow" style="height:180px;">
						  <table class="table table-bordered table-hover table-fixed-header" cellpadding="0" cellspacing="0" id="condiciones" width="100%">
							  <thead>
								<tr class="info">
									<td width="3%">#</td>
									<td width="15%">Enfermedad</td>
									<td width="40%">Mensaje Positivo</td>
									<td width="40%">Mensaje Negativo</td>
									<td></td>
								</tr>
							  </thead>
							  <tbody>
								  {{--*/$x=1;/*--}}
								 @foreach(Enfermedad::all() as $enfermedad)
									<tr align="justify">
										<td>{{ $x++ }}.</td>
										<td>{{ $enfermedad->descripcion }}</td>
										<td>{{ $enfermedad->mensaje_positivo }}</td>
										<td>{{ $enfermedad->mensaje_negativo }}</td>
										<td><a href="{{ route('datos.condiciones.edit', $enfermedad->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Editar Enfermedad"><span class="glyphicon glyphicon-pencil"></span> Editar Enfermedad</a></td>
									</tr>
								 @endforeach
							  </tbody>
						  </table>
						</div>
						<div class="clear"></div>
			        </div>
		        </div>
		    </div>
		</div>
		{{ Form::model($datos['enfermedad'], $datos['form'], array('role' => 'form')) }}
			<div class="row" style="margin-top:0px;">
				<h3>Datos de la Enfermedad</h3>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
					{{ Form::label('descripcion', 'Nombre de la Enfermedad:') }}
					{{ Form::text('descripcion', null, array('placeholder' => 'Nombre de Grupo', 'class' => 'form-control', 'required' => 'required')) }}
				</div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
					{{ Form::label('status', 'Mostrar en Impresión:') }}
					{{ Form::select('status', Array('0' => 'NO', '1' => 'SI'), null, array('class' => 'form-control', 'required' => 'required')) }}
				</div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
					{{ Form::label('mensaje_positivo', 'Mensaje Positivo:') }}
					{{ Form::textarea('mensaje_positivo', null, array('placeholder' => 'Mensaje Positivo', 'class' => 'form-control', 'size' => '3x3')) }}        
				</div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
					{{ Form::label('mensaje_negativo', 'Mensaje Negativo:') }}
					{{ Form::textarea('mensaje_negativo', null, array('placeholder' => 'Mensaje Positivo', 'class' => 'form-control', 'size' => '3x3')) }}        
				</div>
			</div>
			<div class="row" style="margin-top:0px;">
				<h3>Condiciones de la Enfermedad</h3>
				@foreach(Marcador::all() as $marcador)
					@if($marcador->trimestre_marcador == 3)
						<div class="form-group col-sm-4 col-md-4 col-lg-4">
							{{ Form::label('marcador_'.$marcador->id.'_1', $marcador->marcador.':') }}
							{{ Form::select('marcador_'.$marcador->id.'_1',array('' => 'SELECCIONE EL VALOR', '-1' => 'Bajo', '0' => 'Normal', '1' => 'Alto') ,$datos['marcador_'.$marcador->id.'_1'], array('class' => 'form-control')) }}
						</div>
						<div class="form-group col-sm-4 col-md-4 col-lg-4">
							{{ Form::label('trimestre_'.$marcador->id.'', 'Trimestre de '.$marcador->marcador.':') }}        
							{{ Form::select('trimestre_'.$marcador->id.'',array('' => 'SELECCIONE EL TRIMESTRE', '1' => 'I TRIMESTRE', '2' => 'II TRIMESTRE') ,1, array('class' => 'form-control', 'disabled' => 'disabled')) }}
						</div>
						<div class="form-group col-sm-4 col-md-4 col-lg-4">
							{{ Form::label('limites_'.$marcador->id.'_1', 'Limites de '.$marcador->marcador.':') }}        
							{{ Form::text('limite_inferior_'.$marcador->id.'_1', $datos['limite_inferior_'.$marcador->id.'_1'], array('placeholder' => 'Min', 'class' => 'form-control')) }}
							{{ Form::text('limite_superior_'.$marcador->id.'_1', $datos['limite_superior_'.$marcador->id.'_1'], array('placeholder' => 'Max', 'class' => 'form-control')) }}
						</div>
						{{--*/$marcador->trimestre_marcador = 2;/*--}}
					@endif
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
						{{ Form::label('marcador_'.$marcador->id.'', $marcador->marcador.':') }}
						{{ Form::select('marcador_'.$marcador->id.'',array('' => 'SELECCIONE EL VALOR', '-1' => 'Bajo', '0' => 'Normal', '1' => 'Alto') ,$datos['marcador_'.$marcador->id.''], array('class' => 'form-control')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
						{{ Form::label('trimestre_'.$marcador->id.'', 'Trimestre de '.$marcador->marcador.':') }}        
						{{ Form::select('trimestre_'.$marcador->id.'',array('' => 'SELECCIONE EL TRIMESTRE', '1' => 'I TRIMESTRE', '2' => 'II TRIMESTRE') ,$marcador->trimestre_marcador, array('class' => 'form-control', 'disabled' => 'disabled')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
						{{ Form::label('limites_'.$marcador->id.'', 'Limites de '.$marcador->marcador.':') }}        
						{{ Form::text('limite_inferior_'.$marcador->id.'', $datos['limite_inferior_'.$marcador->id.''], array('placeholder' => 'Min', 'class' => 'form-control')) }}
						{{ Form::text('limite_superior_'.$marcador->id.'', $datos['limite_superior_'.$marcador->id.''], array('placeholder' => 'Max', 'class' => 'form-control')) }}
					</div>
				@endforeach
			</div>
			<center style="padding-bottom:15px;">
				{{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
			</center>
			
		{{ Form::close() }}
@stop
