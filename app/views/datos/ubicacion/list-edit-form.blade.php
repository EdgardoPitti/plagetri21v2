@extends ('layout')

@section('title')
	Unidad Administrativa
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Unidad Administrativa</center>
		</h1>
		<div class="row">
	      <div class="col-md-12 col-sm-12 col-lg-12">
	        <div class="panel panel-primary">
	          <div class="panel-heading">
	            <h3 class="panel-title">Lista de Unidades Administrativas</h3>
	            <div class="pull-right">
	              <span class="clickable filter" data-toggle="tooltip" title="Buscar Unidad" data-container="body">
	                <i class="glyphicon glyphicon-filter"></i>
	              </span>
	            </div>
	          </div>
	          <div class="panel-body">
	            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#list-act" placeholder="Filtrar Unidad Administrativa" />
	          </div>
	          <div class="table-responsive overthrow" style="padding:10px 10px;height:170px;">
	              <table class="table table-bordered table-hover list-act" id="list-act">
	                <thead>
		                <tr class="info">
		                    <th>#</th>
		                    <th>Unidad Administrativa</th>
		                    <th></th>
		                </tr>
		             </thead>
		             <tbody>
	                {{--*/ $x = 1; /*--}}
	                @foreach (Ubicacion::all() as $unidad)
	                  <tr>
	                      <td>{{ $x++ }}.</td>
	                      <td>{{ $unidad->ubicacion }}</td>
	                      <td align="center">
							<a href="{{ route('unidad.edit', $unidad->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Editar Datos"><span class="glyphicon glyphicon-pencil"></span></a>                        
	                      </td>
	                  </tr>
	                @endforeach
	                </tbody> 
	              </table>
	          </div>
	        </div>
	      </div>
	    </div>
			{{ Form::model($datos['unidad'], $datos['form'], array('role' => 'form')) }}
				<div class="row">
					<div class="form-group col-sm-6 col-sm-offset-3">
	  					{{ Form::label('ubicacion', 'Unidad Administrativa:') }}
	  					{{ Form::text('ubicacion', null, array('placeholder' => 'Unidad Administrativa', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
				</div>
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				    <center>
				      {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
				      <a href="{{ route('unidad.index') }}" class="btn btn-info">Limpiar Campos</a>
				    </center>
	 			</div>
			{{ Form::close() }}
@stop
