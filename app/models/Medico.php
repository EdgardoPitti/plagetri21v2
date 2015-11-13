<?php
/* En esta tabla se almacenaran todos los médicos en la institucion
* 1- id
* 2- cedula
* 3- primer_nombre
* 4- segundo_nombre
* 5- apellido_paterno
* 6- apellido_materno
* 7- sexo
* 8- id_especialidades_medicas
* 9- telefono
* 10- celular
* 11- email
* 12- foto
* 13- extension
* 14- id_nivel
* 15- id_ubicacion
* 16- observacion
*/
class Medico extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'medicos';

	/* Esta funcion busca los datos de los medicos
	*  Si recibe como sw = 0 (variable search del getDatosController), obtiene todos los medicos, sino realiza la busqueda de los médicos. 
   *  Si recibe como id = 0 entonces devolvera todos los medicos con sus respectivos datos en un arreglo
   *  si recibe un numero distinto de 0 entonces devolvera los datos de ese medico a quien pertenece ese id.
	*/
	function datos_medico($id,$sw=0, $limit=10, $offset=0){
		if($sw == 0){
			if($id == 0){
				//obtiene todos los medicos
				$datos = DB::select("SELECT * FROM medicos WHERE id > 0 LIMIT ".$offset.",".$limit.";");
			}else{
				$datos[0] = Medico::find($id);
			}
		}else{
			//Realiza la busqueda de los médicos por su nombre completo.
			$datos = DB::select("SELECT * FROM medicos WHERE concat(`cedula`,' ',`primer_nombre`,' ',`apellido_paterno`) LIKE '%".$id."%' LIMIT ".$offset.",".$limit.";");
		}
		$x = 0;
		foreach($datos as $medico){			
			if(empty($datos[$x]->foto)){
				$foto = "default1.png";				
			}else{
				$foto = $datos[$x]->foto;
			}
			$datos[$x]->foto = $foto;
			if(!empty($medico->id_especialidades_medicas)) {
				$datos[$x]->especialidad = EspecialidadMedica::where('id_especialidades_medicas', $medico->id_especialidades_medicas)->first()->descripcion;	
			}else {
				$datos[$x]->especialidad = 'POR DEFINIR';
			}
			
			//Funciones para detectar si no esta vacio el campo retorna el valor de la busqueda al modal.			
			if(!empty($medico->id_nivel)){
				$datos[$x]->nivel =  Nivel::where('id', $medico->id_nivel)->first()->nivel;
			}else{
				$datos[$x]->nivel =  'POR DEFINIR';
			}
			if(!empty($medico->id_ubicacion)){
				$datos[$x]->ubicacion = Ubicacion::where('id', $medico->id_ubicacion)->first()->ubicacion;
			}else{
				$datos[$x]->ubicacion = 'POR DEFINIR';			
			}
			$x++;
		}
		return $datos;
	}
}
