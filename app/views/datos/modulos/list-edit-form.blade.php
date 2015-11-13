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
		  <center>Módulos ~ Usuarios </center>
		</h1>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
		    	<div class="panel panel-primary">
		      	<div class="panel-heading">
		        		<h3 class="panel-title">Grupos de Usuarios</h3>
	        			<div class="pull-right">
		          			<span class="clickable filter" data-toggle="tooltip" title="Buscar Grupo" data-container="body">
			            		<i class="glyphicon glyphicon-filter"></i>
		          			</span>
		        		</div>
		      	</div>
			    	<div class="panel-body" style="display:block;">
				       <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar Grupos" /><br>
					    <div class="overthrow" style="height:200px;">
					        <table class="table table-bordered table-hover modulo" id="dev-table">
							  	<thead>
							  		<tr class="info">
							  			<th>#</th>
							  			<th>Grupo de Usuarios</th>
							  			<th>Cantidad de Usuarios</th>
							  			<th>Acciones</th>
							  		</tr>
							  	</thead>
							  	<tbody>
							  		{{--*/ $n=1; /*--}}
							  		@foreach (GrupoUsuario::all() as $grupo)
							  		<tr align="center">
							  			<td>{{ $n++ }}.</td>
							  			<td>{{ $grupo->grupo_usuario }}</td>
							  			<td>{{ User::where('id_grupo_usuario', $grupo->id)->count() }}</td>
							  			<td align="center">
											<a href="{{ route('datos.modulos.edit', $grupo->id) }}" class="btn btn-success btn-sm" style="margin:3px 0px;" data-toggle="tooltip" title="Editar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>								  				
							  				<a href="{{ route('datos.modulos.show', $grupo->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Cargar Módulos"><span class="glyphicon glyphicon-list-alt"></span> Cargar</a>
							  				{{--<a href="#" data-id="{{ $grupo->id }}"  class="btn btn-danger btn-delete btn-sm" data-toggle="tooltip" title="Eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</a> --}}
							  			</td>
							  		</tr>
							  		@endforeach
							  	</tbody>
							</table>
						</div>
			        </div>
		        </div>
		        <center>
		        	{{ Form::open($form['datos'] , array('role' => 'form')) }}
		        	<div class="row">
						<div class="form-group col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-sm-offset-4">
							{{ Form::label('grupo_usuario', 'Nombre de Grupo:') }}
							{{ Form::text('grupo_usuario', $form['grupo']->grupo_usuario, array('placeholder' => 'Nombre de Grupo', 'class' => 'form-control', 'required' => 'required')) }}
						</div>
				    </div>
						{{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
						 <a href="{{ route('datos.modulos.index') }}" class="btn btn-info">Limpiar Campos</a><hr>
		        	{{ Form::close() }}
		        	</center>
		    </div>
		    @if(!is_null($tipousuario->id))
			    <center>
			    	<b>Grupo de Usuario:</b> {{ $tipousuario->grupo_usuario }}
			    	{{ Form::open(array('route' => 'datos.modulos.store', 'method' => 'POST'), array('role' => 'form')) }}
			    		<div class="row">
			    			{{ Form::text('id_grupo_usuario', $tipousuario->id , array('style' => 'display:none', 'id' => 'id_grupo_usuario')) }}
			    	@foreach ( Modulo::all() as $modulo)			    					        		
			    			<div class="form-group col-sm-3 col-md-3 col-lg-3">
						    	{{ Form::label('modulo_'.$modulo->id.'', $modulo->modulo) }}
						    </div>
			        		<div class="form-group col-sm-3 col-md-3 col-lg-3">
						    	{{ Form::checkbox('modulo_'.$modulo->id.'', 1, ModuloUsuario::where('id_grupo_usuario', $tipousuario->id)->where('id_modulo', $modulo->id)->where('inactivo', '0')->first(),  array('class' => 'form-control cmn-toggle cmn-toggle-round-flat', 'id' => 'cmn-toggle-'.$modulo->id.'')) }}
						    	<label for="cmn-toggle-{{$modulo->id}}"></label>
						    </div>
			    	@endforeach			    		
			    			<div class="form-group col-sm-12 col-md-12 col-lg-12">
							    <center>
							      {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
							      <a href="{{ route('datos.modulos.index') }}" class="btn btn-info">Limpiar Campos</a>
							    </center>
				 			</div>
				 		</div>
					{{ Form::close() }}
			    </center>
		   	@endif
		</div>
		{{ Form::open(array('route' => array('datos.modulos.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
		{{ Form::close() }}
@stop
