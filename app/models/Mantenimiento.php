<?php
/* En esta tabla se almacenaran todos los mantenimientos correspondientes a un activo en especifico asi 
 * como tambien cuando debera ser el proximo mantenimiento
 * 1- id
 * 2- fecha_realizacion
 * 3- realizado_por
 * 4- aprobado_por
 * 5- id_activo
 * 6- proximo_mant
 * 7- observacion
 */
class Mantenimiento extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'mantenimientos';

	//Esta funcion recibe como parametro un numero y devuelve una fecha con el mes actual, el año actual y el decimo del dia
	//de la variable que recibio por ejemplo si recibe 0 devuelve 2014-10-01 y si recibe 3 devuelve 2014-10-31
	//Es aplicada en los mantenimientos para tener un rango de fechas.
	function mes($var){
		$fecha_actual = getdate();
		$fecha = $fecha_actual['year'].'-';
		if($fecha_actual['mon'] < 10){
			$fecha.= '0';
		}
		$fecha.= $fecha_actual['mon'].'-'.$var.'1';
		return $fecha;
	}
}

?>
