<tr style="width:100%;">
    <td style="padding:20px 30px;">
		<?php  
			if (isset($object->id)){
				
				echo '<span class="calculatorwp_list_name">'.mvc_model('calculatorwpWebhook')->find_by_id(mvc_model('calculatorwpWebhookEvent')->find_by_id($object->webhook_event_id)->webhook_id)->name.'</span>';
			}
			else{
				echo '(Not Set)';
			}
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php  
			if (isset($object->successful)){
				$calculatorwp_successful=array('failed','successful');
				echo $calculatorwp_successful[$object->successful];
			}
			else
				echo '(Not Set)';
		?>
	</td>	
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->retry)){
				$calculatorwp_retry=array('first attempt','retry');
				echo $calculatorwp_retry[$object->successful];
			}
			else
				echo '(Not Set)'
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->log_type)){
				$calculatorwp_log_type=array(1=>'Notification trigger',2=>'Notification modification');
				echo $calculatorwp_log_type[$object->log_type];
			}
			else
				echo '(Not Set)'
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->log_type)){
				echo $object->timestamp;
			}
			else
				echo '(Not Set)'
		?>
	</td>
</tr>