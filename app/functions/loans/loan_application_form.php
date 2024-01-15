<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class calculatorwp_gravity_form_manager {

    protected $sl_display_html;
	protected $sl_is_json = false;
    public $loan_application_display_selected='';

    public function __constructor(){}
    
    public function init(){
        $this->load_hooks();
    }

    public function load_hooks(){
        add_shortcode('streamlinemortgage',array($this,"display_form_for_loan"));
        add_shortcode('streamlinemortgage_all_loans',array($this,"do_loan_dropdown"));
        add_action('gform_after_submission', array($this,'submit_form_for_loan'), 10, 2 );
		add_action("wp_ajax_nopriv_sl_submit_form_for_loan",  array($this, "process_primary_form"));
        add_action("wp_ajax_sl_submit_form_for_loan",  array($this, "process_primary_form"));
    }
    
    /*-------------------  Session Management  --------------------*/
    public function assess_situation($param='') {}

    public function do_loan_dropdown($param='') {

        $calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find(['selects'=>['id','name','period_unit','secondary_form','goal_form','currency']]);

        $options_html='<option value="0">Click to select</option>';

        if (count($calculatorwpLoansetting)>0) {                
            foreach ($calculatorwpLoansetting as $key => $value) {
                $options_html.='<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        }

        $final_html = '
        <div class="">
        <div class="calculatorwp_select_a_loan">
            <script type="text/javascript">
                var sl_dropdown_loan_products=[];
                var sl_product_constants_a=[];
            </script>        
            <center>
                <div class="ewm_fw_selector">
                    Select a Loan:
                </div>
                <div  class="ewm_fw_selector">
                    <select class="calculatorwp_select_a_loan_s" id="calculatorwp_select_a_loan" name="show_repayment">
                        '.$options_html.'
                    </select>
                </div>
            </center>
        </div>';
        
        //loans
        $initial_forms_html='';

        if ( count($calculatorwpLoansetting) > 0 ) {

            foreach ($calculatorwpLoansetting as $key => $value) {

                $initial_forms_html.='
                <div class="option_selector_'.$value->id.'">'.$this->return_primary_form(['product_id'=>$value->id]).'</div>
                <script type="text/javascript">
                    sl_dropdown_loan_products.push("option_selector_'.$value->id.'");
                    sl_product_constants_a['.$value->id.']={
                            "sl_currency" : "'.$value->currency .'",
                            "sl_period" :"'.$value->period_unit.'",
                            "sp_product_id": '.$value->id.'
                        }
                </script>';

            }

        }

        $final_html .= '<div class="calculatorwp_display_products"><center>'.$initial_forms_html.'</center></div></div>';

        return  $final_html;

    }

    
    public function loan_process_session_set($param=  array()){

        /*
         * stage =>(creation(primary)/ additional info(secondary)/ goal/ account details -> when not there)
         * object_id / submission_type  => "spending_goal", "loan", "saving", "user"
         * session_id =>>if(user_not_logged_in) session_to_identify_browser
         * form_stage =>(display, submission[stage])
         * form_id => 
         * 
        */
        
        foreach ($param as $key => $value) {
            $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"][$key] = $value;
        }

    }
    
    public function loan_unset_process_session(){

        unset($_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]);

    }

    //set up the display to be shown
    public function loan_application_navigator($param=''){
        
        if(!isset($_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"])){
            $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]=  array();
        }
        $loan_session = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];        
        
        $this->navigator_core($loan_session);

    }

    public function navigator_core($loan_session=''){

        // if($loan_session['stage'] == 'goal' ){
            $this->gravity_form_skipper($loan_session);
        // }

        $loan_session = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
        
        //if loan and submitted see what stage
        switch ($loan_session['stage']) {

            case "primary":

                if($loan_session['submission_stage']=='saving_complete'){//move to next step
                    $this->primary_to_secondary($loan_session);
                }
                else{
                    $this->display_primary_form([
                        "form_id"=>$loan_session['form_id'],
                        'product_id'=>$loan_session['product_id']
                    ]);
                }

                break;
                
            case "secondary":
                // $this->goal_to_final_redirect($loan_session);
                if( $loan_session['submission_stage'] == 'saving_complete' ){
                    $this->secondary_to_goal($loan_session);
                }
                else{
                    $this->primary_to_secondary($loan_session);
                }

                break;
                
            case "goal":                
                if($loan_session['submission_stage']=='saving_complete'){
                    $this->goal_to_final_redirect($loan_session);
                }
                else{
                    $this->secondary_to_goal($loan_session);
                }

                break;
                
            default:
                break;
            
        }
    
    }

    public function gravity_form_skipper($loan_session=''){

        $var_name='';

        //skip to next step if gravity forms is not set
        $secondary_gf_id = mvc_model('calculatorwpLoansetting')->find_by_id($loan_session['product_id'])->secondary_form;
        $goal_gf_id = mvc_model('calculatorwpLoansetting')->find_by_id($loan_session['product_id'])->goal_form;
        
        if ($loan_session['stage']=='primary') {
            //if (!is_numeric($secondary_gf_id) || $secondary_gf_id<1 || is_null($secondary_gf_id) ){
                //move to next step
                $this->loan_process_session_set(["stage"=>'secondary',"submission_stage"=>"saving_complete"]);                   
            //}
        }
        $loan_session = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];        
        
        if ($loan_session['stage']=='secondary') {
            //if (!is_numeric($goal_gf_id) || $goal_gf_id<1 || is_null($goal_gf_id)) {
                //move to next step
                $this->loan_process_session_set(["stage"=>'goal',"submission_stage"=>"saving_complete"]);
            //}
        }
        
    }

    /*------------------- Display Loan Form -------------------*/
    //display the first form
    public function return_primary_form($param=''){ //template for primary
        $this->loan_process_session_set([
                'stage'=>"primary",
                'object_type'=>"loan",
                'session_id' => calculatorwp_class('calculatorwp_account')->get_user_id(),
                "submission_stage"=>"s",
				'product_id'=>$param['product_id']
            ]);
		
		$ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
       
        /* @todo get this from loan id => display form*/
        $sl_period_unit=sl_period_unit;
        $sl_period_unit=maybe_unserialize($sl_period_unit);
        $sl_currency_of_the_world=sl_currency_of_the_world;
        $sl_currency_of_the_world=maybe_unserialize($sl_currency_of_the_world);
        
		if(array_key_exists('calculatorwpLoansetting',$param)){
        if (is_object($param['calculatorwpLoansetting'])) {
            $calculatorwpLoansetting = $param['calculatorwpLoansetting'];
        }
        else{
            $calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($ses_dat['product_id']);
        }}
		else{
			$calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($ses_dat['product_id']);
		}

        $calculatorwpPeriodunit = $sl_period_unit[$calculatorwpLoansetting->period_unit];
        
		$this->loan_process_session_set(["secondary_form" => $calculatorwpLoansetting->secondary_form ]);
		$this->loan_process_session_set(["goal_form" =>  $calculatorwpLoansetting->goal_form ]);
        
        return calculatorwp_class('calculatorwp_calculator_default_theme')->frontend($param);
    }

    public function display_primary_form($param=''){ //template for primary        
        $this->sl_display_html = $this->return_primary_form($param);
    }

    //transition from first display to second
    public function primary_to_secondary(){//template for secondary
        /* Set next stage = goal */
        $this->loan_process_session_set(["stage"=>'secondary',"submission_stage"=>"form_imput"]);
        $ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
        
        $gf_id = mvc_model('calculatorwpLoansetting')->find_by_id($ses_dat['product_id'])->secondary_form;

        $secondary_form = get_post( $gf_id );

        $secondary_form_content = $secondary_form->post_content;

		//echo "secondary!";
        $this->sl_display_html = '
            <div class="sl_gform_manager">
                <div id="render-container"></div>
                <div id="render-container-submit">
                    <input type="button" class="render-container-submit-button" value="Save">
                </div>
                <script>
                    const formRenderOptions = {
                        formData : '.$secondary_form_content.'
                    }   
                </script>
            </div>
        ';

    }
    
    //transition form second to third display
    public function secondary_to_goal(){//template for goal

        /* Set next stage = goal */
        $this->loan_process_session_set([
            "stage"=>'goal',
            "submission_stage"=>'saving_complete',//"form_imput",
           // 'object_type'=> 'spending_goal', //'spending_goal'
        ]);

        // $this->loan_process_session_set(["stage"=>'goal',"submission_stage"=>"saving_complete"]);
        $ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
        $gf_id = mvc_model('calculatorwpLoansetting')->find_by_id($ses_dat['product_id'])->goal_form;

        $goal_form = get_post( $gf_id );

        // new redirect
        // $this->sl_display_html = calculatorwp_class('calculatorwp_account')->user_gate();    
		//echo "goal form!";
        // $this->sl_display_html = '<div class="sl_gform_manager">'.do_shortcode('[gravityform id="'.$gf_id.'" title="false" description="false" ajax="false"]').'</div>';
        $this->sl_display_html = '2<div  id="render-container" class="sl_gform_manager"></div>';
    }
    
    //transition from third display to account
    public function goal_to_final_redirect($param = '') {
       $this->sl_display_html = calculatorwp_class('calculatorwp_account')->user_gate();
       // var_dump($this->sl_display_html );
    }

    public function display_form_for_loan($atts){ //primary / secondary
        //original display do session and find where the process is
		if(array_key_exists("calculatorwp",$_SESSION)){
			$loan_session = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
		}
		else{ $loan_session =[]; }
		
		if (is_array($loan_session)) {
            //@todo think of possible errors
            if( count( $loan_session ) > 0 && $loan_session["submission_stage"] == "saving_complete" ){
                $this->loan_application_navigator();
            }
            else{
				//primary form display
                $this->display_primary_form(['product_id'=>$atts['product']]);
            }
        }
        else{
            //primary form display
            $this->display_primary_form(['product_id'=>$atts['product']]);
        }
		
		return $this->sl_display_html;
		
    }

    /* Submit form data */
	public function process_primary_form(){

        if (isset($_POST['sp_product_id'])) {
            $this->loan_process_session_set([
                'product_id'=>$_POST['sp_product_id']
            ]);
        }
        
		$loan_application = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
        $param = $_POST;
		
		/* create spending goal if it does not exist */
        if(!isset($loan_application['goal_id'])){
            $spending_goal_id = mvc_model("calculatorwpSpendingoal")->create(["calculatorwpSpendingoal"=>["name"=>$param['sl_loan_goal_name'],"description"=>$param['sl_loan_goal_name'],'email'=>$param['sl_loan_app_email']]]);
            $this->loan_process_session_set( ['goal_id'=>$spending_goal_id] );
        }
        
        /* create loan application id if does not exist and attach it to a corresponding goal */
		if(!isset($loan_application['loan_id'])){
            
            $loan_id = mvc_model("calculatorwpClientloan")->create([

				"amount_needed"=>$param["sl_loan_amount"],
				"term"=>$param["sl_loan_term"],
				"term_period"=>$param["sl_loan_term_period"],
				"goal_id"=>$spending_goal_id,
				"loan_setting_id"=>$loan_application['product_id'],
				"loan_stage"=>1,
				//"client_id"=>$loan_application["session_id"],
				"loan_setting_id"=>$loan_application['product_id']
                
			]);
			
			//Save additional information on the primary to db
			if(isset($param['sl_loan_primary_more_info'])){
				$param = [
					'entry'=>$param['sl_loan_primary_more_info'],
					'object_type' => 2 , //loan
					'object_id' => $loan_id
				];
				
				calculatorwp_raw_data::create_primary_form_raw_data_value($param);
			}
			
            $this->loan_process_session_set(['loan_id'=>$loan_id]);
        }
		
		if ( ($loan_id > 0) && ($spending_goal_id > 0) ) {
            $this->loan_process_session_set(["submission_stage" => "saving_complete"]);
		}
		
		$this->sl_is_json=true;
        $this->loan_process_session_set(["stage"=>'primary',"submission_stage"=>"saving_complete"]);//redirect to complete
        
        echo json_encode($param);//["sl_new_form"=>true ]);
		
		wp_die();

	}
    
    public function submit_form_for_loan($form="f", $entries="e"){

		if(!array_key_exists('primary_to_secondary',$_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"])){
			$_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['primary_to_secondary'] = false;
		}
		if($_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['primary_to_secondary']){
			$this->loan_application_navigator();            
		}
		
        $ses_dat = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"];
        /* Start Submission Process */
        $this->loan_process_session_set(["submission_stage" => "submitted"]);
        
		if(isset($_POST['sl_loan_app_amount_d'])){
			$this->process_primary_form(["pf_data"=>$_POST]);
		}
		
        /* create spending goal if it does not exist */
        $spending_goal_id = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['loan_id'];
        
        /* create loan application id if does not exist and attach it to a corresponding goal */
        $loan_id = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['goal_id'];

        /* add info into raw data -> attach it to a loan */
		switch ($_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['object_type']) {
            case 'spending_goal':
               $object_id = $ses_dat['loan_id'];
               $object_type = 1;
                break;
            
            case 'loan':
               $object_id = $ses_dat['loan_id'];
               $object_type = 2;
                break;
            
            case 'saving':
               $object_id = 0;
               $object_type = 3;
                break;
            
            case 'user':
               $object_id = 0;
               $object_type = 4;
                break;

            default:
                break;
        }
        
        $param = [
            'entry'=>$entries,
            'form' => $form,
            'object_type' => $object_type , //loan
            'object_id' => $object_id
        ];
        
        /* return true if saved or false if not */
        $is_raw_data_saved = true; //calculatorwp_class('calculatorwp_raw_data')->gf_to_calculatorwp_parser($param);

        if ($is_raw_data_saved ) {
            // $this->loan_process_session_set(["submission_stage" => "saving_complete"]);
		}
        // $this->loan_application_navigator();
        
    }
	
	public function connect_loan_to_user(){
		//update session
		//update client loan
        $loan_id = 0;
        if( array_key_exists( 'loan_id' , $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"] ) ){ 
            $loan_id = $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]['loan_id'];
        }
        
       $user_id=calculatorwp_class('calculatorwp_account')->get_current_user_sl_id();
       $update_sucessful_id = mvc_model('calculatorwpClientloan')->save([
                'id'=>$loan_id,
                "client_id"=> $user_id
            ]);
		
		if($update_sucessful_id){

            do_action('calculatorwp_loan_application', [
                'loan_id'=>$loan_id,
                "client_id"=> $user_id
            ] );

			unset($_SESSION["calculatorwp"]);

		}
	}
	
	public function there_is_an_active_session(){
		if(isset($_SESSION["calculatorwp"])){
			if (is_array($_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"])) {
			  $active_ses = count( $_SESSION["calculatorwp"]["pending_processes"]["loan_application_process"]);
			}
			else{
				$active_ses = 0;
			}
		}
		if(isset($active_ses)){
			if($active_ses>0){
				return true;
			}
			else{
				return false;
			}
		}
	}
}