<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
if($objects=="show_login"){
	$url=mvc_public_url(array('controller' => simplelender_clientloans , 'action' => 'index'));
	
	echo simplelender_class('simplelender_account')->user_gate($url);
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
	
	<div id="simplelender_dash_content">
			<div class="logout_link_wrapper">

					<div id="simplelender_dash_menu">
						<nav id="site-navigation" class="simplelender_dash_menu" role="navigation" aria-label="Top Menu">
							<?php //wp_nav_menu( array( 'theme_location' => 'simplelender_client_admin_menu' ) ); ?>
						</nav>
					</div>
				
				<span class="logout_link"><?php
				$user = wp_get_current_user();
				echo "<a href='". mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'index',))."'> <b>Loan Applications</b> </a> | ";
				if ( simplelender_fs()->is_plan('growth') ) {
					echo "<a href='". mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'index',))."'> <b>Open Tickets</b> </a> | ";
				}
				echo "<b>".$user->data->user_nicename." </b> - ";
				?>
				<a href="<?php echo  get_site_url(); ?>/wp-login.php?action=logout"><button>Logout</button></a></span>
			</div>
			<br><br>
			
			<div></div>
		<center>Transactions - Loan ID:<b> <?php echo $loan_id_transaction; ?></b></center>

		<table id="simplelender_loan_dash">
			
			<tr>
				<td class="simplelender_sub_title" ><center>Loan Application ID</center></td>
				<td class="simplelender_sub_title"><center>Transaction Type </center></td>
				<td class="simplelender_sub_title"><center>Amount</center></td>
			</tr>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_transaction_show', array('locals' => array('object' => $object))); ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
		</table>
	</div>

	</div>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   }//echo $this->pagination(); ?>