<div class = "sl_dash_wrap_d">

    <div class="mainstats_name">

        <div class="calculatorwp_flow_stats">

            <div id="calculatorwp_application">
				<span class="sl_stat_flow_description">
					<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('calculatorwpClientloan')->count(array('conditions'=>array('loan_stage'=>1))); ?> <span class="sl_stat_flow_description_main">
					New Applications
				</span></div>
            <div id="calculatorwp_processed">
				<span class="sl_stat_flow_description">
					<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('calculatorwpClientloan')->count(array('conditions'=>array('loan_stage'=>array('2','4')))); ?> 
					Viewed & Processing
				</span>
			</div>
            <div id="calculatorwp_repayment">
				<span class="sl_stat_flow_description">
					<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('calculatorwpClientloan')->count(array('conditions'=>array('loan_stage'=>3))); ?> 
					Approved
				</span>
			</div>
            <div id="calculatorwp_close">
				<span class="sl_stat_flow_description">
					<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('calculatorwpClientloan')->count(array('conditions'=>array('loan_stage'=>5))); ?> 
					Declined
				</span>
			</div>
            
        </div>

    </div>
	
	<div class="calculatorwp_log_list">
	
	<?php

		if(count($objects) > 0){
			
			foreach( $objects as $object ){
				
				$status_var=[
					1=>"Notification not viewed by the client yet",
					2=>"Notification viewed by the client",
					3=>"Deleted"
				];
				
				echo '
				<div class="sl_activity_log">
					<div class="sl_message_line">'.$object->message.' </div>
					<span class="sl_note_description">
						<span class="sl_client_link_dash"> Client <a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit','id' => $object->user_id )).'">'.mvc_model('calculatorwpClientaccount')->find_by_id($object->user_id)->firstname.' </a> : <i>'.$status_var[$object->status].'</i>  </span> - 
						<span class="sl_details_list_t">'.$object->time_created.' - 
						Update By: <b>'. $object->admin_user .'</b></span>
					</span>
					<a class="sm_admin_link" target="blank" href ="'.$object->admin_link.'" >Open</a>
				</div>';	
			}
		}
		else{
			echo '<div class="sl_activity_log">There is no activity yet.</div>';
		}
	?>

	</div>
	<div class="cpw_sl_paginate_dash">
		<center><?php  echo paginate_links($pagination); ?></center>
	</div>
    
</div>

