<?php
/* En esta tabla se alamcenara toda la informacion de los coeficientes necesarios para poder
 * realizar las correcciones de los mom de la forma lineal
 * 1- id
 * 2- id_marcador
 * 3- a: coeficiente para la formula
 * 4- b: coeficiente para la formula
 */
class CoeficienteLineal extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'coeficientes_lineales';

}

?>
