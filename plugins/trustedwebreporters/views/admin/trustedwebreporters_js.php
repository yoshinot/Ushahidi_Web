function fillFields(id, trusted_first_name, trusted_last_name,
 trusted_email )
{
	show_addedit();
	$("#trustedwebreporter_id").attr("value", decodeURIComponent(id));
	$("#trusted_first_name").attr("value", decodeURIComponent(trusted_first_name));
	$("#trusted_last_name").attr("value", decodeURIComponent(trusted_last_name));
	$("#trusted_email").attr("value", decodeURIComponent(trusted_email));
}

// Form Submission
function twrAction ( action, confirmAction, id )
{
	var statusMessage;
	var answer = confirm('<?php echo Kohana::lang('ui_admin.are_you_sure_you_want_to'); ?> ' + confirmAction + '?')
	if (answer){
		// Set Category ID
		$("#trustedwebreporter_id").attr("value", decodeURIComponent(id));
		// Set Submit Type
		$("#action").attr("value", action);		
		// Submit Form
		$("#twrMain").submit();			
	
	} 
//	else{
//		return false;
//	}
}