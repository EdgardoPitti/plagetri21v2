<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	if(Auth::check()){
		return View::make('inicio');		
	}else{
		return View::make('login');			
	}
});
	Route::post('sigin', 'AuthController@postLogin');
	//Rutas de Logueo y Registro de Usuarios
	Route::get('logout', 'AuthController@getLogout');
	
	//Rutas que solo ve el administrador
	Route::group(array('before' => array('auth','admin')), function(){
		Route::resource('usuario', 'UsuarioController');
		Route::resource('datos/modulos', 'Datos_ModulosController');
		Route::resource('datos/configuracion', 'ConfiguracionController');
	});
	
	Route::resource('datos/marcadores', 'MarcadoresController');
	//Rutas para controladores de modulos del sistema
	Route::group(array('before' => 'acceso'), function(){ 
		Route::resource('datos/pacientes', 'Datos_PacientesController');
		Route::resource('datos/medicos', 'Datos_MedicosController');
		Route::resource('datos/citas', 'Datos_CitasController');
		Route::resource('datos/mediana', 'Datos_MedianaController');
		Route::resource('datos/agenda', 'Datos_AgendaController');
		Route::resource('datos/activos', 'Datos_ActivosController');
		Route::resource('datos/mantenimientos', 'Datos_MantenimientosController');
		Route::resource('datos/condiciones', 'CondicionesController');
		Route::resource('tipoactivo', 'TiposActivosController');
		Route::resource('unidad', 'UnidadAdministrativaController');	
		
		//Ruta para el control del mapa
		Route::resource('datos/pacientesmapas', 'MapasController');
		Route::resource('reportes', 'ReportesController');

	});
	
	//Route::resource('datos/empresas', 'EmpresasController');
	
	Route::post('almacenargrupo', 'Datos_ModulosController@almacenargrupo');
	Route::post('medicos/getmedicos', 'getDatosController@postData'); //ruta para cargar datos al modal
	Route::get('medicos', 'getDatosController@postMedicos'); //ruta para obtener todos los médicos y filtrar
	Route::get('pacientes/{cita}', 'getDatosController@postPacientes'); //ruta para obtener todos los pacientes y filtrarlos
	Route::get('departamento', 'getDatosController@getDepartamento');
	Route::get('getactivos/{mantentenimiento}', 'getDatosController@getActivos'); //ruta para obtener los activos y filtrarlos
	Route::post('bajaactivo/{id}', 'Datos_ActivosController@bajaActivo'); //ruta para dar de baja a un activo
	Route::get('getMantenimientos', 'getDatosController@getMantenimientos');

	Route::controller('imprimir', 'ImprimirController'); //enlaces para imprimir PDF de reportes
	Route::controller('grafica', 'GraficarController'); //ruta para mostrar las graficas de cita y reportes
	
	//Rutas para elementos dinamicos
	//Route::get('datos/marcadores', 'DropdownController@marcadores');
	Route::get('distrito','DropdownController@getDistrito');
	Route::get('corregimiento','DropdownController@getCorregimiento');
	Route::get('institucion', 'DropdownController@getInstitucion');
	Route::get('institucionprovincia', 'DropdownController@getInstitucionprovincia');
	Route::get('comparar', 'DropdownController@getLimites');
	Route::get('calculo', 'DropdownController@getMomMarcador');
	Route::get('obtenerautomediana', 'DropdownController@getAutoMediana');
	Route::get('correccion_lineal', 'DropdownController@getCoeficienteLineal');
	Route::get('correccion_exponencial', 'DropdownController@getCoeficienteExponencial');
	Route::get('obtenermediana', 'Datos_MedianaController@getObtenerMediana');
	Route::get('obtenerfecha', 'DropdownController@getCalculoFecha');
	Route::get('obtenergarantias', 'DropdownController@getObtenerGarantias');
	Route::get('obtenercostosactivos', 'DropdownController@getObtenerActivos');
	Route::get('obtenerpreventivoactivo', 'DropdownController@getObtenerPreventivoActivo');
	Route::get('obtenercorrectivoactivo', 'DropdownController@getObtenerCorrectivoActivo');
	Route::get('obtenerpreventivos', 'DropdownController@getObtenerPreventivos');
	Route::get('obtenercorrectivos', 'DropdownController@getObtenerCorrectivos');
	Route::post('validarced', 'DropdownController@getValidarCed');
	Route::post('validarcedm', 'DropdownController@getValidarCedM');

	