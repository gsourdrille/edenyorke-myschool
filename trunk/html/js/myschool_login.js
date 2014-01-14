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
            		alert('ok');
            	}else{
            		alert(json['error']);
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