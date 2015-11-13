<?php
/* En esta tabla se almacenan las instituciones disponibles en el pais
 * 1- id
 * 2- id_provincia
 * 3- id_distrito
 * 4- id_corregimiento
 * 5- id_tipo_institucion
 * 6- lugar
 * 7- denominacion
 */
class Institucion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'instituciones';

}

?>
