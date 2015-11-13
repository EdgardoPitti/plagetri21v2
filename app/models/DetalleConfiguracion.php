<?php
/* En esta tabla se almacenaran los detalles pertenecientes a la configuracion general pero en base
 * a la unidad que se esta manejando para cada marcador
 * 1- id
 * 2- id_configuracion
 * 3- id_marcador
 * 4- id_unidad
 */
class DetalleConfiguracion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'detalles_configuraciones';

}

?>
