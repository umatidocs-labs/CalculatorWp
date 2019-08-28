<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 
require_once dirname(__FILE__).'/libs/load_libs.php';
           
function simplelender_class($class_name){
	$class_instance = new $class_name();
	return $class_instance;
}

require_once dirname(__FILE__).'/data_manager/data_manager.php';
require_once dirname(__FILE__).'/user/simplelender_account.php';
require_once dirname(__FILE__).'/loans/simplelender_loan.php';
require_once dirname(__FILE__).'/simplelender_api.php';

class simplelender_init{
	
    public function init(){
		$this->load_hooks();
    }
	
    public function load_hooks(){
		$this->register_my_session();
		simplelender_class('simplelender_loan')->init();
        simplelender_class('simplelender_gravity_form_manager')->init();
		simplelender_class('simplelender_account')->init();
		simplelender_class('simplelender_raw_data')->init();
        if ( simplelender_fs()->is_plan('growth') ) {
            simplelender_class('simplelender_events_manager')->init();        
        }
    }
        
    public function register_my_session(){
        if( ! session_id() ) {
            session_start();
        }
        //unset( $_SESSION["simplelender"]);
    }
}

register_nav_menus( array(
        'simplelender_client_admin_menu' => __( 'Simplelender Client Admin menu', 'simplelender' ),
    ));
add_action('after_setup_theme', 'sl_remove_admin_bar');

function sl_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}


?>
