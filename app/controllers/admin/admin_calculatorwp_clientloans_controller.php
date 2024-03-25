<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminCalculatorwpClientloansController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
        // $menu_html="";
		$menu_html="<div class='sl_b_wrapper_design'>";
        $menu_html.="<div class='sl_menu_html wrap'><ul class='subsubsub lp_com_top_parent'>";
		$menu_html.= "<li class='lp_com_header'> <img class='lp_com_header_img' src='". SM_HOME_URL ."/app/public/img/5.png' alt='". SM_HOME_URL ."/app/public/img/5.png' class='transparent shrinkToFit' width='200' height='100'></li>";
        $menu_html.= "<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientloans', 'action' => 'add','id'=>2)).">New Applications</a></li>";
		$menu_html.= "<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'index',)).">Borrowers</a></li>";
        $menu_html.= "<li class='lp_com_header'> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientloans', 'action' => '',)).">All Applications</a></li>";
        $menu_html.="</ul></div>";

        echo $menu_html;

    }
	
	public function index(){
		do_action("calculatorwp_welcome_lender");
		/*$this->model->find( [ [
			'order' => 'id DESC',
		] ] );
		// $this->set_objects();
		*/

		$collection = $this->model->paginate( [
			'order' => 'id DESC',
		] );

        $this->set('objects', $collection['objects']);
        
		$this->set_pagination($collection);
	}
	
	public function index_select(){
		switch($this->params['id']){
			case 1:
				$this->set('object',mvc_model("calculatorwpClientloan")->find(["conditions"=>["loan_stage"=>1]]));
			break;
			case 2:
				$this->set('object',mvc_model("calculatorwpClientloan"));
			
			break;
			case 3:
				$this->set('object',mvc_model("calculatorwpClientloan")->find(["conditions"=>["loan_stage"=>1]]));
			
			break;
		}
		
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
		
		//$this->set_object();
		$this->set('loan_setting',mvc_model('calculatorwpLoansetting'));
		$this->set('client_id',mvc_model('calculatorwpClientaccount'));
    }
	
	public function edit() {
		if (!empty($this->params['data'])) {
		  
		  if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Successfully saved!');
			$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}
		$this->set_object();
		
		$this->set('loan_setting',mvc_model('calculatorwpLoansetting'));
		$this->set('client_id',mvc_model('calculatorwpClientaccount'));

	}
	
	public function process() {

		$user = wp_get_current_user();

		if (!empty($this->params['data']) ) {

		  $Clientloan_data = [
			'id' => $this->params['data']['CalculatorwpClientloan']['id'],
			'loan_stage' => $this->params['data']['calculatorwpClientloan']['loan_stage'],
		  ];

		  $original_loan_stage = mvc_model('calculatorwpClientloan')->find_by_id( $Clientloan_data['id'] )->loan_stage;

			if ($this->model->save( [ 

				'id'=>$this->params['data']['CalculatorwpClientloan']['id'], 
				'loan_stage' => $this->params['data']['calculatorwpClientloan']['loan_stage'] ] ) ) {

				//change to >> //approval //decline //repayment //close
				if( $Clientloan_data['loan_stage']!== $original_loan_stage ){

					switch ( $original_loan_stage) {
						case 1://decline
							# code...
							break;
						case 2://decline
							# code...
							calculatorwp_class('calculatorwp_loan_process')->approve_loan($Clientloan_data);
							break;
						case 3://approval
							# code...
							break;
						case 4://repayment
							# code...
							break;
						case 5://close
							# code...
							break;
						default:
							# code...
							break;
					}

					$calculatorwpClientloan = mvc_model('calculatorwpClientloan')->find_by_id($Clientloan_data['id']);

					$sl_client_loan_stage = unserialize( sl_client_loan_stage );	

					do_action('calculatorwp_loan_status_change',[
							'borrower_id'=>$calculatorwpClientloan->client_id,
							'borrower_data'=>mvc_model('calculatorwpClientaccount')->find_by_id($calculatorwpClientloan->client_id),
							'loan_id'=>$Clientloan_data['id'],
							'message'=>'The Mortgage Application <b>#'.$Clientloan_data['id'].'</b> has changed its Status to '.$sl_client_loan_stage[$Clientloan_data['loan_stage']],
							'admin_link' => mvc_admin_url(array('controller' => 'calculatorwp_clientloans' , 'action' => 'process', 'id' => $Clientloan_data['id'] )),
							'admin_user' => $user->user_login,
							'admin_email' => $user->user_email,
							]
						);

				}

				$this->flash('notice', 'Successfully Processed!');

				$this->refresh();

			} else {

				$this->flash('error', $this->model->validation_error_html);

			}
		  
		}
		
		$this->set_object();

		$this->set('object_id',$this->params['id']);

	}
	
	public function more_loan_info() {

		$this->set('object_id',$this->params['id']);
	}
	
	public function goal_info() {
		
		$this->set('object_id',$this->params['id']);
		
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