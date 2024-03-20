<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminCalculatorwpClientloannotesController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');

	var $before = ['wrap_a'];
    
	public function index() {

		do_action("calculatorwp_lender_quote");
		do_action("calculatorwp_welcome_lender");
		
		$collection = mvc_model('calculatorwpNotification')->paginate( [
			'order' => 'id DESC',
			'per_page' => 1000
		] );
		
        $this->set('objects', $collection['objects']);
        
		$this->set_pagination($collection);
		
	}

	public function wrap_a(){
		// echo '<div class="sl_b_wrapper_design">';
	}

	public function settings_one() {
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