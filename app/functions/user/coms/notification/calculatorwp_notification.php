<?php
class calculatorwp_notification{
	
	public function init(){

		add_action('calculatorwp_loan_status_change',[$this,'notify']);
		
	}

	public function notify($param=''){

		//@todo (create this table)add to account notification
		$this->add_notification_on_dashboard( $param );
		$this->do_simple_notification( $param );
		$this->notify_admin( $param );

	}

	public function notify_admin( $param = [] ){

		//@todo send out email/ set
		$mail_content = 'You have a new notification! <a href="'.mvc_admin_url( array( 'controller' => 'calculatorwp_clientloannotes' , 'action' => '' ) ).'">Open</a>';
		$mail_subject =	'Notification from '.$_SERVER['HTTP_HOST'];
		$this->mailout([
			'mail_subject'	=>	$mail_subject,
			'recipient_list'=>	$param['admin_email'],
			'mail_content'	=>	$mail_content
		]);

	}

	public function do_simple_notification($param=''){

		//@todo send out email/ set
		$mail_content =	'You have a new notification! <a href="'.mvc_public_url(array('controller' => 'calculatorwp_clientloans' , 'action' => 'notification')).'">Open</a>';
		$mail_subject =	'Notification from '.$_SERVER['HTTP_HOST'];
		
		$this->mailout([
			'mail_subject'	=>	$mail_subject,
			'mail_content'	=>	$mail_content,
			'recipient_list'=>	$param['borrower_data']->email,
		]);

	}

	public function do_advanced_notification_with_api(){
		//@todo 
	}

	public function add_notification_on_dashboard($param=''){

		//@todo test
		mvc_model('calculatorwpNotification')->create([
			'message'=>$param['message'],
			'user_id'=>$param['borrower_data']->id,
			'status'=>1,
			'time_created'=>date("Y-m-d H:i:s"),
			'admin_link' => $param['admin_link'],
			'admin_user' => $param['admin_user']
		]);

	}

	public function mailout( $param = [] ){

		$mail_subject = $param['mail_subject'];
        $mail_content = $param['mail_content']; 
        $recipient_list = $param['recipient_list'];

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
        $headers .= 'From: no_reply@'.$_SERVER['HTTP_HOST']. "\r\n";
        $email_sent = wp_mail( $recipient_list, $mail_subject , $mail_content,$headers);
		
		return $email_sent;

	}
}

//@todo replace with action
function sl_do_notification($param=''){

    return calculatorwp_class('calculatorwp_notification')->notify($param);

}

function sl_notification_mail(){

    // return calculatorwp_class('calculatorwp_notification')->mailout();

}