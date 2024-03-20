<tr >
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->id))
				echo esc_html($object->id);
			else
				echo '---';
		?></center>
	</td>
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 		
			if (isset($object->id)){
				$name_ofloan =mvc_model("calculatorwpLoansetting")->find_by_id($object->loan_setting_id);
				if(isset($name_ofloan)){
				echo esc_html( $name_ofloan->name );}
				else{
					echo '---';
				}
			}else{
				echo '---';
			}
		?></center>
	<!--</td>
	
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			/*if (isset($object->__id))
				echo  mvc_model("calculatorwpDentry")->count(['conditions'=>['trans_id'=>$object->id,'bs_account'=>6]])."(<a href='".mvc_public_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'transaction','id'=>$object->__id))."'>view</a>)";
			else
				echo '---';
				*/
		?> -->
	<td class="calculatorwp_sub_body"><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id)){
				$sl_client_loan_stage=unserialize(sl_client_loan_stage);
        		echo esc_html($sl_client_loan_stage[$object->loan_stage]);
			}
			else
				echo '---';
		?></center>
	</td>
	<td class="calculatorwp_sub_body">
		<center>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
				if (isset($object->id)){
					echo "<a class='sl_menu_item_front_view' href=". esc_html( mvc_public_url(array('controller' => 'calculatorwp_messages', 'action' => 'create_ticket','id'=>$object->id))).">Open Ticket</a>";
				}
				else
					echo '---';
			?>
		</center>
	</td>
</tr>