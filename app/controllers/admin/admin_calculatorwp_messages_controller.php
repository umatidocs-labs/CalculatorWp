<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminCalculatorwpMessagesController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
        
		$menu_html="<div class='sl_b_wrapper_design'>
		<div class='sl_menu_html wrap'>
			<ul class='subsubsub lp_com_top_parent'>
				<li class='lp_com_header' > <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => '',)).">Tickets</a></li>
		        <li class='lp_com_header' > <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_webhooks', 'action' => 'index',)).">Custom eMails</a></li>
		        <li class='lp_com_header' > <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a>
			</li>
		</div>";

	    echo $menu_html;

    }
	
	public function index() {
		
		do_action("calculatorwp_welcome_lender");
		
		$this->set('objects', mvc_model("calculatorwpTicket")->find( [ 'order' => 'id DESC' ] ) );
			
	}

	public function go_pro(){}

	public function unresolved_index() {
		$this->set('objects', mvc_model("calculatorwpTicket")->find(['conditions'=>['status'=>1]]));	
	}

	public function message_room() {
		$calculatorwpTicket=mvc_model("calculatorwpTicket")->find_by_id($this->params['id']);
		$this->set(array(
				'objects'=> mvc_model("calculatorwpMessage")->find(array('conditions'=>array('ticket_id'=>$this->params['id']))),
				'ticket'=>[
					'number'=>$calculatorwpTicket->ticket_id,
					'id'=>$this->params['id'],
					'loan_id'=>$calculatorwpTicket->loan_id,
					'status'=>$calculatorwpTicket->status
				]
			));
	}
	
	public function add() {
		if (!empty($this->params['data']) && !empty($this->params['data'])) {
		  $object = $this->params['data'];
		  if (empty($object['id'])) {
			$this->model->create($this->params['data']);
			$id = $this->model->insert_id;
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
			$this->flash('notice', 'Successfully created!');
			$this->redirect($url);
		 }
		}
		$this->set('loan_setting',mvc_model('calculatorwpLoansetting'));
		$this->set('client_id',mvc_model('MvcUser'));
	}
	
	public function mark_as_resolved() {
		if (mvc_model("calculatorwpTicket")->save(['id'=>$this->params['id'],'status'=>2,'close_time'=>date("Y-m-d H:i:s")])) {
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'message_room', 'id' => $this->params['id']));
			$this->flash('notice', 'Ticket has been marked as resolved!');
			$this->redirect($url);
		} else {
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'message_room', 'id' => $this->params['id']));
			$this->flash('error', $this->model->validation_error_html);
			$this->redirect($url);
		}
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