<?php

class Datos_MedicosController extends BaseController {

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
		$datos['formulario'] = array('route' => 'datos.medicos.store', 'method' => 'POST');
		$datos['label'] = 'Crear';
		$datos['button'] = 'primary';
		$datos['medico'][0] = new Medico; 
		$datos['medico'][0]->id_especialidad_medica = '25';		
		$datos['medico'][0]->foto = 'default1.png';
		return View::make('datos/medicos/list-edit-form')->with('datos', $datos);
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
		$medico = new Medico;
        $data = Input::all();
        $foto = Input::file("foto");
        $rules = array('cedula' => 'unique:medicos,cedula');
        $validator = Validator::make(array('cedula' => $data['cedula']), $rules);
        if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}else{			
			$medico->cedula = $data['cedula'];
			$medico->primer_nombre = $data['primer_nombre'];
			$medico->segundo_nombre = $data['segundo_nombre'];
			$medico->apellido_paterno = $data['apellido_paterno'];
			$medico->apellido_materno = $data['apellido_materno'];
			$medico->sexo = $data['sexo'];
			$medico->id_especialidades_medicas = $data['id_especialidades_medicas'];
			$medico->celular = $data['celular'];
			$medico->telefono = $data['telefono'];
			$medico->extension = $data['extension'];
			$medico->email = $data['email'];
			$medico->id_nivel = $data['id_nivel'];
			$medico->id_ubicacion = $data['id_ubicacion'];
			$medico->observacion = $data['observaciones'];
			$medico->save(); 
			//Almacenamiento de la foto
			if(!is_null($foto)){
				$id = Medico::all()->last()->id; //Se obtiene el id del ultimo medico registrado
				$extension = $foto->getClientOriginalExtension(); //se obtiene la extension de la foto
				$name_foto = 'm_'.$id.'.'.$extension; //Se guarda el nombre del medico con prefijo m_ y el id del medico
				$medico = Medico::find($id); //Buscamos el medico guardado anteriormente
				$medico->foto = $name_foto;
				$medico->save();  			//Guardamos el nombre de la foto en la base de datos
				$foto->move("imgs", $name_foto); //Movemos la foto a la carpeta imgs
			}
			return Redirect::route('datos.medicos.index');
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
		$medico = new Medico;
		if(is_null ($medico)){
			App::abort(404);
		}
		$datos['formulario'] = array('route' => array('datos.medicos.update',$id), 'method' => 'PATCH');
		$datos['label'] = 'Editar';
		$datos['button'] = 'success';
		$datos['medico'] = $medico->datos_medico($id); 	
		return View::make('datos/medicos/list-edit-form')->with('datos', $datos);
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
		$medico = Medico::find($id);
		$data = Input::all();
		if(!is_null($foto)){
			$extension = $foto->getClientOriginalExtension();
			$name_foto = 'm_'.$id.'.'.$extension;
			$medico->foto = $name_foto;
			File::delete('./imgs/'.$name_foto);
			$foto->move("imgs", $name_foto);
		}
		if(is_null($medico)){
			$medico = new Medico;
		}
        $medico->cedula = $data['cedula'];
        $medico->primer_nombre = $data['primer_nombre'];
        $medico->segundo_nombre = $data['segundo_nombre'];
        $medico->apellido_paterno = $data['apellido_paterno'];
        $medico->apellido_materno = $data['apellido_materno'];
        $medico->sexo = $data['sexo'];
        $medico->id_especialidades_medicas = $data['id_especialidades_medicas'];
        $medico->celular = $data['celular'];
        $medico->telefono = $data['telefono'];
        $medico->email = $data['email'];
        $medico->extension = $data['extension'];
        $medico->id_nivel = $data['id_nivel'];
        $medico->id_ubicacion = $data['id_ubicacion'];
        $medico->observacion = $data['observaciones'];
        $medico->save();
        return Redirect::route('datos.medicos.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Medico::destroy($id);
		
      	return Response::json(['success'=> true, 'route' => 'datos/medicos']);
	}


}
