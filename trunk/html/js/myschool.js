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
    
    tinyMCE.init({  
        mode : "exact",  
        theme : "modern", 
        menubar:false,
        statusbar:false,
        toolbar:'undo redo | bold italic underline | bullist numlist | removeformat',
        elements : "newPostArea"  ,
        height:"140px",  
        width:"500px"  
        });
 
});

	
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
 
 function showUploadButton(){
	 $("#admin_image").hide();
     $("#upload_image").show();

 }
 
 function hideUploadButton(){
	 $("#admin_image").show();
     $("#upload_image").hide();

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