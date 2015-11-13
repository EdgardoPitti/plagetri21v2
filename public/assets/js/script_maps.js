jQuery(document).ready(function($){ 
    var coordenada; //variable utilizada para las coordenadas de las provincias,distritos y corregimientos, manejado como 
    var infowindow = null; //para las ventanas de informacion de google map
    var marker = null; 
    
    $("#id_prov").change(function(){
        $.get(""+baseurl+"/distrito", 
        { provincia: $(this).val() }, 
        function(data){            
            var distrito = $('#id_dist');
            var corregimiento = $('#id_correg');
            var posdist = [];
            distrito.empty();
            corregimiento.empty();
            distrito.append("<option value='0'>SELECCIONE DISTRITO</option>");
            corregimiento.append("<option value='0'>SELECCIONE CORREGIMIENTO</option>");
            $.each(data, function(index,element) {
                distrito.append("<option value='"+ element.id_distrito +","+ element.latitud +","+ element.longitud +"'>" + element.distrito + "</option>");
                //Se almacena en un arreglo todos los distritos de la provincia seleccionada
                posdist[index] = [element.latitud, element.longitud, element.distrito];                
            });       
            var icono  = new google.maps.MarkerImage(""+baseurl+"/imgs/distrito.png");         
            setMarkers(map, posdist, icono);//Función que insertara los diferentes marcadores de los distritos de la provincia que se selecciona
        });
        coordenada = $(this).find(':selected').val().split(',');   //obtener datos del distrito seleccionado        
        //si el arreglo coordenada tiene valor 0 carga el mapa inicial sino carga 
        //la posicion de la provincia seleccionada
        if(coordenada[0] == 0){
            initialize();
        }else{                                    
            //envia a la funcion coordenadas el arreglo coordenada y el zoom para que se acerque el mapa
            coordenadas(coordenada, 9);                         
        }
    });      

    $("#id_dist").change(function(){
        $.get(""+baseurl+"/corregimiento", 
        { distrito: $(this).val() }, 
        function(data){
            var corregimiento = $('#id_correg');            
            var poscor = [];
            corregimiento.empty();
            corregimiento.append("<option value='0'>SELECCIONE CORREGIMIENTO</option>");
            $.each(data, function(index,element) {
                corregimiento.append("<option value='"+ element.id_corregimiento +","+ element.latitud +","+ element.longitud +"'>" + element.corregimiento + "</option>");
                poscor[index] = [element.latitud, element.longitud, element.corregimiento];                
            });
            var icono  = new google.maps.MarkerImage(""+baseurl+"/imgs/corregimiento.png"); 
            setMarkers(map, poscor, icono);
        });
        coordenada = $("#id_dist").find(':selected').val().split(',');     
        //si el arreglo coordenada tiene valor 0 carga el mapa inicial sino carga 
        //la posicion del distrito seleccionado
        if(coordenada[0] == 0){
            initialize();
        }else{       
            //envia a la funcion coordenadas el arreglo coordenada y el zoom para que se acerque el mapa       
            coordenadas(coordenada, 10);             
        }                         
    });  

    $('#id_correg').change(function(){
        coordenada = $("#id_correg").find(':selected').val().split(',');                      
        if(coordenada[0] == 0){
            initialize();
        }else{
            //Inicializamos la función de google maps una vez el DOM este cargado                  
            coordenadas(coordenada, 14);             
        }
    });

    //Funcion que carga el mapa inicial con todos los marcadores de cada provincia del pais.
    var map = null;
    function initialize() {                  
        var myOptions = {
          center: new google.maps.LatLng(8.51516, -79.986131),            
          zoom: 7,
          mapTypeId: google.maps.MapTypeId.ROADMAP,              
          mapTypeControl: true,
          mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
          streetViewControl:false
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),myOptions);        
        //Obtener todos los marcadores en cada provincia y comarca extraidos del XML
        $.get(""+baseurl+"/assets/marcadores.xml",function(data) { 
            //Luego de obtener los datos del XML, busca el nodo hijo con nombre marca dentro del archivo XML
            //Y obtiene todos los atributos dentro del mismo
            $(data).find('marca').each(function(){
                var lat    = $(this).attr('latitud');  
                var lng    = $(this).attr('longitud');  
                var html   = $(this).attr('provincia');
                var point  = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));  //Posicion de cada provincia
                
                infowindow = new google.maps.InfoWindow({
                    content: ''
                })
                var icono  = new google.maps.MarkerImage(""+baseurl+"/imgs/provincia.png"); 
                marker = new google.maps.Marker({
                    position: point,
                    map:map,
                    html: html,
                    icon: icono
                });  
                google.maps.event.addListener(marker, "click", function () {                                    
                    infowindow.setContent(this.html);                   
                    infowindow.open(map, this);
                });
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    

    //Funcion para cargar los distintos marcadores al seleccionar provincia o distrito
    //Recibe el mapa original (map) y el arreglo con las coordenads y nombre de distritos o corregimientos, y el icono del marcador
    function setMarkers(map, locations, icono) {                        
        for (var i = 0; i < locations.length; i++) {            
            var newmarker = locations[i];                      
            var latlng = new google.maps.LatLng(newmarker[0], newmarker[1]);            
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                html: newmarker[2],
                icon: icono                
            });
            google.maps.event.addListener(marker, "click", function () {                                    
                infowindow.setContent(this.html);                   
                infowindow.open(map, this);
            });
        }
    }

    //Funcion para posicionar las provincias, distritos y corregimientos cuando se seleccionan
    var coordinate = null;
    var latlng = null;
    function coordenadas(coordinate, zoom){
        latlng = new google.maps.LatLng(coordinate[1], coordinate[2]);   
        var myOptions = {
          center: latlng,            
          zoom: zoom,          
          mapTypeId: google.maps.MapTypeId.ROADMAP,              
          mapTypeControl: true,
          mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
          streetViewControl:false
        };        
        map = new google.maps.Map(document.getElementById("map-canvas"),myOptions);                            
    }     
});
