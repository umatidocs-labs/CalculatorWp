<div class="calculatorwp_clientloans_goal_info">

<div class="wrap ">
    <center><h2 class="calculatorwp_main_title">Mortgage Application</h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
 ?>
<center>
<table class="loan_stages">
    <tr>
		<td class="calculatorwp_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'process','id' => $object_id)).'">Process</a>'; ?>
		</td>
		<td class="calculatorwp_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'more_loan_info','id' => $object_id)).'">Mortgage Details</a>'; ?>
		</td>
		<td class="calculatorwp_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'goal_info','id' => $object_id)).'">Tasks</a>'; ?>
		
		</td>
	</tr>
</table>

<div class="sl_process_body">

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo calculatorwp_class('calculatorwp_raw_data')->display_form_data([
	'object_type'=>1,
	'object_id'=>$object_id
]);        
 ?>
<br>
</div>
</center>
    <br>

</div><?php sl_hide_mitem(); ?>

</div>