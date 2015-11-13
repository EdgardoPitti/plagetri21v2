<?php
/* En esta tabla se almacenara los distritos pertenecientes a cada provincia del pais
 * 1- id_provincia
 * 2- id_distrito
 * 3- distrito
 * 4- latitud
 * 5- longitud 
 */
class Distrito extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'distritos';
}

?>
