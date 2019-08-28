<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
if($objects=="show_login"){
	$url=mvc_public_url(array('controller' => "simplelender_clientloans" , 'action' => 'index'));
	
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
				$client_count=mvc_model('simplelenderNotification')->count([
					'conditions'=>[
						'status'=>1,
						'user_id'=>$client_id
					]]
					);
				$user = wp_get_current_user();
				echo "<a href='". mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'index',))."'> <b>Loan Applications</b> </a> | ";
				if ( simplelender_fs()->is_plan('growth') ) {
					echo "<a href='". mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'index',))."'> <b>Open Tickets</b> </a> | ";
				}
				echo "<a href='". mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'notification',))."'> Notifications <b>(".$client_count.")</b> </a> | ";
				echo "<b> - ".$user->data->user_nicename." </b>";
				
				?>
				<a href="<?php echo  get_site_url(); ?>/wp-login.php?action=logout"><button>Logout</button></a></span>
			</div>
			<br><br>
			<div></div>
		<center>
			<span class="fwidthtd"></span>			
		</center>
		
		<table id="simplelender_loan_dash">
			
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

			//var_dump($objects);
			foreach ($objects as $object): ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show_notification', array('locals' => array('object' => $object))); ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
			
		</table>
		

	</div>

	</div>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   }
do_action("simplelender_build_by");

//echo $this->pagination();

 ?>

 
