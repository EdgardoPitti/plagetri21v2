<?php
/* En esta tabla estan almacenados los distintos tipos de sangre
* 1- id_tipo_sanguineo
* 2- tipo_sangre
*/
class Tiposangre extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipos_sanguineos';
}

?>
