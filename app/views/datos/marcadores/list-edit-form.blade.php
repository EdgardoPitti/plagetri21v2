@extends ('layout')

@section('title')
	Marcadores
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Marcadores Bioquímicos y Ecográficos</center>
		</h1>

	<div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Lista de Marcador</h3>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Buscar Marcadores" data-container="body">
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
		                    <th>Marcador</th>
		                    <th>Trimestre</th>
		                    <th>Unidad</th>
		                    <th></th>
		                </tr>
	              	</thead>
	              	<tbody>
	              	{{--*/ $x=1; /*--}}
					@foreach (Marcador::all() as $marcador)
						<tr>
							<td>{{ $x++ }}.</td>
							<td>{{ $marcador->marcador }}</td>
							<td>
								@if($marcador->trimestre_marcador == 1)
									PRIMER
								@elseif($marcador->trimestre_marcador == 2)
									SEGUNDO
								@else
									AMBOS
								@endif
							</td>
							<td>
								@if(empty(UnidadMarcador::where('id_marcador', $marcador->id)->first()->id_unidad))
									NO DEFINIDO
								@else
									{{ Unidad::where('id', UnidadMarcador::where('id_marcador', $marcador->id)->first()->id_unidad)->first()->unidad	}}
								@endif
							</td>
							<td align="center"><a href="{{ route('datos.marcadores.edit', $marcador->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Editar Marcador"><span class="glyphicon glyphicon-list-alt"></span> Editar </a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			 </div>
          </div>
        </div>
      </div>
    </div>

    {{ Form::model($datos['marcadores'], $datos['form'], array('role' => 'form')) }}
		<div class="row" >
			<div class="form-group col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-sm-offset-4">
		      {{ Form::label('marcador', 'Marcador:') }}
		      {{ Form::text('marcador', null, array('placeholder' => 'Marcador', 'class' => 'form-control', 'required' => 'required')) }}
		    </div>
		    <div class="form-group col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-sm-offset-4">
		      {{ Form::label('trimestre_marcador', 'Trimestre de Marcador:') }}
		      {{ Form::select('trimestre_marcador', array('1' => 'I TRIMESTRE', '2' => 'II TRIMESTRE', '3' => 'AMBOS TRIMESTRES') ,null, array('class' => 'form-control', 'required' => 'required')) }}
		    </div>
		    <div class="form-group col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-sm-offset-4">
		      {{ Form::label('id_unidad', 'Unidad:') }}
		      {{ Form::select('id_unidad', array('0' => 'NO DEFINIDO') + Unidad::all()->lists('unidad', 'id') ,null, array('class' => 'form-control', 'required' => 'required')) }}
		    </div>
		</div>
		<center style="padding-bottom:15px;">
			{{ Form::button($datos['label'].' Marcador', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	      <a href="{{ route('datos.marcadores.index') }}" class="btn btn-info">Limpiar Campos</a>
		</center>
	{{ Form::close() }}

	{{ HTML::script('assets/js/overthrow/overthrow-detect.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-init.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-polyfill.js') }}
    {{ HTML::script('assets/js/overthrow/overthrow-toss.js') }}
@stop
