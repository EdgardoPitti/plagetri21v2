<?php
/* En esta tabla se encuentran almacenados las distintas provincias del país
* 1- id_provincia
* 2- provincia
* 3- latitud  //Utilizado para ubicación en el mapa
* 4- longitud  //Utilizado para ubicación en el mapa
*/
class Provincia extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'provincias';

}

?>
