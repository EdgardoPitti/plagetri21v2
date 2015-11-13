<?php
/* En esta tabla se almacenan los valores correspondientes a una cita determinada
 * 1- id
 * 2- id_paciente
 * 3- id_medico
 * 4- peso
 * 5- fecha_ultrasonido
 * 6- fur: fecha ultima menstruacion
 * 7- fpp: fecha probable de parto
 * 8- fecha_flebotomia
 * 9- edad_gestacional
 * 10- observaciones
 * 11- estatura
 * 12- id_institucion
 * 13- hijos_embarazo
 * 14- fecha_cita
 * 15- riesgo
 * 16- riesgo_fap
 * 17- edad_materna
 * 18- edad_gestacional_fur 
 */

class Cita extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'citas_medicas';

}

?>
