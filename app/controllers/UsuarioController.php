<?php

class UsuarioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos['usuario'] = new User;
		$datos['form'] = array('route' => 'usuario.store', 'method' => 'POST');
		return View::make('datos/usuarios/registrar')->with('datos', $datos);
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
    	$datos = Input::all();
		$user = new User;
		$user->user = $datos['user'];
		$user->password = Hash::make($datos['password']);
		$user->id_grupo_usuario = $datos['id_grupo_usuario'];
		$user->save();
		return Redirect::route('usuario.index');
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
		$datos['usuario'] =  User::find($id);
		$datos['form'] = array('route' => array('usuario.update', $id), 'method' => 'PATCH');
		return View::make('datos/usuarios/registrar')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    	$datos = Input::all();    		
		$user = User::find($id);
		$user->user = $datos['user'];
		if(!empty($datos['password'])){
			$user->password = Hash::make($datos['password']);
		}
		$user->id_grupo_usuario = $datos['id_grupo_usuario'];
		$user->save();
		return Redirect::route('usuario.index');
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
