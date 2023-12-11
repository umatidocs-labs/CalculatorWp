<div class = "">

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
					1=>"not viewed by the client yet",
					2=>"viewed by the client",
					3=>"Deleted"
				];
				
				echo '<div class="sl_activity_log">'.$object->message.' <br><span class="sl_note_description">Client <a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit','id' => $object->user_id )).'">'.mvc_model('calculatorwpClientaccount')->find_by_id($object->user_id)->firstname.' </a>, Created at '.$object->time_created.' ('.$status_var[$object->status].')</span></div>';	
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

