@extends ('layout')

@section('title')
	Mantenimientos
@stop

@section('calendar_css')
	{{HTML::style('assets/css/calendar.css')}}	
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Mantenimientos</center>
		</h1>
		<div class="row">
	    	<div class="col-xs-12">
			    <div class="page-header">
					<h3></h3>
					<div class="pull-left form-inline">
						<div class="btn-group">
							<button class="btn btn-default" data-calendar-nav="prev"><i class="fa fa-chevron-left"></i></button>
							<button class="btn btn-default" data-calendar-nav="today">Hoy</button>
							<button class="btn btn-default" data-calendar-nav="next"><i class="fa fa-chevron-right"></i></button>
						</div>
						<div class="btn-group">
							<button class="btn btn-success" data-calendar-view="year">Año</button>
							<button class="btn btn-success active" data-calendar-view="month">Mes</button>
							<button class="btn btn-success" data-calendar-view="week">Semana</button>							
						</div>
					</div>
				</div>
	    	</div>
	    </div>

		<div class="row">
			<div class="col-xs-12">
	    		<div id="calendar"></div>
			</div>
		</div>

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
	          <div class="panel-body">
	          	<div class="overthrow" style="height:200px;">
	              <table id="table-mantenimiento" data-sort-name="costo">
		            <thead>
		                <tr class="info">
		                    <th data-field="num" data-align="center">#</th>
		                    <th data-field="num_activo" data-align="center">Número de Activo</th>
		                    <th data-field="nombre" data-align="center" class="nombre">Nombre</th>
		                    <th data-field="tipo" data-align="center">Tipo</th>
		                    <th data-field="nivel" data-align="center">Nivel</th>
		                    <th data-field="ubicacion" data-align="center">Ubicación</th>
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

	    @if (!empty($datos['activo']))
	    	<div class="table-responsive overthrow" style="overflow:auto;width:100%;">
				<table class="table table-bordered">
					<tr class="info">
						<th>Número de Activo</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Marca</th>
						<th>Nivel</th>
						<th>Ubicación</th>
						<th>Costo</th>
						<th>Tiempo de Mant.</th>
					</tr>
					<tr class="white">
						<td>{{ $datos['activo']->num_activo }}</td>
						<td>{{ $datos['activo']->nombre }}</td>
						@if(empty(TipoActivo::where('id', $datos['activo']->id_tipo)->first()->tipo))
							<td>No Definido</td>
						@else
							<td>{{ TipoActivo::where('id', $datos['activo']->id_tipo)->first()->tipo }}</td>
						@endif
						<td>{{ $datos['activo']->marca }}</td>
						@if(empty(Nivel::where('id', $datos['activo']->id_nivel)->first()->nivel))
							<td>No Definido</td>
						@else
							<td>{{ Nivel::where('id', $datos['activo']->id_nivel)->first()->nivel }}</td>
						@endif
						@if(empty(Ubicacion::where('id', $datos['activo']->id_ubicacion)->first()->ubicacion))
							<td>No Definido</td>
						@else
							<td>{{ Ubicacion::where('id', $datos['activo']->id_ubicacion)->first()->ubicacion }}</td>
						@endif
						<td>{{ $datos['activo']->costo }}</td>
						@if($datos['activo']->id_fecha_mantenimiento == 2)
							<td>7 DÍAS</td>
						@elseif($datos['activo']->id_fecha_mantenimiento == 3)
							<td>15 DÍAS</td>
						@elseif($datos['activo']->id_fecha_mantenimiento == 4)
							<td>MENSUALES</td>
						@elseif($datos['activo']->id_fecha_mantenimiento == 5)
							<td>TRIMESTRALES</td>
						@elseif($datos['activo']->id_fecha_mantenimiento == 6)
							<td>SEMESTRALES</td>
						@elseif($datos['activo']->id_fecha_mantenimiento == 7)
							<td>Anuales</td>
						@else
							<td>NO DEFINIDO</td>
						@endif
					</tr>					
				</table>
			</div>
			{{ Form::model($datos['mantenimiento'], $datos['form'] + array('files' => 'true'), array('role' => 'form')) }}
				{{ Form::text('id_activo', $datos['activo']->id, array('style' => 'display:none')) }}
				{{ Form::text('id_fecha_mantenimiento', $datos['activo']->id_fecha_mantenimiento, array('style' => 'display:none', 'id' => 'id_fecha_mantenimiento'))}}
				<div class="row">
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
	  					{{ Form::label('fecha', 'Fecha de Realización:') }}
	  					{{ Form::text('fecha', $datos['mantenimiento']->fecha_realizacion, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '2014-01-01', 'max' => '2050-12-31', 'required' => 'required')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				      {{ Form::label('id_tipo_mantenimiento', 'Tipo de Mantenimiento:') }}
				      {{ Form::select('id_tipo_mantenimiento',  TipoMantenimiento::lists('tipo_mantenimiento', 'id'), $datos['mantenimiento']->id_tipo_mantenimiento ,array('class' => 'form-control', 'required' => 'required')) }}
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				      {{ Form::label('realizado_por', 'Realizado por:') }}
				      {{ Form::text('realizado_por', null, array('placeholder' => 'Realizado Por', 'class' => 'form-control', 'required' => 'required')) }}
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				      {{ Form::label('aprobado_por', 'Aprobado por:') }}
				      {{ Form::text('aprobado_por', null, array('placeholder' => 'Aprobado', 'class' => 'form-control')) }}
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
	  					{{ Form::label('proximo', 'Próximo Mantenimiento:') }}
	  					{{ Form::text('proximo', $datos['mantenimiento']->proximo_mant, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '2014-01-01', 'max' => '2050-12-31')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				      {{ Form::label('costo_mantenimiento', 'Costo de Mantenimiento:') }}
				      {{ Form::text('costo_mantenimiento', null, array('placeholder' => 'Costo de Mantenimiento', 'class' => 'form-control')) }}
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('observacion', 'Observación:') }}
				    	{{ Form::textarea('observacion', $datos['mantenimiento']->observacion, array('placeholder' => 'Observación', 'class' => 'form-control', 'size' => '1x3')) }}        
				    </div>
				</div>
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				    <center>
				      {{ Form::button($datos['label'].' Mantenimiento', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
				      <a href="{{ route('datos.mantenimientos.show', $datos['activo']->id) }}" class="btn btn-info">Limpiar Campos</a>
				    </center>
	 			</div>
			{{ Form::close() }}
			@if (!empty(Mantenimiento::where('id_activo', $datos['activo']->id)->first()->id))
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12">
				    	<div class="panel panel-primary">
				      		<div class="panel-heading">
				        		<h3 class="panel-title">Mantenimientos de este Activo</h3>
			        			<div class="pull-right">
				          			<span class="clickable filter" data-toggle="tooltip" title="Buscar Mantenimiento" data-container="body">
					            		<i class="glyphicon glyphicon-filter"></i>
				          			</span>
				        		</div>
				      		</div>
					    	<div class="panel-body">
						        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#tabla_citas" placeholder="Filtrar Citas" /><br>
							    <div class="table-responsive overthrow" style="overflow:auto;width:100%;max-height:240px;">
							        <table class="table table-bordered table-hover" id="tabla_citas">
									  	<thead>
									  		<tr class="info">
									  			<th>#</th>
									  			<th>Fecha de Mant.</th>
									  			<th>Tipo de Mant.</th>
									  			<th>Realizado</th>
									  			<th>Aprobado</th>
									  			<th>Próximo Mant.</th>
									  			<th>Observación</th>
									  			<th></th>
									  		</tr>
									  	</thead>
									  	<tbody>
									  		{{--*/ $x=1; /*--}}
									  		@foreach (Mantenimiento::where('id_activo', $datos['activo']->id)->orderBy('fecha_realizacion', 'asc')->get() as $mantenimiento)
									  			<tr>
									  				<td>{{ $x++ }}</td>
									  				<td>{{ $mantenimiento->fecha_realizacion }}</td>
									  				<td>{{ TipoMantenimiento::find($mantenimiento->id_tipo_mantenimiento)->tipo_mantenimiento }}</td>
									  				<td>{{ $mantenimiento->realizado_por }}</td>
									  				<td>{{ $mantenimiento->aprobado_por }}</td>
									  				<td>{{ $mantenimiento->proximo_mant }}</td>
									  				<td>{{ $mantenimiento->observacion }}</td>
									  				<td align="center">
									  					<a href="{{ route('datos.mantenimientos.edit', $mantenimiento->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Editar Mantenimiento"><span class="glyphicon glyphicon-pencil"></span></a>
									  					
									  				</td>
									  			</tr>
									  		@endforeach
									  	</tbody>
									</table>
								</div>
					        </div>
				        </div>
				    </div>
				</div>
			@endif

	    @endif

	    
		<!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal">
		    <div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title"></h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
				        <p>One fine body&hellip;</p>
				    </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
@stop

@section('script_calendar')
	{{ HTML::script('assets/js/underscore-min.js') }}
	{{ HTML::script('assets/js/calendar.js') }}
	{{ HTML::script('assets/js/language/es-CO.js') }}

	<script type="text/javascript">
		(function($){
			
			var options = {
				events_source: baseurl+'/getMantenimientos',
				view: 'week',
				language: 'es-CO',
				tmpl_path: '{{ url() }}/tmpls/',
				tmpl_cache: false,				
				width: '100%',
				
				onAfterEventsLoad: function(events) 
				{
					if(!events) 
					{
						return;
					}
					var list = $('#eventlist');
					list.html('');

					$.each(events, function(key, val) 
					{
						$(document.createElement('li'))
							.html('<a href="' + val.url + '">' + val.title + '</a>')
							.appendTo(list);
					});
				},
				onAfterViewLoad: function(view) 
				{
					$('.page-header h3').text(this.getTitle());
					$('.btn-group button').removeClass('active');
					$('button[data-calendar-view="' + view + '"]').addClass('active');
				},
				views:{
					day: {enable: 0}
				}
			}

			var calendar = $('#calendar').calendar(options);

			$('.btn-group button[data-calendar-nav]').each(function(){
				var $this = $(this);
				$this.click(function() 
				{
					calendar.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-group button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() 
				{
					calendar.view($this.data('calendar-view'));
				});
			});

			
		}(jQuery));
    </script>
@stop