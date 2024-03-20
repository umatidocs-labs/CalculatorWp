<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	$myClientloan = mvc_model("calculatorwpClientloan")->find_by_id($object->trans_id);
	$myClientaccount = mvc_model("calculatorwpClientaccount")->find_by_id($myClientloan->client_id); ?>
	
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($myClientaccount->acc_number)){
				echo esc_html(calculatorwp_class("calculatorwp_account")->get_user_name_from_acc_no($myClientaccount->acc_number));
				echo "(".esc_html($myClientaccount->acc_number).")";
			}
			else{
				echo '-Not Set-';
			}
		?>
	
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->trans_id))
				echo esc_html($object->trans_id);
			else
				echo '-Not Set-';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
		$trans_title=array(
				"1"=>"Loan Issued",
				"2"=>"Loan Repayed",
			);
			if (isset($object->dr_cr))
				echo esc_html($trans_title[$object->dr_cr])." (".esc_html($object->id).")";
			else
				echo '-Not Set-';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->trans_amount))
				echo esc_html($object->trans_amount);
			else
				echo '-Not Set-';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id)){
					
					if($object->trans_type == 1 && $object->dr_cr==1){						
						
					}
				}
		?>
	</td>
</tr>