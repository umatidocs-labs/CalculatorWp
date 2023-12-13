<?php
class calculatorwp_calculator_default_theme{
	public static $filter_to_show_calculator = 'calculatorwp_calculator_default_theme';
	public static $calculator_title = 'Default Mortgage Calculator';

	public function init(){
		// To reactivate theme, remove this comment.
		add_filter('sl_get_calculator_themes',[$this,'do_menu_themes']);
		add_filter(calculatorwp_calculator_default_theme::$filter_to_show_calculator, [$this,'default_loan_calc']);
	}

	public function do_menu_themes($calculatorwp_calculator_themes=[]){
		//array_push($calculatorwp_calculator_themes,[calculatorwp_calculator_default_theme::$filter_to_show_calculator=>'']);
		$calculatorwp_calculator_themes[calculatorwp_calculator_default_theme::$filter_to_show_calculator]=calculatorwp_calculator_default_theme::$calculator_title;
	
		return $calculatorwp_calculator_themes;
	}

	public function default_loan_calc($param_product_id=''){
		$calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($param_product_id);
			
		$period_unit=[
			"y"=>"Year(s)",
			"m"=>"Month(s)",
			"w"=>"Week(s)",
			"d"=>"Day(s)"
		];

		// var_dump($calculatorwpLoansetting);
		$primary_form = '
		<form enctype="application/x-www-form-urlencoded" action="" method="post">
            <div class="max_amount sl_amount_section">
				<div class="sl_loan_ap_primary_title_feild">
					<center>Mortgage Amount<center>
				</div>
    			<input type="hidden" min="0" placeholder="Enter a number" id="sl_loan_app_amount_'.$calculatorwpLoansetting->id.'" value="" class="sl_loan_app_amount sl_loan_app_amount_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.' sl_loan_ap_primary_input_feild large-text">
				<center>
				<div class="sl_loan_app_amount_display sl_loan_app_amount_display_'.$calculatorwpLoansetting->id.'">
					0
				</span>
				</div>

				<div class="max_amount_sub_sec">
					<div class="sl_subsections_50">

						<span>Home Value('.$calculatorwpLoansetting->currency.')</span>
						<input id="sl_home_value_'.$calculatorwpLoansetting->id.'" name="sl_loan_app_goal" aria-required="true" class="sl_home_value_'.$calculatorwpLoansetting->id.' sl_home_value input_option_selector_'.$calculatorwpLoansetting->id.'  sl_loan_ap_primary_input_feild" type="text" value="0"
						data-product_id="'.$calculatorwpLoansetting->id.'" data-interest_rate="'.$calculatorwpLoansetting->interest_rate.'" data-currency="'.$calculatorwpLoansetting->currency.'"
						data-period_unit="'.$calculatorwpLoansetting->period_unit.'"
						>

					</div>
					<div class="sl_subsections_50">

						<span>Down Payment('.$calculatorwpLoansetting->currency.')</span>
						<input id="sl_home_downpayment_'.$calculatorwpLoansetting->id.'" name="sl_loan_app_goal" aria-required="true" class="sl_home_downpayment_'.$calculatorwpLoansetting->id.' sl_home_downpayment input_option_selector_'.$calculatorwpLoansetting->id.'  sl_loan_ap_primary_input_feild" type="text" value="0" data-product_id="'.$calculatorwpLoansetting->id.'" data-interest_rate="'.$calculatorwpLoansetting->interest_rate.'" data-currency="'.$calculatorwpLoansetting->currency.'"
						data-period_unit="'.$calculatorwpLoansetting->period_unit.'">

					</div>
				</div>

			</div>

            <div class="sl_loan_ap_primary_title_feild">Payment Term( '.$period_unit[$calculatorwpLoansetting->period_unit].' )</div>
            <div class="max_amount">
    			<input type="number" placeholder="Enter a number" id="sl_loan_app_period_'.$calculatorwpLoansetting->id.'"  value="'.$calculatorwpLoansetting->max_period_number.'" class="sl_loan_app_period sl_loan_app_period_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.' sl_loan_ap_primary_input_feild large-text ">
			</div>
            <div class="sl_loan_ap_primary_title_feild">
				Phone Number
			</div>
	        <div class="max_amount">
                <input id="sl_loan_app_goal_'.$calculatorwpLoansetting->id.'" name="sl_loan_app_goal" aria-required="true" class="sl_loan_app_goal_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.'  sl_loan_ap_primary_input_feild" type="text">
            </div>

            <input id="sl_loan_app_goal_description" aria-required="true" type="hidden" name="sl_loan_app_goal_description" class="input_option_selector_'.$calculatorwpLoansetting->id.'  sl_loan_ap_primary_input_feild">
            <input id="sl_loan_app_email" name="sl_loan_app_email" aria-required="true" class="input_option_selector_'.$calculatorwpLoansetting->id.'  sl_loan_ap_primary_input_feild" type="hidden">
        </form>
		<script type="text/javascript">
		sl_calc_more_info = "basic_caclulator";
		</script>
		';
        
        return $primary_form;
	}

	public function frontend($param=[]){
        $ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
		$calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($param['product_id']);
        $param_product_id=$param['product_id'];
        $sl_repayment_htm='';

        if ($calculatorwpLoansetting->show_repayment==1 && $calculatorwpLoansetting->calculator_theme == 'calculatorwp_calculator_default_theme') {
            $sl_repayment_htm= '<div class="sl_repayment_results_'.$calculatorwpLoansetting->id.' sl_repayment_amount_subtitle input_option_selector_'.$calculatorwpLoansetting->id.'"></div>';
        }
        else{
            $sl_repayment_htm='<div class="sl_repayment_results_'.$calculatorwpLoansetting->id.' sl_repayment_amount_subtitle sl_repayment_amount_subtitle_hide input_option_selector_'.$calculatorwpLoansetting->id.' "></div>';
        }

		$primary_form = '<div id="sl_loan_app_body" class="calculator-loan">
			<div class="sl_main_content_area ">
			<div class="sl_main_content_area_input">
        	'.$sl_repayment_htm.'
            <div class="sl_mainf">
		'.apply_filters($calculatorwpLoansetting->calculator_theme,$param_product_id);
        $primary_form .= $this->submit_from_fields(['calculatorwpLoansetting'=>$calculatorwpLoansetting]);
        

        $primary_form .='<div class="sl_main_title">
                    <div class="sl_main_title_text">
                        <center> '.$calculatorwpLoansetting->main_title_text.' </center>
                    </div>
                    <div class="sl_main_title_description">
                        '.$calculatorwpLoansetting->main_title_description.'
                    </div>
                </div> </div></div></div></div>
                    <script type="text/javascript">
                        if(typeof(sl_product_constants) == "undefined"){
                            var sl_product_constants=[];
                        }
                        if(typeof(sl_product_constants_a) == "undefined"){
                            var sl_product_constants_a=[];
                        }
                        sl_product_constants_a.push('.$calculatorwpLoansetting->id.');
                    	sl_product_constants['.$calculatorwpLoansetting->id.']={
                            "currency" : "'.$calculatorwpLoansetting->currency .'",
                            "period" :"'.$calculatorwpLoansetting->period_unit.'",
                            "product_id": '.$calculatorwpLoansetting->id.'
                        }
                        var sl_default_product='.$calculatorwpLoansetting->id.';
                        var sl_secondary_destination_for_calclation="'.mvc_public_url(array('controller' => 'calculatorwp_clientloans' , 'action' => 'complete_application','id'=>'1')).'";
                    </script>                
                ';
        return $primary_form;
	}

	public function submit_from_fields($param=''){
		$calculatorwpLoansetting=$param['calculatorwpLoansetting'];
		$primary_form = '
                    <form enctype="application/x-www-form-urlencoded" action="" method="post" class="">
                        <input type="hidden" class="sl_loan_app_amount_h_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.'" value="1223">
    					<input type="hidden" class="sl_loan_app_period_h_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.'"  value="0">
    					<input type="hidden" class="sl_loan_app_rate_h_'.$calculatorwpLoansetting->id.' input_option_selector_'.$calculatorwpLoansetting->id.'"  value="'.$calculatorwpLoansetting->interest_rate.'%">

                        <br>
                        <center><div class="sl_calc_loader"></div></center>
                        <div>
                            <center>
                                <input value=" '.$calculatorwpLoansetting->button_text.' " class="input_option_selector_'.$calculatorwpLoansetting->id.' sl_repayment_button" type="submit" id="sl_repayment_submit_button">
                            </center>
                        </div>
                    </form>
                ';

        return $primary_form;
	}
}


/*
*   Customize the array below to fit you calculators' name
*
*   $sl_init['affiliate_link'] -> get your  affiiate link  from calculatorwp plugin menu on your wordpress website(simplender wordpress plugin needs to be activated)
*   $sl_init['custom_admin_filter'] -> this is a custom filter that will be called when toyr calculator is selected on loan products settings
*   $sl_init['calculator_admin_title'] -> The name to be displayed on product settings on calculatorwp plugin
*
*/

$sl_init=array(
    'affiliate_link'=>'',
    'custom_admin_filter'=>'mortgage_calc_filter', //mortgage_calc_filter to be changes to you custome name
    'calculator_admin_title'=>'Mortgage calculator',// "Mortgage Calculator" to be changed to your custom name
);

/*  
*   [nothing needs to do here] add affiliate link to earn money
*
*/

/*To display on admin drop down*/
if (function_exists('calculatorwp_calculator_connector')) {
    // calculatorwp_calculator_connector($sl_init);
}

/*
*   1.) Customize function sample_return_calculator_htlm() to return your calculator html
*   2.) Change the function name sample_return_calculator_htlmI() on filter and on function name to avoid same name conflicts
*
*/
// add_filter($sl_init['custom_admin_filter'],'return_sl_mortgage_calculator_htm');

if (!function_exists("return_sl_mortgage_calculator_htm")){
	function return_sl_mortgage_calculator_htm($product_id=''){
		/*
		*   Get objet with loan productdetails e.g.
		*   $object->name
		*   $object->period_unit  d/w/m/y
		*   $object->interest_rate ->fixed if period_unit is daily or weekly ->on reducing(monthly) balance if period_unit monthly or yaerly
		*   $object->currency 
		*   $object->max_amount
		*
		*/

		$sl_product_object = apply_filters('sl_get_loan_product',$product_id);
		
		/*
		*
		*   Add the following IDs into the html feilds and it will be picked by calculatorwp to complete the loan application the IDs are for;
		*   the loan amount being applyed for, 
		*   term of the loan(in this format 2d, 2w, 2m, 2y representing  days, weeks, months, years respectively)
		*   the spending goal e.g. car, home, etc.
		*
		*/
		$sl_html_amount_id='sl_loan_app_amount_'.$product_id;
		$sl_html_amount_terms='sl_loan_app_period_'.$product_id;
		$sl_html_spending_goal_id='sl_loan_app_goal_'.$product_id;
		$sl_loan_name=$sl_product_object->name;
		$sl_currency=$sl_product_object->currency;
		$ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];

		if(	$ses_dat['stage'] == 'primary' && $ses_dat['submission_stage']=='s'	){
			$calculator_html = '<noscript>You need to enable JavaScript to run this app.</noscript>
				<div id="root'.$product_id.'" class="main_morgage'.$product_id.'">	
				</div>
				
				<script type="text/javascript">
					if( typeof(mortgage_product_ids) == "undefined" ){
						mortgage_product_ids=[];
					}
					mortgage_product_ids.push("'.$product_id.'");
					sl_calc_more_info = "mortgage_default";
					
					sl_mortgage_html = `<div class="container"><div class="row"><div class="p-3 col-sm-12 col-md-5"><form class="my-2"><div class="row form-group"><label for="1" class="col-form-label-sm col-sm-4 col-form-label">Home Valuehhhhhhhhhhhhhh:</label><div class="col-sm-8"><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input id="1" type="number" class="form-control" value="300000"></div></div></div><div class="mb-0 row form-group"><label for="downpayment" class="col-form-label-sm col-sm-4 col-form-label">Down Payment:</label><div class="col-sm-8"><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input id="downpayment" type="number" class="form-control" value="50000.00"><input id="downpayment_p" step="0.01" type="number" class="col-sm-4 form-control" value="16.67"><div class="input-group-append"><span class="input-group-text">%</span></div></div></div></div><div class="px-4 pt-1 row form-group"><div class="rc-slider"><div class="rc-slider-rail"></div><div class="rc-slider-track" style="left: 0%; width: 17%;"></div><div class="rc-slider-step"></div><div tabindex="0" class="rc-slider-handle" style="left: 17%;" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="17" aria-disabled="false"></div><div class="rc-slider-mark"></div></div></div><div class="row form-group"><label for="2" class="col-form-label-sm col-sm-4 col-form-label">Loan Amount:</label><div class="col-sm-8"><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input id="2" type="number" class="form-control" value="25000"></div></div></div><div class="mb-0 row form-group"><label for="interestRate" class="col-form-label-sm col-sm-4 col-form-label">Interest Rate:</label><div class="col-sm-8"><div class="input-group input-group-sm"><input id="interestRate" step="0.01" type="number" class="form-control" value="10.47"><div class="input-group-append"><span class="input-group-text">%</span></div></div></div></div><div class="px-4 pt-1 row form-group"><div class="rc-slider"><div class="rc-slider-rail"></div><div class="rc-slider-track" style="left: 0%; width: 34.9%;"></div><div class="rc-slider-step"></div><div tabindex="0" class="rc-slider-handle" style="left: 34.9%;" role="slider" aria-valuemin="0" aria-valuemax="30" aria-valuenow="10.47" aria-disabled="false"></div><div class="rc-slider-mark"></div></div></div><div class="row form-group"><label for="loanTerm" class="col-form-label-sm col-sm-4 col-form-label">Loan Term:</label><div class="col-sm-8"><div class="input-group input-group-sm"><input id="loanTerm" type="number" class="form-control" value="30"><div class="input-group-append"><span class="input-group-text">years</span></div></div></div></div><div class="row form-group"><label for="3" class="col-form-label-sm col-sm-4 col-form-label">Start Date:</label><div class="col-sm-8"><div class="input-group input-group-sm"><select type="select" class="form-control"><option value="0">January</option><option value="1" selected="selected">February</option><option value="2">March</option><option value="3">April</option><option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option><option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option></select><input id="3" type="number" class="form-control" value="2020"></div></div></div><div class="row form-group"><label for="propertyTax" class="col-form-label-sm col-sm-4 col-form-label">Property Tax:</label><div class="col-sm-8"><div class="input-group input-group-sm"><input id="propertyTax" type="number" class="form-control" value="2400"><div class="input-group-append"><span class="input-group-text">$/year</span></div></div></div></div><div class="mb-0 row form-group"><label for="PMI" class="col-form-label-sm col-sm-4 col-form-label">PMI:</label><div class="col-sm-8"><div class="input-group input-group-sm"><input id="PMI" step="0.01" type="number" class="form-control" value="1.00"><div class="input-group-append"><span class="input-group-text">%</span></div></div></div></div><div class="px-4 pt-1 row form-group"><div class="rc-slider"><div class="rc-slider-rail"></div><div class="rc-slider-track" style="left: 0%; width: 10%;"></div><div class="rc-slider-step"></div><div tabindex="0" class="rc-slider-handle" style="left: 10%;" role="slider" aria-valuemin="0" aria-valuemax="10" aria-valuenow="1" aria-disabled="false"></div><div class="rc-slider-mark"></div></div></div><div class="row form-group"><label for="homeInsurance" class="col-form-label-sm col-sm-4 col-form-label">Home Insurance:</label><div class="col-sm-8"><div class="input-group input-group-sm"><input id="homeInsurance" type="number" class="form-control" value="1000"><div class="input-group-append"><span class="input-group-text">$/year</span></div></div></div></div><div class="row form-group"><label for="monthlyHOA" class="col-form-label-sm col-sm-4 col-form-label">Monthly HOA:</label><div class="col-sm-8"><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input id="monthlyHOA" type="number" class="form-control" value="0"></div></div></div></form></div><div class="p-3 col-sm-12 col-md-7"><div class="loan-card card"><div class="card-header"><p class="h3 m-0">$511.46</p><small class="text-muted">Your estimated monthly payment.</small></div><div class="card-body"><table class="borderless-table small mb-0 table table-sm"><tbody><tr><td class="align-middle">Monthly Tax Paid:</td><td>$200.00</td></tr><tr><td class="align-middle">Monthly Home Insurance:</td><td>$83.33</td></tr><tr><td colspan="2"><hr></td></tr></tbody></table><p class="small"><strong>Loan Breakdown</strong></p><div data-highcharts-chart="1"><div id="highcharts-1wy043m-8" style="position: relative; overflow: hidden; width: 403px; height: 200px; text-align: left; line-height: normal; z-index: 0; left: 0.666687px; top: 0.53334px;" dir="ltr" class="highcharts-container "><svg version="1.1" class="highcharts-root" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="403" height="200" viewBox="0 0 403 200"><desc>Created with Highcharts 6.2.0</desc><defs><clipPath id="highcharts-1wy043m-14"><rect x="0" y="0" width="383" height="175" fill="none"></rect></clipPath></defs><rect fill="#ffffff" class="highcharts-background" x="0" y="0" width="403" height="200" rx="0" ry="0"></rect><rect fill="none" class="highcharts-plot-background" x="10" y="10" width="383" height="175"></rect><rect fill="none" class="highcharts-plot-border" data-z-index="1" x="10" y="10" width="383" height="175"></rect><g class="highcharts-series-group" data-z-index="3"><g data-z-index="0.1" class="highcharts-series highcharts-series-0 highcharts-pie-series  highcharts-tracker" transform="translate(10,10) scale(1 1)" style="cursor:pointer;"><path fill="#003559" d="M 205.4903255228245 38.00000098521589 A 47.5 47.5 0 0 1 234.98925070761507 48.26246392813531 L 220.24462535380755 66.88123196406765 A 23.75 23.75 0 0 0 205.49516276141225 61.750000492607946 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="1" stroke-linejoin="round" class="highcharts-point highcharts-color-0"></path><path fill="#006DAA" d="M 235.02647349285655 48.29197179269454 A 47.5 47.5 0 0 1 243.8252611675475 113.56108259563905 L 224.66263058377373 99.53054129781952 A 23.75 23.75 0 0 0 220.26323674642828 66.89598589634727 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="1" stroke-linejoin="round" class="highcharts-point highcharts-color-1"></path><path fill="#0353A4" d="M 243.79718092699972 113.59939381987891 A 47.5 47.5 0 0 1 165.70547335498878 111.43541303121069 L 185.6027366774944 98.46770651560534 A 23.75 23.75 0 0 0 224.64859046349986 99.54969690993946 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="1" stroke-linejoin="round" class="highcharts-point highcharts-color-2"></path><path fill="#061A40" d="M 165.67955784354183 111.39560554349266 A 47.5 47.5 0 0 1 159.2336581630545 74.74474021574055 L 182.36682908152727 80.12237010787028 A 23.75 23.75 0 0 0 185.58977892177091 98.44780277174634 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="1" stroke-linejoin="round" class="highcharts-point highcharts-color-3"></path><path fill="#B9D6F2" d="M 159.2444365542152 74.69847925924411 A 47.5 47.5 0 0 1 205.4340234529416 38.00004582007222 L 205.4670117264708 61.75002291003611 A 23.75 23.75 0 0 0 182.3722182771076 80.09923962962206 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="1" stroke-linejoin="round" class="highcharts-point highcharts-color-4"></path></g><g data-z-index="0.1" class="highcharts-markers highcharts-series-0 highcharts-pie-series " transform="translate(10,10) scale(1 1)"></g></g><text x="10" text-anchor="undefined" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;" y="24"></text><text x="202" text-anchor="middle" class="highcharts-subtitle" data-z-index="4" style="color:#666666;fill:#666666;" y="24"></text><g data-z-index="6" class="highcharts-data-labels highcharts-series-0 highcharts-pie-series  highcharts-tracker" transform="translate(10,10) scale(1 1)" opacity="1" style="cursor:pointer;"><path fill="none" class="highcharts-data-label-connector highcharts-color-0" stroke="#000000" stroke-width="1" d="M 236.0133792335968 12.31996529050652 C 231.0133792335968 12.31996529050652 225.08769115353562 29.316618513356623 223.11246179351522 34.98216958763999 L 221.13723243349483 40.64772066192335"></path><path fill="none" class="highcharts-data-label-connector highcharts-color-1" stroke="#000000" stroke-width="1" d="M 287.3119838225477 75.19615890821899 C 282.3119838225477 75.19615890821899 264.4717811282785 77.5893090972778 258.5250468968555 78.38702582696408 L 252.57831266543243 79.18474255665035"></path><path fill="none" class="highcharts-data-label-connector highcharts-color-2" stroke="#000000" stroke-width="1" d="M 198.2907133198386 162.96850361511355 C 203.2907133198386 162.96850361511355 203.803837968134 144.97581890450655 203.97487951756585 138.9782573343042 L 204.14592106699772 132.98069576410185"></path><path fill="none" class="highcharts-data-label-connector highcharts-color-3" stroke="#000000" stroke-width="1" d="M 124.16491738868763 98.88675325551775 C 129.16491738868763 98.88675325551775 146.89435593066986 95.7775718542362 152.80416877799726 94.74117805380902 L 158.71398162532466 93.70478425338185"></path><path fill="none" class="highcharts-data-label-connector highcharts-color-4" stroke="#000000" stroke-width="1" d="M 152.31754895816553 24.79825857851174 C 157.31754895816553 24.79825857851174 168.50831178078514 38.896727553825144 172.23856605499168 43.59621721226294 L 175.96882032919822 48.29570687070074"></path><g class="highcharts-label highcharts-data-label highcharts-data-label-color-0 " data-z-index="1" transform="translate(241,2)"><text x="5" data-z-index="1" style="font-size:11px;font-weight:bold;color:#000;cursor:pointer;fill:#000;" y="16"><tspan x="5" y="16" class="highcharts-text-outline" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="2px" stroke-linejoin="round" style="">Principal</tspan><tspan x="5" y="16">Principal</tspan></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-1 " data-z-index="1" transform="translate(292,65)"><text x="5" data-z-index="1" style="font-size:11px;font-weight:bold;color:#000;cursor:pointer;fill:#000;" y="16"><tspan x="5" y="16" class="highcharts-text-outline" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="2px" stroke-linejoin="round" style="">Interest</tspan><tspan x="5" y="16">Interest</tspan></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-2 " data-z-index="1" transform="translate(163,153)"><text x="5" data-z-index="1" style="font-size:11px;font-weight:bold;color:#000;cursor:pointer;fill:#000;" y="16"><tspan x="5" y="16" class="highcharts-text-outline" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="2px" stroke-linejoin="round" style="">Tax</tspan><tspan x="5" y="16">Tax</tspan></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-3 " data-z-index="1" transform="translate(16,89)"><text x="5" data-z-index="1" style="font-size:11px;font-weight:bold;color:#000;cursor:pointer;fill:#000;" y="16"><tspan x="5" y="16" class="highcharts-text-outline" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="2px" stroke-linejoin="round" style="">HOA &amp; Insurance</tspan><tspan x="5" y="16">HOA &amp; Insurance</tspan></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-4 " data-z-index="1" transform="translate(58,15)"><text x="5" data-z-index="1" style="font-size:11px;font-weight:bold;color:#000;cursor:pointer;fill:#000;" y="16"><tspan x="5" y="16" class="highcharts-text-outline" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="2px" stroke-linejoin="round" style="">Downpayment</tspan><tspan x="5" y="16">Downpayment</tspan></text></g></g><g class="highcharts-legend" data-z-index="7"><rect fill="none" class="highcharts-legend-box" rx="0" ry="0" x="0" y="0" width="8" height="8" visibility="hidden"></rect><g data-z-index="1"><g></g></g></g></svg></div></div><p class="d-flex justify-content-end"><button type="button" class="btn btn-outline-primary btn-sm">Show Amortization Table</button></p></div></div></div></div><div class="row"><div class="p-3 d-sm-none d-md-block col-sm-12 col-md-7"><div class="loan-card card"><div class="d-flex align-items-center card-header"><svg aria-hidden="true" data-prefix="fas" data-icon="home" class="svg-inline--fa fa-home fa-w-18 fa-2x mx-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M488 312.7V456c0 13.3-10.7 24-24 24H348c-6.6 0-12-5.4-12-12V356c0-6.6-5.4-12-12-12h-72c-6.6 0-12 5.4-12 12v112c0 6.6-5.4 12-12 12H112c-13.3 0-24-10.7-24-24V312.7c0-3.6 1.6-7 4.4-9.3l188-154.8c4.4-3.6 10.8-3.6 15.3 0l188 154.8c2.7 2.3 4.3 5.7 4.3 9.3zm83.6-60.9L488 182.9V44.4c0-6.6-5.4-12-12-12h-56c-6.6 0-12 5.4-12 12V117l-89.5-73.7c-17.7-14.6-43.3-14.6-61 0L4.4 251.8c-5.1 4.2-5.8 11.8-1.6 16.9l25.5 31c4.2 5.1 11.8 5.8 16.9 1.6l235.2-193.7c4.4-3.6 10.8-3.6 15.3 0l235.2 193.7c5.1 4.2 12.7 3.5 16.9-1.6l25.5-31c4.2-5.2 3.4-12.7-1.7-16.9z"></path></svg><div class="mt-0">Mortgage Details</div></div><div class="card-body"><table class="borderless-table small table table-sm"><tbody><tr><td class="align-middle">Loan Ammount:</td><td>$25,000.00</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 13.5778px;" class="mr-1 bar"></div><div class="label">13.58%</div></div></td></tr><tr><td class="align-middle">Down Payment:</td><td>$50,000.00 (16.67%)</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 27.1555px;" class="mr-1 bar"></div><div class="label">27.16%</div></div></td></tr><tr><td class="align-middle">Total Interest Paid:</td><td>$57,124.74</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 31.025px;" class="mr-1 bar"></div><div class="label">31.03%</div></div></td></tr><tr><td class="align-middle">Total PMI to Feb, 2020:</td><td>$0.00</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 0px;" class="mr-1 bar"></div><div class="label">0.00%</div></div></td></tr><tr><td class="align-middle">Total Tax Paid:</td><td>$72,000.00</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 39.1039px;" class="mr-1 bar"></div><div class="label">39.10%</div></div></td></tr><tr><td class="align-middle">Total Home Insurance:</td><td>$30,000.00</td><td class="custom-progress-container"><div class="custom-progress"><div style="width: 16.2933px;" class="mr-1 bar"></div><div class="label">16.29%</div></div></td></tr><tr><td colspan="2"><hr></td></tr><tr><td class="align-middle">Total of 360 Payments:</td><td><strong>$184,124.74</strong></td></tr><tr><td class="align-middle">Loan pay-off date:</td><td><strong>Jan, 2050</strong></td></tr></tbody></table></div></div></div><div class="p-3 d-sm-none d-md-block col-sm-12 col-md-5"><div class="loan-card card"><div class="d-flex align-items-center card-header"><svg aria-hidden="true" data-prefix="fas" data-icon="balance-scale" class="svg-inline--fa fa-balance-scale fa-w-20 fa-2x mx-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M256 336h-.02c0-16.18 1.34-8.73-85.05-181.51-17.65-35.29-68.19-35.36-85.87 0C-2.06 328.75.02 320.33.02 336H0c0 44.18 57.31 80 128 80s128-35.82 128-80zM128 176l72 144H56l72-144zm511.98 160c0-16.18 1.34-8.73-85.05-181.51-17.65-35.29-68.19-35.36-85.87 0-87.12 174.26-85.04 165.84-85.04 181.51H384c0 44.18 57.31 80 128 80s128-35.82 128-80h-.02zM440 320l72-144 72 144H440zm88 128H352V153.25c23.51-10.29 41.16-31.48 46.39-57.25H528c8.84 0 16-7.16 16-16V48c0-8.84-7.16-16-16-16H383.64C369.04 12.68 346.09 0 320 0s-49.04 12.68-63.64 32H112c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h129.61c5.23 25.76 22.87 46.96 46.39 57.25V448H112c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h416c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg><div class="mb-0">Monthly Vs Bi-Weekly Payment</div></div><div class="card-body"><table class="borderless-table small mb-0 table table-sm"><tbody><tr><td><p class="h5 m-0">$511.46</p><p class="text-muted">Monthly Payment</p></td><td><p class="h5 m-0">$255.73</p><p class="text-muted">Bi-weekly Payment</p></td></tr><tr><td><p class="h5 m-0">Jan, 2050</p><p class="text-muted">Monthly Pay-off Date</p></td><td><p class="h5 m-0">Jul, 2040</p><p class="text-muted">Bi-weekly Pay-off Date</p></td></tr><tr><td><p class="h5 m-0">$57,124.74</p><p class="text-muted">Total Interest Paid</p></td><td><p class="h5 m-0">$35,795.12</p><p class="text-muted">Total Interest Paid</p></td></tr></tbody></table><p class="text-center">Total Interest Savings: $21,329.62</p></div></div></div></div></div>`;
					
				</script>

			';
		}
		else{
			$calculator_html = '';
		}
		 /*
		 *  Replace this function with your function that will return a html of your loan calculator, use the Html IDs above.
		 *  $calculator_html = function_to_be_replaced();
		 *
		 */

		 return $calculator_html;
	}
}


?>