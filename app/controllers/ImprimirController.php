<?php

class ImprimirController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function getCita($id){
		//Declarar un arreglo para devolver los resultados.
		$parameter = array();
		//Se instancian los objetos necesarios.
		$paciente = new Paciente;
		$condiciones = new CondicionEnfermedad;
		//Sentencia para crear un objeto para realizar los documentos PDF.
		$pdf = App::make('dompdf');
		
		//Se almacena los datos pertenecientes a la cita.
		$parameter['cita'] = Cita::find($id);
		//Se almacena los datos pertenecientes al pacientes.
		$parameter['datos'] = $paciente->datos_pacientes($parameter['cita']->id_paciente);
		//Se busca la institucion respectiva del ID almacenado en la cita.
		$institucion = Institucion::find($parameter['cita']->id_institucion);
		if(empty($institucion)){
			$parameter['institucion'] = new Institucion;
			$parameter['institucion']->denominacion = 'No Definido';
		}else{
			$parameter['institucion'] = Institucion::find($parameter['cita']->id_institucion);
		}
		//Se busca y se almacena al medico perteneciente al ID que se almaceno en la cita.
		$medico = Medico::find($parameter['cita']->id_medico);
		if(empty($medico)){
			$parameter['medico'] = new Medico;
			$parameter['medico']->primer_nombre = 'No';
			$parameter['medico']->apellido_paterno = 'Definido';
		}else{
			$parameter['medico'] = Medico::find($parameter['cita']->id_medico);
		}
		
		//Se busca y se almacenan los datos pertenecientes a los marcadores de la cita.
		$parameter['marcadores'] = MarcadorCita::where('id_cita', $id)->where('valor','<>','0')->get();
		$parameter['cantidad'] = MarcadorCita::where('id_cita', $id)->where('valor','<>','0')->count();
		//Se llama a la funcion obtenerEnfermedades que me devuelve un arreglo con las enfermedades que dieron positivo y negativo de la cita
		//correspondiente al ID que le envio.
		$parameter['resultados'] = $condiciones->obtenerEnfermedades($id);
		//Cargo la vista mandandole los respectivos datos correspondientes almacenados en el arreglo $parameter.
		$pdf = PDF::loadView('datos/citas/Print', $parameter);
		//Creo el archivo pdf y lo almaceno utilizando la cedula como el nombre del archivo.
		return $pdf->stream(''.$parameter['datos'][0]->cedula.'.pdf', array("Attachment" => false));
	}

	public function getCostoactivos(){
		$pdf = App::make('dompdf');
		
		$pdf = PDF::loadView('datos/reportes/imprimir/costo_activos');

		return $pdf->stream();
	}

	public function getDepartamento($id){
		$parameter = array();

		$tipo = '>';
		if($id != 0){
			$tipo = '=';
		}
		$parameter['id'] = $id;

		$parameter['departamento'] = DB::table('activos AS a')
            ->join('ubicacion AS ub', 'a.id_ubicacion', '=', 'ub.id')
            ->join('unidades_administrativas AS ua', 'a.id_unidad_administrativa', '=', 'ua.id')
            ->select('a.num_activo','a.nombre','a.marca','a.serie','ub.ubicacion','ua.unidad_administrativa')
            ->where('a.id_ubicacion', $tipo, $id)
            ->get();
       	
		$pdf = App::make('dompdf');

		$pdf->loadView('datos/reportes/imprimir/reporte-departamento', $parameter);

		$depto = 'TODOS';
		if($id != 0){
			$depto = mb_strtoupper($parameter['departamento'][0]->ubicacion, 'UTF-8');
		}

		return $pdf->stream('Reporte-Por-Departamento-'.$depto.'.pdf');
	}
}