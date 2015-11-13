@extends ('layout')

@section('title')
	Buscar Pacientes en el Mapa
@stop
@section('scripts')
  {{ HTML::script('https://maps.googleapis.com/maps/api/js?sensor=false') }}
         
    
@stop

@section ('content')   
     <h1>
     <div style="position:relative;">
        <div style="position:absolute;left:0px;">
          <a href="{{URL::to('/')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span><span class="return"> Inicio</span></a>
        </div>
      </div>
      <center>Reporte por Mapa</center>
    </h1><hr>
    <div class="form-group col-sm-4 col-md-4 col-lg-4">

      {{ Form::label('id_prov', 'Provincia:') }}      
      {{ Form::select('id_prov',  array('0, 8.51516, -79.986131' => 'SELECCIONE PROVINCIA') + Provincia::select('provincia', DB::raw('concat(id_provincia,",",latitud,",",longitud) AS datosprov'))->lists('provincia', 'datosprov'), null, array('class' => 'form-control')); }}    
    </div>
    <div class="form-group col-sm-4 col-md-4 col-lg-4">
      {{ Form::label('id_dist', 'Distrito:') }}
      {{ Form::select('id_dist',  array('0' => 'SELECCIONE DISTRITO'), null, array('class' => 'form-control')); }}
    </div>
     <div class="form-group col-sm-4 col-md-4 col-lg-4">
      {{ Form::label('id_correg', 'Corregimiento:') }}
      {{ Form::select('id_correg',  array('0' => 'SELECCIONE CORREGIMIENTO'), null, array('class' => 'form-control')); }}    
    </div>
  	<center>
      <a href="marcadores" class="btn btn-primary">Actualizar Mapa</a>
  	  <div id="map-canvas" style="margin-top:4px;"></div>
  	</center>

@stop