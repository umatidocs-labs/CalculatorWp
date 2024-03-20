<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo $this->html->traffic_manager_link($object); ?>
	<td class="sl_list_single_message">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->message)){
				$sl_message_status=array(
						1=>'Sent',
						2=>'Delivered',
						3=>'Seen'
					);
				echo '<br><div class="sl_list_name">'.esc_html($object->message).'</div>';
				echo '<span class="sl_list_message_details">'.esc_html($sl_message_status[$object->status]).' by <b>'.esc_html(mvc_model('calculatorwpClientaccount')->find_by_id($object->sender_id)->firstname).'</b> at '.esc_html($object->send_time) .'</span>';
			}
		?>
	</td>
	
</tr>