<?php
class DropdownController extends BaseController
{
    //Funcion que recibe el id de la provincia y devuelve los distritos correspondientes de esa provincia
    public function getDistrito()
    {
        $provincia = Input::get('provincia');
        $distrito = Distrito::where('id_provincia',$provincia);
        return ($distrito->get(['id_distrito', 'latitud', 'longitud', 'distrito']));
    }
    //Funcion que recibe el id del distrito y devuelve los corregimientos correspondientes de ese distrito
    public function getCorregimiento()
    {    
        $distrito = Input::get('distrito');
        $corregimiento = Corregimiento::where('id_distrito',$distrito);
        return ($corregimiento->get(['id_corregimiento', 'latitud', 'longitud', 'corregimiento']));
    }
    
    public function marcadores(){
        $xml = new DOMDocument("1.0", "UTF-8");

        $node = $xml->createElement("marcadores");
        $parnode = $xml->appendChild($node);
        
        foreach(Provincia::all() as $provincia){
            $node = $xml->createElement('marca');
            $marca = $parnode->appendChild($node);
            $marca->setAttribute("latitud", $provincia->latitud);
            $marca->setAttribute("longitud", $provincia->longitud);
            $marca->setAttribute("provincia", $provincia->provincia);
        }       
        $xml->formatOutput = true;
        $strings = $xml->saveXML();
        $xml->save('assets/marcadores.xml');
        return Redirect::to('datos/pacientesmapas');
    }
    //Funcion que recibe el id del tipo de institucion obligatorio y/o el id de la provincia y devuelve las instituciones correspondientes de esa provincia y tipo
    public function getInstitucion()
    {
        $tipo = Input::get('tipo');
        $provincia = Input::get('provincia');
        $institucion = Institucion::where('id_tipo_institucion', $tipo);
        if(!empty($provincia)){
            $institucion = Institucion::where('id_provincia', $provincia)->where('id_tipo_institucion', $tipo);                   
        }
        return ($institucion->get(['id','denominacion']));
    }
    //Funcion que recibe el id del tipo de institucion y/o el id de la provincia obligatorio y devuelve las instituciones correspondientes de esa provincia y tipo
    public function getInstitucionprovincia()
    {
        $tipo = Input::get('tipo');
        $provincia = Input::get('provincia');
        $institucion = Institucion::where('id_provincia', $provincia);
        if(!empty($tipo)){
            $institucion = Institucion::where('id_provincia', $provincia)->where('id_tipo_institucion', $tipo);                   
        }
        return ($institucion->get(['id','denominacion']));
    }
    //Funcion que recibe el id del marcador y la semana para proceder a buscar los valores correspondientes superior e inferior de ese marcador
    public function getLimites()
    {
        $id = Input::get('idmarcador');
        $trimestre = Input::get('trimestre');
        $limites = ValorNormal::where('id_marcador', $id)->where('semana', $semana)->where('id_unidad', UnidadMarcador::where('id_marcador', $id)->get()->last()->id_unidad);
        return ($limites->get(['lim_inferior', 'lim_superior']));
    }
    //Funcion que recibe el id del marcador y devuelve la mediana correspondiente a ese marcador
    public function getMomMarcador()
    {
        $id = Input::get('idmarcador');
        $semana = Input::get('semana');
        if(empty(Configuracion::all()->last()->automatico) OR Configuracion::all()->last()->automatico == 0){
			$mediana = MedianaMarcador::where('id_marcador', $id)->where('semana', $semana)->where('id_unidad', UnidadMarcador::where('id_marcador', $id)->get()->last()->id_unidad);
		}else{
			$mediana = MedianaMarcadorAuto::where('id_marcador', $id)->where('semana', $semana)->where('id_unidad', UnidadMarcador::where('id_marcador', $id)->get()->last()->id_unidad);
		}
        return ($mediana->get(['mediana_marcador']));
    }
    //Funcion que recibe el id de la raza y del marcador y devuelve los coeficientes correspondientes a la funcion lineal
    public function getCoeficienteLineal()
    {
        $idmarcador = Input::get('idmarcador');
        $coeficiente = CoeficienteLineal::where('id_marcador', $idmarcador);
        return ($coeficiente->get(['a', 'b']));
    }
    //Funcion que recibe el id de la raza y del marcador y devuelve los coeficientes correspondientes a la funcion exponencial
    public function getCoeficienteExponencial()
    {
        $idmarcador = Input::get('idmarcador');
        $idraza = Input::get('idraza');
        $coeficiente = CoeficienteExponencial::where('id_marcador', $idmarcador);
        return ($coeficiente->get(['a', 'b']));
    }
    public function getAutoMediana(){
		$idmarcador = Input::get('marcador');
		$semana = Input::get('semana');
		$medianas = MedianaMarcadorAuto::where('id_marcador', $idmarcador)->where('semana', $semana);
		return ($medianas->get(['mediana_marcador', 'id_unidad']));
	}
	public function getValidarCed(){
		$data = Input::all();
		$paciente = Paciente::where('cedula', $data['ced']);
		return ($paciente->get(['cedula']));
	}
	public function getValidarCedM(){
		$data = Input::all();
		$medico = Medico::where('cedula', $data['ced']);
		return ($medico->get(['cedula']));
	}
    public function getCalculoFecha(){
        $tipo = Input::get('tipo');
        $fecha = Input::get('fecha');
        $tiempo = 0;
        if($tipo == 2){
            $tiempo = '+7 days';
        }elseif($tipo == 3){
            $tiempo = '+15 days';
        }elseif($tipo == 4){
            $tiempo = '+1 month';
        }elseif($tipo == 5){
            $tiempo = '+3 month';
        }elseif($tipo == 6){
            $tiempo = '+6 month';
        }elseif($tipo == 7){
            $tiempo = '+12 month';
        }else{
            $tiempo = '';
        }
        $proximo = date('Y-m-d', strtotime("".$fecha." ".$tiempo.""));
        return $proximo;
    }
    
    public function getObtenerGarantias(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            /*$activos = DB::table('activos')->whereBetween('fecha_garantia', array($fecha_inicio, $fecha_fin))->select('num_activo','nombre',DB::raw("DATE_FORMAT(fecha_garantia, '%e %b. %Y') AS fecha_garantia"), 'costo')->get();            
            return $activos;            */
            setLocale(LC_TIME, 'Spanish');
            $activos = Activo::whereBetween('fecha_garantia', array($fecha_inicio, $fecha_fin))->select('num_activo','nombre','fecha_garantia','costo')->get()->toArray();
            $cantidad = count($activos);
            for($x=0; $x < $cantidad; $x++){
               array_set($activos[$x], 'fecha_garantia', Carbon::parse($activos[$x]['fecha_garantia'])->formatLocalized('%#d %b %Y')); 
            }

            return Response::json($activos);
        }else{
            App::abort(403);
        }
    }
    public function getObtenerActivos(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            //$limit = Input::get('limit'); 
           // $offset = Input::get('offset');
            
            //$n = 1;
            setLocale(LC_TIME, 'Spanish');
            //$activos = DB::table('activos')->whereBetween('fecha_compra', array($fecha_inicio, $fecha_fin))->orderBy('costo', 'desc')->get();            
            $datosactivos = Activo::whereBetween('fecha_compra', array($fecha_inicio, $fecha_fin))->select('num_activo','nombre','modelo','marca','serie', 'fecha_compra','costo')->orderBy('costo', 'desc')->get()->toArray();
            $cantidad = count($datosactivos);            
            for($x=0; $x < $cantidad; $x++){
                //cambia el valor de un campo del arreglo
                array_set($datosactivos[$x], 'fecha_compra', Carbon::parse($datosactivos[$x]['fecha_compra'])->formatLocalized('%#d %b %Y'));
            }

            /*
            setLocale(LC_TIME, 'Spanish');
            $data = '{
                "total": '.$cantidad.',
                "rows": [';

                foreach($datosactivos as $datos){
                    $num = $n + $offset;                
                    if($n > 1){
                        $data.= ',';
                    }
                    
                    $n++;
                    $data .= '{
                        "num": '.$num.',
                        "num_activo": "'.$datos->num_activo.'",
                        "nombre": "'.$datos->nombre.'",
                        "modelo": "'.$datos->modelo.'",
                        "marca": "'.$datos->marca.'",
                        "serie": "'.$datos->serie.'",
                        "fecha_compra": "'.$datos->fecha.'",
                        "costo": "'.$datos->costo.'"
                        
                    }';
                }

             $data .= ']
             }';
                */
            //return $datosactivos;
            return Response::json($datosactivos);            
        }else{            
           App::abort(403);
        }
    }
    public function getObtenerPreventivoActivo(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');            
            $preventivo = DB::select("SELECT a.num_activo, a.nombre, a.modelo, a.serie, a.marca, t.tipo_fuente, count(m.id) AS cantidad FROM mantenimientos m, activos a, tipos_fuentes t WHERE id_tipo_mantenimiento = 1 AND m.id_activo = a.id AND a.id_tipo_fuente = t.id AND fecha_realizacion between '".$fecha_inicio."' AND '".$fecha_fin."' GROUP BY id_activo ORDER BY cantidad desc;");
            return $preventivo;
        }else{
            App::abort(403);
        }
    }
    public function getObtenerCorrectivoActivo(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            $correctivo = DB::select("SELECT a.num_activo, a.nombre, a.modelo, a.serie, a.marca, t.tipo_fuente, count(m.id) AS cantidad FROM mantenimientos m, activos a, tipos_fuentes t WHERE id_tipo_mantenimiento = 2 AND m.id_activo = a.id AND a.id_tipo_fuente = t.id AND fecha_realizacion between '".$fecha_inicio."' AND '".$fecha_fin."' GROUP BY id_activo ORDER BY cantidad desc;");
            return $correctivo;            
        }else{
            App::abort(403);
        }
    }
    public function getObtenerPreventivos(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            setLocale(LC_TIME, 'Spanish');
            $preventivos = DB::select("SELECT m.fecha_realizacion,a.num_activo,a.nombre,a.marca,a.modelo,a.serie,m.realizado_por,m.aprobado_por,a.costo from mantenimientos m, activos a where m.id_tipo_mantenimiento = 1 and a.id = m.id_activo AND m.fecha_realizacion BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' order by m.costo_mantenimiento desc");
            
            $arrPreventivo = json_decode(json_encode($preventivos), true);
            $cantidad = count($arrPreventivo);
            for($x=0; $x < $cantidad; $x++){
                array_set($arrPreventivo[$x], 'fecha_realizacion', Carbon::parse($arrPreventivo[$x]['fecha_realizacion'])->formatLocalized('%#d %b %Y'));
            }
            return Response::json($arrPreventivo);
        }else{
            App::abort(403);
        }
    }
    public function getObtenerCorrectivos(){
        if(Request::ajax()){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            $correctivos = DB::select("SELECT m.fecha_realizacion,a.num_activo,a.nombre,a.marca,a.modelo,a.serie,m.realizado_por,m.aprobado_por,a.costo from mantenimientos m, activos a where m.id_tipo_mantenimiento = 2 and a.id = m.id_activo AND m.fecha_realizacion BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' order by m.costo_mantenimiento desc");
            
            $arrCorrectivo = json_decode(json_encode($correctivos), true);
            $cantidad = count($arrCorrectivo);
            for($x=0; $x < $cantidad; $x++){
                array_set($arrCorrectivo[$x], 'fecha_realizacion', Carbon::parse($arrCorrectivo[$x]['fecha_realizacion'])->formatLocalized('%#d %b %Y'));
            }
            return Response::json($arrCorrectivo);           
        }else{
            App::abort(403);
        }
    }
}
