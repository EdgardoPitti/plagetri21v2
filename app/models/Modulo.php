<?php
/* En esta tabla se encuentran almacenados los módulos que llevan a las distintas secciones del sistema
* 1- id
* 2- modulo
* 3- ruta
* 4- imagen
*/
class Modulo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'modulos';

}

?>
