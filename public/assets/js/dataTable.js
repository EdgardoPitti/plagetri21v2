$(function () {
	
	$("#table-medico").bootstrapTable({
		height: 415,
		url: baseurl+'/medicos',
		search: true,
		sidePagination: 'server',
		pagination: true
	});
	$("#table-paciente").bootstrapTable({
		height: 380,
		url: baseurl+'/pacientes/0',
		search: true,
		sidePagination: 'server',
		pagination: true
	}); 
    $("#table-cita").bootstrapTable({
        height: 380,
        url: baseurl+'/pacientes/1',
        search: true,
        sidePagination: 'server',
        pagination: true
    });
    /*filtro activo por departamento*/
    var $activo_departamento = $("#table_activo_departamento");
    $activo_departamento.bootstrapTable({
        height: 380,
        url: baseurl+'/departamento',        
        sidePagination: 'server',
        pagination: true,
        pageSize: 100,
        pageList: "[20,100,200,1000]",
        queryParams: function(p){
        	return {
        		search: $('#search').val(),
        		order: p.order,				
				limit: p.limit,
            	offset: p.offset,
        	};
        },
        responseHandler: function(res) {
			disablePrint(res.total);
			return res;

		}        
    });
   	
    $('#search').change(function (e) {
    	e.preventDefault();    	
    	var id = $(this).val();
		var opcion;
		$activo_departamento.bootstrapTable('refresh',{query: {search: id }});	
		//modifica enlace para la impresion de los departamentos	
		$('.print-depto').attr('href', baseurl + '/imprimir/departamento/' + id);
		
		opcion = $('option:selected', this).text();	
		if($(this).val() == 0){
			opcion = 'Todos';
		}
		$('span.title').html(opcion);
	});
    //Si no existen datos deshabilita el enlace y muestrar un error
   	function disablePrint(res){
   		if(res === 0){
   			$('.print-depto').addClass('disabled');
   			$('#alert').removeClass('hide');
   		}else{
   			$('.print-depto').removeClass('disabled');
   			$('#alert').addClass('hide');
   		}
   	}
    
    /*cambio del activo por departamento*/

	$('.cita-anterior').bootstrapTable({
		height: 150
	});
	$("#mediana-marcadores").bootstrapTable({
		height: 250
	});
	$(".modulo").bootstrapTable({
		height: 195
	});			
	$("#config").bootstrapTable({
		height: 250
	});			
	$('.agenda').bootstrapTable({
		height: 180
	});
	$('#table-activo').bootstrapTable({
		height: 300,
		url: baseurl+'/getactivos/0',
		search: true,
		sidePagination: 'server',
		pagination: true
	});
    $('#table-mantenimiento').bootstrapTable({
		height: 300,
		url: baseurl+'/getactivos/1',
		search: true,
		sidePagination: 'server',
		pagination: true
    });
	$('.list-act').bootstrapTable({
		height: 150
	});
	$('.mantenimientos').bootstrapTable({
		height: 180
	});
});