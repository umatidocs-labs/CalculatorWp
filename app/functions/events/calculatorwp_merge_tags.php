<?php

	require_once dirname(__FILE__).'/tags/calculatorwp_borrower_tags.php';
	require_once dirname(__FILE__).'/tags/calculatorwp_loan_tags.php';
	require_once dirname(__FILE__).'/tags/calculatorwp_more_tags.php';

	function calculatorwp_acf(){
		global $wpdb;
		$type='acf-field';
		$result = $wpdb->get_results($wpdb->prepare(
			"SELECT post_name, post_excerpt FROM wp_posts WHERE post_type = %s ", $type
			), ARRAY_A);
		return $result;
	}

	class calculatorwp_merge_tags{
		public $calculatorwp_tags;
		
		public function __construct(){
			$this->calculatorwp_tags = array(
			'calculatorwp_borrower_tags'=>array(
				'tags' => array(
					array('tag_name'=>'{account_no}','filter_name'=>'calculatorwp_account_no','filter_params'=>1),
					array('tag_name'=>'{first_name}','filter_name'=>'calculatorwp_first_name','filter_params'=>1),
					array('tag_name'=>'{middle_name}','filter_name'=>'calculatorwp_middle_name','filter_params'=>1),
					array('tag_name'=>'{last_name}','filter_name'=>'calculatorwp_last_name','filter_params'=>1),
					array('tag_name'=>'{email}','filter_name'=>'calculatorwp_email','filter_params'=>1),
					array('tag_name'=>'{phone_number}','filter_name'=>'calculatorwp_phone_number','filter_params'=>1),					
				),
				'more_info'=>'Borrower information'
				),
			'calculatorwp_loan_tags'=>array(
				'tags' => array(

					array('tag_name'=>'{application_ID}','filter_name'=>'calculatorwp_application_ID','filter_params'=>1),
					array('tag_name'=>'{loan_amount}','filter_name'=>'calculatorwp_application_amount_needed','filter_params'=>1),
					array('tag_name'=>'{loan_application_date}','filter_name'=>'calculatorwp_application_date','filter_params'=>1),
					array('tag_name'=>'{needed_by_date}','filter_name'=>'calculatorwp_application_needed_by_date','filter_params'=>1),
					array('tag_name'=>'{issue_date}','filter_name'=>'calculatorwp_application_issue_date','filter_params'=>1),
					array('tag_name'=>'{fully_settled_date}','filter_name'=>'calculatorwp_application_fully_settled_date','filter_params'=>1),
					array('tag_name'=>'{application_term}','filter_name'=>'calculatorwp_application_term','filter_params'=>1),			
					array('tag_name'=>'{term_period}','filter_name'=>'calculatorwp_application_term_period','filter_params'=>1),
					array('tag_name'=>'{loan_product}','filter_name'=>'calculatorwp_application_product','filter_params'=>1),
					array('tag_name'=>'{application_stage}','filter_name'=>'calculatorwp_application_stage','filter_params'=>1),
				
				),
				'more_info'=>'Loan application information'),
			'calculatorwp_more_tags'=>array(
				'tags' => array(
				),
				'more_info'=>'Forms submission during<br> the loan application process'),
			);

			$this->calculatorwp_tags['calculatorwp_more_tags']['tags'] = $this->more_info_array_of_tags();
			
		}
		
		public function init(){
			calculatorwp_class('calculatorwp_borrower_tags')->init();
			calculatorwp_class('calculatorwp_loan_tags')->init();
			calculatorwp_class('calculatorwp_more_tags')->init();
		}
		
		public function more_info_array_of_tags(){

			$a_more_infor_keys = mvc_model('calculatorwpDatKey')->find();		
			$more_info_array_of_tags=[];

			if (!is_array($a_more_infor_keys )) {
				$a_more_infor_keys = [];
			}
			
			foreach($a_more_infor_keys as $value){
				//create array of tags
				array_push($more_info_array_of_tags,array(
					'tag_name'=>'{sl_'.$value->name.'}',
					'filter_name'=>'calculatorwp_sl_more_infor_loan_application',
					'filter_params'=>1,
					'tag_custom_info'=>'{sl_'.$value->id.'}'));
			}
			
			return $more_info_array_of_tags;
		}

		public function replace_tags_with_values($param){
		
			$array_of_tags= $this->calculatorwp_tags;
			$param['data_text']=' '.$param['data_text'].' ';
				
			foreach($array_of_tags as $single_array_of_tags){
				foreach($single_array_of_tags as $single_tag_type){
					if (is_array($single_tag_type )) {						
						foreach ($single_tag_type as $single_merge_tag_arr) {
							$param['data_text'] = $this->process_single_tag($param,$single_merge_tag_arr);
						}
					}
				}
			}
			
			return $param['data_text'];
		}
		
		public function display_tag_onsidebar($category='calculatorwp_user_tags'){
			return 
			$final_html ='
	                <ul id= "calculatorwp_webhook_tags">
			<li class="adienienti_tag_copier_header"><b><h3>Merge Tags</h3></b>(Click on tag to copy)</li>
	                <li class="adienienti_tag_copier_header">
	                <select id="calculatorwp_tags_switcher" name="" class="">
						<option selected value="calculatorwp_borrower_tags">Borrower</option>
	                    <option value="calculatorwp_loan_tags">Loan Application</option>
						<option value="calculatorwp_more_tags">Form Fields</option>
	                </select>
	                </li>'.
			$this->single_tag_display()
			.'</ul>
				<script>
				    var btns = document.querySelectorAll("code");
				    var clipboard = new ClipboardJS(btns);

				    clipboard.on("success", function(e) {
				        console.log(e);
				    });

				    clipboard.on("error", function(e) {
				        console.log(e);
				    });
				</script>
			
			';
			return $final_html;
		}
		
		public function single_tag_display(){
			$final_html = "";
	                foreach ($this->calculatorwp_tags as $category => $value) {
	                    $final_html .='<li class=" btn '.$category.' calculatorwp_tag_copier_body" >'.$value['more_info'].'</li>';
	                    foreach($value['tags'] as $single_tag){                    	
	                        $final_html .= '<li class=" btn '.$category.' simplender_tag_copier_body" ><div class="adienienti_tag_copier_body" ><code data-clipboard-text="'.$single_tag['tag_name'].'"  >'.$single_tag['tag_name'].'</code></div></li>';
	                    }
			}
			return $final_html;
		}
		
		public function process_single_tag($param, $merge_tag){
			
			if(strpos($param['data_text'],$merge_tag['tag_name']) == true){

				if ($merge_tag['filter_params'] > 0) {
					if (!empty($merge_tag['tag_custom_info'])) {					
						$param['data']['tag_custom_info']=$merge_tag['tag_custom_info'];									
					}
					$new_value = apply_filters($merge_tag['filter_name'],$param['data']);
				}
				else{
					$new_value = apply_filters($merge_tag['filter_name']);
				}

				return str_replace($merge_tag['tag_name'],$new_value,$param['data_text']);			
			}
			else{
				return $param['data_text'];
			}

		}
	}

	?>
	
