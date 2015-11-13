<?php
/* En esta tabla se almacena el tipo de activo con su descripción
* 1- id
* 2- tipo
* 3- descripción
*/
class TipoActivo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'tipos_activos';

}

?>