<?php
/* En esta tabla se almacenaran los distintos módulos del sistema, al que podrá acceder un usuario
* 1- id
* 2- id_modulo
* 3- id_grupo_usuario
* 4- inactivo
*/
class ModuloUsuario extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'modulos_usuarios';

}

?>
