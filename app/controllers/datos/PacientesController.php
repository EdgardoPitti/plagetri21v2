<?php

class Datos_PacientesController extends BaseController {

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
		$datos['form'] = array('route' => 'datos.pacientes.store', 'method' => 'POST');
		$datos['label'] = 'Crear';
		$datos['button'] = 'primary';
		$datos['paciente'][0] = new Paciente;
		$datos['paciente'][0]->id_nacionalidad = 62;
		$datos['paciente'][0]->fuma = 0;
		$datos['paciente'][0]->diabetes = 0;
		$datos['paciente'][0]->embarazo_trisomia = 0;
		$datos['paciente'][0]->foto = 'default.png';

	    return View::make('datos/pacientes/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$paciente = new Paciente;
		return View::make('datos/pacientes/form')->with('paciente', $paciente);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();  
		$rules = array('cedula' => 'unique:pacientes,cedula');
		$foto = Input::file("foto");
        $paciente = new Paciente;
        
        $validator = Validator::make(array('cedula' => $data['cedula']), $rules);
        if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}else{			
			$paciente->cedula = $data['cedula'];
			$paciente->primer_nombre = $data['primer_nombre'];
			$paciente->segundo_nombre = $data['segundo_nombre'];
			$paciente->apellido_paterno = $data['apellido_paterno'];
			$paciente->apellido_materno = $data['apellido_materno'];
			$paciente->sexo = $data['sexo'];
			$paciente->fecha_nacimiento = $data['fecha_nacimiento'];
			$paciente->lugar_nacimiento = $data['lugar_nacimiento'];
			$paciente->id_provincia_nacimiento = $data['id_provincia'];
			$paciente->id_distrito_nacimiento = $data['id_distrito'];
			$paciente->id_corregimiento_nacimiento = $data['id_corregimiento'];
			$paciente->telefono = $data['telefono'];
			$paciente->celular = $data['celular'];
			$paciente->email = $data['email'];
			$paciente->id_nacionalidad = $data['id_nacionalidad'];
			$paciente->id_tipo_sangre = $data['id_tipo_sanguineo'];
			$paciente->id_provincia_residencia = $data['id_provincia_residencia'];
			$paciente->id_distrito_residencia = $data['id_distrito_residencia'];
			$paciente->id_corregimiento_residencia = $data['id_corregimiento_residencia'];
			$paciente->lugar_residencia = $data['lugar_residencia'];
			$paciente->id_raza = $data['id_raza'];
			$paciente->id_etnia = $data['id_etnia'];
			$paciente->diabetes = $data['diabetes'];
			$paciente->embarazo_trisomia = $data['embarazo_trisomia'];
			$paciente->fuma = $data['fuma'];
			$paciente->save();
			//Almacenamiento de Foto
			if(!is_null($foto)){
				$id = Paciente::all()->last()->id;
				$extension = $foto->getClientOriginalExtension();
				$nombre_foto = 'p_'.$id.'.'.$extension;
				$paciente = Paciente::find($id);
				$paciente->foto = $nombre_foto;
				$paciente->save();
				$foto->move("imgs",$nombre_foto);
			}
			return Redirect::route('datos.pacientes.index');
        }
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
		$paciente = new Paciente;
		$datos['form'] =  array('route' => array('datos.pacientes.update', $id), 'method' => 'PATCH');
      	$datos['label']= 'Editar';
      	$datos['button'] = 'success';
		$datos['paciente'] = $paciente->datos_pacientes($id);
		return View::make('datos/pacientes/list-edit-form')->with('datos', $datos);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$foto = Input::file('foto');
		$paciente = Paciente::find($id);
		$data = Input::all();
		//Pregunto si no es nulo la variable foto y asi saber si seleccione una nueva foto
		if(!is_null($foto)){
			//Si no es nulo fue que seleccione una foto
			//Extraigo la extension de la foto
			$extension = $foto->getClientOriginalExtension();
			//Armo el nombre de la foto con el id y la extension de la nueva foto
			$nombre_foto = 'p_'.$id.'.'.$extension;
			//Ingreso el nuevo nombre de la foto en la base de datos con todo y extension
			$paciente->foto = $nombre_foto;
			//Busco en la carpeta de foto si existe alguna foto con ese mismo nombre y extension y la elimino
			File::delete('./imgs/'.$nombre_foto);
			//Muevo la nueva foto a la carpeta imgs
			$foto->move("imgs", $nombre_foto);	
		}
		//Si en caso el paciente fue borrado justo cuando fue editado se almacenara de nuevo
		if(is_null($paciente))
		{
		 	$paciente = new Paciente;
		}
		//Sentencias para almacenar los datos correspondientes de cada paciente
        $paciente->cedula = $data['cedula'];
        $paciente->primer_nombre = $data['primer_nombre'];
        $paciente->segundo_nombre = $data['segundo_nombre'];
        $paciente->apellido_paterno = $data['apellido_paterno'];
        $paciente->apellido_materno = $data['apellido_materno'];
        $paciente->sexo = $data['sexo'];
        $paciente->fecha_nacimiento = $data['fecha_nacimiento'];
        $paciente->lugar_nacimiento = $data['lugar_nacimiento'];
        $paciente->id_provincia_nacimiento = $data['id_provincia'];
        $paciente->id_distrito_nacimiento = $data['id_distrito'];
        $paciente->id_corregimiento_nacimiento = $data['id_corregimiento'];
        $paciente->id_provincia_residencia = $data['id_provincia_residencia'];
        $paciente->id_distrito_residencia = $data['id_distrito_residencia'];
        $paciente->id_corregimiento_residencia = $data['id_corregimiento_residencia'];
        $paciente->lugar_residencia = $data['lugar_residencia'];     
        $paciente->telefono = $data['telefono'];
        $paciente->celular = $data['celular'];
        $paciente->email = $data['email'];
        $paciente->id_nacionalidad = $data['id_nacionalidad'];
        $paciente->id_tipo_sangre = $data['id_tipo_sanguineo'];
        $paciente->id_raza = $data['id_raza'];
        $paciente->id_etnia = $data['id_etnia'];
        $paciente->diabetes = $data['diabetes'];
        $paciente->fuma = $data['fuma'];
        $paciente->embarazo_trisomia = $data['embarazo_trisomia'];
        $paciente->save();
        return Redirect::route('datos.pacientes.index');	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Paciente::destroy($id);
		
      return Response::json(['success'=> true, 'route' => 'datos/pacientes']);
	}


}
