@extends ('layout')

@section('title')
	Proveedores
@stop

@section('content')
		<h1>
		 <div style="position:relative;">
			<div style="position:absolute;left:0px;">
		    	<a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
			</div>
		 </div>
		  <center>Proveedores</center>
		</h1>
		<div class="row">
	      <div class="col-md-12 col-sm-12 col-lg-12">
	        <div class="panel panel-primary">
	          <div class="panel-heading">
	            <h3 class="panel-title">Lista de Proveedores</h3>
	            <div class="pull-right">
	              <span class="clickable filter" data-toggle="tooltip" title="Buscar Proveedor" data-container="body">
	                <i class="glyphicon glyphicon-filter"></i>
	              </span>
	            </div>
	          </div>
	          <div class="panel-body">
	            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#list-act" placeholder="Filtrar Proveedores" />
	          </div>
	          <div class="table-responsive overthrow" style="padding:10px 10px;height:170px;">
	              <table class="table table-bordered table-hover list-act" id="list-act">
	                <thead>
		                <tr class="info">
		                    <th>#</th>
		                    <th>Nombre</th>
		                    <th>RUC</th>
		                    <th>Teléfono</th>
		                    <th>Dirección</th>
		                    <th></th>
		                </tr>
		             </thead>
		             <tbody>
	                {{--*/ $x = 1; /*--}}
	                @foreach (Proveedor::all() as $proveedor)
	                  <tr>
	                      <td>{{ $x++ }}.</td>
	                      <td>{{ $proveedor->nombre }}</td>
	                      <td>{{ $proveedor->ruc }}</td>
	                      <td>{{ $proveedor->telefono }}</td>
	                      <td>{{ $proveedor->direccion }}</td>
	                      <td align="center">
							<a href="{{ route('proveedor.edit', $proveedor->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Editar Datos"><span class="glyphicon glyphicon-pencil"></span></a>                        
	                      </td>
	                  </tr>
	                @endforeach
	                </tbody> 
	              </table>
	          </div>
	        </div>
	      </div>
	    </div>
			{{ Form::model($datos['proveedor'], $datos['form'], array('role' => 'form')) }}
				<div class="row">
					<div class="form-group col-sm-6 col-sm-offset-3">
	  					{{ Form::label('nombre', 'Nombre:') }}
	  					{{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
					<div class="form-group col-sm-6 col-sm-offset-3">
	  					{{ Form::label('ruc', 'RUC:') }}
	  					{{ Form::text('ruc', null, array('placeholder' => 'RUC', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
					<div class="form-group col-sm-6 col-sm-offset-3">
	  					{{ Form::label('telefono', 'Teléfono:') }}
	  					{{ Form::text('telefono', null, array('placeholder' => 'telefono', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
				    <div class="form-group col-sm-6 col-sm-offset-3">
				    	{{ Form::label('direccion', 'Dirección:') }}
				    	{{ Form::textarea('direccion', null, array('placeholder' => 'Dirección', 'class' => 'form-control', 'size' => '3x1')) }}
				    </div>
				    <div class="form-group col-sm-6 col-sm-offset-3">
				    	{{ Form::label('detalle', 'Detalle:') }}
				    	{{ Form::textarea('detalle', null, array('placeholder' => 'Detalle', 'class' => 'form-control', 'size' => '3x1')) }}
				    </div>
				</div>
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				    <center>
				      {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
				      <a href="{{ route('tipoactivo.index') }}" class="btn btn-info">Limpiar Campos</a>
				    </center>
	 			</div>
			{{ Form::close() }}
@stop
