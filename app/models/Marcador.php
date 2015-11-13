<?php
/* En esta tabla se almacenan los marcadores correspondiente a los examenes para la deteccion de 
 * enfermedades durante el embarazo.
 * 1- id
 * 2- marcador
 */
class Marcador extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'marcadores';
}

?>
