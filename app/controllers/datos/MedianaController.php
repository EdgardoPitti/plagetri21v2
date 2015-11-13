<?php

class Datos_MedianaController extends BaseController {

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
		return View::make('datos/mediana/list-edit-form');
	}
	public function getObtenerMediana()
	{
		$id = Input::get('marcador');
		$semana = Input::get('semana');
		$idunidad = Input::get('unidad');
        $mediana = MedianaMarcador::where('id_marcador',$id)->where('semana', $semana)->where('id_unidad', $idunidad);
        if(empty($mediana)){
        	$mediana = new MedianaMarcador;
        	$mediana->mediana_marcador = 0;
        }
        return ($mediana->get(['mediana_marcador']));
	}

	public function getSalvarMediana()
	{

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
		$mediana = MedianaMarcador::where('id_marcador', $data['marcador'])->where('semana', $data['semana'])->first();
		if(empty($mediana)){
			$mediana = new MedianaMarcador;
			$mediana->id_marcador = $data['marcador'];
			$mediana->semana = $data['semana'];
		}
		$mediana->id_unidad = $data['id_unidad'];
		$mediana->mediana_marcador = $data['mediana'];
		$mediana->save();
		return Redirect::route('datos.mediana.index');
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

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	
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
