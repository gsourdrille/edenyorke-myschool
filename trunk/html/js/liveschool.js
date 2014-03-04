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
    
   
    
    $('#add_more').click(function(e){
        e.preventDefault();
        $(this).before("<input name='postfile[]' type='file'/>");
    });
    
    
    
    var $form = $('#postForm');
	
	$('#envoyer').on('click', function() {
		$form.trigger('submit');
		return false;
	});
	
	$form.on('submit', function() {
		tinyMCE.get("newPostArea").save();
		var formData = new FormData($(this)[0]);
           $.ajax({
        	    url: $(this).attr('action'), 
                type: $(this).attr('method'), 
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(json) {
                	if(json['error']){
                		$('#post_error').html("");
                		$('#post_error').append(json["error_message"]);
                	}else{
                	closeNewPost();
	                	$('#zonePosts').html("");
	                	$('#zonePosts').load("/html/html/main/zone_posts.php");
                	}
                }            
           });
           return false;  
    });
	
	 $('#avatar_upload').uploadify({
	        'buttonImage' : '/html/images/upload_button.png',
		 	'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'image' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&x=100&y=100&f=0";
	    		$("#avatar_image").attr("src",$url);
	    		$("#admin_image").show();
	    	    $("#upload_image").hide();
	    	    $("#userfileId").val(myFile.path);
	    	
	    	}
	    });
	 
	 $('#etablissement_principale_upload').uploadify({
		 	'buttonImage' : '/html/images/upload_button.png',
	        'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'image' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&x=100&y=100&f=0";
	    		$("#etablissement_image_principale").attr("src",$url);
	    		$("#admin_image").show();
	    	    $("#upload_image").hide();
	    	    $("#etablissementImagePrincipaleId").val(myFile.path);
	    	}
	    });
	 
	 $('#etablissement_fond_upload').uploadify({
		 	'buttonImage' : '/html/images/upload_button.png',
	        'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'image' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$url="/core/controller/thumb_controller.php?src="+myFile.path+"&x=100&y=100&f=0";
	    		$("#etablissement_image_fond").attr("src",$url);
	    		$("#admin_image_fond").show();
	    	    $("#upload_image_fond").hide();
	    	    $("#etablissementImageFondId").val(myFile.path);
	    	}
	    });
	    
	 
	 $('#upload_file').uploadify({
		 	'buttonImage' : '/html/images/upload_button.png',
	        'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'file' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$("#postFileId").append("<input id=\"FILE_"+myFile.id+"\" type=\"hidden\" name=\"postFile[]\" value=\""+myFile.name+"\" />");
	    		var filePreview;
	    		if(myFile.type == "image"){
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"> <img class=\"postPjThumbnails\" src=\"/core/controller/thumb_controller.php?src="+myFile.path+"&x=30&y=30&f=0 \"></a>";
	    		}else{
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"><img class=\"postPjThumbnails\" src=/html/images/icone-document.jpg title=\""+myFile.name+"\"></a>";
	    		}
	    		$("#listeFilePreview").append(filePreview);
	    	},
	    	'onUploadError' : function(file, errorCode, errorMsg, errorString) {
	            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
	        }
	    });
	    
	 
	 $('#upload_file_edit').uploadify({
		 	'buttonImage' : '/html/images/upload_button.png',
	        'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'file' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$("#postFileAddId").append("<input id=\"FILE_"+myFile.id+"\" type=\"hidden\" name=\"postFile[]\" value=\""+myFile.name+"\" />");
	    		var filePreview;
	    		if(myFile.type == "image"){
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"> <img class=\"postPjThumbnails\" src=\"/core/controller/thumb_controller.php?src="+myFile.path+"&x=30&y=30&f=0 \"></a>";
	    		}else{
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"><img class=\"postPjThumbnails\" src=/html/images/icone-document.jpg title=\""+myFile.name+"\"></a>";
	    		}
	    		$("#listeFileEditPreview").append(filePreview);
	    	},
	    	'onUploadError' : function(file, errorCode, errorMsg, errorString) {
	            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
	        }
	    });
	
	tinyMCE.init({  
        mode : "exact",  
        theme : "modern", 
        menubar:false,
        statusbar:false,
        toolbar:'undo redo | bold italic underline | bullist numlist | removeformat',
        elements : "newPostArea"  ,
        height:"167px",  
        width:"310px"  
        });
    
    
   
    
    
	
});




function deleteFile(id){
	var prev = "#PREV_"+id;
	var file = "#FILE_"+id;
	$(file).remove();
	$(prev).remove();
}

function deletePj(idPj,idPost){
	$("#postFileDeleteId"+idPost).append("<input type=\"hidden\" name=\"postDeleteFile[]\" value=\""+idPj+"\" />");
	var prev = "#PREV_"+idPj;
	$(prev).remove();
}


function sendComment(idForm,idDiv){
	var $div = "#"+idDiv.id;
	var $form = $(idForm);
         $sendComment = $.ajax({
        	url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $form.serialize(), 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/html/html/main/zone_posts.php", function() {
            		$($div).show();
            	});
            	
            }            
       });
	   return false;  
}

function editComment(idCommentaire,idDiv){
	var $div = "#"+idDiv.id;
	var $form = $("#commentEditForm"+idCommentaire);
         $sendComment = $.ajax({
        	url: $form.attr('action'), 
            type: $form.attr('method'), 
            data: $form.serialize(), 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/html/html/main/zone_posts.php", function() {
            		$($div).show();
            	});
            	
            }            
       });
	   return false;  
}

function deleteCommentaire(idCommentaire,idDiv){
	var myPostData="action=DELETE&idCommentaire="+idCommentaire;
	var $div = "#"+idDiv.id;
         $.ajax({
            url: "/core/controller/create_comment_controller.php", 
            type: "POST", 
            data: myPostData, 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/html/html/main/zone_posts.php", function() {
            		$($div).show();
            	});
            	
            }            
       });
	   return false;  
}

	
 function loadNiveaux() {
    var selectBox = document.getElementById("liste_niveaux");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.location.href='admin_niveaux_controller.php?action=showNiveau&idNiveau='+selectedValue;
}
 
 function loadClasses() {
	    var selectBox = document.getElementById("liste_classes");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='admin_niveaux_controller.php?action=showClasse&idClasse='+selectedValue;
	}
 
 function loadEnseignants() {
	    var selectBox = document.getElementById("liste_enseignants");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='admin_enseignants_controller.php?action=showEnseignant&idUser='+selectedValue;
	}
 
 function loadEleves() {
	    var selectBox = document.getElementById("liste_eleves");
	    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	    document.location.href='admin_eleves_controller.php?action=showEleve&idUser='+selectedValue;
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
 
 function showComment(id){
	 $(id).show();
 }
 
 function hideComment(id){
	 $(id).hide();
 }
 
 
 
 function openNewPost(){
	$("#link_new_post").hide();
    $("#zone_new_post").fadeIn(1000);
    tinyMCE.get("newPostArea").setContent('');
 	$("#postFileId").html('');
 	$("#listeFilePreview").html('');
 	$("#selectRight").multiselect({
   	   selectedText: "# of # selected",
   	   minWidth:"154px",
   	   autoOpen:true,
   	   header: false,
   	   selectedList: 4,
   	   height:"135px",
   	   noneSelectedText: 'Pour qui ?',
   	   position: {
   		      my: 'left top',
   		      at: 'left bottom'
   	   }
   	});
 	$("#selectRight").multiselect("uncheckAll");
 	$("#allowCommentNew").prop('checked',true);
 	$("#onlyEnseignantNew").prop('checked',false);
 	}
 
 function closeNewPost(){
	 $("#link_new_post").show();
     $("#zone_new_post").fadeOut(500);
 }
 function showAssoPost(){
	 $("#step2").show();
     $("#step1").hide();
 }
 
 function hideAssoPost(){
	 $("#step2").hide();
     $("#step1").show();
 }
 
 function showEditPost(idPost){
	 $("#post_content_"+idPost).hide();
	 $("#edit_post_"+idPost).show();
	 $("#selectRight"+idPost).multiselect({
	  	   selectedText: "# of # selected",
	  	   minWidth:"154px",
	  	   autoOpen:true,
	  	   header: false,
	  	   selectedList: 4,
	  	   height:"135px",
	  	   noneSelectedText: 'Pour qui ?',
	  	   position: {
	  		      my: 'left top',
	  		      at: 'left bottom'
	  	   }
	  	});
	 
	 tinyMCE.init({  
	        mode : "exact",  
	        theme : "modern", 
	        menubar:false,
	        statusbar:false,
	        toolbar:'undo redo | bold italic underline | bullist numlist | removeformat',
	        elements : "editPostArea"+idPost  ,
	        height:"167px",  
	        width:"310px"  
	        });
	 
	 
	    $("#add_more"+idPost).click(function(e){
	        e.preventDefault();
	        $(this).before("<input name='postfile[]' type='file'/>");
	    });
	    
	    $('#upload_file_edit'+idPost).uploadify({
		 	'buttonImage' : '/html/images/upload_button.png',
	        'swf'      : '/html/js/uploadify/uploadify.swf',
	        'uploader' : '/core/controller/upload_controller.php',
	        'formData' : { 'type' : 'file' },
	        'fileSizeLimit' : '6MB',
	    	'onUploadSuccess' : function(file, data, response) {
	    		var myFile = jQuery.parseJSON(data);
	    		$("#postFileAddId"+idPost).append("<input id=\"FILE_"+myFile.id+"\" type=\"hidden\" name=\"postFile[]\" value=\""+myFile.name+"\" />");
	    		var filePreview;
	    		if(myFile.type == "image"){
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"> <img class=\"postPjThumbnails\" src=\"/core/controller/thumb_controller.php?src="+myFile.path+"&x=30&y=30&f=0 \"></a>";
	    		}else{
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"><img class=\"postPjThumbnails\" src=/html/images/icone-document.jpg title=\""+myFile.name+"\"></a>";
	    		}
	    		$("#listeFileEditPreview"+idPost).append(filePreview);
	    	},
	    	
	    });
	 
 }
 
 function hideEditPost(idPost){
	 $("#post_content_"+idPost).show();
	 $("#edit_post_"+idPost).hide();
 }
 

 
 function editPost(idPost){
	 	tinyMCE.triggerSave();
		var $form = $("#postEditForm"+idPost);
		var formData = new FormData($form[0]);
	         $.ajax({
	        	 	url: $form.attr('action'), 
	                type: $form.attr('method'), 
	                data: formData,
	                async: false,
	                cache: false,
	                contentType: false,
	                processData: false,
	                dataType: 'json',
	                success: function(json) {
	                	if(json['error']){
	                		$('#post_error'+idPost).html("");
	                		$('#post_error'+idPost).append(json["error_message"]);
	                	}else{
		                	closeNewPost();
		                	$('#zonePosts').html("");
		                	$('#zonePosts').load("/html/html/main/zone_posts.php");
	                	}
	                }             
	       });
		   return false;  
	}
 
 
 function deletePost(idPost){
	 $('#dialog-confirm-delete-post').dialog({
	    autoOpen: false,
	    modal: true,
	    buttons: {
	        'Oui': function () {
	        	var myPostData="action=DELETE&idPost="+idPost;
		         $.ajax({
		            url: "/core/controller/create_post_controller.php", 
		            type: "POST", 
		            data: myPostData, 
		            dataType: 'json',
		            success: function(json) {
		            	$('#dialog-confirm-delete-post').dialog('close');
		            	$('#dialog-confirm-delete-post').dialog('destroy');
		            	$("#zonePosts").html("");
		            	$("#zonePosts").load( "/html/html/main/zone_posts.php");
		            	
		            }            
		       });
			   return false;  
	        },
	        'Non': function () {
	            $(this).dialog('close');
	        }
	    }
	});
	 
	 $( "#dialog-confirm-delete-post" ).dialog( "open" );
 }
 
 
 function showEditCommentaire(idComment){
	 $("#comment_content_"+idComment).hide();
	 $("#edit_commentaire_"+idComment).show();
 }
 
 function hideEditCommentaire(idComment){
	 $("#comment_content_"+idComment).show();
	 $("#edit_commentaire_"+idComment).hide();
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
 
 function showMorePost(offset){
	      $.get("/html/html/main/zone_posts.php?offset="+offset+" #morePosts", function(data) {
	    	     $("#morePosts").replaceWith(data);
	    	});
}
 
 function showGaleria(idPost){
	 $("#dialog-galeria").html("");
	 $("#dialog-galeria").load("/html/html/main/visionneuse.php?idPost="+idPost);
	 $('#dialog-galeria').dialog({
	   autoOpen: false,
	    modal: true,
	    width: 720,
	    open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#dialog-galeria').dialog('close');
            })
        }
	    
       });

	 $( "#dialog-galeria" ).dialog( "open" );
	 Galleria.loadTheme('/html/js/galleria/themes/classic/galleria.classic.min.js');
	 Galleria.run('.galleria', {
		 width: 700,
		 height: 467
		});
 }
 
 
 
 
 function changeEtablissement(id){
	document.location.href='change_etablissement_controller.php?etablissement='+id;
		 
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
 
 

 
