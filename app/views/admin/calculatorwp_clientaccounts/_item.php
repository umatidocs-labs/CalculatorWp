<tr style="width:100%;">

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>

	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			if (isset($object->firstname))
				echo '<span class="">'.$object->firstname .'</span>';
			else
				echo '(undefined)';
		?>
	</td>
	<td class="sl_list_single_item_single">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			if (isset($object->acc_number))
				echo $object->acc_number;
			else
				echo '(undefined)';
		?>
	</td>
	<td class="sl_house_keeping">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id)){
				echo "<center> <a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit', 'id' => $object->__id)).">Open</a> </center>";
			}
			else
				echo '---';

		?>
	</td>
</tr>
