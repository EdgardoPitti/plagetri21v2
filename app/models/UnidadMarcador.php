<?php
/* En esta tabla se almacena la configuración global de las unidades de los marcadores
*  eligiendo el ultimo registro de cada marcador como la unidad que se maneja en ese instante.
* 1- id
* 2- id_marcador
* 3- id_unidad
* 4- id_usuario
*/
class UnidadMarcador extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'unidades_marcadores';

}

?>
