<?php
/* En esta tabla se almacenaran los valores a comparar con los marcadores de las citas.
* 1- id
* 2- id_marcador
* 3- id_unidad
* 4- semana
* 5- lim_inferior
* 6- lim_superior
*/

class ValorNormal extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'valores_normales';

}

?>
