<?php
/* Esta tabla se encarga de almacenar los valores de los marcadores que se
*  registran en la cita para después hacer los cálculos automáticos del sistema 
* 1- id
* 2- id_marcador
* 3- semana
* 4- id_metodologia
* 5- id_unidad
* 6- valor
* 7- positivo
*/
class ValorMarcador extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'valores_marcadores';

}

?>
