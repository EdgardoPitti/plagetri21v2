<?php
/* En esta tabla esta almacenado en que edificio se encuentra un medico
* 1- id
* 2- ubicacion
*/
class MedianaMarcadorAuto extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'mediana_marcadores_automaticos';
	
	
	function AlmacenarData($data){
			foreach($data as $datos){		
					$medianamarcador = new MedianaMarcadorAuto;
					$medianamarcador->semana = $datos['semana'];
					$medianamarcador->id_marcador = $datos['marcador'];
					$medianamarcador->id_unidad = $datos['unidad'];
					$medianamarcador->mediana_marcador = $datos['mediana'];
					$medianamarcador->save();
			}
	}

}

?>
