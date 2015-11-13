<?php
/* En esta tabla se almacena la configuracion general del sistema en cuanto a si el sistema esta en modo
 * automatico y la cantidad de registros que se requiere para ser automatico
 * 1- id
 * 2- id_usuario
 * 3- automatico
 * 4- cantidad_registros
 * 
 */
class Configuracion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'configuraciones';

}

?>
