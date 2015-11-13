function eliminar(id) {
	swal({
	  title: "¿Está seguro de eliminarlo?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Si, seguro!",
	  cancelButtonText: "Cancelar",
	  closeOnConfirm: false
	},
	function(){
	  var form = $('#form-delete');
      var action = form.attr('action').replace('USER_ID', id);
      var row =  $(this).parents('tr');
       
      $.post(action, form.serialize(), function(result) {
         if (result.success) {
         	var ruta = ""+baseurl+"/"+result.route;	            	
         	window.location.replace(ruta);                         
         } else {
            row.show();
         }
      }, 'json');
	});
}