//--- TABULADOR DE LA NOMINA --------------------------------------------------------------------------------------------------------			
$(document).ready(function() {
	$('#tblDetalle').dataTable({
		"sPaginationType": "full_numbers",
		"ordering": false
	});
	$('#tblDetalle').css('width','100%');
});