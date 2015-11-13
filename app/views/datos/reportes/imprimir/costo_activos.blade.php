@extends('datos.reportes.imprimir_layout')

@section('title')
	Reporte Costo de Activos
@stop

@section('css')
	<style type="text/css">
      .title{
        text-align: center;
        font-weight: bold;
      }
		 .title-cost{
    		margin: 10px 0;    		
    	}
      .title-graph{
        margin: 15px 0px;
      }
    	.table{
    		width: 100%;    		
    		border-top: 1px solid #333;
    		border-left: 1px solid #333;
    		border-spacing: 0;
    	}
    	.table th, .table td {
    		padding: 3px;
    		border-right: 1px solid #333;
    		border-bottom: 1px solid #333;
    	}
    	.table th{
    		background: #dfdfdf;
    	}      
	</style>
@stop

@section('contenido')
  {{--*/ setlocale(LC_TIME, 'Spanish'); /*--}}
	<div class="title title-cost">
		<h3>Lista de Activos con mayor Costo</h3>
	</div>
	<table class="table">
       <thead>
        <tr>
            <th>#</th>
            <th>Número de Activo</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Serie</th>
            <th>Fecha de Compra</th>
            <th>Costo</th>
        </tr>
      </thead>   
      <tbody>
        {{--*/ $x = 1; /*--}}                  
        @foreach ( Activo::where('id', '>', '0')->orderBy('costo', 'desc')->take(10)->get() as $activo)
          <tr>
              <td>{{ $x++ }}.</td>
              <td>{{ $activo->num_activo }}</td>
              <td>{{ $activo->nombre }}</td>
              <td>{{ $activo->modelo }}</td>
              <td>{{ $activo->marca }}</td>
              <td>{{ $activo->serie }}</td>
              @if(empty($activo->fecha_compra))
              <td>NO DEFINIDO</td>
              @else
              <td>{{ Carbon::parse($activo->fecha_compra)->formatLocalized('%#d %b %Y') }}</td>
              @endif
              <td>{{ $activo->costo }}</td>
          </tr>
        @endforeach
      </tbody>          
    </table>

    <div class="grafica">      
      <center>
        @if(Activo::all()->count() > 0)
    	   <img src="{{ URL::to('grafica/grafmayorcosto') }}">
        @endif
      </center>
    </div>
@stop