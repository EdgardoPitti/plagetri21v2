<?php
/* En esta tabla se almacena los grupos a los que pertenecen los usuarios
 * 1- id
 * 2- grupo_usuario
 */
class GrupoUsuario extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'grupos_usuarios';

}

?>
