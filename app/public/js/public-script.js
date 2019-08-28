jQuery(document).ready(function($) {
	
    sl_loan_app_amount=0;
	sl_loan_app_period =0;
	sl_loan_periods_full_names={
		'd':'day(s)',
		'w':'week(s)',
		'm':'month(s)',
		'y':'year(s)'
	};
	var sl_active_loan={};
	var sl_period = 'Month';
	if(typeof(ajax_object.ajaxurl)=='string'){
		ajax_object.ajax_url=ajax_object.ajaxurl;
	}
	 
	if(typeof(sl_core_functions) == "undefined"){
		sl_core_functions= "";
	}
	if(typeof(sl_product_constants) == "undefined"){
		sl_product_constants= [];
	}
	if(typeof(sl_product_constants_a) == "undefined"){
		sl_product_constants_a= [];
	}
	 
	//multiple products class
	simplelender_multiple_products={
		"init":function(){
			//hide all products on load
			sl_dropdown_loan_products.forEach(simplelender_multiple_products.hide_all_product);
			//change loan product
			simplelender_multiple_products.listener();
		},
		"listener":function(){
			$('.simplelender_select_a_loan_s').change(function(){
				simplelender_multiple_products.switch_product();
			});
		},
		"hide_all_product":function(item){
			$('.'+item).hide();
			$('.input_'+item).removeClass('sl_active_product');
		},
		"switch_product":function(){
			sl_dropdown_loan_products.forEach(simplelender_multiple_products.hide_all_product);
			sp_product_id = $('#simplelender_select_a_loan').val();
			//display selected product
			$('.option_selector_'+$('#simplelender_select_a_loan').val()).show();
			simplelender_loan_product_display.init($('#simplelender_select_a_loan').val());
			//activate feilds in the selected product
			$('.input_option_selector_'+$('#simplelender_select_a_loan').val()).addClass('sl_active_product');			
			//select product constaants
			//sl_product_constants = sl_product_constants_a[$('#simplelender_select_a_loan').val()];
			//change display numbers
			simplelender_loan_product_display.update_display_values_on_slider();
		}		
	};
	if(typeof(sl_dropdown_loan_products) !== "undefined"){	
		simplelender_multiple_products.init();
	}
	
	simplelender_user={
		"init":function(){
			$('#sl-wp-user-reg-submit').click(function(e){
				e.preventDefault();
				simplelender_user.submit_user_registration_value();
			});
			$('#sl_user_pass_confirm').blur(function(){
				if($('#sl_user_pass_confirm').val() == $('#sl_user_pass').val()){
					$('#sl_user_pass').removeClass('sl_user_pass');
					$('.sl_email_section_user_pass_message').html('');
				}
				else{
					$('#sl_user_pass').addClass('sl_user_pass');
					$('.sl_email_section_user_pass_message').html('Password need to be te same.<br>');
				}
			});
			$('#sl_user_login_confirm').blur(function(){
				if($('#sl_user_login_confirm').val() == $('#sl_user_login').val()){
					$('#sl_email_section').removeClass('sl_email_section');
					$('.sl_email_section_correction_message').html('');
				}
				else{
					$('#sl_email_section').addClass('sl_email_section');
					$('.sl_email_section_correction_message').html('emails need to be te same.<br>');
				}
			});
			
			$('#sl_user_gate_menu_item_login').click(function(){
				$('#sl_user_gate_login').show(); 
				$('#sl_user_gate_signup').hide();
			});
			
			$('#sl_user_gate_menu_item_create_ac').click(function(){
				$('#sl_user_gate_login').hide(); 
				$('#sl_user_gate_signup').show();
			});
		},
		"submit_user_registration_value":function(){
			//do loader
			$('.sl_user_reg_loader').show();
			
			//get info
			sl_response={
				"sl_new_regestration_form":"Ups, Could not load the form, please try some other time"
			};

			//replace info on relevant location
			var data_l = {
				"action": "sl_submit_registration_form",
				"sl_username_d":$('#sl_username').val(),
				"sl_mail_d":$('#sl_user_login').val(),
				"sl_pass_d":$('#sl_user_pass').val()
			};

			jQuery.post(ajax_object.ajax_url, data_l, function(response) {
				console.log('response2');
				console.log(response);
				if(response !== undefined){
					sl_response = JSON.parse(response);
					if(sl_response.signup_status==true){
						//change focus to login
						$('#sl_user_gate_login').show(); 
						$('#sl_user_gate_signup').hide();
						//populate values 
						$('#user_login').val(sl_response.additional_info.logins.login);
						$('#user_pass').val(sl_response.additional_info.logins.pass);
						//click login button
						$('#wp-submit').click();
					}
				}
				else{
					$('#sl_loan_app_body').html(sl_response.error_message);
				}
					
				//remove loader
				$('.sl_user_reg_loader').hide();
			});
		}
	
	};
	simplelender_user.init();
	
	//Loan product 	
	simplelender_loan_product_display={
		"set_active_loan":function(loan_id){
			sl_active_loan={
				"amount_slider":"sl_loan_app_amount_"+loan_id,
				"term_slider":"sl_loan_app_period_"+loan_id,
				"amount_h":"sl_loan_app_amount_h_"+loan_id,
				"term_h":"sl_loan_app_period_h_"+loan_id,
				"rate_h":"sl_loan_app_rate_h_"+loan_id,
				"calc_results":"sl_repayment_results_"+loan_id,
				"amount_slider_output":"sl_loan_app_amount_slider_output_"+loan_id,
				"term_slider_output":"sl_loan_app_period_slider_output_"+loan_id,
				"currency":sl_product_constants[loan_id].currency,
				"period" :sl_product_constants[loan_id].period,
                "product_id":sl_product_constants[loan_id].product_id,
				"loader":'sl_calc_loader',
				"goal_name":'sl_loan_app_goal_'+loan_id,
				"product_id":loan_id,
				"repayment_button":'sl_repayment_button'
			}
		},
		"set_classes":function(){
			item=sl_active_loan;
			$('.'+item.amount_h).addClass('sl_active_product');
			$('.'+item.amount_h).addClass('amount');
			
			$('.'+item.term_h).addClass('sl_active_product');
			$('.'+item.term_h).addClass('term');
			
			$('.'+item.rate_h).addClass('sl_active_product');
			$('.'+item.rate_h).addClass('rate');
			
			$('.'+item.calc_results).addClass('sl_active_product');
			$('.'+item.calc_results).addClass('results');
		},
		"update_display_values_on_slider_change":function(){//change amount and period displayed			
			simplelender_loan_product_display.update_amount_and_period_displayed();
			simplelender_loan_product_display.change_calculator_numbers();
		},
		"update_amount_and_period_displayed":function(){
			item = sl_active_loan;
			$("."+item.amount_slider_output).html(item.currency+" "+$("#"+item.amount_slider).val());
			$("."+item.term_slider_output).html($("#"+item.term_slider).val()+" "+sl_loan_periods_full_names[item.period]);
		},
		"change_calculator_numbers":function(){
			item = sl_active_loan;
			//update amount and term
			$(".amount").val($("#"+item.amount_slider).val());
			$(".term").val($("#"+item.term_slider).val()+item.period);
			$(".calculator-loan").accrue();
		},
		"listener":function(){
			$("#"+sl_active_loan.amount_slider).change(function(){
				simplelender_loan_product_display.update_display_values_on_slider_change();
				simplelender_loan_product_display.change_calculator_numbers();
			});
			$('#'+sl_active_loan.term_slider).change(function(){
				simplelender_loan_product_display.update_display_values_on_slider_change();
				simplelender_loan_product_display.change_calculator_numbers();
			});
			$('.'+sl_active_loan.repayment_button).click(function(e){
				e.preventDefault();
				simplelender_loan_product_display.submit_value();
			});
			$("#"+item.amount_slider).change(function(){
				simplelender_loan_product_display.change_calculator_numbers();
			});
			$("#"+item.term_slider).change(function(){
				simplelender_loan_product_display.change_calculator_numbers();
			});
		},
		"submit_value":function(){
			//do loader
			$('.'+sl_active_loan.loader).show();			
			//get info
			sl_response={
				"sl_new_form":"Ups, Could not load the form, please try some other time"
				};
			//replace info on relevant location
			var data_l = {
				"action": "sl_submit_form_for_loan",
				"sl_loan_amount":$("#"+sl_active_loan.amount_h).val(),
				"sl_loan_term":$("#"+sl_active_loan.term_h).val(),
				"sl_loan_goal_name":$("#"+sl_active_loan.goal_name ).val(),
				"sp_product_id":sl_active_loan.product_id
			};
				
			//ajax_object.ajax_url="http://localhost/wordpress/wp-admin/admin-ajax.php";
			jQuery.post(ajax_object.ajax_url, data_l, function(response) {
				window.location=sl_secondary_destination_for_calclation;			
			});
		},
		"init":function(loan_id){
			simplelender_loan_product_display.set_active_loan(loan_id);
			simplelender_loan_product_display.set_classes();
	
			simplelender_loan_product_display.update_display_values_on_slider_change();
			simplelender_loan_product_display.listener();
			$(".calculator-loan").accrue();
		},
	};
	//loop through products
	sl_product_constants_a.forEach(simplelender_loan_product_display.init);
	
	//ticketing
	sl_list_message_details_num=0;
	simplelender_ticketing_object={
		"init":function(){
			//Ticketing
			$('#simplelenderMessageSubmitButton').click(function(){
				simplelender_ticketing_object.send_message();
			});
		},
		"send_message":function(){
			sl_list_message_details_var="sl_list_message_details"+sl_list_message_details_num;
			//add message to list
			$('#simplelenderMessageInputarea').before('<tr style="width:100%;"><td class="sl_list_single_message">	<div class="sl_list_name">'+$("#simplelenderMessageInputarea").val()+'</div><br><span class="sl_list_message_details" id="'+sl_list_message_details_var+'">sending...</span> </td></tr>');
			sl_list_message_details_num=sl_list_message_details_num+1;
			
			//send to serv
			data_m={
				'message':$("#simplelenderMessageInputarea").val() ,
				'ticket_id':simplelender_ticket_id,
				'sender_id':simplelender_user_id
			};
			var data_l= {
				"action": "simplelender_send_message",
				"simplelender_message_data":data_m
			};
		
			jQuery.post(ajax_object.ajax_url, data_l, function(response) {
				if(typeof response !== 'undefined'){
					//console.log(response);
					//alert(typeof response );
					response = JSON.parse(response);
					$("#"+sl_list_message_details_var).html(response.message_status+' at '+response.time+' by '+response.sender_id);
					
				}
			});
			
			//record that it has been sent
	
		},
		"load_sent_message":function(){
				//add message to list
				//simplelender_latest_message_id=1;
				//send to serv			
				data_m={
					//'latest_message_id':simplelender_latest_message_id ,
					'ticket_id':simplelender_ticket_id				
				};
				//alert('response.messages');
				var data_l = {
					"action": "simplelender_load_more_message",
					"simplelender_message_load_data":data_m
				};
			
				jQuery.post(ajax_object.ajax_url, data_l, function(response) {
					//if(typeof response !== 'undefined'){
						//console.log(response);
						//alert(typeof response );
						//if there is a new message
						//if(response.is_there_new_message){
							//response = JSON.parse(response);
							alert('response.messages');
							//$('#simplelenderMessageInputarea').before('<tr style="width:100%;"><td class="sl_list_single_message">	<div class="sl_list_name">'+response.message+'</div><br><span class="sl_list_message_details" id="'+sl_list_message_details_var+'">'+response.message_status+' at '+response.time+' by '+response.sender_id+'</span> </td></tr>');
						//}
					//}
				});
		},
	}
	simplelender_ticketing_object.init();
});