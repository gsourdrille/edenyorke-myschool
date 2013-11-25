jQuery.fn.filterByText = function(textbox, selectSingleMatch) {
	  return this.each(function() {
	    var select = this;
	    var options = [];
	    $(select).find('option').each(function() {
	      options.push({value: $(this).val(), text: $(this).text()});
	    });
	    $(select).data('options', options);
	    $(textbox).bind('change keyup', function() {
	      var options = $(select).empty().scrollTop(0).data('options');
	      var search = $.trim($(this).val());
	      var regex = new RegExp(search,'gi');
	 
	      $.each(options, function(i) {
	        var option = options[i];
	        if(option.text.match(regex) !== null) {
	          $(select).append(
	             $('<option>').text(option.text).val(option.value).addEventListener('click', function() {
	            	 loadNiveaux();
	             }));
	      
	        }
	      });
	      if (selectSingleMatch === true &&
	          $(select).children().length === 1) {
	        $(select).children().get(0).selected = true;
	      }
	    });
	  });
	};
//	$(function() {
//		  $('#liste_niveaux').filterByText($('#filter'), true);
//		});  

	
 function loadNiveaux() {
    var selectBox = document.getElementById("liste_niveaux");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.location.href='admin_niveaux_controller.php?action=show&idNiveau='+selectedValue;
}