<?php
/*En esta tabla se almacenaran los activos y posee los siguientes campos
 * 1- id
 * 2- codigo
 * 3- descripcion
 * 4- id_tipo
 * 5- marca
 * 6- id_nivel
 * 7- id_ubicacion
 * 8- fecha_compa
 * 9- num_factura
 * 10- costo
 * 11- id_proveedor
 * 
 */
class Activo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'activos';

}

?>
