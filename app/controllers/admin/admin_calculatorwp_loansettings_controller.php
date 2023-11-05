<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminCalculatorwpLoansettingsController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
		
        $menu_html="<div class='sl_b_wrapper_design'>
		<div class='sl_menu_html wrap'>
			<ul class='subsubsub lp_com_top_parent'>
				<li class='lp_com_header'><a class='' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => '',)).">Product(s)</a> </li>
				<li class='lp_com_header'> <a class='' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'add','id'=>2)).">New Product</a></li>
			</ul>
		</div>";

        echo $menu_html;

    }
    
    public function index() {
    	do_action("calculatorwp_welcome_lender");
		$objects = $this->model->find();
		$this->set_objects();
    }
	
    public function add() {
		$total_count = $this->model->count(['conditions'=>[]]);
		//if($total_count > 0 ){
			//$url = MvcRouter::admin_url(array('controller' => 'calculatorwp_messages' , 'action' => 'go_pro'));
			//$MvcAdminController = new MvcAdminController();
			// $MvcAdminController->flash('notice', 'We are happy to be of service to you, add a new product and <b>comminicate & follow up on leads like a pro.</b>');
			// $MvcAdminController->redirect($url);
		//}
		// else{
			if (!empty($this->params['data']) && !empty($this->params['data'])) {
					$object = $this->params['data'];
				
				if (empty($object['id'])) {
					$this->model->create($this->params['data']);
					$id = $this->model->insert_id;
					$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
					$this->flash('notice', 'Successfully saved! <br>IMPORTANT: You need to go to Settings > Permalinks and click “save” to avoid getting a 404 page. <br>Use the shortcodes below to start accepting loan applications and user account creation<br> Getting started documentation <b>:</b> <a href = "https://wordpress.org/support/?post_type=topic&p=11352130" >Click Here</a>');
					$this->redirect($url);
				}
			}
		//}
		
    }
	
    public function edit() {
        if (!empty($this->params['data']) ) {
           
           if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Successfully saved! <br>IMPORTANT: You need to go to Settings > Permalinks and click “save” to avoid getting a 404 page. <br>Use the shortcodes to start accepting loan applications and user account creation<br> Getting started documentation https://wordpress.org/support/?post_type=topic&p=11352130');
				$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}
		$this->set_object();			
	}
	
    public function grouplink() {
		
    }
	
    public function delete() {
	$this->set_object();
		if (!empty($this->object)) {
		  $this->model->delete($this->params['id']);
		  $this->flash('notice', 'Successfully deleted!');
		} else {
		  $this->flash('warning', 'An Error Message with ID "'.$id.'" couldn\'t be found.');
		}
		$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'index'));
		$this->redirect($url);
    }
    
}

?>