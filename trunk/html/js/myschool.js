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
                url: "/myschool/core/controller/create_post_controller.php", 
                type: $(this).attr('method'), 
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(json) {
                	closeNewPost();
                	$('#zonePosts').html("");
                	$('#zonePosts').load("/myschool/html/html/main/zone_posts.php");
                }            
           });
           return false;  
    });
	
	var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
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


function sendComment(idForm,idDiv){
	var $div = "#"+idDiv.id;
	var $form = $(idForm);
         $sendComment = $.ajax({
            url: "/myschool/core/controller/create_comment_controller.php", 
            type: $form.attr('method'), 
            data: $form.serialize(), 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/myschool/html/html/main/zone_posts.php", function() {
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
            url: "/myschool/core/controller/create_comment_controller.php", 
            type: $form.attr('method'), 
            data: $form.serialize(), 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/myschool/html/html/main/zone_posts.php", function() {
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
            url: "/myschool/core/controller/create_comment_controller.php", 
            type: "POST", 
            data: myPostData, 
            dataType: 'json',
            success: function(json) {
            	$("#zonePosts").html("");
            	$("#zonePosts").load( "/myschool/html/html/main/zone_posts.php", function() {
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
     $("#zone_new_post").show();
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
 }
 
 function closeNewPost(){
	 $("#link_new_post").show();
     $("#zone_new_post").hide();
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
	 
 }
 
 function hideEditPost(idPost){
	 $("#post_content_"+idPost).show();
	 $("#edit_post_"+idPost).hide();
 }
 
 function deletePj(idPj, idPost){
	 $("#pj_"+idPj).remove();
	 var currentval = $("#pjToDelete_"+idPost).val();
	 if(currentval==""){
		 $("#pjToDelete_"+idPost).val(idPj);
	 }else{
		 $("#pjToDelete_"+idPost).val(currentval + "," + idPj);
	 }
 }
 
 function editPost(idPost){
	 	tinyMCE.triggerSave();
		var $form = $("#postEditForm"+idPost);
		var formData = new FormData($form[0]);
	         $.ajax({
	        	 url: "/myschool/core/controller/create_post_controller.php", 
	                type: $form.attr('method'), 
	                data: formData,
	                async: false,
	                cache: false,
	                contentType: false,
	                processData: false,
	                success: function(json) {
	                	closeNewPost();
	                	$('#zonePosts').html("");
	                	$('#zonePosts').load("/myschool/html/html/main/zone_posts.php");
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
		            url: "/myschool/core/controller/create_post_controller.php", 
		            type: "POST", 
		            data: myPostData, 
		            dataType: 'json',
		            success: function(json) {
		            	$('#dialog-confirm-delete-post').dialog('close');
		            	$('#dialog-confirm-delete-post').dialog('destroy');
		            	$("#zonePosts").html("");
		            	$("#zonePosts").load( "/myschool/html/html/main/zone_posts.php");
		            	
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
	            url: "/myschool/core/controller/admin_infos_controller.php", 
	            type: $form.attr('method'), 
	            data: $data, 
	            dataType: 'json',
	            success: function(json) {
	            	$("#ajoutClasseUser").html("");
	            	$("#ajoutClasseUser").load( "/myschool/html/html/admin/admin_infos/admin_liste_classes.php");
	            }            
	       });
		   return false;  
 }
 
 function deleteClasse(){
		var $form = $("#ajoutClasseUserForm");
			$data = $form.serialize() + "&action=DELETE";
	         $.ajax({
	            url: "/myschool/core/controller/admin_infos_controller.php", 
	            type: $form.attr('method'), 
	            data: $data, 
	            dataType: 'json',
	            success: function(json) {
	            	$("#ajoutClasseUser").html("");
	            	$("#ajoutClasseUser").load( "/myschool/html/html/admin/admin_infos/admin_liste_classes.php");
	            }            
	       });
		   return false;  
}
 
 function showMorePost(offset){
	      //$("#morePosts").load("/myschool/html/html/main/zone_posts.php?offset="+offset);
	      $.get("/myschool/html/html/main/zone_posts.php?offset="+offset+" #morePosts", function(data) {
	    	     $("#morePosts").replaceWith(data);
	    	});
}
 
 function showGaleria(idPost){
	 $("#dialog-galeria").html("");
	 $("#dialog-galeria").load("/myschool/html/html/main/visionneuse.php?idPost="+idPost);
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
	 Galleria.loadTheme('/myschool/html/js/galleria/themes/classic/galleria.classic.min.js');
	 Galleria.run('.galleria', {
		 width: 700,
		 height: 467
		});
 }
 
 // Helper function that formats the file sizes
 function formatFileSize(bytes) {
     if (typeof bytes !== 'number') {
         return '';
     }

     if (bytes >= 1000000000) {
         return (bytes / 1000000000).toFixed(2) + ' GB';
     }

     if (bytes >= 1000000) {
         return (bytes / 1000000).toFixed(2) + ' MB';
     }

     return (bytes / 1000).toFixed(2) + ' KB';
 }
 
 
