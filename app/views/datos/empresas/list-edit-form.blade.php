@extends ('layout')

@section('title')
	Empresas
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Empresas</center>
		</h1>
		<div class="row">
	      <div class="col-md-12 col-sm-12 col-lg-12">
	        <div class="panel panel-primary">
	          <div class="panel-heading">
	            <h3 class="panel-title">Lista de Empresas</h3>
	            <div class="pull-right">
	              <span class="clickable filter" data-toggle="tooltip" title="Buscar Empresa" data-container="body">
	                <i class="glyphicon glyphicon-filter"></i>
	              </span>
	            </div>
	          </div>
	          <div class="panel-body">
	            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#list-act" placeholder="Filtrar Activo" />
	          </div>
	          <div class="table-responsive overthrow" style="padding:10px 10px;height:170px;">
	              <table class="table table-bordered table-hover list-act" id="list-act">
	                <thead>
		                <tr class="info">
		                    <th>#</th>
		                    <th>Nombre</th>
		                    <th>RUC</th>
		                    <th>Teléfono</th>
		                    <th>Descripción</th>
		                    <th></th>
		                </tr>
		             </thead>
		             <tbody>
	                {{--*/ $x = 1; /*--}}
	                @foreach (Empresa::all() as $empresa)
	                  <tr>
	                      <td>{{ $x++ }}.</td>
	                      <td>{{ $empresa->nombre }}</td>
	                      <td>{{ $empresa->ruc }}</td>
	                      <td>{{ $empresa->telefono }}</td>
	                      <td>{{ $empresa->descripcion }}</td>
	                      <td align="center">
							<a href="{{ route('datos.empresas.edit', $empresa->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Editar Datos"><span class="glyphicon glyphicon-pencil"></span></a>                        
	                      </td>
	                  </tr>
	                @endforeach
	                </tbody> 
	              </table>
	          </div>
	        </div>
	      </div>
	    </div>
			{{ Form::model($datos['empresa'], $datos['form'], array('role' => 'form')) }}
				<div class="row">
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
	  					{{ Form::label('nombre', 'Nombre de la Empresa:') }}
	  					{{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
	  					{{ Form::label('ruc', 'RUC:') }}
	  					{{ Form::text('ruc', null, array('placeholder' => 'RUC', 'class' => 'form-control')) }}
					</div>
					<div class="form-group col-sm-4 col-md-4 col-lg-4">
				      {{ Form::label('telefono', 'Teléfono:') }}
				      {{ Form::text('telefono', null, array('placeholder' => 'Teléfono', 'class' => 'form-control')) }}
				    </div>
				    <div class="form-group col-sm-4 col-md-4 col-lg-4">
				    	{{ Form::label('descripcion', 'Descripción:') }}
				    	{{ Form::textarea('descripcion', null, array('placeholder' => 'Observación', 'class' => 'form-control', 'size' => '3x1')) }}
				    </div>
				</div>
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				    <center>
				      {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
				      <a href="{{ route('datos.empresas.index') }}" class="btn btn-info">Limpiar Campos</a>
				    </center>
	 			</div>
			{{ Form::close() }}
@stop
