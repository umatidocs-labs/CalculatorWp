<?php
	
	class AdminCalculatorwpWebhookLogsController extends MvcAdminController {
	    
	    var $default_columns = array('id', 'name');
		public $before = ['domenu'];
		
	    public function domenu() {
	        $menu_html="";
	        $menu_html.="<div class='calculatorwp_menu_html'><center>";
			$menu_html.='<div>
					<span class="wp-core-ui button-primary" ><a class="calculatorwp_menu_item_a"  href="'.mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "index", "id" =>"2" )).'">APIs</a></span>
				</div>';
	        
	        $menu_html.="</center></div>";

	        echo $menu_html;
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
			foreach($more_data as $key=>$value){
				foreach($value as $single){
					$single['webhook_id']=$id;
					mvc_model($key)->save($single);
				}
			}
		}
	    
		public function edit() {
			if (!empty($this->params['data'])) {
			  $object = $this->params['data'];			 
			  $object['calculatorwpWebhook']['last_modified'] = time();
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

		public function clear_logs(){
			mvc_model('calculatorwpWebhookLog')->delete_all();
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'index', 'id' =>''));
			$this->flash('notice', 'Logs have been successfully cleared!');
			$this->redirect($url);		
		}
		
		public function download_logs(){
			//redirect to edit with
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'index', 'id' => ''));
			$this->flash('notice', 'Csv downloaded' );
			$this->redirect($url); 
		}

	}

	?>