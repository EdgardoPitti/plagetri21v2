@extends ('layout')

@section('title')
	Agenda Telefónica
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Agenda Telefónica</center>
		</h1>
		


		<hr>
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
      <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Lista de Agendas Telefónicas</h3>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Buscar Agenda" data-container="body">
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body" style="display:block;">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar Datos" /><br>
            
            <div class="overthrow" style="height:190px;">
					<table class="table table-bordered table-hover agenda" cellpadding="0" cellspacing="0" id="dev-table">
	                <thead>
		                <tr class="info">
		                    <th>#</th>
		                    <th>Nombre Completo</th>
		                    <th>Profesión</th>
		                    <th>Teléfono</th>
		                    <th>Celular</th>
		                    <th>Extensión</th>
		                    <th></th>
		                </tr>
	              	</thead>
	              	<tbody>
	              	{{--*/ $x=1; /*--}}
					@foreach (Agenda::all() as $agenda)
						<tr>
							<td>{{ $x++ }}.</td>
							<td>{{ $agenda->nombre_completo }}</td>
							<td>{{ $agenda->profesion }}</td>
							<td>{{ $agenda->telefono }}</td>
							<td>{{ $agenda->celular }}</td>
							<td>{{ $agenda->extension }}</td>
							<td align="center"><a href="{{ route('datos.agenda.edit', $agenda->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Editar Agenda"><span class="glyphicon glyphicon-list-alt"></span> Editar </a></td>
						</tr>
					@endforeach
					{{-- Médicos --}}
					@foreach (Medico::all() as $medico)
						<tr>
							<td>{{ $x++ }}.</td>
							<td>{{ $medico->primer_nombre.' '.$medico->apellido_paterno }}</td>
							@if(empty(EspecialidadMedica::where('id_especialidades_medicas', $medico->id_especialidades_medicas)->first()->descripcion))
								<td> Doctor </td>
							@else
								<td>{{ EspecialidadMedica::where('id_especialidades_medicas', $medico->id_especialidades_medicas)->first()->descripcion }}</td>
							@endif
							<td>{{ $medico->telefono }}</td>
							<td>{{ $medico->celular }}</td>
							<td>{{ $medico->extension }}</td>
							<td><a href='#Show' onclick='show({{$medico->id}})'  class='btn btn-info btn-sm ver' data-toggle='modal'  title='Ver Médico' style='margin:3px 0px;'><span class='glyphicon glyphicon-eye-open'></span> Ver </a></td>
						</tr>
					@endforeach
					
					</tbody>
				</table>
			 </div>
          </div>
        </div>
      </div>
    </div>

    {{ Form::model($datos['agenda'], $datos['form'], array('role' => 'form')) }}
		<div class="row" >
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('nombre_completo', 'Nombre Completo:') }}
		      {{ Form::text('nombre_completo', null, array('placeholder' => 'Nombre Completo', 'class' => 'form-control', 'required' => 'required')) }}
		    </div>
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('ruc', 'RUC:') }}
		      {{ Form::text('ruc', null, array('placeholder' => 'RUC', 'class' => 'form-control')) }}
		    </div>		    
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('profesion', 'Profesión:') }}
		      {{ Form::text('profesion', null, array('placeholder' => 'Profesión', 'class' => 'form-control')) }}
		    </div>
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('telefono', 'Teléfono:') }}
		      {{ Form::text('telefono', null, array('placeholder' => 'Telefono', 'class' => 'form-control', 'required' => 'required')) }}
		    </div>
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('celular', 'Celular:') }}
		      {{ Form::text('celular', null, array('placeholder' => 'Celular', 'class' => 'form-control')) }}
		    </div>
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('correo', 'Correo:') }}
		      {{ Form::text('correo', null, array('placeholder' => 'Correo', 'class' => 'form-control')) }}
		    </div>
			<div class="form-group col-sm-4 col-md-4 col-lg-4">
		      {{ Form::label('extension', 'Extensión:') }}
		      {{ Form::text('extension', null, array('placeholder' => 'Extensión', 'class' => 'form-control')) }}
		    </div>
		    <div class="form-group col-sm-4 col-md-4 col-lg-4">
		    	{{ Form::label('detalle', 'Detalle:') }}
	    		{{ Form::textarea('detalle', null, array('placeholder' => 'Detalle', 'class' => 'form-control', 'size' => '1x1')) }}        
			</div>
		    <div class="form-group col-sm-4 col-md-4 col-lg-4">
		    	{{ Form::label('proveedor', 'Es Proveedor?:') }}
		    	{{ Form::checkbox('proveedor', 1, null,  array('class' => 'form-control cmn-toggle cmn-toggle-round-flat', 'id' => 'cmn-toggle')) }}
		    	<label for="cmn-toggle"></label>
		    </div>
		</div>
		<center style="padding-bottom:15px;">
			{{ Form::button($datos['label'].' Agenda', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	      <a href="{{ route('datos.agenda.index') }}" class="btn btn-info">Limpiar Campos</a>
		</center>
	{{ Form::close() }}

	{{ HTML::script('assets/js/overthrow/overthrow-detect.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-init.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-polyfill.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-toss.js') }}
@stop
