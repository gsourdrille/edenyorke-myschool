$(document).ready(function() {
 
    $('#btn-add-classe').click(function(){
        $('#select-classe-from option:selected').each( function() {
                $('#select-classe-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
        });
    });
    $('#btn-remove-classe').click(function(){
        $('#select-classe-to option:selected').each( function() {
            $(this).remove();
        });
    });
        
   
	
	$('#avatar_upload').uploadFile({
		url:'/core/controller/upload_controller.php',
		fileName:"Filedata",
		formData : { 'type' : 'image', 'taille' : '200' },
		showStatusAfterSuccess:false,
		autoSubmit:true,
		multiple:false,
		maxFileSize:1024*5000,
		dragDropStr: "<span><b>Faites glisser et déposez l'image</b></span>",
		abortStr:"abandonner",
		extErrorStr:"n'est pas autorisé. Extensions autorisées:",
		sizeErrorStr:"n'est pas autorisé. Admis taille max:",
		multiDragErrorStr: "Plusieurs Drag & Drop de fichiers ne sont pas autorisés.",
		onSuccess:function(files,data,xhr){
			var myFile = jQuery.parseJSON(data);
			if(myFile.error){
				$("#error_upload_avatar").show();
				$("#error_upload_avatar").append(myFile.error_message);
				$("#admin_image").show();
	    	    $("#upload_image").hide();
			}else{
				$("#error_upload_avatar").hide();
				$("#error_upload_avatar").html("");
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&f=0";
	    		$("#avatar_image").attr("src",$url);
	    		$("#admin_image").show();
	    	    $("#upload_image").hide();
	    	    $("#userfileId").val(myFile.path);
			}
		}
	});
	
	$('#etablissement_principale_upload').uploadFile({
		url:'/core/controller/upload_controller.php',
		fileName:"Filedata",
		formData : { 'type' : 'image', 'taille' : '200' },
		showStatusAfterSuccess:false,
		autoSubmit:true,
		multiple:false,
		maxFileSize:1024*5000,
		dragDropStr: "<span><b>Faites glisser et déposez l'image</b></span>",
		abortStr:"abandonner",
		extErrorStr:"n'est pas autorisé. Extensions autorisées:",
		sizeErrorStr:"n'est pas autorisé. Admis taille max:",
		multiDragErrorStr: "Plusieurs Drag & Drop de fichiers ne sont pas autorisés.",
		onSuccess:function(files,data,xhr){
			var myFile = jQuery.parseJSON(data);
			if(myFile.error){
				$("#error_upload_principale").show();
				$("#error_upload_principale").append(myFile.error_message);
				$("#admin_image").show();
	    	    $("#upload_image").hide();
			}else{
				$("#error_upload_principale").hide();
				$("#error_upload_principale").html("");
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&f=0";
	    		$("#etablissement_image_principale").attr("src",$url);
	    		$("#admin_image").show();
	    	    $("#upload_image").hide();
	    	    $("#etablissementImagePrincipaleId").val(myFile.path);
			}
		}
	});
	
	$('#etablissement_fond_upload').uploadFile({
		url:'/core/controller/upload_controller.php',
		fileName:"Filedata",
		formData : { 'type' : 'image', 'taille' : '1000' },
		showStatusAfterSuccess:false,
		autoSubmit:true,
		multiple:false,
		maxFileSize:1024*5000,
		dragDropStr: "<span><b>Faites glisser et déposez l'image</b></span>",
		abortStr:"abandonner",
		extErrorStr:"n'est pas autorisé. Extensions autorisées:",
		sizeErrorStr:"n'est pas autorisé. Admis taille max:",
		multiDragErrorStr: "Plusieurs Drag & Drop de fichiers ne sont pas autorisés.",
		onSuccess:function(files,data,xhr){
			var myFile = jQuery.parseJSON(data);
			if(myFile.error){
				$("#error_upload_fond").show();
				$("#error_upload_fond").append(myFile.error_message);
				$("#admin_image_fond").show();
	    	    $("#upload_image_fond").hide();
			}else{
				$("#error_upload_fond").hide();
				$("#error_upload_fond").html("");
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&f=0";
	    		$("#etablissement_image_fond").attr("src",$url);
	    		$("#admin_image_fond").show();
	    	    $("#upload_image_fond").hide();
	    	    $("#etablissementImageFondId").val(myFile.path);
			}
		}
	});
	
	
});





	
 function loadNiveaux() {
    var selectBox = document.getElementById("liste_niveaux");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.location.href='/classes/niveaux/'+selectedValue;
}
 
 function loadClasses() {
	    var selectBox = document.getElementById("liste_classes");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='/classes/classes/'+selectedValue;
	}
 
 function loadEnseignants() {
	    var selectBox = document.getElementById("liste_enseignants");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='/enseignants/'+selectedValue;
	}
 
 function loadEleves() {
	    var selectBox = document.getElementById("liste_eleves");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='/eleves/'+selectedValue;
	}
 
 function selectAllClasses(){
	 $("#select-classe-to option").prop('selected', 'selected');
 }
 
 function showUploadImagePrincipaleButton(){
	 $("#admin_image").hide();
     $("#upload_image").show();

 }

 
 function hideUploadButton(){
	 $("#admin_image").show();
     $("#upload_image").hide();

 }
 
 
 function showUploadImageFondButton(){
	 $("#admin_image_fond").hide();
     $("#upload_image_fond").show();

 }
 
  function hideUploadImageFondButton(){
	 $("#admin_image_fond").show();
     $("#upload_image_fond").hide();

 }

 
 
 
 
 
 function addClasse(){
		var $form = $("#ajoutClasseUserForm");
			$data = $form.serialize() + "&action=ADD";
	         $.ajax({
	            url: $form.attr('action'), 
	            type: $form.attr('method'), 
	            data: $data, 
	            dataType: 'json',
	            success: function(json) {
	            	$("#ajoutClasseUser").html("");
	            	$("#ajoutClasseUser").load( "/html/html/admin/admin_infos/admin_liste_classes.php");
	            }            
	       });
		   return false;  
 }
 
 function deleteClasse(){
		var $form = $("#ajoutClasseUserForm");
			$data = $form.serialize() + "&action=DELETE";
	         $.ajax({
	            url: $form.attr('action'), 
	            type: $form.attr('method'), 
	            data: $data, 
	            dataType: 'json',
	            success: function(json) {
	            	$("#ajoutClasseUser").html("");
	            	$("#ajoutClasseUser").load( "/html/html/admin/admin_infos/admin_liste_classes.php");
	            }            
	       });
		   return false;  
}
 
  
 function deleteAvatar(){
	 $("#userfileId").val("delete");
	 $("#avatar_image").attr("src","/html/images/icon_user.png");
 }
 
 function deleteImagePrincipale(){
	 $("#etablissementImagePrincipaleId").val("delete");
	 $("#etablissement_image_principale").attr("src","/html/images/defaut_image_etablissement.jpeg");
 }
 
 function deleteImageFond(){
	 $("#etablissementImageFondId").val("delete");
	 $("#etablissement_image_fond").attr("src","/html/images/defaut_image_etablissement.jpeg");
 }
 
 

 
