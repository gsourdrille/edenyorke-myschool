$(document).ready(function() {

});
function demandeInscription(){
	var $form = $("#demandeInscriptionForm");
		$data = $form.serialize();
         $.ajax({
            url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $data, 
            dataType: 'json',
            success: function(json) {
            	if(json['error']){
            		$("#error_demande_generale").hide();
            		$("#error_demande_login").hide();
            		$("#error_demande_mdp").hide();
            		$("#error_demande_nom").hide();
        			$("#error_demande_prenom").hide();
            		$("#error_demande_tel").hide();
            		$("#error_demande_nom_etablissement").hide();
            		
            		if(json['error_login']){
            			$("#error_demande_login").show();
            			$("#error_demande_login").html(json['error_login']);
            		}
            		if(json['error_mdp']){
            			$("#error_demande_mdp").show();
            			$("#error_demande_mdp").html(json['error_mdp']);
            		}
            		if(json['error_nom']){
            			$("#error_demande_nom").show();
            			$("#error_demande_nom").html(json['error_nom']);
            		}
            		if(json['error_prenom']){
            			$("#error_demande_prenom").show();
            			$("#error_demande_prenom").html(json['error_prenom']);
            		}
            		if(json['error_tel']){
            			$("#error_demande_tel").show();
            			$("#error_demande_tel").html(json['error_tel']);
            		}
            		if(json['error_generale']){
            			$("#error_demande_generale").show();
            			$("#error_demande_generale").html(json['error_generale']);
            		}
            		if(json['error_nom_etablissement']){
            			$("#error_demande_nom_etablissement").show();
            			$("#error_demande_nom_etablissement").html(json['error_nom_etablissement']);
            		}
            	}else{
            		$("#error_demande_generale").hide();
            		$("#error_demande_login").hide();
            		$("#error_demande_mdp").hide();
            		$("#error_demande_nom").hide();
        			$("#error_demande_prenom").hide();
            		$("#error_demande_tel").hide();
            		$("#error_demande_nom_etablissement").hide();
            		$("#demande_inscription_succes").show();
            		$("#register_etablissement_conteneur").hide();
            	}
            }  
       });
	   return false;  
}

function demandeNouveauMotDePasse(){
	var $form = $("#forgotForm");
		$data = $form.serialize();
         $.ajax({
            url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $data, 
            dataType: 'json',
            success: function(json) {
            	if(json['error']){
            		$("#error_forgot_general").hide();
            		if(json['error_login']){
            			$("#error_forgot_general").show();
            			$("#error_forgot_general").html(json['error_login']);
            		}
            	}else{
            		$("#forgot_conteneur_succes").show();
            		$("#forgot_conteneur").hide();
            	}
            }  
       });
	   return false;  
}

function login(){
	var $form = $("#loginForm");
		$data = $form.serialize();
         $.ajax({
            url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $data, 
            dataType: 'json',
            success: function(json) {
            	if(json['error']){
            		$("#error_login_general").hide();
            		if(json['error_login']){
            			$("#error_login_general").show();
            			$("#error_login_general").html(json['error_login']);
            		}
            	}else{
            		window.location = '/myschool/core/controller/tableau_controller.php';
            	}
            }  
       });
	   return false;  
}

function inscription(){
	var $form = $("#inscriptionForm");
		$data = $form.serialize();
         $.ajax({
            url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $data, 
            dataType: 'json',
            success: function(json) {
            	if(json['error']){
            		$("#error_inscription_general").hide();
            		$("#error_inscription_login").hide();
            		$("#error_inscription_mdp").hide();
            		$("#error_inscription_nom").hide();
        			$("#error_inscription_prenom").hide();
            		$("#error_inscription_code").hide();
            		
            		if(json['error_login']){
            			$("#error_inscription_login").show();
            			$("#error_inscription_login").html(json['error_login']);
            		}
            		if(json['error_mdp']){
            			$("#error_inscription_mdp").show();
            			$("#error_inscription_mdp").html(json['error_mdp']);
            		}
            		if(json['error_nom']){
            			$("#error_inscription_nom").show();
            			$("#error_inscription_nom").html(json['error_nom']);
            		}
            		if(json['error_prenom']){
            			$("#error_inscription_prenom").show();
            			$("#error_inscription_prenom").html(json['error_prenom']);
            		}
            		if(json['error_code']){
            			$("#error_inscription_code").show();
            			$("#error_inscription_code").html(json['error_code']);
            		}
            		if(json['error_general']){
            			$("#error_inscription_general").show();
            			$("#error_inscription_general").html(json['error_general']);
            		}
            	}else{
            		$("#error_inscription_general").hide();
            		$("#error_inscription_login").hide();
            		$("#error_inscription_mdp").hide();
            		$("#error_inscription_nom").hide();
        			$("#error_inscription_prenom").hide();
            		$("#error_inscription_code").hide();
            		$("#inscription_succes").show();
            		$("#register_conteneur").hide();
            	}
            }  
       });
	   return false;  
}


 
 function showInscriptionBox(){
	 $("#login_conteneur").hide();
	 $("#register_conteneur").show();
 }
 
 function hideInscriptionBox(){
	 $("#login_conteneur").show();
	 $("#register_conteneur").hide();
 }
 
 
 function hideInscriptionSuccesBox(){
	 $("#login_conteneur").show();
	 $("#inscription_succes").hide();
 }
 
 function showDemandeInscriptionBox(){
	 $("#login_conteneur").hide();
	 $("#register_etablissement_conteneur").show();
 }
 
 function hideDemandeInscriptionBox(){
	 $("#login_conteneur").show();
	 $("#register_etablissement_conteneur").hide();
 }
 
 
 function hideDemandeSuccesBox(){
	 $("#login_conteneur").show();
	 $("#demande_inscription_succes").hide();
 }
 function showForgotBox(){
	 $("#login_conteneur").hide();
	 $("#forgot_conteneur").show();
 }
 
 function hideForgotBox(){
	 $("#login_conteneur").show();
	 $("#forgot_conteneur").hide();
 }
 
 function hideForgotSuccesBox(){
	 $("#login_conteneur").show();
	 $("#forgot_conteneur_succes").hide();
 }