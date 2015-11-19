<?php

class CondicionEnfermedad extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'condiciones_enfermedades';

	//Funcion que recibe el ID de la cita para luego buscar sus respectivos marcadores y realizar las comparaciones
	//para devolver los resultados de las enfermedades si son positivos o negativos.
	function obtenerEnfermedades($id){
		$tipo_cita = Cita::find($id)->tipo_cita;
		//Ciclo que recorre todas las enfermedades
		foreach(Enfermedad::where('status', 1)->get() as $enfermedad){
			//Variable usada como switch para detectar enfermedades.
			$sw = 1;
			//Variable usada como contador
			$contador = 0;
			//Se crea un objeto para poder almacenar la informacion de los resultados.
			$resultado[$enfermedad->id] = new Enfermedad;
			//Almaceno el nombre de la enfermedad en el resultado usando como indice el ID de la enfermedad
			$resultado[$enfermedad->id]->enfermedad = $enfermedad->descripcion;
			//Sentencia para buscar todas las condiciones pertenecientes a una enfermedad especifica
			$condiciones = CondicionEnfermedad::where('id_enfermedad', $enfermedad->id)->where('valor_condicion', '<>', '')->where('trimestre_marcador', $tipo_cita)->get();
			//Variable que almacena la suma de los porcentajes
			$porcentaje = 0;
			//Variabele que almacena el mensaje de advertencia si el porcentaje es alto
			$advertencia = '';
			//Variable que almacena la mediana de los porcentajes
			$porcentajeTotal = 0;
			//Ciclo que recorre todas las condiciones
			foreach($condiciones as $condicion){
				//Decision donde se compara el valor obtenido del marcador de la cita
				//con la condicion para ver si son diferentes.
				$mom_marcador = '';
				if(!empty(MarcadorCita::where('id_cita', $id)->where('id_marcador', $condicion->id_marcador)->first()->mom)){
					$mom_marcador = MarcadorCita::where('id_cita', $id)->where('id_marcador', $condicion->id_marcador)->first()->mom;
				}
				if($mom_marcador <> 0){
					//Si la condicion es -1 quiere decir que es bajo
					if($condicion->valor_condicion == -1){
						if($mom_marcador < $condicion->limite_inferior){
							$porcentaje = $porcentaje + 1;
						}else{
							$porcentaje = $porcentaje + ($condicion->limite_inferior)/($mom_marcador);	
						}
						$sw = 0;
					}elseif($condicion->valor_condicion == 1){
						if($mom_marcador > $condicion->limite_superior){
							$porcentaje = $porcentaje + 1;
						}else{
							$porcentaje = $porcentaje + ($mom_marcador)/($condicion->limite_superior);	
						}						
						$sw = 0;
					}elseif(($mom_marcador > $condicion->limite_inferior) && ($mom_marcador < $condicion->limite_superior)){
						$porcentaje = $porcentaje + 1;
						$sw = 0;
					}
				}	
				$contador++;			
			}
			if($contador > 0){
				$porcentajeTotal = ($porcentaje)/($contador);
			}else{
				$sw = 1;
			}
			//Condicion para evaluar el porcentaje de contraer una enfermedad
			if($porcentajeTotal >= 0.85){
				$advertencia = '<br><p style="background:orange;">Tamiz Negativo, sin embargo existe un alto riesgo para contraer esta enfermedad</p>';
			}
			//Decision que determina el mensaje a imprimir
			//Si la variable Switch es igual a 0 quiere decir que nunca entro en la decision anterior
			//en caso contrario quiere decir que la variable tiene el valor de 1 y por lo tanto una condicion se cumple y la enfermedad es positiva
			if($sw == 0 && $porcentajeTotal == 1){
				$resultado[$enfermedad->id]->resultado = '<b style="background:#d9534f;">Tamiz Positivo</b>';				
				$resultado[$enfermedad->id]->mensaje = $enfermedad->mensaje_positivo;
			//De ser falso la condicion osea que el switch tomo el valor de 1 quiere decir que no fueron
			//exactamente los valores de la cita con las condiciones y arroja un resultado negativo
			}else{
				$resultado[$enfermedad->id]->resultado = '<b>Tamiz Negativo</b>';				
				$resultado[$enfermedad->id]->mensaje = $enfermedad->mensaje_negativo.' '.$advertencia;
			}
		}
		//Devuelve un arreglo con tdas las enfermedades usando como indice el ID de cada enfermedad
		//Con sus respectivo nombre, resultado si fue positivo o negativo y el mensaje correspondiente.
		return $resultado;
	}
	
	
}

?>
