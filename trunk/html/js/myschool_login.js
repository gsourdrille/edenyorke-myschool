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
   
var $demandeInscriptionform = $('#demandeInscriptionForm');
	
	$('#envoyerDemandeInscription').on('click', function() {
		$demandeInscriptionform.trigger('submit');
		return false;
	});
	
	$demandeInscriptionform.on('submit', function() {
		$.ajax({
            url: "/myschool/core/controller/demande_inscription_controller.php", 
            type: $demandeInscriptionform.attr('method'), 
            data: $demandeInscriptionform.serialize(), 
            dataType: 'json',
            success: function(json) {
            	if(json['reponse']=='ok'){
            		$("#demande_inscription_succes").show();
            		$("#register_etablissement_conteneur").hide();
            	}else{
            		$("#error_demande_inscription").show();
            		$("#error_demande_inscription").html("");
            		$("#error_demande_inscription").append(json['error']);
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
 
 function showDemandeInsciptionBox(){
	 $("#login_conteneur").hide();
	 $("#register_etablissement_conteneur").show();
 }
 
 function hideDemandeInsciptionBox(){
	 $("#login_conteneur").show();
	 $("#register_etablissement_conteneur").hide();
 }