<?php

require_once dirname(__FILE__).'/action-scheduler/action-scheduler.php';

if ( !function_exists( 'simplemortgage_plugin_active' ) ) {

	function simplemortgage_plugin_active( $plugin )
	{
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	}
	
}
if ( simplemortgage_plugin_active( "gravityforms-master/gravityforms.php" ) ||  simplemortgage_plugin_active( "gravityforms/gravityforms.php" ) ) {
	//do nothing for now
}
else{
	if( !class_exists('GFForms') ){
		// require_once dirname(__FILE__).'/gf/gravityforms.php';
	}
}

if (!function_exists('MvcPublicLoader')){
    require_once dirname(__FILE__).'/mvc/MvcLoader.php';
}
?>