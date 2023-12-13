<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class calculatorwp_loan_application extends calculatorwp_loan_process{

    public static function init_hooks(){
                        
        add_action( 'calculatorwp_loan_application' , ['calculatorwp_loan_application','run_notifications_complete'] );

    }
	
    public function submit_form_with_accounts($param){
   
        // to gravity form: login -or- sign up
        if( $Current_user_id > 0 ){
            $url = mvc_public_url(array('controller' => $this , 'action' => 'edit', 'id' => $id));
        }

    }

    public static function run_notifications_complete( $params = [] ){

        $user_user_email = '';

        $user_list = get_users(array( 'role__in' => array( 'administrator' ))); 

		foreach( $user_list as $user ) {
            $user_user_email .=  $user->user_email .', ';
		}


		do_action('calculatorwp_loan_status_change',[
            'borrower_id'   => $params['client_id'],
            'borrower_data' => mvc_model('calculatorwpClientaccount')->find_by_id($params['client_id']),
            'loan_id'       => $params['loan_id'],
            'message'       =>'Congratulations! you have a New Mortgage Application <b>#'.$params['loan_id'].'</b>' ,
            'admin_link'    => mvc_admin_url(array('controller' => 'calculatorwp_clientloans' , 'action' => 'process', 'id' =>  $params['loan_id'] )),
            'admin_user'    => 'StreamlineMortgage',
            'admin_email'   => $user_user_email,
        ]
        );

    }
	
}

calculatorwp_loan_application::init_hooks();
