<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			if (isset($object->__id))
				echo '<span class="">'.$object->ticket_id.'</span>';
			else
				echo '(undefined)';
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->status)){
				$ticket_status= array(
					1 =>'Open', 
					2=>'Resolved'
				);
				echo $ticket_status[$object->status];
			}
			else{
				echo '(undefined)';
			}
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_id)){
				$object_loan_id = mvc_model("calculatorwpClientloan")->find_by_id($object->loan_id)->loan_setting_id;
				echo mvc_model("calculatorwpLoansetting")->find_by_id($object_loan_id)->name;
			}
			else{
				echo '(undefined)';
			}
		?>
	</td>
	<td class="sl_house_keeping">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id))
				echo "<center><a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => 'message_room', 'id' => $object->__id)).">Open</a></center>";
			else
				echo '---';
		?>
	</td>
</tr>