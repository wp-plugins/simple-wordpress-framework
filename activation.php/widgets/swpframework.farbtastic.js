jQuery(document).ready(function() {
	var swpf_activePicker = null;
	var swpf_farbtastic = jQuery.farbtastic('#swpf_farbtastic', swpf_colorPicked);

	jQuery(document).mousedown(function(){
		jQuery('#swpf_farbtastic').hide();
		swpf_activePicker = null;
	});

	jQuery('.swpf_colorpicker').bind('click', swpf_popUpFarbtastic);
	jQuery('.swpf_colorpicker_text').bind('change', swpf_color_changeAfterInput);

	function swpf_popUpFarbtastic(event) {
		jQuery(this).prev('input:first').focus();

		var color = new RGBColor(jQuery(this).css('background-color'));
		swpf_farbtastic.setColor(color.toHex());
		jQuery('#swpf_farbtastic').css({ left: (event.pageX+20)+'px', top: (event.pageY-180)+'px' });
		jQuery('#swpf_farbtastic').show();
		swpf_activePicker = jQuery(this);
	}

	function swpf_colorPicked(event) {
		if (swpf_activePicker != null) {
			swpf_activePicker.css("background", swpf_farbtastic.color);
			swpf_activePicker.prev('input:first').val(swpf_farbtastic.color);
			swpf_activePicker.prev('input:first').focus();
		}
	}

	function swpf_color_changeAfterInput(event) {
	
		var color = new RGBColor(document.getElementById(this.name).value);
		
		jQuery(this).next('input:first').focus().css('background-color', color.toHex() );

	}
});


