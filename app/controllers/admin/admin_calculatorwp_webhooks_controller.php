<?php
	class AdminCalculatorwpWebhooksController extends MvcAdminController {
	    
	    var $default_columns = array('id', 'name');
		public $before = ['domenu'];
		
	    public function domenu() {
	    	
			//$menu_html="";
			$menu_html="<div class='sl_b_wrapper_design'>";
		    $menu_html.="<div class='sl_menu_html wrap'><ul class='subsubsub lp_com_top_parent' >";
						$menu_html.= "<li class='lp_com_header'> <img class='lp_com_header_img' src='". SM_HOME_URL ."/app/public/img/5.png' alt='". SM_HOME_URL ."/app/public/img/5.png' class='transparent shrinkToFit' width='200' height='100'></li>";
						$menu_html.= "<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => 'index',)).">Ticketing</a></li>";
						$menu_html.= '<li class="lp_com_header"> <a href="'.mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "index", "id" =>"" )).'">All Custom Email(s)</a></li>';
	  					$menu_html.= "<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a></li>";
		    $menu_html.="</ul></div>";
		   

	        echo $menu_html;
	    }
		
		public function index(){
			do_action("calculatorwp_welcome_lender");
		
			$this->set('objects', mvc_model("calculatorwpWebhook")->find());
				
		}
		public function go_pro(){
			
		}

		public function add() {
			if (!empty($this->params['data']) && !empty($this->params['data'])) {
			  $object = $this->params['data'];
			  $more_data=$this->params['more_data'];
			  if (empty($object['id'])) {
				 
				$this->model->create($object);
				$id = $this->model->insert_id;
				$this->save_additional_data($more_data,$id );
				$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
				$this->flash('notice', 'Successfully created!');
				$this->redirect($url);
			 }
			}
		}
		
		public function save_additional_data($more_data,$id ){
			if (is_array($more_data)) {				
				foreach($more_data as $key=>$value){
						if (is_array($value)) {	
						foreach($value as $single){
							$single['webhook_id']=$id;
							mvc_model($key)->save($single);
						}
					}
				}
			}
		}
	  
		public function edit() {
			if (!empty($this->params['data'])) {
			  $object = $this->params['data'];
			  $object['calculatorwpWebhook']['last_modified'] = date('Y-m-d H:i:s');
			  if ($this->model->save($object)) {
				$more_data=$this->params['more_data'];
				$id=$object['calculatorwpWebhook']['id'];
				$this->save_additional_data($more_data,$id );
				
				$this->flash('notice', 'Successfully saved!');
				$this->refresh();
			  } else {
				$this->flash('error', $this->model->validation_error_html);
			  }
			}
			$this->set_object();		
		}
		
		public function resend_failed_webhook(){
			$id = $this->params['id'];
			$retry_processing_failed_events = calculatorwp_class('calculatorwp_events_manager')->retry_processing_failed_events($id);
			
			//redirect to edit with 
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
			$this->flash('notice', $retry_processing_failed_events );
			$this->redirect($url);
		}
		
		public function view_logs(){
			$this->set('objects', mvc_model('calculatorwpWebhookLog')->find(array("conditions"=>array("webhook_id"=>$this->params['id'],))));
		}
		
	}
?>