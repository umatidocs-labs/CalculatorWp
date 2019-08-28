<div class="wrap simplelender_input">
    <center><h2 class="simplelender_main_title">VIEW LOAN APPLICATION</h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
   // echo "<a class='loan_transactions_link' href=".mvc_admin_url(array('controller' => 'admin_simplelender_dentries' , 'action' => 'transaction_list','id'=>$object->id)).">Transactions for this Loan</a><br>";
?>
<center>
<table class="loan_stages">
    <tr>
		<td class="simplelender_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'process','id' => $object->id)).'">Process</a>'; ?>
		</td>
		<td class="simplelender_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'more_loan_info','id' => $object->id)).'">More Loan Info</a>'; ?>
		</td>
		<td class="simplelender_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'goal_info','id' => $object->id)).'">Goal Info</a>'; ?>
		
		</td>
	</tr>
</table>
<center>Data from second gravity form on the loan application process(manage on loan product)</center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo simplelender_class('simplelender_raw_data')->display_form_data([
	'object_type'=>1,
	'object_id'=>$object->goal_id
]); ?>
<br>
</center>
    <br>

</div>