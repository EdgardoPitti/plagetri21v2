<?php

class Datos_AgendaController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos['form'] = array('route' => 'datos.agenda.store', 'method' => 'POST');
		$datos['agenda'] = new Agenda;
		$datos['label'] = 'Crear';
		return View::make('datos/agenda/list-edit-form')->with('datos', $datos);
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
		$data = Input::all();
		$proveedor = 1;
		$agenda = new Agenda;
		$agenda->nombre_completo = $data['nombre_completo'];
		$agenda->profesion = $data['profesion'];
		$agenda->telefono = $data['telefono'];
		$agenda->celular = $data['celular'];
		$agenda->extension = $data['extension'];
		$agenda->correo = $data['correo'];
		$agenda->ruc = $data['ruc'];
		$agenda->detalle = $data['detalle'];
		if(empty($data['proveedor'])){
			$proveedor = 0;
		}
		$agenda->proveedor = $proveedor;
		$agenda->save();

		return Redirect::route('datos.agenda.index');
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($id)
	{


	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datos['agenda'] = Agenda::find($id);
		$datos['label'] = 'Editar';
		$datos['form'] = array('route' => array('datos.agenda.update', $id), 'method' => 'PATCH');
		return View::make('datos/agenda/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$proveedor = 1;
		$data = Input::all();
		$agenda = Agenda::find($id);
		$agenda->nombre_completo = $data['nombre_completo'];
		$agenda->profesion = $data['profesion'];
		$agenda->telefono = $data['telefono'];
		$agenda->celular = $data['celular'];
		$agenda->extension = $data['extension'];
		$agenda->correo = $data['correo'];
		$agenda->ruc = $data['ruc'];
		$agenda->detalle = $data['detalle'];
		if(empty($data['proveedor'])){
			$proveedor = 0;
		}
		$agenda->proveedor = $proveedor;
		$agenda->save();

		return Redirect::route('datos.agenda.index');

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
