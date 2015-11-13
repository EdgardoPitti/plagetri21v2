@extends('datos.reportes.imprimir_layout')

@section('title')
	Reporte Activos por departamento
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
    <div class="title title-cost">
        @if($id != 0)            
            <h3>Departamento: {{ $departamento[0]->ubicacion }}</h3>
        @else
            <h3>Todos los Departamentos</h3>
        @endif
    </div>
    <table class="table">
       <thead>
        <tr>
            <th>#</th>
            <th>Número de Activo</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Serie</th>
            <th>Unidad Administrativa</th>
            <th>Departamento</th>
        </tr>
      </thead>   
      <tbody>
        {{--*/ $n =1; /*--}}
        @foreach($departamento as $depto)
            <tr>
                <td align="center">{{$n}}</td>
                <td align="center">{{$depto->num_activo}}</td>
                <td align="center">{{ $depto->num_activo.' - '.$depto->nombre.' (Mantenimiento Realizado)' }}</td>
                <td align="center">{{$depto->marca}}</td>
                <td align="center">{{$depto->serie}}</td>
                <td align="center">{{$depto->unidad_administrativa}}</td>
                <td align="center">{{$depto->ubicacion}}</td>
            </tr>
            {{--*/ $n++; /*--}}
        @endforeach
      </tbody>
    </table>
@stop