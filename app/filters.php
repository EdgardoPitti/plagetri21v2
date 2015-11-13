<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response) {
	$response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate'); 
	$response->headers->set('Pragma','no-cache'); 
	$response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT'); 
});

/*
| Authentication Filters
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('/');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

//Filtro para la ruta usuario, si es distinto de 1 = ADMINISTRADOR, acceso no autorizado.
Route::filter('admin', function(){
	if(Auth::check()){
		if(Auth::user()->id_grupo_usuario != 1){
			App::abort(403);
		}		
	}
});

//Filtro para el acceso a los distintos modulos de plagetri21.
Route::filter('acceso', function()
{
	//Verifica si esta logueado
	if(Auth::check()){
		//Obtiene el id_grupo_usuario del usuario logueado
		$groupId = Auth::user()->id_grupo_usuario;
		//obtiene la ruta que accede el usuario, Ej. datos/citas/{citas}/edit
		$ruta = Route::getCurrentRoute()->uri();
		
		// convierte en arreglo la ruta
		$ruta_array = explode('/', $ruta);
		
		//Si la ruta corresponde "datos/citas", y no se encuentra vacio el indice 1, concatenara dicha ruta
		// de lo contrario se selecciono reportes.
		if(!empty($ruta_array[1])){
			//ej. datos.citas
			$ruta_final = $ruta_array[0].'.'.$ruta_array[1];			
		}else{
			//ej. reportes
			$ruta_final = $ruta_array[0];
		}
		
		//Selecciona el ID del Modulo que contenga la ruta que trata de visitar el usuario autenticado
		$modulo = Modulo::where('ruta', 'like' , '%'.$ruta_final.'%')->select('id')->first()->toArray();
		
		//Busca si el usuario tiene acceso al modulo que desea entrar
		$moduloUser = ModuloUsuario::where('id_grupo_usuario', $groupId)->where('id_modulo', $modulo['id'])->where('inactivo', 0)->select('id')->get()->toArray();
		
		//Si está vacío no tiene acceso al modulo		
		if(empty($moduloUser)){
			App::abort(403);
		}
		
	}
	
});
/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});