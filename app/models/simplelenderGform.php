<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
/*function simplelender_get_gravity_table_name(){

	if(class_exists('GFForms')) {
		$GFForms_version=GFForms::version;
	}

	if(!empty($GFForms_version)) {
		if ( $GFForms_version >= 2.4 ){
			return '{prefix}gf_form';
		}
		else{
			return '{prefix}rg_form';
		}
	}
	else{
		return '{prefix}gf_form';
	}
}*/

class simplelenderGform extends MvcModel {

    var $display_field = 'title';
	var $table ='{prefix}gf_form';
}

?>