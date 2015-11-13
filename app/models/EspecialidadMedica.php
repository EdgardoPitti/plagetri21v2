<?php
/* En esta tabla se almacenara las especialidades existentes pertenecientes a los medicos
 * 1- id_especialidad_medica
 * 2- descripcion 
 */
class EspecialidadMedica extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'especialidades_medicas';
}

?>
