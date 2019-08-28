<?php
//@todo initialize init class on parent include
/*
class simplelender_api_reception{
	public function init(){
		add_action('init',[$this,'listen_for_api_data']);
	}

	public function listen_for_api_data(){
		if (isset($_POST['sl_api_key']) && isset($_POST['sl_api_secret'])) {
			$are_api_auth_correct=$this->are_api_auth_correct(['api_key'=>$_POST['sl_api_key','api_secret'=>$_POST['sl_api_secret']]]);

			if ($are_api_auth_correct) {
				# process api data
				$this->process_api_data();
			}
		}
	}

	public function are_api_auth_correct($param=''){
		//@todo check from database if credentials are correct
		//@todo create and manage credentials
		return true;
	}

	public function process_api_data($param=''){
		//@todo save keys and values if the start with sl_
		$this->save_keys_and_values();
		//@update loan application status if there is a change
		do_action('simplelender_api_reception_complete');
	}

	public function save_keys_and_values($param=''){
		foreach ($_POST as $key => $value) {
			//todo if key starts with sl_? save data
		}
	}

	public function update_loan_status(){
		//@todo if loan status changed? change loan status: forget
	}
}
//@todo settings to display on frontend/ key=>['name', 'vaule']
//@todo display all recieved data on backend-> per loan application/ list of reception
//@todo display approved data on frontend
*/
?>