<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
			if (isset($object->client_id) && is_numeric($object->client_id)){
				
				echo '<span class="">'.calculatorwp_class('calculatorwp_account')->get_user_name_from_sl_user_id($object->client_id).'</span>';
			}
			else{
				echo '(anonymous)';
			}
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			$sl_client_loan_stage=unserialize(sl_client_loan_stage);
			if (!is_null($object->loan_stage))
				echo $sl_client_loan_stage[$object->loan_stage];
			else
				echo '(undefined)';
		?>
	</td>	
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 
			$Loansetting_name=mvc_model("calculatorwpLoansetting")->find_by_id($object->loan_setting_id);//->name ;
//var_dump($Loansetting_name);
			if (!is_null($object->loan_setting_id) && !is_null($Loansetting_name)){				
				echo $Loansetting_name->name;
			}
			else{
				echo '---';
			}
		?>
	</td>
	<td class="sl_house_keeping">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (!is_null($object->__id)){
					echo "<center>
						<!-- <a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientloans', 'action' => 'edit', 'id' => $object->__id)).">Edit</a> -->
						<a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientloans', 'action' => 'process', 'id' => $object->__id))."> Open </a>
						</center>";
		
				}				
				else
					echo '---';
		?>
	</td>
</tr>