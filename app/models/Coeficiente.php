<?php
/* En esta tabla se alamcenara toda la informacion de los coeficientes necesarios para poder
 * realizar las correcciones de los mom
 * 1- id
 * 2- id_raza
 * 3- id_marcador
 * 4- a: coeficiente para la formula
 * 5- b: coeficiente para la formula
 */
class Coeficiente extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'coeficientes';
}

?>
