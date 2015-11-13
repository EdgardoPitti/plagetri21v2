(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this), search = $this.val().toLowerCase(), target = $this.attr('data-filters'), $target = $(target), $rows = $target.find('tbody tr');
					if(search == '') {
						$rows.show(); 
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<div class="filterTable_no_results" style="color:red; width:100%;">No se encuentran Datos.</div>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();
	
	$('.container').on('click', '.panel-heading span.filter', function(e){
		var $this = $(this), 
				$panel = $this.parents('.panel');
		
		$panel.find('.panel-body').slideToggle();
		if($this.css('display') != 'block') {
			$panel.find('.panel-body').show();
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
});

function show(id) {	
    var host = window.location.host; 
	$.post(""+baseurl+"/medicos/getmedicos",            
	  { medico: id }, 
	  function(data){	    
       $("#loading").fadeIn().html('<img alt="Medico" src="'+baseurl+'/imgs/loading.gif" style="width:20px;">');
		 var datos = "<h4><label>"+data.first_name+" "+data.second_name+" "+data.last_name+" "+data.last_sec_name+"</label></h4><div class='row showDatos'>";	  	 
	  	 datos += "<div class='col-md-3 col-lg-3' align='center'> <img alt='Medico' src='"+baseurl+"/imgs/"+data.foto+"' class='img-rounded' style='width:80px;'> </div>";
       datos += "<div class=' col-md-9 col-lg-9 '>";
       datos += "<table class='table table-user-information'><tbody>"; 
       datos += "<tr><td>Extensi&oacute;n:</td><td><label></label>"+data.extension+"</td></tr>";  
       datos += "<tr><td>Especialidad:</td><td><label>"+data.especiality+"</label></td></tr>";    
       datos += "<tr><td>Nivel:</td><td><label>"+data.level+"</label></td></tr>";
       datos += "<tr><td>Ubicación:</td><td><label>"+data.ubicacion+"</label></td></tr>";      
       datos += "<tr><td>Observación:</td><td><label>"+data.observacion+"</label></td></tr></tbody></table></div></div>";      
       
       setTimeout(function() {
			$("#loading").fadeOut();        
		 }, 2500);
       $("#showdatos").html(datos);      
		            
	}, 'json');
}
//Mostrar loading al hacer submit en configuracion
jQuery(document).ready(function ($) {
	$("#form-load").submit(function () {					
		$("#processing-modal").modal('show');

		return true;				
	});    			
});
jQuery(document).ready(function ($) {
  $('#scrollbar').perfectScrollbar();
  $('#scrollbar2').perfectScrollbar();
  $('#scrollbar3').perfectScrollbar();
  $('#scrollbar4').perfectScrollbar();	  
});
$(document).ready(function() {
 $('#condiciones').fixedHeaderTable();
});

//recibe valores del boton
function baja(btn){
	id = btn.value;
	title = btn.title
	var activoClass = $('.activo');
	activoClass.empty();
	$('#form_baja').attr("action", baseurl + '/bajaactivo/' + id );
	activoClass.append("<i class='fa fa-trash-o'></i> "+title);
	$('#modalBaja').modal(show);
}