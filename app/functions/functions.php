<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 

header("Access-Control-Allow-Origin: *");

require_once dirname(__FILE__).'/libs/load_libs.php';
           
function calculatorwp_class($class_name){
	$class_instance = new $class_name();
	return $class_instance;
}

require_once dirname(__FILE__).'/data_manager/data_manager.php';
require_once dirname(__FILE__).'/user/calculatorwp_account.php';
require_once dirname(__FILE__).'/loans/calculatorwp_loan.php';
require_once dirname(__FILE__).'/calculatorwp_api.php';
require_once dirname(__FILE__).'/events/calculatorwp_events_manager.php';
// require_once dirname(__FILE__).'/mobileapp/load_classes.php';

class calculatorwp_init{
	
    public function init(){
		$this->load_hooks();
    }
	
    public function load_hooks(){
		
		$this->register_my_session();
		calculatorwp_class('calculatorwp_loan')->init();
        calculatorwp_class('calculatorwp_gravity_form_manager')->init();
		calculatorwp_class('calculatorwp_account')->init();
		calculatorwp_class('calculatorwp_raw_data')->init();
       
        add_action('calculatorwp_borrower_top_menu',[$this,'borrower_top_menu']);
    }
        
    public function register_my_session(){
        if( ! session_id() ) {
            session_start();
        }
        //unset( $_SESSION["calculatorwp"]);
    }

    public function borrower_top_menu(){
        $top_menu_html = '<div class="logout_link_wrapper">
                    <div id="calculatorwp_dash_menu">
                        <nav id="site-navigation" class="calculatorwp_dash_menu" role="navigation" aria-label="Top Menu">
                        </nav>
                    </div>
                <span class="logout_link">';
       // $client_id=
        $user = wp_get_current_user();
        $client_id = mvc_model('calculatorwpClientaccount')->find_one([
                        'conditions'=>[
                            'wp_user_id'=>$user->data->ID
                        ]])->id;
       $client_notification_count = mvc_model('calculatorwpNotification')->count([
                                            'conditions'=>[
                                                'status'=>1,
                                                'user_id'=>$client_id
                                        ]]);
        $top_menu_html .= "<a href='". mvc_public_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'index',))."'> <span class='cwp_menu_item'>Mortgage Applications </span> </a> ";
        $top_menu_html .= "<a href='". mvc_public_url(array('controller' => 'calculatorwp_messages', 'action' => 'index',))."'>  <span class='cwp_menu_item'> Tickets </span> </a> ";
        $top_menu_html .= "<a href='". mvc_public_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'notification','id'=>$client_id))."'>  <span class='cwp_menu_item'> Notifications (".$client_notification_count.") </span> </a>";
        // $top_menu_html .= "<span class=''> ".$user->data->user_nicename." </span>";
        $top_menu_html .= "<a href=".wp_logout_url($_SERVER['REDIRECT_URL'])."><button> ".$user->data->user_nicename." : Logout</button></a></span></div>";

        echo $top_menu_html;
    }
}

function show_data_name(){
	global $wpdb;
	$WP_DC_CURRENT_BLOG_ID = WP_DC_CURRENT_BLOG_ID;
	$WP_DC_CURRENT_BLOG_ID = $wpdb->get_blog_prefix($WP_DC_CURRENT_BLOG_ID);

	// var_dump($WP_DC_CURRENT_BLOG_ID);

}

add_shortcode( 'show_data_name', 'show_data_name' );

register_nav_menus( array(
        'calculatorwp_client_admin_menu' => __( 'calculatorwp Client Admin menu', 'calculatorwp' ),
    ));
add_action('after_setup_theme', 'sl_remove_admin_bar');

function sl_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}


function sl_request_business(){
	$messages = 'We are happy to be of service to you, <b>comminicate & follow up on leads like a pro.</b>';
	$url = MvcRouter::admin_url(array('controller' => 'calculatorwp_messages' , 'action' => 'go_pro'));
	$MvcAdminController = new MvcAdminController();
	$MvcAdminController->flash('notice', $messages );
	$MvcAdminController->redirect($url);
	
}

add_action("sl_require_pro_action","sl_request_business");

function sl_do_track(){
	
	echo "
			<!-- Facebook Pixel Code -->
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window,document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '2077079475867950'); 
					fbq('track', 'Subscribe', {
						value: 20,
						currency: 'usd',
						subscription_id: '1',
					  });
				</script>
				<noscript>
				 <img height='1' width='1' 
				src='https://www.facebook.com/tr?id=2077079475867950&ev=Subscribe
				&noscript=1'/>
				</noscript>
			<!-- End Facebook Pixel Code -->
		";
		update_option('sm_current_plan','growth');	
	
		echo "
			<!-- Facebook Pixel Code -->
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window,document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '2077079475867950'); 
					fbq('track', 'Subscribe', {
						value: 70,
						currency: 'usd',
						subscription_id: '2',
					  });
				</script>
				<noscript>
				 <img height='1' width='1' 
				src='https://www.facebook.com/tr?id=2077079475867950&ev=Subscribe
				&noscript=1'/>
				</noscript>
			<!-- End Facebook Pixel Code -->
			";
		update_option('sm_current_plan','connect');
	
		echo "
			<!-- Facebook Pixel Code -->
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window,document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '2077079475867950'); 
					fbq('track', 'Subscribe', {
						value: 700,
						currency: 'usd',
						subscription_id: '3',
					  });
				</script>
				<noscript>
				 <img height='1' width='1' 
				src='https://www.facebook.com/tr?id=2077079475867950&ev=Subscribe
				&noscript=1'/>
				</noscript>
			<!-- End Facebook Pixel Code -->";
			update_option('sm_current_plan','enterprise');
	

}

function sm_check_status(){
	//update_option('sm_current_plan','enterpriser');
	sl_do_track();
}

function sl_hide_mitem(){
echo "
<script type='text/javascript'>
	jQuery('.current').hide();
</script>";
}

add_action("admin_footer",'sm_check_status');


?>

