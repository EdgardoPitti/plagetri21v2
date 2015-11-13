@extends ('layout')

@section('title')
	Citas de Tamizaje
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Citas de Tamizaje</center>
		</h1>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
		    	<div class="panel panel-primary">
			      	<div class="panel-heading">
			        		<h3 class="panel-title">Lista de Pacientes</h3>
		        			<div class="pull-right">
			          			<span class="clickable filter" data-toggle="tooltip" title="Buscar Paciente" data-container="body">
				            		<i class="glyphicon glyphicon-filter"></i>
			          			</span>
			        		</div>
			      	</div>
			    	<div class="panel-body" style="display:block">
					    <div class="overthrow" style="height:250px;">							
							<table id="table-cita">
							    <thead>
								    <tr class="info">
								        <th data-field="num" data-align="center">#</th>
								        <th data-field="cedula" data-align="center">Cédula</th>
								        <th data-field="name" data-align="center">Nombre Completo</th>
								        <th data-field="date" data-align="center">Fecha Nacimiento</th>
								        <th data-field="cel" data-align="center">Celular</th>
								        <th data-field="tel" data-align="center">Teléfono</th>
								        <th data-field="email" data-align="center">E-mail</th>
								        <th data-field="url" data-align="center"> Acciones</th>
								    </tr>
							    </thead>
							</table>	 
						</div>
			        </div>
		        </div>
		    </div>
		</div>
		
		@if(!empty($datos))
			<h3>Datos Generales del Paciente</h3>
			<div class="table-responsive overthrow" id="scrollbar2" style=" position:relative;overflow:hidden;width:100%;">
				<table class="table table-bordered">
					<tr  class="info">
						<th style="width:100px">Cédula</th>
						<th>Nombre Completo</th>
						<th>Edad</th>
						<th>Fuma</th>
						<th>Diabetes</th>
						<th>Nacionalidad</th>
						<th>Etnia</th>
						<th>Raza</th>
						<th>Tipo de Sangre</th>
						<th>Casos Ant. con Trisomia</th>
					</tr>
					<tr class="white">
						<td>{{ $datos[0]->cedula }}</td>
						<td>{{ $datos[0]->primer_nombre.' '.$datos[0]->segundo_nombre.' '.$datos[0]->apellido_paterno.' '.$datos[0]->apellido_materno }}</td>
						<td>{{ $datos[0]->edad }}</td>
						<td>{{ $datos[0]->fumadora }}</td>
						<td>{{ $datos[0]->diabetico }}</td>
						<td>{{ $datos[0]->nacionalidad }}</td>
						<td>{{ $datos[0]->etnia }}</td>
						<td>{{ $datos[0]->raza }}</td>
						<td>{{ $datos[0]->tipo_sangre }}</td>
						<td>{{ $datos[0]->embarazos_anteriores }}</td>
					</tr>
				</table>
			</div>
			<hr>
			<h3>Datos de Contacto del Paciente</h3>
			<div class="table-responsive overthrow" id="scrollbar3" style=" position:relative;overflow:hidden;width:100%;">
				<table class="table table-bordered">
					<tr class="info">
						<th>Provincia</th>
						<th>Distrito</th>
						<th>Corregimiento</th>
						<th>Lugar</th>
						<th>Teléfono</th>
						<th>E-mail</th>
						<th>Celular</th>
					</tr>
					<tr class="white">
						<td>{{ $datos[0]->provincia_residencia }}</td>
						<td>{{ $datos[0]->distrito_residencia }}</td>
						<td>{{ $datos[0]->corregimiento_residencia }}</td>
						<td>{{ $datos[0]->lugar_residencia }}</td>
						<td>{{ $datos[0]->telefono }}</td>
						<td>{{ $datos[0]->email }}</td>
						<td>{{ $datos[0]->celular }}</td> 
					</tr>
				</table>
			</div>
			<hr>
			<h3>Datos de la Cita</h3>
			{{ Form::model($form['citas'], $form['datos'] , array('role' => 'form')) }}
				<div class="row">
					{{ Form::text('id_paciente', $datos[0]->id, array('style' => 'display:none', 'id' => 'id_paciente')) }}
					{{ Form::text('fecha_nacimiento', $datos[0]->fecha_nacimiento, array('style' => 'display:none', 'id' => 'fecha_nacimiento')) }}
					{{ Form::text('semana', $form['citas']->edad_gestacional_fur , array('style' => 'display:none', 'id' => 'semana')) }}
					{{ Form::text('edad', $form['citas']->edad_materna , array('style' => 'display:none', 'id' => 'edad')) }}
					{{ Form::text('caso_anterior', $datos[0]->embarazo_trisomia , array('style' => 'display:none', 'id' => 'caso_anterior')) }}
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('riesgo', 'Riesgo:') }}&nbsp;&nbsp;&nbsp;&nbsp;{{ Form::label('riesgocorregido', 'Corrección por FAP:') }}
				    	<div id="riesgo_pantalla">1/{{ $form['citas']->riesgo }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1/{{ $form['citas']->riesgo_fap }}</div>
				    	{{ Form::text('riesgo', $form['citas']->riesgo, array('style' => 'display:none', 'id' => 'riesgo')) }}  
				    	{{ Form::text('riesgo_fap', $form['citas']->riesgo_afp, array('style' => 'display:none', 'id' => 'riesgo_fap')) }}  
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('fecha_cita', 'Fecha de Cita:') }}
      					{{ Form::text('fecha_cita', $form['citas']->fecha_cita, array('id' => 'fecha_cita','class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'required' => 'required')) }}
    				</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('fecha_flebotomia', 'Fecha de Flebotomia:') }}
      					{{ Form::text('fecha_flebotomia', $form['citas']->fecha_flebotomia, array('id' => 'fecha_flebotomia','class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd','required' => 'required')) }}
    				</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('id_medico', 'Médico:') }}
      					{{ Form::select('id_medico', array('0' => 'SELECCION EL  MÉDICO') + Medico::select('id', DB::raw('concat(apellido_paterno," ",apellido_materno,", ",primer_nombre," ",segundo_nombre) AS nombre_completo'))->orderBy('apellido_paterno', 'ASC')->lists('nombre_completo','id'), $form['citas']->id_medico, array('class' => 'form-control', 'required' => 'required')) }}
    				</div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('peso', 'Peso(kg):') }}
				    	{{ Form::text('peso', $form['citas']->peso, array('placeholder' => 'Peso', 'class' => 'form-control', 'required' => 'required')) }}        
				    </div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('estatura', 'Estatura(m):') }}
				    	{{ Form::text('estatura', $form['citas']->estatura, array('placeholder' => 'Estatura', 'class' => 'form-control')) }}        
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('fur', 'Fecha de Ultima Menstruación:') }}
      					{{ Form::text('fur', $form['citas']->fur, array('id' =>'fur','class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd','required' => 'required')) }}
    				</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('fpp', 'Fecha Probable de Parto:') }}
      					{{ Form::text('fpp', $form['citas']->fpp, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd')) }}
    				</div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('edad_gestacional', 'Edad Gestacional por Ultrasonido:') }}
				    	{{ Form::text('edad_gestacional', $form['citas']->edad_gestacional, array('placeholder' => 'Edad Gestacional', 'class' => 'form-control', 'required' => 'required')) }}        
				    </div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('hijos_embarazo', 'Cantidad de Hijos en Embarazo:') }}
      					{{ Form::select('hijos_embarazo', array('0' => 'SELECCION LA CANTIDAD DE HIJO', '1' => 'UNO', '2' => 'DOS', '3' => 'TRES', '4' => 'CUATRO', '5' => 'CINCO', '6' => 'SEIS'), $form['citas']->hijos_embarazo, array('class' => 'form-control', 'required' => 'required')) }}
				    </div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('fecha_ultrasonido', 'Fecha del Ultrasonido:') }}
      					{{ Form::text('fecha_ultrasonido', $form['citas']->fecha_ultrasonido, array('class' => 'form-control datepicker', 'placeholder' => 'aaaa-mm-dd', 'min' => '2000-01-01', 'max' => '2050-12-31')) }}
    				</div>
    			    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('observaciones', 'Observaciones:') }}
				    	{{ Form::textarea('observaciones', $form['citas']->observaciones, array('placeholder' => 'Observaciones', 'class' => 'form-control', 'size' => '1x1')) }}        
				    </div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('id_provincia_institucion', 'Provincia:') }}
      					{{ Form::select('id_provincia_institucion', array('0' => 'SELECCIONE LA PROVINCIA') + Provincia::lists('provincia', 'id_provincia'), $form['institucion']->id_provincia, array('class' => 'form-control')) }}
    				</div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('id_tipo_institucion', 'Tipo de Institución:') }}
      					{{ Form::select('id_tipo_institucion', array('0' => 'SELECCIONE EL TIPO DE INSTITUCION') + Tipoinstitucion::lists('tipo_institucion', 'id'), $form['institucion']->id_tipo_institucion, array('class' => 'form-control')) }}
    				</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
      					{{ Form::label('id_institucion', 'Institución:') }}
      					{{ Form::select('id_institucion', array('0' => 'SELECCIONE LA INSTITUCIÓN') + Institucion::where('id_provincia', $form['institucion']->id_provincia)->where('id_tipo_institucion', $form['institucion']->id_tipo_institucion)->lists('denominacion', 'id'), $form['citas']->id_institucion, array('class' => 'form-control', 'required' => 'required')) }}
    				</div>
				</div>
				<h3>Marcadores</h3>
				<div class="row">
					<div class="col-sm-4">
      					{{ Form::label('tipo_cita', 'Tipo de Cita:') }}
      					{{ Form::select('tipo_cita', array('1' => 'PRIMER TRIMESTRE', '2' => 'SEGUNDO TRIMESTRE') , $form['citas']->tipo_cita, array('class' => 'form-control', 'id' => 'tipo_cita')) }}
					</div>
					@if($form['citas']->tipo_cita  == '2')
							{{--*/$display = 'display:block;';/*--}}
							{{--*/$display_1 = 'display:none;';/*--}}
							{{--*/$title = '2° Trimestre';/*--}}
					@else
							{{--*/$display = 'display:none;';/*--}}
							{{--*/$display_1 = 'display:block;';/*--}}
							{{--*/$title = '1° Trimestre';/*--}}
					@endif
					<input type="hidden" name="id_cita_referencia" value="0">
					<div class="col-sm-12" style="margin-top:15px;{{$display}}" id="tab_citas">						
						<div class="table-responsive overthrow" style="max-height:150px;">
					 		<table class="table table-hover table-bordered" cellpadding="0" cellspacing="0">
							  	<thead>
							  		<tr class="info">
							  			<th style="padding:10px 0px 10px 5px;"></th>
							  			<th style="padding:10px 0px 10px 5px;">Fecha de Cita</th>
							  			<th style="padding:10px 0px 10px 5px;">Fecha de Flebotomía</th>
							  			<th style="padding:10px 0px 10px 5px;">Institucion</th>
							  			<th style="padding:10px 0px 10px 5px;">Peso</th>
							  			@foreach (Marcador::all() as $marcador)
							  				<th style="padding:10px 0px 10px 5px;">{{ $marcador->marcador }}</th>
							  			@endforeach
							  			<th style="padding:10px 0px 10px 5px;"></th>
							  		</tr>
							  	</thead>
							  	<tbody>
							  		{{--*/ $cita = Cita::where('id_paciente', $datos[0]->id)->where('tipo_cita', '1')->where('id_cita_referencia', '0')->orwhere('id', $form['citas']->id_cita_referencia)->get(); 
							  		/*--}}
							  		@if( empty($cita[0]) )
							  			<tr class="white">
							  				<td colspan="14" align="center">No existen citas para referenciar.</td>
							  			</tr>
							  		@else
								  		@foreach ($cita as $citas)
								  			@if($form['citas']->id_cita_referencia == $citas->id)
								  				{{--*/$checked = 'checked';/*--}}
								  			@else
								  				{{--*/$checked = '';/*--}}
								  			@endif
									  		<tr class="white" align="center">
									  			<td><input type="radio" id="id_cita_referencia" name="id_cita_referencia" value="{{$citas->id}}" {{$checked}}></td>
									  			<td>{{ $citas->fecha_cita }}</td>
									  			<td>{{ $citas->fecha_flebotomia }}</td>
									  			@if($citas->id_institucion == 0)
													<td>No Definida</td>
												@else
													<td>{{ Institucion::where('id', $citas->id_institucion)->first()->denominacion }}</td>
												@endif	
									  			<td>{{ $citas->peso }}</td>
									  			@foreach (Marcador::all() as $marcador)
									  				<td>{{ $form['marcador_cita']->obtenerMarcador($marcador->id, $citas->id)->valor }}</td> 
									  			@endforeach
									  			<td align="center">
									  				<a href="{{ route('datos.citas.edit', $citas->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Editar Cita"><span class="glyphicon glyphicon-pencil"></span> Editar </a>
									  			</td>
									  		</tr>
								  		@endforeach
								  	@endif
							  	</tbody>
							</table>							
						</div>				
					</div>
					
					<div class="col-md-12 col-lg-12">
						<h3 class="title">{{ $title }}</h3>
						<div class="portlet">
							<div class="tabbable-panel">
								<div class="tabbable-line">
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab1" style="{{ $display }}">
											<div class="table-responsive overthrow">
												<table class="table table-striped" style="width:100%">
													<thead>
														<tr class="info">
															<th style="text-align:center;padding:6px;">			
												    				{{ Form::label('2_met_general', 'Métodología en General:') }}
												    		</th>
												    		<th style="text-align:center;padding:6px;">
												    				{{ Form::select('2_met_general', array('0' => 'SELECCION EL  MÉTODO') + Metodologia::lists('metodologia','id'), null, array('class' => 'form-control')) }}
												    		</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">MOM del Marcador</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">Correccion por Peso</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">Correccion por Peso</th>
												    	</tr>
													</thead>
													<tbody>
												    @foreach (Marcador::where('trimestre_marcador', '2')->OrWhere('trimestre_marcador', '3')->get() as $marcadores)
														<tr>
															<td style="padding-top:28px;">
																{{ Form::label('2_valor_'.$marcadores->id, $marcadores->marcador.': ') }}
												    			{{ Form::text('2_valor_'.$marcadores->id, $form['2_marcador_'.$marcadores->id.'']->valor, array('placeholder' => $marcadores->marcador, 'class' => 'form-control', 'onKeyUp' => 'Division('.$marcadores->id.','.$datos[0]->id_raza.', 2)')) }}
												    			@if($form['2_marcador_'.$marcadores->id.'']->id_unidad != 0)
																	{{ Unidad::where('id', $form['2_marcador_'.$marcadores->id.'']->id_unidad)->first()->unidad }}
												    			@else
																	{{ Unidad::where('id', UnidadMarcador::where('id_marcador', $marcadores->id)->get()->last()->id_unidad)->first()->unidad }}
												    			@endif
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('2_metodo_'.$marcadores->id, 'Métodología para '.$marcadores->marcador.':') }}
								      							{{ Form::select('2_metodo_'.$marcadores->id, array('0' => 'SELECCION EL  MÉTODO') + Metodologia::lists('metodologia','id'), $form['2_marcador_'.$marcadores->id.'']->id_metodologia, array('class' => 'form-control')) }}															
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('2_mom_'.$marcadores->id, 'MOM '.$marcadores->marcador.':') }}
								      								<div id="2_pantalla_mom_{{$marcadores->id}}">{{ $form['2_marcador_'.$marcadores->id.'']->mom }}</div>
												    			{{ Form::text('2_mom_'.$marcadores->id, $form['2_marcador_'.$marcadores->id.'']->mom, array('style' => 'display:none')) }}	
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('2_corr_lineal_'.$marcadores->id, 'Lineal:') }}
								      								<div id="2_pantalla_lineal_{{$marcadores->id}}">{{ $form['2_marcador_'.$marcadores->id.'']->corr_peso_lineal }}</div>
												    			{{ Form::text('2_corr_lineal_'.$marcadores->id, $form['2_marcador_'.$marcadores->id.'']->corr_peso_lineal, array('placeholder' => 'MOM CORREGIDO', 'class' => 'form-control', 'style' => 'display:none')) }}
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('2_corr_exp_'.$marcadores->id, 'Exponencial:') }}
								      								<div id="2_pantalla_exponencial_{{$marcadores->id}}">{{ $form['2_marcador_'.$marcadores->id.'']->corr_peso_exponencial }}</div>
												    			{{ Form::text('2_corr_exp_'.$marcadores->id, $form['2_marcador_'.$marcadores->id.'']->corr_peso_exponencial, array('placeholder' => 'MOM CORREGIDO', 'class' => 'form-control', 'style' => 'display:none')) }}
															</td>
														</tr>
												    @endforeach
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab2" style="{{ $display_1 }}">
											<div class="table-responsive overthrow">
												<table class="table table-striped" style="width:100%">
													<thead>
														<tr class="info">
															<th style="text-align:center;padding:6px;">			
												    				{{ Form::label('1_met_general', 'Métodología en General:') }}
												    		</th>
												    		<th style="text-align:center;padding:6px;">
												    				{{ Form::select('1_met_general', array('0' => 'SELECCION EL  MÉTODO') + Metodologia::lists('metodologia','id'), null, array('class' => 'form-control')) }}
												    		</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">MOM del Marcador</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">Correccion por Peso</th>
												    		<th style="text-align:center;padding:6px 6px 10px 6px;">Correccion por Peso</th>
												    	</tr>
													</thead>
													<tbody>
												     @foreach (Marcador::where('trimestre_marcador', '1')->OrWhere('trimestre_marcador', '3')->get() as $marcadores)
														<tr>
															<td style="padding-top:28px;">
																{{ Form::label('1_valor_'.$marcadores->id, $marcadores->marcador.': ') }}
												    			{{ Form::text('1_valor_'.$marcadores->id, $form['1_marcador_'.$marcadores->id.'']->valor, array('placeholder' => $marcadores->marcador, 'class' => 'form-control', 'onKeyUp' => 'Division('.$marcadores->id.','.$datos[0]->id_raza.', 1)')) }}
												    			@if($form['1_marcador_'.$marcadores->id.'']->id_unidad != 0)
																	{{ Unidad::where('id', $form['1_marcador_'.$marcadores->id.'']->id_unidad)->first()->unidad }}
												    			@else
																	{{ Unidad::where('id', UnidadMarcador::where('id_marcador', $marcadores->id)->get()->last()->id_unidad)->first()->unidad }}
												    			@endif
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('1_metodo_'.$marcadores->id, 'Métodología para '.$marcadores->marcador.':') }}
								      							{{ Form::select('1_metodo_'.$marcadores->id, array('0' => 'SELECCION EL  MÉTODO') + Metodologia::lists('metodologia','id'), $form['1_marcador_'.$marcadores->id.'']->id_metodologia, array('class' => 'form-control')) }}															
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('mom_'.$marcadores->id, 'MOM '.$marcadores->marcador.':') }}
								      								<div id="1_pantalla_mom_{{$marcadores->id}}">{{ $form['1_marcador_'.$marcadores->id.'']->mom }}</div>
												    			{{ Form::text('1_mom_'.$marcadores->id, $form['1_marcador_'.$marcadores->id.'']->mom, array('style' => 'display:none')) }}		
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('1_corr_lineal_'.$marcadores->id, 'Lineal:') }}
								      								<div id="1_pantalla_lineal_{{$marcadores->id}}">{{ $form['1_marcador_'.$marcadores->id.'']->corr_peso_lineal }}</div>
												    			{{ Form::text('1_corr_lineal_'.$marcadores->id, $form['1_marcador_'.$marcadores->id.'']->corr_peso_lineal, array('placeholder' => 'MOM CORREGIDO', 'class' => 'form-control', 'style' => 'display:none')) }}
															</td>
															<td style="padding-top:28px;">
								      							{{ Form::label('1_corr_exp_'.$marcadores->id, 'Exponencial:') }}
								      								<div id="1_pantalla_exponencial_{{$marcadores->id}}">{{ $form['1_marcador_'.$marcadores->id.'']->corr_peso_exponencial }}</div>
												    			{{ Form::text('1_corr_exp_'.$marcadores->id, $form['1_marcador_'.$marcadores->id.'']->corr_peso_exponencial, array('placeholder' => 'MOM CORREGIDO', 'class' => 'form-control', 'style' => 'display:none')) }}
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
						</div>
					</div>
				</div>	
				<center>
					@if($form['label'] == 'Editar')
						{{ Form::button($form['label'].' Cita', array('type' => 'submit', 'class' => 'btn btn-success')) }}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('datos.citas.show', $datos[0]->id) }}" class="btn btn-info"> Nueva Cita</a>
					@else
						{{ Form::button($form['label'].' Cita', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
					@endif
				</center>
			{{ Form::close() }}		
			@if (!empty(Cita::where('id_paciente', $datos[0]->id)->first()->id))
				<div class="row" style="margin-top:15px;">
					<div class="col-md-12 col-sm-12 col-lg-12">
				    	<div class="panel panel-primary">
				      	<div class="panel-heading">
			        		<h3 class="panel-title">Citas Anteriores</h3>
		        			<div class="pull-right">
			          			<span class="clickable filter" data-toggle="tooltip" title="Buscar Citas" data-container="body">
				            		<i class="glyphicon glyphicon-filter"></i>
			          			</span>
			        		</div>
				      	</div>
					    	<div class="panel-body" style="display:block">
						        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#tabla-citas" placeholder="Filtrar Citas"/><br>
							    <div class="overthrow" style="height:150px;">
							        <table class="table table-hover table-bordered cita-anterior" cellpadding="0" cellspacing="0" id="tabla-citas">
									  	<thead>
									  		<tr class="info">
									  			<th>#</th>
									  			<th>Fecha de Cita</th>
									  			<th>Fecha de Flebotomía</th>
									  			<th>Institucion</th>
									  			<th>Peso</th>
									  			@foreach (Marcador::all() as $marcador)
									  				<th>{{ $marcador->marcador }}</th>
									  			@endforeach
									  			<th></th>
									  		</tr>
									  	</thead>
									  	<tbody>
									  		{{--*/ $n=1; /*--}}
									  		@foreach (Cita::where('id_paciente', $datos[0]->id)->orderBy('fecha_cita', 'desc')->get() as $citas)
										  		<tr align="center">
										  			<td>{{ $n++ }}.</td>
										  			<td>{{ $citas->fecha_cita }}</td>
										  			<td>{{ $citas->fecha_flebotomia }}</td>
										  			@if($citas->id_institucion == 0)
														<td>No Definida</td>
													@else
														<td>{{ Institucion::where('id', $citas->id_institucion)->first()->denominacion }}</td>
													@endif	
										  			<td>{{ $citas->peso }}</td>
										  			@foreach (Marcador::all() as $marcador)
										  				 	<td>{{ $form['marcador_cita']->obtenerMarcador($marcador->id, $citas->id)->valor }}</td> 
										  			@endforeach
										  			<td align="center">
										  				<a href="{{ route('datos.citas.edit', $citas->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Editar Cita"><span class="glyphicon glyphicon-pencil"></span> Editar </a>
										  				<a href="{{ URL::to('imprimir/cita/'.$citas->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
										  			</td>
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
				
			@endif
		@endif
		<br>
	{{ HTML::script('assets/js/overthrow/overthrow-detect.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-init.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-polyfill.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-toss.js') }}
@stop
