<?php
/* En esta tabla se almacenara todas las medianas correspondientes a cada marcador para 
 * realizar el calculo de las mom, entre los cuales los campos son
 * 1- id
 * 2- id_marcador
 * 3- mediana_marcador
 * 4- id_unidad
 * 5- semana
 */

class MedianaMarcador extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'mediana_marcadores';
	
	
	/*
	function obtenerMediana($id){
		$valor = MedianaMarcador::where('id_marcador', $id)->first();
		if(is_null($valor)){
			$valor = new MedianaMarcador;
			$valor->mediana_marcador = 0;
		}
		return $valor;
	}*/
}

?>
