jQuery(document).ready(function($) {
	
	function calculatorwp_change_activate_notification(notification_id){
		//replace info on relevant location
		var data_l= {
			"action": "calculatorwp_change_activate_notification",
			"calculatorwp_notification_id":notification_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
			
			}
		});
	}
	
	if(typeof(calculatorwp_number_of_notifications) !== 'undefined'){
		$.each(calculatorwp_number_of_notifications,function(index, value){
			$("#"+index).change(function(){
				calculatorwp_change_activate_notification(value);
			});
		});
	}
	function calculatorwp_close_recipient(i){
		$("#calculatorwp_close_recipient_"+i).click(function(){
			$("#calculatorwp_main_row_recipient_"+i).html('');
		});
	}
		
	function calculatorwp_del_recipient(recipient_id){
		var data_l = {
			"action": "calculatorwp_delete_recipient",
			"calculatorwp_recipient_id":recipient_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
			}
		});
	}
	
	function calculatorwp_delete_recipient_on_server(i){
		$("#calculatorwp_close_recipient_"+i).click(function(){
			recipient_id= $("#calculatorwp_id_recipient_"+i).val();
			if(recipient_id>0){
				calculatorwp_del_recipient(recipient_id);
			}
		});
	}
	
	$('#calculatorwp_add_recipient_node').click(function(e){
		e.preventDefault();
		$('#calculatorwp_additional_mail_recipient').before('<tr id="calculatorwp_main_row_recipient_'+calculatorwp_next_recipient_node+'"><td>	<select name="more_data[calculatorwpMailRecipient]['+ calculatorwp_next_recipient_node +'][type]" type="text"  class="calculatorwp_input_feild">	<option value=""></option> <option value="email" selected="selected">Email</option>  </select> </td><td><input id="" name="more_data[calculatorwpMailRecipient]['+calculatorwp_next_recipient_node+'][recipient]" type="text" value="" class="calculatorwp_input_feild"></td><td><center><span class="calculatorwp_close_recipient_class" id="calculatorwp_close_recipient_'+calculatorwp_next_recipient_node+'">x</span></center></td></tr><br>');
		calculatorwp_close_recipient(calculatorwp_next_recipient_node);
		calculatorwp_next_recipient_node++;
	});
	
	if(typeof calculatorwp_next_recipient_node  == 'undefined'){
		calculatorwp_next_recipient_node='';
	}
	for(var i=0; i < calculatorwp_next_recipient_node ; i++ ){		
		calculatorwp_delete_recipient_on_server(i);
		calculatorwp_close_recipient(i);
	}
	
	//-----------------------url -------------------------------------
	
	function calculatorwp_close_url(i){
		$("#calculatorwp_close_url_"+i).click(function(){
			$("#calculatorwp_main_row_url_"+i).html('');
		});
	}
		
	function calculatorwp_del_url(url_id){
		
		var data_l= {
			"action": "calculatorwp_delete_url",
			"calculatorwp_url_id":url_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
			}
		});
	}
	
	function calculatorwp_delete_url_on_server(i){
		$("#calculatorwp_close_url_"+i).click(function(){
			url_id= $("#calculatorwp_id_url_"+i).val();
			
			if(url_id>0){
				calculatorwp_del_url(url_id);
			}
		});
	}
	
	$('#calculatorwp_add_url_node').click(function(e){
		e.preventDefault();
		$('#calculatorwp_additional_url').before('<tr id="calculatorwp_main_row_url_'+calculatorwp_next_url_node+'"><td>	<select name="more_data[calculatorwpWebhookUrl]['+calculatorwp_next_url_node+'][type]" class="calculatorwp_input_feild"><option value=""></option><option value="POST" selected="selected">POST</option><option value="GET" >GET</option>	<option value="PUT" >PUT</option></select> </td><td><input id="" name="more_data[calculatorwpWebhookUrl]['+calculatorwp_next_url_node+'][url]" type="url" value="" class="calculatorwp_input_feild"></td><td><center><span class="calculatorwp_close_url_class" id="calculatorwp_close_url_'+calculatorwp_next_url_node+'">[X]</span></center></td></tr><br>');
		calculatorwp_close_url(calculatorwp_next_url_node);
		calculatorwp_next_url_node++;
	});
	if(typeof calculatorwp_next_url_node  == 'undefined'){
		calculatorwp_next_url_node='';
	}
	
	for(var i=0; i < calculatorwp_next_url_node ; i++ ){		
		calculatorwp_delete_url_on_server(i);
		calculatorwp_close_url(i);
	}

	//-----------------------args -------------------------------------
	
	function calculatorwp_close_args(i){
		$("#calculatorwp_close_args_"+i).click(function(){
			$("#calculatorwp_main_row_args_"+i).html('');
		});
	}
		
	function calculatorwp_del_args(args_id){
		//replace info on relevant location
		var data_l= {
			"action": "calculatorwp_delete_args",
			"calculatorwp_args_id":args_id
		};
		
		//ajax_object.ajax_url="http://localhost/wordpress/wp-admin/admin-ajax.php";
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
				console.log(response);
			}
		});
	}
	
	function calculatorwp_delete_args_on_server(i){
		$("#calculatorwp_close_args_"+i).click(function(){
			args_id= $("#calculatorwp_id_args_"+i).val();
			if(args_id>0){
				calculatorwp_del_args(args_id);
			}
		});
	}
	
	$('#calculatorwp_add_args_node').click(function(e){
		e.preventDefault();
		$('#calculatorwp_additional_args').before('<tr id="calculatorwp_main_row_args_'+calculatorwp_next_args_node+'"><td><input id="" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][key_name]" type="text" value="" class="calculatorwp_input_feild"></td><td><input id="" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][value]" type="text" value="" class="calculatorwp_input_feild"> <input id="calculatorwp_id_args_'+calculatorwp_next_args_node+'" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][type]" type="hidden" value="body" > </td><td><center><span class="calculatorwp_close_args_class" id="calculatorwp_close_args_'+calculatorwp_next_args_node+'">[X]</span></center></td></tr><br>');
		calculatorwp_close_args(calculatorwp_next_args_node);
		calculatorwp_next_args_node++;
	});
	
	$('#calculatorwp_add_header_args_node').click(function(e){
		e.preventDefault();
		$('#calculatorwp_additional_header_args').before('<tr id="calculatorwp_main_row_args_'+calculatorwp_next_args_node+'"><td><input id="" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][key_name]" type="text" value="" class="calculatorwp_input_feild"></td><td><input id="" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][value]" type="text" value="" class="calculatorwp_input_feild"> <input id="calculatorwp_id_args_'+calculatorwp_next_args_node+'" name="more_data[calculatorwpWebhookArgs]['+calculatorwp_next_args_node+'][type]" type="hidden" value="header" > </td><td><center><span class="calculatorwp_close_args_class" id="calculatorwp_close_args_'+calculatorwp_next_args_node+'">[X]</span></center></td></tr><br>');
		calculatorwp_close_args(calculatorwp_next_args_node);
		calculatorwp_next_args_node++;
	});
	$('#calculatorwp_tags_switcher').change(function(){
		calculatorwp_tags_switcher = $('#calculatorwp_tags_switcher').val();
		
		if(calculatorwp_tags_switcher == 'calculatorwp_borrower_tags'){
			$('.calculatorwp_borrower_tags').css({"display": "list-item"});
			
			$('.calculatorwp_more_tags').hide();
			$('.calculatorwp_loan_tags').hide();
		}
		else if(calculatorwp_tags_switcher == 'calculatorwp_loan_tags'){
			$('.calculatorwp_loan_tags').show();
			
			$('.calculatorwp_more_tags').hide();
			$('.calculatorwp_borrower_tags').hide();
		}
		
		else if(calculatorwp_tags_switcher == 'calculatorwp_more_tags'){
			$('.calculatorwp_more_tags').show();
			
			$('.calculatorwp_borrower_tags').hide();
			$('.calculatorwp_loan_tags').hide();
		}

	});
	
	if(typeof calculatorwp_next_args_node  == 'undefined'){
		calculatorwp_next_args_node='';
	}
	
	for(var i=0; i < calculatorwp_next_args_node ; i++ ){
		calculatorwp_delete_args_on_server(i);
		calculatorwp_close_args(i);
	}
	
	$('.calculatorwp_borrower_tags').css({"display": "list-item"});

});

