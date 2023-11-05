<?php
/**
* 
*/
require_once dirname(__FILE__).'/calculatorwp_ticket.php';

class calculatorwp_message extends calculatorwp_ticket
{
	
	function __construct()
	{
		# code...
	}

	function init(){
		add_action("wp_ajax_calculatorwp_send_message",  array($this, "send_message")); 
		add_action("calculatorwp_load_more_message",  array($this, "load_more_message"));
	}

	function load_more_message(){
		//@todo be worked on
		$db_response=3;

		$dat_response=array(
				'is_there_new_message'=> true,
				'messages'=>'nnn'
			);
		
		echo json_encode($dat_response);
        
        wp_die();
	}

	function send_message(){
		$db_response=mvc_model('calculatorwpMessage')->create(array(
				'message'=>$_POST['calculatorwp_message_data']['message'],
				'ticket_id'=>$_POST['calculatorwp_message_data']['ticket_id'],
				'sender_id'=>$_POST['calculatorwp_message_data']['sender_id'],
				'send_time'=>date("Y-m-d H:i:s"),
				'status'=>1
			));

		if ($db_response>0) {
			$dat_response=array(
				'message_status'=>'sent',
				'time'=>date("Y-m-d H:i:s"),
				'sender_id'=>mvc_model('calculatorwpClientaccount')->find_by_id($_POST['calculatorwp_message_data']['sender_id'])->firstname
				);
		}
		else{
			$dat_response=array(
				'message_status'=>'ups, we encountered an error when sending',
				'time'=>date("Y-m-d H:i:s"),
				'sender_id'=>mvc_model('calculatorwpClientaccount')->find_one(['conditions'=>['wp_user_id'=>$_POST['calculatorwp_message_data']['sender_id']]])->firstname
			);
		}
		
		echo json_encode($dat_response);
        
        wp_die();
	}
}
?>