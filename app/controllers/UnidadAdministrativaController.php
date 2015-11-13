<?php

class UnidadAdministrativaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos['form'] = array('route' => 'unidad.store', 'method' => 'POST');
		$datos['unidad'] = new Ubicacion;
		return View::make('datos/ubicacion/list-edit-form')->with('datos', $datos);
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
		$unidad = new Ubicacion;
		$unidad->ubicacion = $data['ubicacion'];
		$unidad->save();
		
		return Redirect::route('unidad.index');
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
		$datos['unidad'] = Ubicacion::find($id);
		$datos['form'] = array('route'=> array('unidad.update', $id), 'method' => 'PATCH');		
		return View::make('datos/ubicacion/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$unidad = Ubicacion::find($id);
		$unidad->ubicacion = $data['ubicacion'];
		$unidad->save();
		
		return Redirect::route('unidad.index');
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
