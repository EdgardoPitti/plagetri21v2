<?php

class CondicionesController extends BaseController {

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
		
		//Creacion del Objeto para enviar los parametros a la vista
		$datos['enfermedad'] = new Enfermedad;
		//Ciclo que recorre todo los marcadores para almacenar en las variables de cada marcador el valor
		foreach(Marcador::all() as $marcador){
			if($marcador->trimestre_marcador == 3){
				$datos['marcador_'.$marcador->id.'_1'] = '';
				$datos['limite_inferior_'.$marcador->id.'_1'] ='';
				$datos['limite_superior_'.$marcador->id.'_1'] = '';
			}
			$datos['marcador_'.$marcador->id.''] = '';
			$datos['limite_inferior_'.$marcador->id.''] ='';
			$datos['limite_superior_'.$marcador->id.''] = '';
		}
		//Variable que almacena los datos para el formulario
		$datos['form'] = array('route' => 'datos.condiciones.store', 'method' => 'POST');
		//Retorno hacia la vista
		return View::make('datos/condiciones/list-edit-form')->with('datos', $datos);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Se almacena los datos que provienen del formulario en la variable data
		$data = Input::all();
		//Se crea el objeto para almacenar los datos
		$enfermedad = new Enfermedad;
		//Se almacenan los datos en los campos correspondientes
		$enfermedad->descripcion = $data['descripcion'];
		$enfermedad->mensaje_positivo = $data['mensaje_positivo'];
		$enfermedad->mensaje_negativo = $data['mensaje_negativo'];
		$enfermedad->status = $data['status'];
		$enfermedad->save();
		
		//Ciclo que recorre todo los marcadores		
		foreach(Marcador::all() as $marcador){
			//Si el trimestre del marcador es 3 quiere decir que el marcador esta en ambos trimestes
			if($marcador->trimestre_marcador == 3){
				if($data['marcador_'.$marcador->id.'_1'] <> ''){
					//Se crea el objeto para almacenar los datos
					$condiciones = new CondicionEnfermedad;
					//Se coloca los valores respectivos en cada campos
					$condiciones->id_enfermedad = $enfermedad->id;
					$condiciones->id_marcador = $marcador->id;
					$condiciones->valor_condicion = $data['marcador_'.$marcador->id.'_1'];
					$condiciones->limite_inferior = $data['limite_inferior_'.$marcador->id.'_1'];
					$condiciones->limite_superior = $data['limite_superior_'.$marcador->id.'_1'];
					$condiciones->trimestre_marcador = 1;
					$condiciones->id_user_created = Auth::user()->id;
					$condiciones->save();
				}
			}
			//Se pregunta si el marcador que viene del formulario no esta en blanco para poder almacenarlo
			if($data['marcador_'.$marcador->id.''] <> ''){
				//Se crea el objeto para almacenar los datos
				$condiciones = new CondicionEnfermedad;
				//Se coloca los valores respectivos en cada campos
				$condiciones->id_enfermedad = $enfermedad->id;
				$condiciones->id_marcador = $marcador->id;
				$condiciones->valor_condicion = $data['marcador_'.$marcador->id.''];
				$condiciones->limite_inferior = $data['limite_inferior_'.$marcador->id.''];
				$condiciones->limite_superior = $data['limite_superior_'.$marcador->id.''];
				if($marcador->trimestre_marcador == 3){
					$condiciones->trimestre_marcador = 2;
				}else{
					$condiciones->trimestre_marcador = $marcador->trimestre_marcador;
				}
				$condiciones->id_user_created = Auth::user()->id;
				$condiciones->save();
			}
		}
		//Se retorna a la vista 
		return Redirect::route('datos.condiciones.index');
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
		//Se crea el objeto de la enfermedad buscandola por el id recibido
		$datos['enfermedad'] = Enfermedad::find($id);
		//Se almacena los valores necesarios del formulario para poder editar las enfermedades
		$datos['form'] = array('route' => array('datos.condiciones.update', $id), 'method' => 'PATCH');
		//Ciclo que recorre todos los marcadores para buscar la condicion de ese marcador para esa enfermedad
		foreach(Marcador::all() as $marcador){
				if($marcador->trimestre_marcador == '3'){
					$condicion = CondicionEnfermedad::where('id_enfermedad', $id)->where('id_marcador', $marcador->id)->where('trimestre_marcador', '1')->first();	
					if(empty($condicion)){
						$datos['marcador_'.$marcador->id.'_1'] = '';
						$datos['limite_superior_'.$marcador->id.'_1'] = '';
						$datos['limite_inferior_'.$marcador->id.'_1'] = '';
					}else{
						$datos['marcador_'.$marcador->id.'_1'] = $condicion->valor_condicion;
						$datos['limite_superior_'.$marcador->id.'_1'] = $condicion->limite_superior;
						$datos['limite_inferior_'.$marcador->id.'_1'] = $condicion->limite_inferior;
					}
					$marcador->trimestre_marcador = '2';
				}
				//Se busca la condicion perteneciente a esa enfermedad y ese marcador
				$condicion = CondicionEnfermedad::where('id_enfermedad', $id)->where('id_marcador', $marcador->id)->where('trimestre_marcador', $marcador->trimestre_marcador)->first();
				//En caso de que no tenga se devuelve el valor nulo y si tiene se devuelve el valor correspondiente
				if(empty($condicion)){
					$datos['marcador_'.$marcador->id.''] = '';
					$datos['limite_superior_'.$marcador->id.''] = '';
					$datos['limite_inferior_'.$marcador->id.''] = '';
				}else{
					$datos['marcador_'.$marcador->id.''] = $condicion->valor_condicion;		
					$datos['limite_superior_'.$marcador->id.''] = $condicion->limite_superior;
					$datos['limite_inferior_'.$marcador->id.''] = $condicion->limite_inferior;
				}
		}
		//Retorno a la vista con los datos correspondientes
		return View::make('datos/condiciones/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		
		//Se almacena en la variable data los valores de los campos recibidos del formularios
		$data = Input::all();
		//Se busca la enfermedad por el id recibido para poder editarla
		$enfermedad = Enfermedad::find($id);
	
		//Se coloca los valores recibidos del fomrulario para almacenarlo en cada campo correspondiente
		$enfermedad->descripcion = $data['descripcion'];
		$enfermedad->mensaje_positivo = $data['mensaje_positivo'];
		$enfermedad->mensaje_negativo = $data['mensaje_negativo'];
		$enfermedad->status = $data['status'];
		$enfermedad->save();
		
		//Ciclo que recorre los marcadores con los valores recibidos del formulario
		foreach(Marcador::all() as $marcador){
			if($marcador->trimestre_marcador == 3){
				$sw = 0;
				$condicion = CondicionEnfermedad::where('id_enfermedad', $id)->where('id_marcador', $marcador->id)->where('trimestre_marcador', '1')->first();
				if($data['marcador_'.$marcador->id.'_1'] == '' && !empty($condicion)){
					CondicionEnfermedad::destroy($condicion->id);
				}elseif($data['marcador_'.$marcador->id.'_1'] <> '' && !empty($condicion)){
					$condicion = CondicionEnfermedad::find($condicion->id);
					$sw = 1;
				}elseif($data['marcador_'.$marcador->id.'_1'] <> '' && empty($condicion)){
					$condicion = new CondicionEnfermedad;
					$sw = 1;
				}
				if($sw == 1){
					$condicion->id_enfermedad = $id;
					$condicion->id_marcador = $marcador->id;
					$condicion->trimestre_marcador = '1';
					$condicion->valor_condicion = $data['marcador_'.$marcador->id.'_1'];
					$condicion->limite_superior = $data['limite_superior_'.$marcador->id.'_1'];
					$condicion->limite_inferior = $data['limite_inferior_'.$marcador->id.'_1'];
					$condicion->id_user_updated = Auth::user()->id;
					$condicion->save();	
				}
				$marcador->trimestre_marcador = '2';
			}
			$sw = 0;
			//Variable que almacena el objeto de la condicion perteneciente a esa enfermedad y ese marcador
			$condicion = CondicionEnfermedad::where('id_enfermedad', $id)->where('id_marcador', $marcador->id)->where('trimestre_marcador', $marcador->trimestre_marcador)->first();
			//Si el valor recibido del formulario viene en blanco y la condicion exista en la base de datos se procede a editar el valor
			if($data['marcador_'.$marcador->id.''] == '' && !empty($condicion)){
				CondicionEnfermedad::destroy($condicion->id);
			}elseif($data['marcador_'.$marcador->id.''] <> '' && !empty($condicion)){
				$condicion = CondicionEnfermedad::find($condicion->id);
				$sw = 1;
			}elseif($data['marcador_'.$marcador->id.''] <> '' && empty($condicion)){
				$condicion = new CondicionEnfermedad;
				$sw = 1;
			}
			if($sw == 1){
				$condicion->id_enfermedad = $id;
				$condicion->id_marcador = $marcador->id;
				$condicion->trimestre_marcador = $marcador->trimestre_marcador;
				$condicion->valor_condicion = $data['marcador_'.$marcador->id.''];
				$condicion->limite_superior = $data['limite_superior_'.$marcador->id.''];
				$condicion->limite_inferior = $data['limite_inferior_'.$marcador->id.''];
				$condicion->id_user_updated = Auth::user()->id;
				$condicion->save();	
			}
			
		}


		//Se retorna a la vista
		return Redirect::route('datos.condiciones.index');	
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}


}
