<?php
class Datos_CitasController extends BaseController {

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
		$paciente = new Paciente;
		$datos = $paciente->datos_pacientes(0);
		return View::make('datos/citas/list-edit-form')->with('pacientes', $datos);
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
		$citas = new Cita;
		$citas->id_paciente = $data['id_paciente'];
		$citas->id_medico = $data['id_medico'];
		$citas->peso = $data['peso'];
		$citas->fecha_ultrasonido = $data['fecha_ultrasonido'];
		$citas->fur = $data['fur'];
		$citas->fpp = $data['fpp'];
		$citas->fecha_flebotomia = $data['fecha_flebotomia'];
		$citas->fecha_cita = $data['fecha_cita'];
		$citas->edad_gestacional = $data['edad_gestacional'];
		$citas->observaciones = $data['observaciones'];
		$citas->estatura = $data['estatura'];
		$citas->id_institucion = $data['id_institucion'];
		$citas->hijos_embarazo = $data['hijos_embarazo'];
		$citas->riesgo = $data['riesgo'];
		$citas->edad_materna = $data['edad'];
		$citas->edad_gestacional_fur = $data['semana'];
		$citas->riesgo_fap = $data['riesgo_fap'];
		$citas->id_institucion = $data['id_institucion'];
		$citas->tipo_cita = $data['tipo_cita'];
		$citas->id_cita_referencia = $data['id_cita_referencia'];
		$citas->save();
		//Se obtiene el ultimo id de las citas que fue la que se almaceno previamente
		$id_cita = Cita::all()->last()->id;
		if($data['tipo_cita'] == '2' AND $data['id_cita_referencia'] != '0'){
			$cita = Cita::find($data['id_cita_referencia']);
			$cita->id_cita_referencia = $id_cita;
			$cita->save();
		}
		//Decisiones para almacenar las metodologias de cada marcador
		$met_general = $data[''.$data['tipo_cita'].'_met_general'];
		//Ciclo que recorre todo los marcadores y busca los valores de cada uno para almacenarlos respectivamente.
		foreach(Marcador::where('trimestre_marcador', $data['tipo_cita'])->OrWhere('trimestre_marcador', '3')->get() as $marcador){
			$marcadorcita = new MarcadorCita;
			$valormarcador = new ValorMarcador;
			$marcadorcita->id_cita = $id_cita;
			$marcadorcita->id_marcador = $marcador->id;
			//Se comprueba si no se eligio un marcador para esa metodologia y se le asigna el que selecciono general
			if($data[''.$data['tipo_cita'].'_metodo_'.$marcador->id] == 0){
				$marcadorcita->id_metodologia = $met_general;
			}else{
				$marcadorcita->id_metodologia = $data[''.$data['tipo_cita'].'_metodo_'.$marcador->id.''];
				$valormarcador->id_metodologia = $data[''.$data['tipo_cita'].'_metodo_'.$marcador->id.''];
			}
			//Se busca el id de la unidad del marcador en la que esta configurada el sistema actualmente
			$marcadorcita->id_unidad = UnidadMarcador::where('id_marcador', $marcador->id)->get()->last()->id_unidad;
			$marcadorcita->valor = $data[''.$data['tipo_cita'].'_valor_'.$marcador->id.''];
			$marcadorcita->mom = $data[''.$data['tipo_cita'].'_mom_'.$marcador->id.''];
			$marcadorcita->corr_peso_lineal = $data[''.$data['tipo_cita'].'_corr_lineal_'.$marcador->id.''];
			$marcadorcita->corr_peso_exponencial = $data[''.$data['tipo_cita'].'_corr_exp_'.$marcador->id.''];
			$marcadorcita->save();
			
			//Sentencias para almacenar los mismos valores de los marcadores en otra tabla para posterior analisis
			$valormarcador->id_marcador = $marcador->id;
			$valormarcador->semana = $data['semana'];
			$valormarcador->id_metodologia = $met_general;
			$valormarcador->id_unidad = UnidadMarcador::where('id_marcador', $marcador->id)->get()->last()->id_unidad;
			$valormarcador->valor = $data[''.$data['tipo_cita'].'_valor_'.$marcador->id.''];
			$valormarcador->save();
		}
		return Redirect::route('datos.citas.show', $data['id_paciente']);	
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($id)
	{
		$paciente = new Paciente;
		$datos = $paciente->datos_pacientes(0);
		$dato_paciente = $paciente->datos_pacientes($id);
		$form['datos'] = array('route' => 'datos.citas.store', 'method' => 'POST');
		$form['label'] = 'Crear';
		$form['citas'] = new Cita;
		$form['citas']->riesgo = 100;
		$form['citas']->riesgo_fap = 100;
		$form['citas']->tipo_cita = 2;	
		$form['citas']->id_institucion = 1;
		$form['institucion'] = Institucion::find(1);	
		$form['citas']->fecha_cita = date("20y-m-d");
		$marcadorcita = new MarcadorCita;
		$form['marcador_cita'] = $marcadorcita;
		//Ciclo que recorre todos los marcadores
		foreach (Marcador::all() as $marcador){
			if($marcador->trimestre_marcador == 3){
				$form['2_marcador_'.$marcador->id.''] = new MarcadorCita;
				$form['2_marcador_'.$marcador->id.'']->mom = '0.00000';
				$form['2_marcador_'.$marcador->id.'']->corr_peso_lineal = '0.00000';
				$form['2_marcador_'.$marcador->id.'']->corr_peso_exponencial = '0.00000';	
				$marcador->trimestre_marcador = '1';
			}
			$form[''.$marcador->trimestre_marcador.'_marcador_'.$marcador->id.''] = new MarcadorCita;
			$form[''.$marcador->trimestre_marcador.'_marcador_'.$marcador->id.'']->mom = '0.00000';
			$form[''.$marcador->trimestre_marcador.'_marcador_'.$marcador->id.'']->corr_peso_lineal = '0.00000';
			$form[''.$marcador->trimestre_marcador.'_marcador_'.$marcador->id.'']->corr_peso_exponencial = '0.00000';	
		}
		return View::make('datos/citas/list-edit-form')->with('pacientes', $datos)->with('datos', $dato_paciente)->with('form', $form);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$paciente = new Paciente;
		$cita = Cita::find($id);
		$institucion = Institucion::find($cita->id_institucion);
		//Decision para saber si se encontro la institucion perteneciente a la citas
		if(empty($institucion)){
			$form['institucion'] = new Institucion;
		}else{
			$form['institucion'] = $institucion;	
		}
		$datos = $paciente->datos_pacientes(0);
		$dato_paciente = $paciente->datos_pacientes($cita->id_paciente);
		$form['datos'] = array('route' => array('datos.citas.update', $id), 'method' => 'PATCH');
		$form['label'] = 'Editar';
		$form['citas'] =  $cita;
		$marcadorcita = new MarcadorCita;
		//Ciclo que recorre todos los marcadores y los busca para devolver los datos correspondientes
		foreach(Marcador::all() as $marcador){
			if($marcador->trimestre_marcador == '3'){
				$form['1_marcador_'.$marcador->id.''] = $marcadorcita->obtenerMarcador($marcador->id, $id);
				$marcador->trimestre_marcador = '2';
			}
			$form[''.$marcador->trimestre_marcador.'_marcador_'.$marcador->id.''] = $marcadorcita->obtenerMarcador($marcador->id, $id);
		}
		$form['marcador_cita'] = $marcadorcita;
		return View::make('datos/citas/list-edit-form')->with('pacientes', $datos)->with('datos', $dato_paciente)->with('form', $form);
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
		$citas = Cita::find($id);
		$id_anterior = $citas->id_cita_referencia;
		if(!empty($id_anterior)){
			$cita_anterior = Cita::find($id_anterior);
			$cita_anterior->id_cita_referencia = 0;
			$cita_anterior->save();
		}
		//sino encuentra una cita crea un nuevo objeto
		if(is_null($citas))
		{
		 	$citas = new Cita;
		}
		//Sentencias para almacenar los datos correspondientes de la cita
		$citas->id_medico = $data['id_medico'];
		$citas->peso = $data['peso'];
		$citas->fecha_ultrasonido = $data['fecha_ultrasonido'];
		$citas->fur = $data['fur'];
		$citas->fpp = $data['fpp'];
		$citas->fecha_flebotomia = $data['fecha_flebotomia'];
		$citas->fecha_cita = $data['fecha_cita'];
		$citas->edad_gestacional = $data['edad_gestacional'];
		$citas->observaciones = $data['observaciones'];
		$citas->estatura = $data['estatura'];
		$citas->id_institucion = $data['id_institucion'];
		$citas->hijos_embarazo = $data['hijos_embarazo'];
		$citas->edad_materna = $data['edad'];
		$citas->edad_gestacional_fur = $data['semana'];
		$citas->riesgo = $data['riesgo'];
		$citas->riesgo_fap = $data['riesgo_fap'];
		$citas->tipo_cita = $data['tipo_cita'];
		$citas->id_cita_referencia = $data['id_cita_referencia'];
		$citas->save();
		if($data['tipo_cita'] == '2' AND $data['id_cita_referencia'] != '0'){
			$cita = Cita::find($data['id_cita_referencia']);
			$cita->id_cita_referencia = $id;
			$cita->save();
		}
		//Se almacena en una variable el id de la metodologia que eleigio en general.
		$met_general = $data[''.$data['tipo_cita'].'_met_general'];
		//Ciclo para recorrer todos los marcadores
		foreach (Marcador::where('trimestre_marcador', $data['tipo_cita'])->Orwhere('trimestre_marcador', '3')->get() as $marcador){		
			$marcador_cita = new MarcadorCita;
			$marcadorcita = $marcador_cita->obtenerMarcador($marcador->id, $id);
			$marcadorcita->id_cita = $id;
			$marcadorcita->id_marcador = $marcador->id;
			$marcadorcita->valor = $data[''.$data['tipo_cita'].'_valor_'.$marcador->id.''];
			$marcadorcita->mom = $data[''.$data['tipo_cita'].'_mom_'.$marcador->id.''];
			$marcadorcita->corr_peso_lineal = $data[''.$data['tipo_cita'].'_corr_lineal_'.$marcador->id.''];
			$marcadorcita->corr_peso_exponencial = $data[''.$data['tipo_cita'].'_corr_exp_'.$marcador->id.''];
			//Si la metodologia es distinta de 0 quiere decir que se eligio una para ese marcador
			if($data[''.$data['tipo_cita'].'_metodo_'.$marcador->id.''] <> 0){
				//Se almacena la metodologia correspondiente
				$marcadorcita->id_metodologia = $data[''.$data['tipo_cita'].'_metodo_'.$marcador->id.''];	
			}else{
				//Sino entonces se almacena el metodo que se eligio como general.
				$marcadorcita->id_metodologia = $met_general;
			}
			$marcadorcita->save();
		}
		return Redirect::route('datos.citas.show', $data['id_paciente']);	
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
