<?php

class getDatosController extends BaseController {
	
	public function postData(){
		if(Request::ajax()) {
			$medico = new Medico;
	
			$medico_id = Input::get('medico');
			
			$datos = $medico->datos_medico($medico_id);
			
			$data = array(
				'foto' => $datos[0]->foto,
				'first_name' => $datos[0]->primer_nombre,
				'second_name' => $datos[0]->segundo_nombre,
				'last_name' => $datos[0]->apellido_paterno,
				'last_sec_name' => $datos[0]->apellido_materno,
				'extension' => $datos[0]->extension,
				'especiality' => $datos[0]->especialidad,
				'level' => $datos[0]->nivel,
				'ubicacion' => $datos[0]->ubicacion,
				'observacion' => $datos[0]->observacion
					
			);
			
			return Response::json($data);
		}else {
			App::abort(403);		
		}
	
	}
	//Funcion para obtener todos los médicos y filtrarlos con su respectiva paginacion.
	public function postMedicos(){
		if(Request::ajax()) {
			$medico = new Medico;
		    	
			//variables recibidas por el script bootstrap-table
			$search = Input::get('search'); //utilizada para buscar un médico en la base de datos
			$limit = Input::get('limit'); 
			$offset = Input::get('offset');
			
			//Si recibe la variable "search" vacía, obtiene todos los médicos, sino busca alguno en específico.
			//variable cantidad: sirve para conocer el total de registros y realizar la paginación de acuerdo al limit y offset.
			if(empty($search)){
				$datos = $medico->datos_medico(0, 0, $limit, $offset);
				$cantidad = Medico::all()->count();		
			}else{
				//Obtiene todos los datos de los médicos que se buscan en la función "datos_medico" del modelo "medico"
				$datos = $medico->datos_medico($search, 1, $limit, $offset);				
				//Funcion que recibe cuantos registros se obtienen al realizar la búsqueda.
				$c = DB::select("SELECT count(id) as cantidad FROM medicos WHERE concat(`cedula`,' ',`primer_nombre`,' ',`apellido_paterno`) LIKE '%".$search."%'");
				$cantidad = $c[0]->cantidad;			
			}
			
			$n = 1;
			$comilla = "'";
			$data = array();
			//ciclo para obtener todos los datos del médico y guardarlos en la variable "data"
			foreach($datos as $medicos){
				$img = '<img src='.$comilla.URL::to('imgs/'.$medicos->foto).$comilla.' style='.$comilla.'width:50px;height:50px;'.$comilla.'>';
				if (GrupoUsuario::where('id', Auth::user()->id_grupo_usuario)->first()->grupo_usuario != "RECEPCION") {
					$url = '<a href='.$comilla.route('datos.medicos.edit', $medicos->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Editar M&eacute;dico'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-pencil'.$comilla.'></span> Editar </a> <a href='.$comilla.'#Show'.$comilla.' id='.$comilla.''.$medicos->id.''.$comilla.' onclick='.$comilla.'show('.$medicos->id.');'.$comilla.'  class='.$comilla.'btn btn-info btn-sm'.$comilla.' data-toggle='.$comilla.'modal'.$comilla.'  title='.$comilla.'Ver Médico'.$comilla.' style='.$comilla.'margin:3px 0px;'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-eye-open'.$comilla.'></span> Ver </a> <a href='.$comilla.'#'.$comilla.' data-id='.$comilla.''.$medicos->id.''.$comilla.' onclick='.$comilla.'eliminar('.$medicos->id.');'.$comilla.' class='.$comilla.'btn btn-danger btn-delete btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.' title='.$comilla.'Eliminar'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-remove'.$comilla.'></span> Eliminar </a>';
				}else{
					$url = '<a href='.$comilla.route('datos.medicos.edit', $medicos->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Cargar M&eacute;dico'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-search'.$comilla.'></span> Cargar </a> <a href='.$comilla.'#Show'.$comilla.' id='.$comilla.''.$medicos->id.''.$comilla.' onclick='.$comilla.'show('.$medicos->id.');'.$comilla.'  class='.$comilla.'btn btn-info btn-sm'.$comilla.' data-toggle='.$comilla.'modal'.$comilla.'  title='.$comilla.'Ver Médico'.$comilla.' style='.$comilla.'margin:3px 0px;'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-eye-open'.$comilla.'></span> Ver </a>';
				}

				$data[] = array(
					'num' => $n,
					'foto' => $img,
					'cedula' => $medicos->cedula,
					'name' => $medicos->primer_nombre.' '.$medicos->segundo_nombre.' '.$medicos->apellido_paterno.' '.$medicos->apellido_materno,
					'ext' => $medicos->extension,
					'tel' => $medicos->telefono,
					'cel' => $medicos->celular,
					'esp' => $medicos->especialidad,
					'url' => $url
				);
				
				$n++;
			}
			return Response::json(array('total' => $cantidad, 'rows' => $data));		
		}else {
			App::abort(403);
		}		
			
	}
	//Funcion que recibe como parametro cita, si el valor de cita es 0, mostrara el boton de eliminar paciente,
	//sino no lo mostrará
	public function postPacientes($cita){
		if(Request::ajax()) {
			$paciente = new Paciente;
			
			$search = Input::get('search');
			$limit = Input::get('limit');
			$offset = Input::get('offset');
			
			if(empty($search)){
				$datos = $paciente->datos_pacientes(0, 0, $limit, $offset);			
				$cantidad = Paciente::all()->count();				
			}else {
				$datos = $paciente->datos_pacientes($search, 1, $limit, $offset);
				$c = DB::select("SELECT count(id) as cantidad FROM pacientes WHERE concat(`cedula`,' ',`primer_nombre`,' ',`apellido_paterno`) LIKE '%".$search."%'");
				$cantidad = $c[0]->cantidad;
			}	
			
			$comilla = "'";
			$n = 1;

			$data = array();
			foreach ($datos as $pacientes) {

				$cant_citas = Cita::where('id_paciente', $pacientes->id)->count();
				if($cita == 0){
					$url = '<a href='.$comilla.URL::to('datos/citas/'.$pacientes->id).$comilla.' class='.$comilla.'btn btn-primary btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Crear Cita'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-list-alt'.$comilla.'></span> Crear Cita </a>  <a href='.$comilla.route('datos.pacientes.edit', $pacientes->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Editar Paciente'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-pencil'.$comilla.'></span> Editar </a> <a href='.$comilla.'#'.$comilla.' data-id='.$comilla.''.$pacientes->id.''.$comilla.' onclick='.$comilla.'eliminar('.$pacientes->id.');'.$comilla.' class='.$comilla.'btn btn-danger btn-delete btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.' title='.$comilla.'Eliminar'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-remove'.$comilla.'></span> Eliminar </a>';
				}else{
					$url = '<a href='.$comilla.URL::to('datos/citas/'.$pacientes->id).$comilla.' class='.$comilla.'btn btn-primary btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Crear Cita'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-list-alt'.$comilla.'></span> Crear Cita </a>  <a href='.$comilla.route('datos.pacientes.edit', $pacientes->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Editar Paciente'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-pencil'.$comilla.'></span> Editar Paciente </a>';
				}	
				
				$data[] = array(
					'num' => $n,
					'name' => $pacientes->primer_nombre.' '.$pacientes->segundo_nombre.' '.$pacientes->apellido_paterno.' '.$pacientes->apellido_materno,
					'cedula' => $pacientes->cedula,
					'date' => $pacientes->fecha_nacimiento,
					'cel' => $pacientes->celular,
					'tel' => $pacientes->telefono,
					'email' => $pacientes->email,
					'cita' => $cant_citas,
					'url' => $url
				);

				$n++;
			}	

			return Response::json(array('total' => $cantidad, 'rows' => $data));
		}else {
			App::abort(403);		
		}
	}


	public function getActivos($mantenimiento){
		if(Request::ajax()){
			
			$search = Input::get('search');
			$limit = Input::get('limit');
			$offset = Input::get('offset');
			$order = Input::get('order');

			if(!empty($search)){
				$search_act = DB::select("SELECT a.id, a.num_activo, a.nombre, t.tipo, n.nivel, u.ubicacion, a.costo FROM activos a, tipos_activos t, ubicacion u, niveles n WHERE t.id = a.id_tipo AND u.id = a.id_ubicacion AND n.id = a.id_nivel AND (t.tipo LIKE '%".$search."%' OR u.ubicacion LIKE '%".$search."%' OR a.num_activo LIKE '%".$search."%' OR a.nombre LIKE '%".$search."%') ORDER BY a.costo ".$order." LIMIT ".$offset.",".$limit.";");
				$count = DB::select("SELECT a.id, a.num_activo, a.nombre, t.tipo, n.nivel, u.ubicacion, a.costo FROM activos a, tipos_activos t, ubicacion u, niveles n WHERE t.id = a.id_tipo AND u.id = a.id_ubicacion AND n.id = a.id_nivel AND (t.tipo LIKE '%".$search."%' OR u.ubicacion LIKE '%".$search."%' OR a.num_activo LIKE '%".$search."%' OR a.nombre LIKE '%".$search."%') ORDER BY a.costo ".$order.";");
				$cantidad = count($count);

			}else{
				$search_act = DB::select("SELECT a.id, a.num_activo, a.nombre, t.tipo, n.nivel, u.ubicacion, a.costo FROM activos a, tipos_activos t, ubicacion u, niveles n WHERE t.id = a.id_tipo AND u.id = a.id_ubicacion AND n.id = a.id_nivel AND a.id > 0 ORDER BY a.costo ".$order." LIMIT ".$offset.",".$limit.";");
				$count = DB::select("SELECT a.id, a.num_activo, a.nombre, t.tipo, n.nivel, u.ubicacion, a.costo FROM activos a, tipos_activos t, ubicacion u, niveles n WHERE t.id = a.id_tipo AND u.id = a.id_ubicacion AND n.id = a.id_nivel AND a.id > 0 ORDER BY a.costo ".$order.";");
				$cantidad = count($count);		
			}

			$comilla = "'";
			$n = 1;

			$data = array();
			foreach ($search_act as $activo) {

				if ($mantenimiento == 0) {
					$url = '<a href='.$comilla.route("datos.mantenimientos.show", $activo->id).$comilla.' class='.$comilla.'btn btn-primary btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Crear Mantenimiento'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-list-alt'.$comilla.'></span></a> <a href='.$comilla.route('datos.activos.edit', $activo->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' style='.$comilla.'margin:3px 0px;'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.' title='.$comilla.'Editar'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-pencil'.$comilla.'></span></a> <button class='.$comilla.'btn btn-warning btn-sm'.$comilla.' onclick='.$comilla.'baja(this)'.$comilla.' value='.$comilla.$activo->id.$comilla.' data-toggle='.$comilla.'modal'.$comilla.' data-target='.$comilla.'modalBaja'.$comilla.' title='.$comilla.'Dar de baja a '.utf8_encode($activo->nombre).$comilla.'><span class='.$comilla.'glyphicon glyphicon-trash'.$comilla.'></span></button>';
				}else{
					$url = '<a href='.$comilla.route("datos.mantenimientos.show", $activo->id).$comilla.' class='.$comilla.'btn btn-primary btn-sm'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.'  title='.$comilla.'Crear Mantenimiento'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-list-alt'.$comilla.'></span></a> <a href='.$comilla.route('datos.activos.edit', $activo->id).$comilla.' class='.$comilla.'btn btn-success btn-sm'.$comilla.' style='.$comilla.'margin:3px 0px;'.$comilla.' data-toggle='.$comilla.'tooltip'.$comilla.' title='.$comilla.'Editar'.$comilla.'><span class='.$comilla.'glyphicon glyphicon-pencil'.$comilla.'></span></a>';
				}

				$data[] = array(
					'num' => $n,
					'num_activo' => $activo->num_activo,
					'nombre' => $activo->nombre,
					'tipo' => $activo->tipo,
					'nivel' => $activo->nivel,
					'ubicacion' => $activo->ubicacion,
					'costo' => $activo->costo,
					'urls' => $url
				);

				$n++;
			}

			return Response::json(array('total' => $cantidad, 'rows' => $data));

		}else{
			App::abort(403);
		}
	}

	public function getMantenimientos(){
		
		if(Request::ajax()){
			
			$fecha_inicio = date('Y-m-d', Input::get('from')/1000);
			$fecha_fin = date('Y-m-d', Input::get('to')/1000);
			$out = array();

			foreach (Mantenimiento::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))->get() as $mantenimientos) {
				$activo = Activo::where('id', $mantenimientos->id_activo)->first();
				$out[] = array(
	    		    'id' => $mantenimientos->id,
	        		'title' => $activo->num_activo.' - '.utf8_encode($activo->nombre).' (Mantenimiento Realizado)',
	        		'url' => route('datos.mantenimientos.edit', $mantenimientos->id),
	        		'class' => 'event-success',
	        		'start' => strtotime($mantenimientos->fecha_realizacion)*1000+42799000,
	        		'end' => strtotime($mantenimientos->fecha_realizacion)*1000+42799000
			   	);
	    	}
	    	foreach(Activo::all() as $activos){
	    		$mantenimientos = Mantenimiento::where('id_activo', $activos->id)->orderBy('created_at', 'desc')->first();
	    			if(!empty($mantenimientos)){
		    			$out[] = array(
						    'id' => $mantenimientos->id.'c',
				    		'title' => $activos->num_activo.' - '.utf8_encode($activos->nombre).' (Prox. Mantenimiento)',
				    		'url' => route('datos.mantenimientos.show', $activos->id),
				    		'class' => 'event-important',
				    		'start' => strtotime($mantenimientos->proximo_mant)*1000+42799000,
				    		'end' => strtotime($mantenimientos->proximo_mant)*1000+42799000
					   	);			
	    			}
	   		
	    	}
    		return Response::json(array('success' => 1, 'result' => $out));    		

	    }else{
	    	App::abort(403);
	    }
		
	}

	public function getDepartamento(){
		
		if(Request::ajax()){
			
			$id = Input::get('search'); 
			$limit = Input::get('limit');
			$offset = Input::get('offset');

			$tipo = '>';

			if($id != 0){
				$tipo = '=';
			}
			
			$out = array();
			$n = 1;

			$activos = DB::table('activos AS a')
			->join('ubicacion AS ub', 'a.id_ubicacion', '=', 'ub.id')
			->join('unidades_administrativas AS ua', 'a.id_unidad_administrativa', '=', 'ua.id')
			->select(DB::raw('SQL_CALC_FOUND_ROWS *'),'a.num_activo','a.nombre','a.marca','a.serie','ub.ubicacion','ua.unidad_administrativa')
			->where('a.id_ubicacion', $tipo, $id)			
			->take($limit)->skip($offset)			
			->get();
			
			//Obtiene la cantidad de registros de activos segun su ubicacion
			$cantidad = DB::select(DB::raw("SELECT FOUND_ROWS() AS totalActivos;"));
			$cantidad = $cantidad[0]->totalActivos;

			foreach ($activos as $activo) {
				$out[] = array(
					'num' => $n, 
	    		    'num_activo' => $activo->num_activo,
	        		'nombre' => $activo->num_activo.' - '.utf8_encode($activo->nombre).' (Mantenimiento Realizado)',
	        		'marca' => $activo->marca,
	        		'serie' => $activo->serie,
	        		'unidad_administrativa' => $activo->unidad_administrativa,
	        		'departamento' => $activo->ubicacion
			   	);
			   	$n++;
	    	}

    		return Response::json(array('total' => $cantidad, 'rows' => $out));    		

	    }else{
	    	App::abort(403);
	    }
		
	}

}