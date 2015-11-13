<?php
/*En esta tabla se almacenaran todos los corregimientos pertenecientes al pais
 * 1- id_provincia
 * 2- id_distrito
 * 3- id_corregimiento
 * 4- corregimiento
 * 5- latitud
 * 6- longitud 
 */
class Corregimiento extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'corregimientos';

}

?>
