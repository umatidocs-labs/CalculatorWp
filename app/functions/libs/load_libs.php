<?php

require_once dirname(__FILE__).'/action-scheduler/action-scheduler.php';

if ( !function_exists( 'simplemortgage_plugin_active' ) ) {

	function simplemortgage_plugin_active( $plugin )
	{
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	}
	
}

if (!function_exists('MvcPublicLoader')){
    require_once dirname(__FILE__).'/mvc/MvcLoader.php';
}
?>