<?php

class Datos_MantenimientosController extends BaseController {

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
		return View::make('datos/mantenimientos/list-edit-form')->with('objeto', new Mantenimiento);
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
		$mantenimientos = new Mantenimiento;
		$mantenimientos->fecha_realizacion = $data['fecha'];
		$mantenimientos->id_tipo_mantenimiento = $data['id_tipo_mantenimiento'];
		$mantenimientos->realizado_por = $data['realizado_por'];
		$mantenimientos->aprobado_por = $data['aprobado_por'];
		$mantenimientos->id_activo = $data['id_activo'];
		$mantenimientos->proximo_mant = $data['proximo'];
		$mantenimientos->observacion = $data['observacion'];
		$mantenimientos->costo_mantenimiento = $data['costo_mantenimiento'];
		$mantenimientos->save();
		return Redirect::route('datos.mantenimientos.show', $data['id_activo']);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($id)
	{	
		$datos['form'] = array('route' => 'datos.mantenimientos.store', 'method' => 'POST');
		$datos['label'] = 'Crear';
		$datos['mantenimiento'] = new Mantenimiento; 
		$datos['activo'] = Activo::find($id);
		return View::make('datos/mantenimientos/list-edit-form')->with('datos', $datos)->with('objeto', new Mantenimiento);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datos['label'] = 'Editar';
		$datos['form'] = array('route' => array('datos.mantenimientos.update', $id), 'method' => 'PATCH');
		$datos['mantenimiento'] = Mantenimiento::find($id);
		$datos['activo'] = Activo::find($datos['mantenimiento']->id_activo);
		return View::make('datos/mantenimientos/list-edit-form')->with('datos', $datos)->with('objeto', new Mantenimiento);
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
		$mantenimientos = Mantenimiento::find($id);
		$mantenimientos->fecha_realizacion = $data['fecha'];
		$mantenimientos->id_tipo_mantenimiento = $data['id_tipo_mantenimiento'];
		$mantenimientos->realizado_por = $data['realizado_por'];
		$mantenimientos->aprobado_por = $data['aprobado_por'];
		$mantenimientos->id_activo = $data['id_activo'];
		$mantenimientos->proximo_mant = $data['proximo'];
		$mantenimientos->observacion = $data['observacion'];
		$mantenimientos->costo_mantenimiento = $data['costo_mantenimiento'];
		$mantenimientos->save();
		return Redirect::route('datos.mantenimientos.show', $data['id_activo']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$mantenimiento = Mantenimiento::find($id);
		$mantenimiento->delete();
		return Redirect::route('datos.mantenimientos.index');
	}


}
