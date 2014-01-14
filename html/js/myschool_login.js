$(document).ready(function() {

var $form = $('#inscriptionForm');
	
	$('#envoyer').on('click', function() {
		$form.trigger('submit');
		return false;
	});
	
	$form.on('submit', function() {
		$.ajax({
            url: "/myschool/core/controller/inscription_controller.php", 
            type: $form.attr('method'), 
            data: $form.serialize(), 
            dataType: 'json',
            success: function(json) {
            	if(json['reponse']=='ok'){
            		$("#inscription_succes").show();
            		$("#register_conteneur").hide();
            	}else{
            		$("#error_inscription").show();
            		$("#error_inscription").html("");
            		$("#error_inscription").append(json['error']);
            	}
            	
            }            
       });
	   return false;  
    });
   
	
});



 
 function showInsciptionBox(){
	 $("#login_conteneur").hide();
	 $("#register_conteneur").show();
 }
 
 function hideInsciptionBox(){
	 $("#login_conteneur").show();
	 $("#register_conteneur").hide();
 }