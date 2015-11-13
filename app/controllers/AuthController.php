<?php
	class AuthController extends BaseController{
		
		
		//Función para verificar los datos del usuario e iniciar sesión
		public function postLogin() {
		  $reglas = array(
	  			'user' => 'required', 
	  			'password' => 'required'
		  ); 	
		  
		  $validator = Validator::make(Input::all(), $reglas);

		  if($validator->fails()){
		  	return Redirect::to('/')->withErrors($validator)->withInput();
		  }else{

		      $user_data = array(
		         'user' => Input::get('user'),
		         'password' => Input::get('password')
		      );

		      if(Auth::attempt($user_data)){
		        return Redirect::to('/');
		      }else{
		      	return View::make('login')->with('error_login', 'Usuario o Contraseña Incorrectos');	      	
		      }		  	
		  }	     
	    } 
	    
	    //Funcion para cerrar sesión
	    public function getLogout(){
	      if(Auth::check()){
	         Auth::logout();	         
	      }
	      return Redirect::to('/');
	    }	    
	}
?>
