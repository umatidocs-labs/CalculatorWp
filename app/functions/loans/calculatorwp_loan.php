<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

require_once dirname(__FILE__).'/calculatorwp_loan_process.php';
require_once dirname(__FILE__).'/calculatorwp_loan_application.php';
require_once dirname(__FILE__).'/loan_application_form.php';
require_once dirname( __FILE__ ) . '/calculatorwp_calculator_connector.php';
require_once dirname(__FILE__).'/calculatorwp_calculator_default_theme.php';

class calculatorwp_loan extends calculatorwp_loan_application{
   
    public function init(){
		$this->load_hooks();
    }
	
    public function load_hooks(){
       	calculatorwp_class('calculatorwp_calculator_default_theme')->init();
    }
	
	public function loan_balance($param=array('loan_id'=>'')){
		return '';
	}
	
	public function loan_summary($param=array('loan_id'=>'')){
		return '
		<div>
			<span> <b>Total Loan Issue:</b>  </span>|
			<span> <b>Total Loan Repaid:</b>  </span>|
			<span> <b>Outstanding bal:</b> '.$this->loan_balance(array('loan_id'=>$param['loan_id'])).' </span>|
			<span> <b>Number of transaction:</b>  </span>|
			<span> <b>Extra info:</b> Nothing specific </span>
		</div>';
	}
}


?>