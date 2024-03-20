<tr style="width:100%;">
	<td class="sl_list_single_item_single">
		<span class="">			
			<input id="calculatorwpWebhookNotificationIsActive<?php echo  $object->id; ?>" name="calculatorwpWebhookNotificationIsActive<?php echo  $object->id; ?>" type="checkbox" <?php if($object->notification_is_active){ ?>checked="checked" value="1" <?php } ?>  class="calculatorwp_input_feild">
		</span>
	</td>
    <td class="sl_list_single_item_single">
		<?php  
			if (isset($object->name)){
				
				echo '<span class="">'.esc_html($object->name).'</span>';
			}
			else{
				echo '(Not Set)';
			}
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php  
			if (isset($object->webhook_trigger_action) )
				echo esc_html($object->webhook_trigger_action);
			else
				echo '(Not Set)';
		?>
	</td>	
	<td class="sl_list_single_item_single">
		<?php    
			if (isset($object->last_time_event_is_triggered ))
				echo esc_html($object->last_time_event_is_triggered );
			else
				echo '( Not Set )';
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php    
			if (isset($object->number_of_times_event_was_trigger ))
				echo esc_html($object->number_of_times_event_was_trigger) ;
			else
				echo '( Not Set )';
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php    
			if (isset($object->unsuccessful_attempts_to_send_webhook ))
				echo esc_html($object->unsuccessful_attempts_to_send_webhook) ;
			else
				echo '(Not Set)';
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php    
			if (isset($object->id))
				echo esc_html(calculatorwp_class('calculatorwp_events_manager')->WebhookLog_unsuccessful_count($object->id));
			else
				echo '(Not Set)';
		?>
	</td>
	<td class="calculatorwp_house_keeping">

		<?php   
			if (isset($object->__id)){
				echo "<center><a class='calculatorwp_house_keeping_link sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'calculatorwp_webhooks', 'action' => 'edit', 'id' => $object->__id)).">Open</a>";
			}
			else
				echo '---';
		?>
		
	</td>
</tr>