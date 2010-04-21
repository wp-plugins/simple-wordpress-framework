function swpf_checkSetupSubmit($url) {

	theForm = document.post

	errMsg = '';
	if (theForm.swpf_setup_plugin_name.value=='') errMsg += '\n Plugin Name';
	if (theForm.swpf_setup_plugin_file_name.value=='') errMsg += '\n File Name';
	if (theForm.swpf_setup_plugin_uri.value=='') errMsg += '\n Plugin URI';
	if (theForm.swpf_setup_plugin_description.value=='') errMsg += '\n Description';
	if (theForm.swpf_setup_plugin_version.value=='') errMsg += '\n Version';
	if (theForm.swpf_setup_plugin_author_uri.value=='') errMsg += '\n Author URI';
	if (theForm.swpf_setup_readme_contributors.value=='') errMsg += '\n Contributors URI';
	if (theForm.swpf_setup_readme_donatelink.value=='') errMsg += '\n Donate URI';
	if (theForm.swpf_setup_readme_tags.value=='') errMsg += '\n Tags';
	if (theForm.swpf_setup_readme_requiresatleast.value=='') errMsg += '\n Requires at Least';
	if (theForm.swpf_setup_readme_testedupto.value=='') errMsg += '\n Tested Up To';
	if (theForm.swpf_setup_readme_stabletag.value=='') errMsg += '\n Stable Tag';

	if (theForm.swpf_setup_plugin_name.value!='')
	{
		if (theForm.swpf_setup_plugin_name.value===theForm.swpf_setup_plugin_function_prefix.value)  errMsg += '\n Plugin Name must be different than Function Prefix (Hint: use upper and lowercase letters)';
		if (theForm.swpf_setup_plugin_name.value===theForm.swpf_setup_plugin_directory_name.value) errMsg += '\n Plugin Name must be different than Directory Name (Hint: use upper and lowercase letters)';
	}

	if (theForm.swpf_setup_plugin_function_prefix.value!='')
	{
		if (theForm.swpf_setup_plugin_function_prefix.value===theForm.swpf_setup_plugin_directory_name.value) errMsg += '\n Function Prefix must be different than Directory Name (Hint: use upper and lowercase letters)';
	}


	if (errMsg!='')
	{
		alert('The information below is required before you can save your Artwork:\n' + errMsg);
	}
	else
	{
		theForm.submit();
	}

}
