<?php
/*En esta tabla se almacenaran los datos de las personas o empresas de contacto con el hospital
 * 1- id
 * 2- nombre_completo
 * 3- profesion
 * 4- telefono
 * 5- celular
 * 6- extension
 * 7- correo
 * 8- ruc
 * 
 */
class Agenda extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'agendas';

}

?>
