<?php
class calculatorwp_calculator_connector{

    Public static $filter_to_show_calculator;
    Public static $calculator_title;
    Public static $affiliate_link;

	public function init(){
		add_filter('sl_get_calculator_themes',[$this,'do_menu_themes']);		
		if( !empty($this->filter_to_show_calculator) ){
			add_filter($this->filter_to_show_calculator, [$this,'load_my_loan_calc']);
		}
		
        add_filter('sl_get_loan_product',[$this,'get_loan_product_details']);
    }

    public function __construct($args=''){
		calculatorwp_calculator_connector::$filter_to_show_calculator= $args['custom_admin_filter'];
        calculatorwp_calculator_connector::$calculator_title = $args['calculator_admin_title'];
        calculatorwp_calculator_connector::$affiliate_link = $args['affiliate_link'];
    }

    public function get_loan_product_details($product_id=''){
        return mvc_model('calculatorwpLoansetting')->find_by_id($product_id);
    }

    /*
    *   Function name calculatorwp_calculator_connector::do_menu_themes($calculatorwp_calculator_themes)
    *   Adds your calculator on the loan setting theme options on calculatorwp wordpress plugin: to find it, 
    *   select calculatorwp->loan products->(add or edit exsisting loan product)-> from "calculator theme" dropdown option see your calculator
    *   
    *   Your do not need to do anything here
    */
	public function do_menu_themes($calculatorwp_calculator_themes=[]){
		$calculatorwp_calculator_themes[calculatorwp_calculator_connector::$filter_to_show_calculator] = calculatorwp_calculator_connector::$calculator_title;
	
		return $calculatorwp_calculator_themes;
	}

    /*
    *   Function name calculatorwp_calculator_connector::load_my_loan_calc($param_product_id)
    *   
    *   Displays your calculator and submit feilds to calculatorwp 
    *    
    */
	public function load_my_loan_calc($param_product_id=''){
       $primary_form =apply_filters(mvc_model('calculatorwpLoansetting')->find_by_id($param_product_id)->calculator_theme,$param_product_id);
    
        return $primary_form;
	}

}

function calculatorwp_calculator_connector($args=''){
    $calculatorwp_calculator_connector=new calculatorwp_calculator_connector($args);
    $calculatorwp_calculator_connector->init();
}