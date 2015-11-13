<?php
/* En esta tabla se almacenan todos los datos del paciente
* 1- id
* 2- cedula
* 3- primer_nombre
* 4- segundo_nombre
* 5- apellido_paterno
* 6- apellido_materno
* 7- sexo
* 8- fecha_nacimiento
* 9- celular
* 10- telefono
* 11- email
* 12- id_provincia_nacimiento
* 13- id_distrito_nacimiento
* 14- id_corregimiento_nacimiento
* 15- id_nacionalidad
* 16- id_etnia
* 17- id_tipo_sangre
* 18- diabetes 
* 19- id_raza
* 20- id_provincia_residencia
* 21- id_distrito_residencia
* 22- id_corregimiento_residencia
* 23- lugar_residencia
* 24- fuma
* 25- embarazo_trisomia
* 26- foto
*/
class Paciente extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pacientes';

	//Funcion para calcular la edad de una persona recibiendo como parametro la fecha de nacimiento

	function edad($fecha)
	{
		$fecha_actual = getdate();
        $edad = 0;
        $fecha = explode("-", $fecha);
        if (!checkdate($fecha[1],$fecha[2],$fecha[0])){
                $edad = 'Fecha Inválida';
        }else{
                if($fecha[0] < $fecha_actual['year']){
                        if($fecha[1] < $fecha_actual['mon']){
                                $edad = $fecha_actual['year'] - $fecha[0];
                        }else{
                                $edad = $fecha_actual['year'] - $fecha[0];
                                $edad--;
                        }                              
                }
        }
        return $edad;
    }
    //Funcion que busca los datos de los pacientes
    //Si recibe como id = 0 entonces devolvera todos los pacientes con sus respectivos datos en un arreglo
    //si recibe un numero distinto de 0 entonces devolvera los datos de ese paciente a quien pertenece ese id.
    function datos_pacientes($id, $sw=0, $limit=10, $offset=0)
    {
    	if($sw == 0){
			if($id == 0){
				$datos = DB::select("SELECT * FROM pacientes WHERE id > 0 LIMIT ".$offset.",".$limit.";");
			}else{
				$datos[0] = Paciente::find($id);
			}
    	}else {
			$datos = DB::select("SELECT * FROM pacientes WHERE concat(`cedula`,' ',`primer_nombre`,' ',`apellido_paterno`) LIKE '%".$id."%'");    	
    	}
		$x = 0;
		//Ciclo que recorre todos los pacientes o un paciente en especifico.
		foreach ($datos as $paciente){
			//Decision que reemplaza el booleano de diabetes por palabras.
			if($paciente->diabetes == 1){
				$datos[$x]->diabetico = 'Si';	
			}else{
				$datos[$x]->diabetico = 'No';
			}
			//Decision que reemplaza el booleano de fuma por palabras.
			if($paciente->fuma == 1){
				$datos[$x]->fumadora = 'Si';
			}else{
				$datos[$x]->fumadora = 'No';
			}
			//Decision que reemplaza el booleano de embarazos anteriores con trisomia por palabras.
			if($paciente->embarazo_trisomia == 1){
				$datos[$x]->embarazos_anteriores = 'Si';
			}else{
				$datos[$x]->embarazos_anteriores = 'No';
			}
			//Decision para comprobar si el paciente tiene una imagen almacenada
			//en caso que no la tenga se le pone la imagen por default.
			if(empty($datos[$x]->foto)){
				$foto = 'default.png';
			}else{
				$foto = $datos[$x]->foto;
			}
			//Sentencias para almacenar los datos del/los paciente(s) en la variable a retornar
			$datos[$x]->foto = $foto;
			if(empty($paciente->id_etnia)){
				$datos[$x]->etnia = 'No Definida';
			}else{
				$datos[$x]->etnia = Etnia::where('id_etnia', $paciente->id_etnia)->first()->etnia;
			}
			if(empty($paciente->id_raza)){
				$datos[$x]->raza = 'No Definida';				
			}else{
				$datos[$x]->raza = Raza::where('id_razas', $paciente->id_raza)->first()->raza;
			}
			if(empty($paciente->fecha_nacimiento)){
				$datos[$x]->edad = '0';
			}else{
				$datos[$x]->edad = $this->edad($paciente->fecha_nacimiento);
			}
			if(empty($paciente->id_provincia_nacimiento)){
				$datos[$x]->provincia_nacimiento = 'No Definida';
			}else{
				$datos[$x]->provincia_nacimiento = Provincia::where('id_provincia', $paciente->id_provincia_nacimiento)->first()->provincia;
			}
			if(empty($paciente->id_distrito_nacimiento)){
				$datos[$x]->distrito_nacimiento = 'No Definido';
			}else{
				$datos[$x]->distrito_nacimiento = Distrito::where('id_distrito', $paciente->id_distrito_nacimiento)->first()->distrito;
			}
			if(empty($paciente->id_corregimiento_nacimiento)){
				$datos[$x]->corregimiento_nacimiento = 'No Definido';
			}else{
				$datos[$x]->corregimiento_nacimiento = Corregimiento::where('id_corregimiento', $paciente->id_corregimiento_nacimiento)->first()->corregimiento;
			}
			if(empty($paciente->id_provincia_residencia)){
				$datos[$x]->provincia_residencia = 'No Definida';
			}else{
				$datos[$x]->provincia_residencia = Provincia::where('id_provincia', $paciente->id_provincia_residencia)->first()->provincia;	
			}
			if(empty($paciente->id_distrito_residencia)){
				$datos[$x]->distrito_residencia = 'No Definido';
			}else{
				$datos[$x]->distrito_residencia = Distrito::where('id_distrito', $paciente->id_distrito_residencia)->first()->distrito;
			}
			if(empty($paciente->id_corregimiento_nacimiento)){
				$datos[$x]->corregimiento_residencia = 'No Definido';
			}else{
				$datos[$x]->corregimiento_residencia = Corregimiento::where('id_corregimiento', $paciente->id_corregimiento_nacimiento)->first()->corregimiento;				
			}
			if(empty($paciente->id_nacionalidad)){
				$datos[$x]->nacionalidad = 'No Definida';
			}else{
				$datos[$x]->nacionalidad = Nacionalidad::where('id_nacionalidad', $paciente->id_nacionalidad)->first()->nacionalidad;
			}
			if(empty($paciente->id_tipo_sangre)){
				$datos[$x]->tipo_sangre = 'No Definida';
			}else{
				$datos[$x]->tipo_sangre = Tiposangre::where('id_tipo_sanguineo', $paciente->id_tipo_sangre)->first()->tipo_sangre;
			}
			$x++;	
		}
		return $datos;
    }
	public function getFullNameAttribute() {
			return ucfirst($this->primer_nombre) . ' ' . ucfirst($this->segundo_nombre) . ' ' . ucfirst($this->apellido_paterno) . ' ' . ucfirst($this->apellido_materno);
	}
    //Funcion que calcula el riesgo de una persona recibiendo la edad
    function riesgo($edad){
		//Sentencias del calculo de la probablidad por edad
		$probabilidad = number_format(0.000627 + exp(-16.2395 + (0.286 * ($edad - 0.5))), 6, '.', '');
		//Sentencia para el calculo del riesgo
		$riesgo = number_format(number_format(1/number_format(1 - $probabilidad, 6, '.', ''), 6, '.', '')/$probabilidad, 2, '.', '');
		$datos['p'] = $probabilidad;
		$datos['r'] = $riesgo;
		return $datos;
    }
}

?>
