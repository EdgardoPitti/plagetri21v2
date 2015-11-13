<?php

class MarcadoresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Instancia de Marcador
		$datos['marcadores'] = new Marcador;
		//Texto para el boton
		$datos['label'] = 'Agregar';
		//Rutas para el formulario
		$datos['form'] = array('route' => 'datos.marcadores.store', 'method' => 'POST');
		//Llamado de la vista
		return View::make('datos/marcadores/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Recibo de datos
		$data = Input::all();
		//Instancia de Marcador
		$marcador = new Marcador;
		//Colocacion de los campos con los de las bd
		$marcador->marcador = $data['marcador'];
		$marcador->trimestre_marcador = $data['trimestre_marcador'];
		$marcador->id_user_created = Auth::user()->id;
		//Almacenamiento
		$marcador->save();
		//Si la unidad es diferente de 0 quiere decir que el usuario selecciono una unidad
		if($data['id_unidad'] <> 0){
			//Instancia de la Unidad
			$unidad = new UnidadMarcador;
			//Almacenamiento de Datos
			$unidad->id_marcador = $marcador->id;
			$unidad->id_unidad = $data['id_unidad'];
			$unidad->id_usuario = Auth::user()->id;
			$unidad->save();
		}
		//Llamado de Ruta
		return Redirect::route('datos.marcadores.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Llamado del modelo para el registro especifico
		$datos['marcadores'] = Marcador::find($id);
		//Rutas del formulario
		$datos['form'] = array('route' => array('datos.marcadores.update', $id), 'method' => 'PATCH');
		//Texto del Boton
		$datos['label'] = 'Editar';
		//Instancia para conocer si ese marcador tiene unidad
		$unidad = UnidadMarcador::where('id_marcador', $id)->first();
		//Pregunta si el id no es vacio 
		if(!empty($unidad->id)){
			//Si no es vacio entonces almaceno el id de la unidad en el arreglo
			$datos['marcadores']->id_unidad = $unidad->id_unidad;
		}
		//Llamado de la vista
		return View::make('datos/marcadores/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Recibo de Datos
		$data = Input::all();
		//Llamado del modelo para el registro
		$marcador = Marcador::find($id);
		$marcador->marcador = $data['marcador'];
		$marcador->trimestre_marcador = $data['trimestre_marcador'];
		$marcador->id_user_updated = Auth::user()->id;
		$marcador->save();
		//Condicion para saber si el usuario selecciono una unidad
		if($data['id_unidad'] <> 0){
			//Instancia para conocer si exista una unidad para ese marcador
			$unidad = UnidadMarcador::where('id_marcador', $id)->first();
			//Condicion para saber si el id de la unidad esta vacio
			if(empty($unidad->id)){
				//Si esta vacio se instancia un nuevo registro
				$unidadMarcador = new UnidadMarcador;
				$unidadMarcador->id_marcador = $id;
			}else{
				//Sino esta vacio se carga el registro a editar
				$unidadMarcador = UnidadMarcador::find($unidad->id);
			}
			//Se colocan los datos
			$unidadMarcador->id_unidad = $data['id_unidad'];
			$unidadMarcador->id_usuario = Auth::user()->id;
			//Almacenamiento de datos
			$unidadMarcador->save();
		}
		//Llamado de ruta
		return Redirect::route('datos.marcadores.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
