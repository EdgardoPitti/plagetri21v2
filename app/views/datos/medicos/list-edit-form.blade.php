@extends ('layout')

@section ('title') {{ $datos['label'] }} M&eacute;dicos @stop

@section ('content')
	@if(GrupoUsuario::where('id', Auth::user()->id_grupo_usuario)->first()->grupo_usuario == 'RECEPCION')
		{{--*/$block = 'disabled';/*--}}
	@else
		{{--*/$block = '';/*--}}
	@endif
	<h1>
		<div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		</div>
		<center>{{ $datos['label'] }} M&eacute;dico</center>
	</h1><hr>	

	<div class="modal fade" id="Show" tabindex="-1" role="dialog" aria-labelledby="showMedico" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header fondo-hd">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title"><i class="fa fa-plus-square"></i> M&eacute;dico &nbsp;<div id="loading" style="position:absolute;top:13px;left:100px;"></div></h4>
	      </div>
	      <div class="modal-body" id="showdatos">
	      	{{-- Datos obtenidos del archivo filtro.js --}}
	      </div>
	      <div class="modal-footer fondo-ft">	        
	        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
	       </div>
	    </div>
	  </div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Lista de M&eacute;dicos</h3>
					<div class="pull-right">
						<span class="clickable filter" data-toggle="tooltip" title="Buscar M&eacute;dicos" data-container="body">
							<i class="glyphicon glyphicon-filter"></i>
						</span>
					</div>
				</div>
				<div class="panel-body" style="display:block;">	
					<div class="overthrow" style="height:250px;">
						<table id="table-medico">
						    <thead>
							    <tr class="info">
							        <th data-field="num" data-align="center">#</th>
							        <th data-field="foto" data-align="center">Foto</th>
							        <th data-field="cedula" data-align="center">Cédula</th>
							        <th data-field="name" data-align="center">Nombre</th>
							        <th data-field="ext" data-align="center">Extensión</th>
							        <th data-field="tel" data-align="center">Teléfono</th>
							        <th data-field="cel" data-align="center">Celular</th>
							        <th data-field="esp" data-align="center">Especialidad Médica</th>
							        <th data-field="url"></th>
							    </tr>
						    </thead>
						</table>					
					</div>
				</div>
			</div>
		</div>
	</div>

	{{ Form::model($datos['medico'][0], $datos['formulario'] + array('files' => 'true'), array('role' => 'form')) }}

	  <div class="row">
	    @if($errors->has('cedula'))
		    <div class="alert alert-danger">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
				<p style="text-align:center;font-weight:bold;">{{ $errors->first("cedula") }}</p>	    
		    </div>	    
	    @endif
	  	<div class="form-group col-sm-4 col-md-4 col-lg-4">
	      <center>
	        {{ Form::label('foto', 'Foto de Perfil') }}<br>
	        {{ HTML::image('imgs/'.$datos['medico'][0]->foto.'', null, array('id' => 'foto', 'name' => 'foto', 'style' => 'heigth:150px; width:150px;')) }} <br><br>	        
	        <div class="input-group image-preview">
	            <input type="text" class="form-control image-preview-filename" placeholder="Buscar Foto" disabled="disabled">
	            <span class="input-group-btn">
	                <!-- image-preview-clear button -->
	                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
	                    <span class="glyphicon glyphicon-remove"></span>
	                </button>
	                <!-- image-preview-input -->
	                <div class="btn btn-default image-preview-input">
	                    <span class="glyphicon glyphicon-folder-open"></span>
	                    <span class="image-preview-input-title"></span>
	                    {{ Form::file('foto', array('accept' => 'image/*')) }}
	                </div>
	            </span>
	        </div>   
	    </div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4 @if($errors->has('cedula')) has-error has-feedback @endif" id="errorCedula">
	      {{ Form::label('cedula', 'N&uacute;mero de C&eacute;dula:', ['class' => 'control-label']) }}
	      {{ Form::text('cedula', null, array('placeholder' => 'N&uacute;mero de C&eacute;dula', 'class' => 'form-control', 'required' => 'required', 'aria-describedby' => 'inputError', 'onkeyup' => 'validarced(2)', ''.$block.'')) }}
			@if($errors->has('cedula'))		
		      <span class='glyphicon glyphicon-remove form-control-feedback remove' aria-hidden='true' onclick='clearInput();' data-toggle='tooltip' data-placement='top' title='Cédula duplicada'></span> 
		      <span id='inputError' class='sr-only remove'>(error)</span>
		   @endif	      
		  </div>	    
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	      {{ Form::label('primer_nombre', 'Primer Nombre:') }}
	      {{ Form::text('primer_nombre', null, array('placeholder' => 'Primer Nombre', 'class' => 'form-control', 'required' => 'required', ''.$block.'')) }}        
	    </div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	      {{ Form::label('segundo_nombre', 'Segundo Nombre:') }}
	      {{ Form::text('segundo_nombre', null, array('placeholder' => 'Segundo Nombre', 'class' => 'form-control', ''.$block.'')) }}
	    </div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	      {{ Form::label('apellido_paterno', 'Apellido Paterno:') }}
	      {{ Form::text('apellido_paterno', null, array('placeholder' => 'Apellido Paterno', 'class' => 'form-control', 'required' => 'required', ''.$block.'')) }}        
	    </div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	      {{ Form::label('apellido_materno', 'Apellido Materno:') }}
	      {{ Form::text('apellido_materno', null, array('placeholder' => 'Apellido Materno', 'class' => 'form-control', ''.$block.'')) }}
	    </div>	   
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	      {{ Form::label('sexo', 'Sexo:') }}	     
	      {{ Form::select('sexo', array('0' => 'FEMENINO', '1' => 'MASCULINO'), null, array('class' => 'form-control', 'required' => 'required', ''.$block.'')); }}
	    </div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('id_especialidades_medicas', 'Especialidad M&eacute;dica:') }}
			{{ Form::select('id_especialidades_medicas', array('0' => 'SELECCIONE ESPECIALIDAD') + EspecialidadMedica::lists('descripcion', 'id_especialidades_medicas'), $datos['medico'][0]->id_especialidad_medica, array('class' => 'form-control', 'required' => 'required', ''.$block.'')) }}
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('extension', 'Extensi&oacute;n:') }}
			{{ Form::text('extension', null, array('placeholder' => 'Extensi&oacute;n', 'class' => 'form-control', ''.$block.'')) }}			
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('telefono', 'Tel&eacute;fono:') }}
			{{ Form::text('telefono', null, array('placeholder' => 'Tel&eacute;fono', 'class' => 'form-control', ''.$block.'')) }}			
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('celular', 'Celular:') }}
			{{ Form::text('celular', null, array('placeholder' => 'Celular', 'class' => 'form-control', ''.$block.'')) }}
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('email', 'E-mail:') }}
			{{ Form::text('email', null, array('placeholder' => 'E-mail', 'class' => 'form-control', ''.$block.'')) }}
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('id_nivel', 'Nivel:') }}
			{{ Form::select('id_nivel', array('0' => 'SELECCIONE NIVEL') + Nivel::lists('nivel', 'id'), null, array('class' => 'form-control', ''.$block.'')) }}
		</div>
		<div class="form-group col-sm-4 col-md-4 col-lg-4">
			{{ Form::label('id_ubicacion', 'Ubicación:') }}
			{{ Form::select('id_ubicacion', array('0' => 'SELECCIONE UBICACI&Oacute;N') + Ubicacion::lists('ubicacion', 'id'), null, array('class' => 'form-control', ''.$block.'')) }}
		</div>
	    <div class="form-group col-sm-4 col-md-4 col-lg-4">
	    	{{ Form::label('observaciones', 'Observaciones:') }}
	    	{{ Form::textarea('observaciones', $datos['medico'][0]->observacion, array('placeholder' => 'Observaciones', 'class' => 'form-control', 'size' => '1x1', ''.$block.'')) }}        
	    </div>
	  </div>
	  <div class="form-group col-sm-12 col-md-12 col-lg-12">
    	<center>
    	@if(GrupoUsuario::where('id', Auth::user()->id_grupo_usuario)->first()->grupo_usuario != 'RECEPCION')
		  {{ Form::button($datos['label'].' M&eacute;dico', array('type' => 'submit', 'class' => 'btn btn-'.$datos['button'].'')) }}    
		@endif
		  <a href="{{ route('datos.medicos.index') }}" class="btn btn-info">Limpiar Campos</a>
		</center>
	  </div>
	{{ Form::close() }}
	{{ Form::open(array('route' => array('datos.medicos.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
  {{ Form::close() }}
	<br>
  	{{ HTML::script('assets/js/overthrow/overthrow-detect.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-init.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-polyfill.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-toss.js') }}
@stop
