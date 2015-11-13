<?php

class TiposActivosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos['form'] = array('route' => 'tipoactivo.store', 'method' => 'POST');
		$datos['tipoactivo'] = new TipoActivo;
		return View::make('datos/tiposactivos/list-edit-form')->with('datos', $datos);
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
		$tipoactivo = new TipoActivo;
		$tipoactivo->tipo = $data['tipo'];
		$tipoactivo->descripcion = $data['descripcion'];
		$tipoactivo->save();
		
		return Redirect::route('tipoactivo.index');
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
		$datos['tipoactivo'] = TipoActivo::find($id);
		$datos['form'] = array('route'=> array('tipoactivo.update', $id), 'method' => 'PATCH');		
		return View::make('datos/tiposactivos/list-edit-form')->with('datos', $datos);
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
		$tipoactivo = TipoActivo::find($id);
		$tipoactivo->tipo = $data['tipo'];
		$tipoactivo->descripcion = $data['descripcion'];
		$tipoactivo->save();
		return Redirect::route('tipoactivo.index');
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
