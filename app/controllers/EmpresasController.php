<?php

class EmpresasController extends \BaseController {

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
		$datos['form'] = array('route' => 'datos.empresas.store', 'method' => 'POST');
		$datos['empresa'] = new Empresa;
		return View::make('datos/empresas/list-edit-form')->with('datos', $datos);
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
		$empresa = new Empresa;
		$empresa->nombre = $data['nombre'];
		$empresa->ruc = $data['ruc'];
		$empresa->telefono = $data['telefono'];
		$empresa->descripcion = $data['descripcion'];
		$empresa->save();
		
		return Redirect::route('datos.empresas.index');
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
		$datos['empresa'] = Empresa::find($id);
		$datos['form'] = array('route'=> array('datos.empresas.update', $id), 'method' => 'PATCH');
		
		return View::make('datos/empresas/list-edit-form')->with('datos', $datos);
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
		$empresa = Empresa::find($id);
		$empresa->nombre = $data['nombre'];
		$empresa->ruc = $data['ruc'];
		$empresa->telefono = $data['telefono'];
		$empresa->descripcion = $data['descripcion'];
		$empresa->save();
		
		return Redirect::route('datos.empresas.index');
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
