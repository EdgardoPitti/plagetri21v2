<?php

class ConfiguracionController extends BaseController {

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
		$unidadmarcador = new UnidadMarcador;
		$unidadmarcador->id_marcador = 0;
		return View::make('datos/configuracion/list-edit-form')->with('unidadmarcador', $unidadmarcador);
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
		if($data['control'] == 1){
			$unidadmarcador = new UnidadMarcador;
			$unidadmarcador->id_marcador = $data['id_marcador'];
			$unidadmarcador->id_unidad = $data['id_unidad'];
			$unidadmarcador->id_usuario = Auth::user()->id;
			$unidadmarcador->save();
		}else{
			if(empty($data['automatico'])){
				$data['automatico'] = 0;
				$data['registros'] = 0;
			}
			$configuracion = new Configuracion;
			$configuracion->id_usuario = Auth::user()->id;
			$configuracion->automatico = $data['automatico'];
			$configuracion->cantidad_registros = '0';//$data['registros'];
			$configuracion->save();
			$id = Configuracion::all()->last()->id;
			if($data['automatico'] == 1){
				foreach(Marcador::all() as $marcador){
					$detalleconfiguracion = new DetalleConfiguracion;
					$detalleconfiguracion->id_configuracion = $id;
					$detalleconfiguracion->id_marcador = $marcador->id;
					$detalleconfiguracion->id_unidad = UnidadMarcador::where('id_marcador', $marcador->id)->get()->last()->id_unidad;
					$detalleconfiguracion->save();				
				}
				$i = 0;
				for($x=1;$x<38;$x++){
					foreach(Unidad::all() as $unidad){
						$suma = 0;
						$mediana = 0;
						$cantidad = 0;	
						foreach(Marcador::all() as $marcador){
								//Sentencia para obtener la suma de los valores de los marcadores correspondientes de cada semana y unidad
								$suma = DB::table('valores_marcadores')->select(DB::raw('sum(valor) as val'))->where('id_marcador', $marcador->id)->where('semana', $x)->where('id_unidad', $unidad->id)->get();
								//Sentencia para obtener la cantidad de los marcadores correspondientes de cada semana y unidad
								$cantidad = DB::table('valores_marcadores')->select(DB::raw('count(id) as cant'))->where('id_marcador', $marcador->id)->where('semana', $x)->where('id_unidad', $unidad->id)->get();
								//Si la suma tiene un valor se hace la operacion para la mediana
								if($suma[0]->val){
									$mediana = $suma[0]->val/$cantidad[0]->cant;
								}else{
									$mediana = 0;
								}

								$datos[$i]['semana'] = $x;
								$datos[$i]['marcador'] = $marcador->id;
								$datos[$i]['unidad'] = $unidad->id;
								$datos[$i]['mediana'] = number_format($mediana, 2, '.', '');								
								$i++;
						}
					}
				}
				$medianamarcador = new MedianaMarcadorAuto;
				$medianamarcador->AlmacenarData($datos);
			}
		}
		//print_r($datos);
		return Redirect::route('datos.configuracion.index');		
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
		$unidadmarcador = UnidadMarcador::where('id_marcador', $id)->get()->last();
		if(empty($unidadmarcador->id)){
			$unidadmarcador = new UnidadMarcador;
		}
		$unidadmarcador->id_marcador = $id;
		return View::make('datos/configuracion/list-edit-form')->with('unidadmarcador', $unidadmarcador);
		
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
