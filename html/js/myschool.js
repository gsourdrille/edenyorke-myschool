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