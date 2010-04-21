jQuery(document).ready(function() {
	var myplugin_activePicker = null;
	var myplugin_farbtastic = jQuery.farbtastic('#myplugin_farbtastic', myplugin_colorPicked);

	jQuery(document).mousedown(function(){
		jQuery('#myplugin_farbtastic').hide();
		myplugin_activePicker = null;
	});

	jQuery('.myplugin_colorpicker').bind('click', myplugin_popUpFarbtastic);
	jQuery('.myplugin_colorpicker_text').bind('change', myplugin_color_changeAfterInput);

	function myplugin_popUpFarbtastic(event) {
		jQuery(this).prev('input:first').focus();

		var color = new RGBColor(jQuery(this).css('background-color'));
		myplugin_farbtastic.setColor(color.toHex());
		jQuery('#myplugin_farbtastic').css({ left: (event.pageX+20)+'px', top: (event.pageY-180)+'px' });
		jQuery('#myplugin_farbtastic').show();
		myplugin_activePicker = jQuery(this);
	}

	function myplugin_colorPicked(event) {
		if (myplugin_activePicker != null) {
			myplugin_activePicker.css("background", myplugin_farbtastic.color);
			myplugin_activePicker.prev('input:first').val(myplugin_farbtastic.color);
			myplugin_activePicker.prev('input:first').focus();
		}
	}

	function myplugin_color_changeAfterInput(event) {
	
		var color = new RGBColor(document.getElementById(this.name).value);
		
		jQuery(this).next('input:first').focus().css('background-color', color.toHex() );

	}
});


