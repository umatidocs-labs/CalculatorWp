<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminCalculatorwpMailchimpsController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');

    public $before = ['domenu'];
		
	    public function domenu() {

		    $menu_html="<div class='sl_b_wrapper_design'>
			<div class='sl_menu_html wrap'>
				<ul class='subsubsub lp_com_top_parent'>
					<li class='lp_com_header'> <img class='lp_com_header_img' src='". SM_HOME_URL ."/app/public/img/5.png' alt='". SM_HOME_URL ."/app/public/img/5.png' class='transparent shrinkToFit' width='200' height='100'></li>
					<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => 'index',)).">Ticketing</a> </li>
					<li class='lp_com_header'> <a href='".mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "index", "id" =>"" ))."'>Custom Email(s)</a></li>
					<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a></li>
		        </ul>
			</div>";

	        echo $menu_html;
	}
    
	public function index() {
		
		do_action("calculatorwp_lender_quote");
		do_action("calculatorwp_welcome_lender");

		if (!empty($this->params['data']) && !empty($this->params['data'])) {
	            $object = $this->params['data'];
	        
			if (empty($object['id'])) {
				$this->model->create($this->params['data']);
				$id = $this->model->insert_id;
				$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'settings_two', 'id' => $id));
				$this->flash('notice', 'Almost Done...');
				$this->redirect($url);
	        }
		}				
	}

	public function settings_two() {
		if (!empty($this->params['data'])) {
           
           if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Done!');
				$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}

		$this->set_object();					
	}
	
}

?>