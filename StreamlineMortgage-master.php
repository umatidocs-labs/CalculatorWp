<?php

/* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */

/*
Plugin Name: StreamlineMortgage-master
Plugin URI: https://www.naiwealth.com/
Description: A complete loan origination tool for lenders on wordpress.
Author: Naiwealth
Version: 2.6.9
Author URI: https://www.naiwealth.com/
*/

/*
if ( ! function_exists( 'cowp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function cowp_fs() {
        global $cowp_fs;

        if ( ! isset( $cowp_fs ) ) {
            // Activate multisite network integration.
            if ( ! defined( 'WP_FS__PRODUCT_11543_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_11543_MULTISITE', true );
            }

            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $cowp_fs = fs_dynamic_init( array(
                'id'                  => '11543',
                'slug'                => 'StreamlineMortgage-master',
                'premium_slug'        => 'CalculatorWP-premium',
                'type'                => 'plugin',
                'public_key'          => 'pk_a9f1ac9df7685f4550844c7d21158',
                'is_premium'          => true,
                'is_premium_only'     => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'is_org_compliant'    => false,
                'trial'               => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                'menu'                => array(
                    'slug'           => 'mvc_calculatorwp_clientloannotes',
                    'support'        => false,
                ),
            ) );
        }

        return $cowp_fs;
    }

    // Init Freemius.
    cowp_fs();
    // Signal that SDK was initiated.
    do_action( 'cowp_fs_loaded' );
}

error_reporting( 0 );
*/
if ( !defined( 'WP_calculatorwp__PLUGIN_DIR' ) ) {
    
    $dir_name = basename( dirname( __FILE__ ) );
    define( 'WP_calculatorwp__PLUGIN_DIR', $dir_name );
    define( 'WP_calculatorwp__PLUGIN_URL', plugins_url( plugin_basename( WP_calculatorwp__PLUGIN_DIR ) ) );
    global  $wpdb ;
    $WP_DC_CURRENT_BLOG_ID = get_current_blog_id();
    $WP_DC_CURRENT_BLOG_ID = $wpdb->get_blog_prefix( $WP_DC_CURRENT_BLOG_ID );
    define( 'WP_DC_CURRENT_BLOG_ID', $WP_DC_CURRENT_BLOG_ID );
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }
    
    if ( !function_exists( 'calculatorwp_fs' ) ) {
        // Create a helper function for easy SDK access.
        class fs_c
        {
            public function is_plan( $plans )
            {
                return true;
            }
        
        }
        function calculatorwp_fs()
        {
            global  $calculatorwp_fs ;
            if ( !isset( $calculatorwp_fs ) ) {
                // Include Freemius SDK.
                $calculatorwp_fs = new fs_c();
            }
            return $calculatorwp_fs;
        }
        
        // Init Freemius.
        calculatorwp_fs();
        // Signal that SDK was initiated.
        do_action( 'calculatorwp_fs_loaded' );
    }
    
    require_once dirname( __FILE__ ) . '/app/functions/functions.php';
    if ( !function_exists( 'calculatorwp_activate' ) ) {
        function calculatorwp_activate()
        {
            ob_start();

            global  $wp_rewrite ;
            require_once dirname( __FILE__ ) . '/calculatorwp_loader.php';
            $loader = new calculatorwpLoader();
            $loader->activate();
            $wp_rewrite->flush_rules( true );
            
            ob_get_clean();
            GFForms::activation_hook();
        }
    
    }
    function calculatorwp_confirm_install()
    {
        global  $wpdb ;
        $table_name = $wpdb->base_prefix . "calculatorwp_account";
        $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
        if ( !$wpdb->get_var( $query ) == $table_name ) {
            // go go
            calculatorwp_activate();
        }
    }
    
    add_action( 'admin_init', 'calculatorwp_confirm_install' );
    if ( !function_exists( 'calculatorwp_deactivate' ) ) {
        function calculatorwp_deactivate()
        {
            global  $wp_rewrite ;
            require_once dirname( __FILE__ ) . '/calculatorwp_loader.php';
            $loader = new calculatorwpLoader();
            $loader->deactivate();
            $wp_rewrite->flush_rules( true );
        }
    
    }
    if ( !function_exists( 'calculatorwp_loadmanager' ) ) {
        function calculatorwp_loadmanager()
        {
            calculatorwp_class( 'calculatorwp_init' )->init();
        }
    
    }
    register_activation_hook( __FILE__, 'calculatorwp_activate' );
    register_deactivation_hook( __FILE__, 'calculatorwp_deactivate' );
    add_action(
        'init',
        'calculatorwp_loadmanager',
        8888,
        1
    );
} else {
    //echo there are tow installations of calculatorwp.
    if ( !function_exists( 'calculatorwp_plugin_active' ) ) {
        function calculatorwp_plugin_active( $plugin )
        {
            return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
        }
    
    }
   
}
