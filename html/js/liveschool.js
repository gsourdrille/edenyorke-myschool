$(document).ready(function() {
    
    
    
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
	
	
	
	
	
	$('#upload_file').uploadFile({
		url:'/core/controller/upload_controller.php',
		fileName:"Filedata",
		formData : { 'type' : 'file', 'taille' : '1000' },
		showStatusAfterSuccess:false,
		autoSubmit:true,
		multiple:true,
		maxFileSize:1024*5000,
		dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
		abortStr:"abandonner",
		extErrorStr:"n'est pas autorisé. Extensions autorisées:",
		sizeErrorStr:"n'est pas autorisé. Admis taille max:",
		onSuccess:function(files,data,xhr){
			var myFile = jQuery.parseJSON(data);
    		$("#postFileId").append("<input id=\"FILE_"+myFile.id+"\" type=\"hidden\" name=\"postFile[]\" value=\""+myFile.name+"\" />");
    		var filePreview;
    		if(myFile.type == "image"){
    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"> <img class=\"postPjThumbnails\" src=\"/core/controller/thumb_controller.php?src="+myFile.path+"&x=30&y=30&f=0&resize=true  \"></a>";
    		}else{
    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"><img class=\"postPjThumbnails\" src=/html/images/icone-document.jpg title=\""+myFile.name+"\"></a>";
    		}
    		$("#listeFilePreview").append(filePreview);
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
	    
	    
	    
	    $('#upload_file_edit'+idPost).uploadFile({
			url:'/core/controller/upload_controller.php',
			fileName:"Filedata",
			formData : { 'type' : 'file', 'taille' : '1000' },
			showStatusAfterSuccess:false,
			autoSubmit:true,
			multiple:true,
			maxFileSize:1024*5000,
			dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
			abortStr:"abandonner",
			extErrorStr:"n'est pas autorisé. Extensions autorisées:",
			sizeErrorStr:"n'est pas autorisé. Admis taille max:",
			onSuccess:function(files,data,xhr){
				var myFile = jQuery.parseJSON(data);
	    		$("#postFileAddId"+idPost).append("<input id=\"FILE_"+myFile.id+"\" type=\"hidden\" name=\"postFile[]\" value=\""+myFile.name+"\" />");
	    		var filePreview;
	    		if(myFile.type == "image"){
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"> <img class=\"postPjThumbnails\" src=\"/core/controller/thumb_controller.php?src="+myFile.path+"&x=30&y=30&f=0&resize=true  \"></a>";
	    		}else{
	    			filePreview = "<a id=\"PREV_"+myFile.id+"\" href=\"#dev\" onclick=\"deleteFile("+myFile.id+")\"><img class=\"postPjThumbnails\" src=/html/images/icone-document.jpg title=\""+myFile.name+"\"></a>";
	    		}
	    		$("#listeFileEditPreview"+idPost).append(filePreview);
			}
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
	document.location.href='/etablissement/'+id;
		 
 }
 
 
