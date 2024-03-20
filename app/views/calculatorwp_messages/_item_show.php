<tr >
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->ticket_id))
				echo esc_html($object->ticket_id);
			else
				echo '---';
		?></center>
	</td>
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_id))
				echo esc_html( $object->loan_id);
			else
				echo '---';
		?></center>
	</td>
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->status)){
				$sl_status=[
					1=>'Open',
					2=>'Resolved'
				];
				echo esc_html($sl_status[$object->status]);
			}
			else
				echo '---';
		?></center>
	</td>
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->id)){				
        		echo "<a class='sl_menu_item_front_view' href=".mvc_public_url(array('controller' => 'calculatorwp_messages', 'action' => 'message_room','id'=>$object->id)).">Open</a>";
			}
			else
				echo '---';
		?></center>
	</td>
</tr>