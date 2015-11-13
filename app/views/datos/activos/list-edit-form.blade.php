@extends ('layout')

@section('title')
	Activos
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Activos</center>
		</h1>
		
		@if(Session::has('mensaje'))
			<div class="alert alert-warning">{{ Session::get('mensaje') }}</div>
		@endif

		<div class="row">
	      <div class="col-md-12 col-sm-12 col-lg-12">
	        <div class="panel panel-primary">
	          <div class="panel-heading">
	            <h3 class="panel-title">Lista de Activos</h3>
	            <div class="pull-right">
	              <span class="clickable filter" data-toggle="tooltip" title="Buscar Activo" data-container="body">
	                <i class="glyphicon glyphicon-filter"></i>
	              </span>
	            </div>
	          </div>
	          <div class="panel-body" style="display:block;">	            
	            <div class="overthrow" style="height:200px;">
	              <table id="table-activo" data-sort-name="costo">
		            <thead>
		                <tr class="info">
		                    <th data-field="num" data-align="center">#</th>
		                    <th data-field="num_activo" data-align="center">Número de Activo</th>
		                    <th data-field="nombre" data-align="center" class="nombre">Nombre</th>
		                    <th data-field="tipo" data-align="center">Tipo</th>
		                    <th data-field="nivel" data-align="center">Nivel</th>
		                    <th data-field="ubicacion" data-align="center">Departamento</th>
		                    <th data-field="costo" data-align="center" data-sortable="true">Costo</th>
		                    <th data-field="urls" data-align="center">Opciones</th>
		                </tr>
		            </thead>	             
	              </table>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>	
	    {{--*/ $fecha_actual = Carbon::now() /*--}}
	    <div class="modal fade" id="modalBaja" tabindex="-1" role="dialog" aria-labelledby="baja" aria-hidden="true">
      	 <form id="form_baja" method="POST" accept-charset="UTF-8" action="">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header fondo-hd">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title activo"> </h4>
		      </div>
		      <div class="modal-body" id="showdatos">
		      		<input name="_token" type="hidden" value="{{ csrf_token() }}">		      		
			        {{ Form::hidden('id_estado', 3) }}
			        {{ Form::label('fecha_de_baja', 'Fecha de Baja') }}
			        {{ Form::text('fecha_de_baja', $fecha_actual->format('Y-m-d'), array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '1950-01-01', 'max' => '2020-12-31')) }}
		      </div>
		      <div class="modal-footer fondo-ft">	        
		        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
		      	<button type="submit" class="btn btn-success">Dar de Baja</button>
		       </div>
		    </div>
		  </div>
       	 </form>
		</div>

		{{ Form::model($datos['activo'], $datos['form'] + array('files' => 'true') , array('role' => 'form')) }}
			<div class="row">
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('num_activo', 'Número de Activo:') }}
			      {{ Form::text('num_activo', null, array('placeholder' => 'Número de Activo', 'class' => 'form-control', 'required' => 'required')) }}

			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('nombre', 'Nombre:') }}
			      {{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control', 'required' => 'required')) }}
			    </div>
		        <div class="form-group col-sm-4 col-md-4 col-lg-4">
 				    {{ Form::label('fecha_compra', 'Fecha de Compra:') }}
    				{{ Form::text('fecha_compra', $datos['activo']->fecha_compra, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '1950-01-01', 'max' => '2020-12-31')) }}
    			</div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('tipo', 'Tipo de Activo:') }}
			      {{ Form::select('tipo', array('0' => 'SELECCIONE EL TIPO DE ACTIVO') + TipoActivo::lists('tipo', 'id'), $datos['activo']->id_tipo, array('class' => 'form-control')); }}    
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('marca', 'Marca:') }}
			      {{ Form::text('marca', null, array('placeholder' => 'Marca', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('modelo', 'Modelo:') }}
			      {{ Form::text('modelo', null, array('placeholder' => 'Modelo', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('serie', 'Serie:') }}
			      {{ Form::text('serie', null, array('placeholder' => 'Serie', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('voltaje', 'Voltaje:') }}
			      {{ Form::text('voltaje', null, array('placeholder' => 'Voltaje', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('consumo', 'Consumo:') }}
			      {{ Form::text('consumo', null, array('placeholder' => 'Consumo', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('alimentacion', 'Alimentacion:') }}
			      {{ Form::text('alimentacion', null, array('placeholder' => 'Alimentacion', 'class' => 'form-control')) }}
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('id_tipo_fuente', 'Tipo de Fuente:') }}
			      {{ Form::select('id_tipo_fuente',  array('0' => 'SELECCIONE EL TIPO DE FUENTE') + TipoFuente::lists('tipo_fuente', 'id'), null, array('class' => 'form-control')); }}    
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('id_tiempo_depreciacion', 'Tiempo de Depreciación:') }}
			      {{ Form::select('id_tiempo_depreciacion', TiempoDepreciacion::lists('tiempo', 'id'), null, array('class' => 'form-control')); }}    
			    </div>
 				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('id_fecha_mantenimiento', 'Fecha de Mantenimiento:') }}
			      {{ Form::select('id_fecha_mantenimiento',  array('0' => 'SELECCIONE LA FECHA DE MANTENIMIENTO') + FechaMantenimiento::lists('fecha_mantenimiento', 'id'), null, array('class' => 'form-control')); }}    
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('protocolo', 'Protocolo de Mantenimiento:') }}
			      {{ Form::text('protocolo', null, array('placeholder' => 'Protocolo de Mantenimiento', 'class' => 'form-control')) }}
			    </div>
 				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('id_estado', 'Estado:') }}
			      {{ Form::select('id_estado',  array('0' => 'SELECCIONE EL ESTADO') + TipoEstado::lists('tipo_estado', 'id'), null, array('class' => 'form-control')); }}    
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('nivel', 'Nivel:') }}
			      {{ Form::select('nivel',  array('0' => 'SELECCIONE EL NIVEL') + Nivel::lists('nivel', 'id'), $datos['activo']->id_nivel, array('class' => 'form-control')); }}    
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('ubicacion', 'Departamento:') }}
			      {{ Form::select('ubicacion',  array('0' => 'SELECCIONE EL DEPARTAMENTO') + Ubicacion::lists('ubicacion', 'id'), $datos['activo']->id_ubicacion, array('class' => 'form-control')); }}    
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('unidad_administrativa', 'Unidad Administrativa:') }}
			      {{ Form::select('unidad_administrativa',  array('0' => 'SELECCIONE LA UNIDAD ADMINISTRATIVA') + UnidadAdministrativa::lists('unidad_administrativa', 'id'), $datos['activo']->id_unidad_administrativa, array('class' => 'form-control')); }}    
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('proveedor', 'Proveedor:') }}
			      {{ Form::select('proveedor',  array('0' => 'SELECCIONE EL PROVEEDOR') + Agenda::where('proveedor', '1')->lists('nombre_completo', 'id'), $datos['activo']->id_proveedor, array('class' => 'form-control')); }}    
			    </div>
			     <div class="form-group col-sm-4 col-md-4 col-lg-4">
 				    {{ Form::label('fecha_garantia', 'Fecha de Garantía:') }}
    				{{ Form::text('fecha_garantia', null, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '1950-01-01', 'max' => '2020-12-31')) }}
    			</div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('num_factura', 'Número de Factura:') }}
			      {{ Form::text('num_factura', null, array('placeholder' => 'Número de Factura', 'class' => 'form-control')) }}
			    </div>
				<div class="form-group col-sm-4 col-md-4 col-lg-4">
			      {{ Form::label('costo', 'Costo:') }}
			      {{ Form::text('costo', null, array('placeholder' => 'Costo', 'class' => 'form-control')) }}
			    </div>
			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
			    	{{ Form::label('descripcion', 'Descripcion:') }}
			    	{{ Form::textarea('descripcion', $datos['activo']->descripcion, array('placeholder' => 'Desripcion', 'class' => 'form-control', 'size' => '1x4')) }}        
			    </div>
			</div>
			<div class="form-group col-sm-12 col-md-12 col-lg-12">
			    <center>
			      {{ Form::button($datos['label'].' Activo', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
			      <a href="{{ route('datos.activos.index') }}" class="btn btn-info">Limpiar Campos</a>
			    </center>
 			</div>
		{{ Form::close() }}


@stop