<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

MvcConfiguration::set(array(
    'Debug' => false
));

$sl_menu_item = array(
    'AdminPages' => array(
    	'calculatorwp_clientloannotes' => array(
                'icon'=>'dashicons-bank',
                'label'=>'Streamline Mortgage',
                'add'=> array(
                    'label' => 'Statistics',
                    'in_menu' => false,
                ),
            ),
        'calculatorwp_clientloans' => array(
            'icon'=>'dashicons-chart-area',
            'label'=>'Applications',
            'add'=> array(
                    'label' => null,
                    'in_menu' => false,
                ),
            'process'=> array(
                    'label' => 'Process' ,
                    'in_menu' => false
                ),
            'delete'=> array(
                    'label' => __('Delete', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
            'edit'=> array(
                    'label' => __('edit', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
            'goal_info'=>array(
                    'label' => __('edit', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
            'more_loan_info'=>array(
                    'label' => __('edit', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
            'index_select'=>array(
                    'label' => __('index_select', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
            'parent_slug'=>'mvc_calculatorwp_clientloannotes',
        ),
    	'calculatorwp_loansettings' => array(
            'icon'=>'dashicons-bank',
			'label'=>'Products',
			'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'parent_slug'=>'mvc_calculatorwp_clientloannotes',
        ),
        'calculatorwp_messages' => array(
            'icon'=>'dashicons-chart-area',
            'label'=>'Communications',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'create_ticket'=> array(
                'label' => __('message_room', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'message_room'=> array(
                'label' => __('message_room', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ), 
            'go_pro'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'mark_as_resolved'=>array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'unresolved_index'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_calculatorwp_clientloannotes',
        ),
        'calculatorwp_dentries' => array(
            'icon'=>'dashicons-chart-area',
            'label'=>'Transactions',
            'transaction_list'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'repay'=> array(
                'label' => __('repay', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'payment_done'=> array(
                'label' => __('payment_done', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'in_menu' => false,
			'parent_slug'=>'mvc_calculatorwp_clientloans',
        ),        
        'calculatorwp_clientaccounts' => array(
            'label'=>'Borrowers',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_calculatorwp_clientloannotes',
        ),
        'calculatorwp_webhook_logs' => array(  
            'icon'=>'dashicons-chart-area',
            'label'=>'Logs',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'add'=> array(
                'label' => __('ad', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'download_logs'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'clear_logs'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'hide_menu'=> true,
            'parent_slug'=>'mvc_calculatorwp_webhooks',
        ),        
        'calculatorwp_webhooks' => array(
            'icon'=>'dashicons-chart-area',
            'label'=>'Custom eMail',    
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'go_pro'=> array(
                'label' => __('ad', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'resend_failed_webhook'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'view_logs'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_calculatorwp_messages',
        ),
        'calculatorwp_mailchimps' => array(
                'icon'=>'dashicons-chart-area',
                'label'=>'Mailchimp Settings',
                'index'=> array(
                    'label' => 'Statistics',
                    'in_menu' => false,
                ),
                'settings_two'=> array(
                    'label' => __('edit', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
                 'parent_slug'=>'mvc_calculatorwp_messages',
        ),
    )
);

MvcConfiguration::append($sl_menu_item);

add_action('admin_init', 'calculatorwp_on_mvc_admin_init');
add_action('wp_enqueue_scripts','calculatorwp_public_resources');

function calculatorwp_public_resources($options) {
   wp_enqueue_style('sl_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'style_public'));
    
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );
	
    wp_enqueue_script( 'sl-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'public-script') , array('jquery') );
	wp_localize_script( 'sl-main-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    
    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_enqueue_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );   

    wp_enqueue_style('calculatorwp-mvc_admin', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'wh-style'));
    wp_enqueue_script( 'calculatorwp-clipboard-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    // Your custom js file
    wp_enqueue_script( 'calculatorwp-media-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'wh-script') , array('jquery') );
    wp_localize_script( 'calculatorwp-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    // Your custom js file
    wp_enqueue_script( 'sl-calc-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'accrue') , array('jquery') );


    //CSS files
    wp_enqueue_style('ps_boards_a_style_public', mvc_css_url( WP_calculatorwp__PLUGIN_DIR, 'style_candidate_public' ) ) ;

    wp_enqueue_style('ps_boards_b_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'bootstrap-reboot.min'));

    wp_enqueue_style('ps_boards_c_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'bootstrap-grid.min'));

    wp_enqueue_style('ps_boards_d_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'owl.carousel.min'));

    wp_enqueue_style('ps_boards_e_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'nouislider.min'));

    wp_enqueue_style('ps_boards_d_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'select2.min'));

    wp_enqueue_style('ps_boards_e_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'jquery.mCustomScrollbar.min'));

    wp_enqueue_style('ps_boards_f_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'ionicons.min'));

    wp_enqueue_style('ps_boards_g_style_public', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'main'));

    wp_enqueue_style('ps_boards_h_style_public', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');

    wp_enqueue_style('ps_boards_i_style_public', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css');


    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'srb-boards-a-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'public-candidate-script.js') , array('jquery') );
    wp_localize_script( 'srb-boards-a-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-b-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'bootstrap.bundle.min.js') , array('jquery') );
    wp_localize_script( 'srb-boards-b-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-c-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'owl.carousel.min.js') , array('jquery')) ;
    //wp_localize_script( 'srb-boards-c-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-d-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'wNumb.js') , array('jquery') );
    wp_localize_script( 'srb-boards-d-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-e-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'nouislider.min.js') , array('jquery') );
    wp_localize_script( 'srb-boards-e-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-f-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'select2.min.js' ) , array('jquery') );
    wp_localize_script( 'srb-boards-f-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-g-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'jquery.mousewheel.min.js' ) , array('jquery') );
    wp_localize_script( 'srb-boards-g-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    wp_enqueue_script( 'srb-boards-h-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'jquery.mCustomScrollbar.min.js') , array('jquery') );
    wp_localize_script( 'srb-boards-h-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'srb-boards-i-main-lib-uploader-js', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js' , array('jquery') );
    //wp_localize_script( 'srb-boards-i-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    //wp_enqueue_script( 'srb-boards-i-main-lib-uploader-js', mvc_js_url(WP_SRBOARDS__PLUGIN_DIR, 'main') , array('jquery') );
    //wp_localize_script( 'srb-boards-i-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    //wp_enqueue_script( 'srb-boards-j-main-lib-uploader-js', WP_calculatorwp__PLUGIN_DIR.'/app/public/js/public-job-script.js' , array('jquery') );
    //wp_localize_script( 'srb-boards-j-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    //wp_enqueue_script( 'srb-boards-k-main-lib-uploader-js', WP_calculatorwp__PLUGIN_DIR.'/app/public/js/public-client-script.js' , array('jquery') );
    //wp_localize_script( 'srb-boards-k-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'srb-boards-l-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'public-profile-script.js' ) , array('jquery') );
    wp_localize_script( 'srb-boards-l-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    //wp_enqueue_script( 'srb-boards-m-main-lib-uploader-js', WP_calculatorwp__PLUGIN_DIR.'/app/public/js/public-agency-script.js' , array('jquery') ); 
    //wp_localize_script( 'srb-boards-m-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    //wp_enqueue_script( 'srb-boards-o-main-lib-uploader-js', WP_calculatorwp__PLUGIN_DIR.'/app/public/js/sr_js_resent_candidate_widget.js'  , array('jquery') ); 
    //wp_localize_script( 'srb-boards-o-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

    // Load the datepicker script (pre-registered in WordPress).
    // wp_enqueue_script( 'srb-boards-m-main-lib-uploader-js', mvc_js_url(WP_SRBOARDS__PLUGIN_DIR, 'public-job-scriptjs') , array('jquery') );
    // wp_localize_script( 'srb-boards-m-main-lib-uploader-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

}

function calculatorwp_on_mvc_admin_init($options) {
    
    wp_enqueue_style('sl-mvc_admin', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'style'));
   
    //Core media script
    wp_enqueue_media();

    // Your custom js file
    wp_enqueue_script( 'sl-media-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'main-script') , array('jquery') );
    wp_localize_script( 'sl-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'sl-main-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'public-script') , array('jquery') );
	wp_localize_script( 'sl-main-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
   
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_enqueue_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script( 'calculatorwp-copy-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    wp_enqueue_style('calculatorwp-mvc_admin', mvc_css_url(WP_calculatorwp__PLUGIN_DIR, 'wh-style'));
    wp_enqueue_script( 'calculatorwp-clipboard-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    // Your custom js file
    wp_enqueue_script( 'calculatorwp-media-lib-uploader-js', mvc_js_url(WP_calculatorwp__PLUGIN_DIR, 'wh-script') , array('jquery') );
    wp_localize_script( 'calculatorwp-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

function my_hidden_submenu_page(){

    //remove it
    remove_submenu_page('mvc_calculatorwp_clientloannotes','mvc_calculatorwp_clientloans-process');

}

add_action('admin_menu', 'my_hidden_submenu_page',0,10000);

?>