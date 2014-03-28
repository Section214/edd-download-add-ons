jQuery(document).ready(function($){
	$( '#is_add_on' ).click(function(e){	
		if ($(this).is(':checked')){
			$('#is_add_on_for').show();
		} else {
			$('#is_add_on_for').hide();
		}	
	});	
});