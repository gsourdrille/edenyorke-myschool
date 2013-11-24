<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>filterByText example</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>
    jQuery.fn.filterByText = function(textbox, selectSingleMatch) {
        return this.each(function() {
            var select = this;
            var options = [];
            $(select).find('option').each(function() {
                options.push({value: $(this).val(), text: $(this).text()});
            });
            $(select).data('options', options);
            $(textbox).bind('change keyup', function() {
                var options = $(select).empty().data('options');
                var search = $.trim($(this).val());
                var regex = new RegExp(search,"gi");
              
                $.each(options, function(i) {
                    var option = options[i];
                    if(option.text.match(regex) !== null) {
                        $(select).append(
                           $('<option>').text(option.text).val(option.value)
                        );
                    }
                });
                if (selectSingleMatch === true && $(select).children().length === 1) {
                    $(select).children().get(0).selected = true;
                }
            });            
        });
    };

    $(function() {
        $('#select').filterByText($('#textbox'), true);
    });  
</script>
</head>
<body>
<input id="textbox" type="text" /><br />
<select id="select" multiple>
  <option value="1">1</option>
  <option value="1234567890">1234567890</option>
  <option value="better">better</option>
  <option value="world">world</option>
  <option value="goodly deeds">goodly deeds</option>
</select>
</body>
</html>