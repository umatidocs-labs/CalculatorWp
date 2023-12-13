<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

if($objects=="show_login"){

	$url=mvc_public_url(array('controller' => "calculatorwp_clientloans" , 'action' => 'index'));
	
	echo calculatorwp_class('calculatorwp_account')->user_gate($url);

}
elseif($objects=='sl_client_account_not_created'){

	?>
		<div class="client_dash">
			<h3><center>Your account not a loan client account, please contact us and we will resolve this.</center></h3>
		</div>

		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
}
else{

?><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

if($objects=="show_login"){

	$url=mvc_public_url(array('controller' => "calculatorwp_clientloans" , 'action' => 'index'));
	
	echo calculatorwp_class('calculatorwp_account')->user_gate($url);

}
elseif($objects=='sl_client_account_not_created'){

	?>
	<div class="client_dash">
	<h3><center>Your account not a loan client account, please contact us and we will resolve this.</center></h3>
	</div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
}
else{
?>

<div class="client_dash">
	
	<div id="calculatorwp_dash_content">
			<?php do_action('calculatorwp_borrower_top_menu'); ?>
			
			<br><br>
			<div></div>
		<center>
			<span class="fwidthtd"></span>			
		</center>
		<div class="sm_new_notifications">New Notifications (<?php echo count( $objects ) ; ?>)</div>
		<table id="calculatorwp_loan_dash">
			
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

			//var_dump($objects);
			foreach ($objects as $object): ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show_notification', array('locals' => array('object' => $object))); ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
			
		</table>

		<br><br><br>

		<div class="sm_viewed_notifications">Viewed Notifications</div>

		<table id="calculatorwp_loan_dash">
			
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

			//var_dump($objects);
			foreach ($viewed as $single): ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show_notification', array('locals' => array('object' => $single))); ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
			
		</table>
		

	</div>

	</div>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   }
do_action("calculatorwp_build_by");
}
 ?>