<?php
use JpGraph\JpGraph;
 
class GraficarController extends \BaseController {
         
    public function getPintargrafica($riesgo) {
        
      JpGraph::module('bar');        
		
		$riesgo = number_format($riesgo, 0, '', '');
		$valor_riesgo = 100/$riesgo;
				
		if($riesgo <= 385){
			$color_riesgo = '#d9534f';		
		}else {
			$color_riesgo = '#5cb85c';		
		}
		
		$tamiz = 320;
		$valor_tamiz = 100/$tamiz;
		
		if($tamiz <= 385){
			$color_tamiz = '#d9534f';		
		}else {
			$color_tamiz = '#5cb85c';		
		}
		
		$data = array($valor_riesgo,$valor_tamiz);

		// Instancia la gráfica recibiendo como parámetros ancho, alto
		$graph = new Graph(310,210);
		$graph->SetScale("textlin");
		//Muestra borde de la gráfica
		$graph->SetBox(true);
				
		$graph->title->SetColor('black');
		$graph->title->Set('El Síndrome de Down');

		$labelsX = array("Edad Solamente\n(1:".$riesgo.")", "Suero Tamíz\n(1:".$tamiz.")");
		$graph->xaxis->SetTickLabels($labelsX);	//muestra los labels de las gráficas de barra
		$graph->xaxis->SetLabelAlign('center','top','center');	//Centrar los labels	
		$graph->ygrid->SetFill(false); //oculta el fondo de la gráfica
		$graph->yaxis->SetTitle('1:385', "middle");	//Titulo de axis Y seteado a la mitad de la gráfica	
		$graph->yaxis->HideLabels(); //Oculta los valores de la axis Y		
		$graph->yaxis->HideTicks(false,false); //Oculta las líneas de la axis Y
				
		$graph->xaxis->SetColor('black');
		$graph->yaxis->SetColor('black');

		// Crea la gráfica de barra
		$suero = new BarPlot($data);
		
		// Agrega la gráfica de suero
		$graph->Add($suero);
		
		$suero->SetColor("white");
		$suero->SetFillColor(array($color_riesgo, $color_tamiz));
		$suero->SetWidth(0.6);		
		
		//línea intermedia de la gráfica
		$band = new PlotBand(HORIZONTAL,BAND_SOLID,0.2496,0.25,'black');
		$band->ShowFrame(false);
		$graph->Add($band);					
				
		//Muestra la grafica
		$graph->Stroke();
    }

    public function getGrafmayorcosto(){
    	JpGraph::module('bar'); 

    	$graph = new Graph(680,300);
		$graph->SetScale("textlin");
		$graph->yscale->SetGrace(5);
		$graph->SetBox(true);

		$labels = array();
		$valores = array();
    	foreach(Activo::where('id', '>', '0')->orderBy('costo', 'desc')->take(10)->get() as $activo){
    		$labels[] = $activo->num_activo;
    		$valores[] = $activo->costo;
    	}

    	//titulo de la grafica
		$graph->title->SetColor('black');
		$graph->title->Set('Gráfica: Activos con Mayor Costo');		

		//valores de los labels en ambas axis y como se ubicaran
    	$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->SetLabelAlign('center','top','center');
		$graph->ygrid->SetFill(false);
		$graph->yaxis->HideLabels(false);		
		$graph->yaxis->HideTicks(false,false);

		//Fonts para las axis 
		$graph->xaxis->SetColor('black');
		$graph->yaxis->SetColor('black');

		//grafica de activos con mayor costo
		$mayorCosto = new BarPlot($valores);
		$mayorCosto->SetColor('white');
		$mayorCosto->SetWidth(0.6);

		//agrega la grafica generada a la instancia de la grafica
		$graph->Add($mayorCosto);

		//Despliega la grafica
		$graph->Stroke();
    }
 }