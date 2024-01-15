<div class='wrap calculatorwp_input cwp_coms_wrap_outer' id="calculatorwp_webhook_input">

<center>
	<h2 class="calculatorwp_main_title"> Edit Custom Email </h2>
	<?php echo '<a class="sl_list_single_item_button" href="'.mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "resend_failed_webhook", "id" =>$object->id)).'"><i>Resend failed events </i></a>'; ?>
	<?php echo '<a class="sl_list_single_item_button" href="'.mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "view_logs", "id" =>$object->id)).'"><i>View Logs</i></a>'; ?>
	<br><br><br>
	
	<div class="sl_list_single_item_status">
		<b>Active Retrys:</b> 
		<?php echo calculatorwp_class('calculatorwp_events_manager')->WebhookLog_unsuccessful_count($object->id); ?>
		<?php echo '<b> Last Modified:</b> '.$object->last_modified; ?>
		<?php echo '<b> Last Sent:</b> '.$object->last_time_event_is_triggered ; ?>
	</div>
	
</center>

<?php echo $this->form->create($model->name); ?>

<hr>
	<div class="calculatorwp_title_feild-email">Email active</div>
	<div><?php echo $this->form->checkbox_input('notification_is_active',array('label' => '','value'=>1,'class'=>'calculatorwp_input_feild')); ?></div>

	<div class="calculatorwp_title_feild-email">name</div>
	<div class="calculatorwp_title_feild-email"><?php  echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>

	<div class="calculatorwp_title_feild-email">Trigger</div>
	<div>
		<?php
	$calculatorwp_array_output=[
		"calculatorwp_login"=>"Login",
		"calculatorwp_signup"=>"Signup",
		"calculatorwp_loan_application"=>"Loan Application",
		"calculatorwp_loan_status_change"=>"Loan Status Change",
		"calculatorwp_new_transaction"=>"New Transaction"
	];

	echo $this->form->select('webhook_trigger_action', array( 'value' => $object->webhook_trigger_action,'options'=> $calculatorwp_array_output , 'class'=>'calculatorwp_input_feild', ));
	
	?></div>
	<br><br><br><br>
	<hr>
	<div><center><h2>EMAIL</h2></center></div>
	<hr>
	<div class="calculatorwp_title_feild-email">Send email</div>
	<div><?php echo $this->form->checkbox_input('mail_active',array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>
	
	<div class="calculatorwp_title_feild-email">Email subject</div>
	<div><?php echo $this->form->input('mail_subject',array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>

	<div class="calculatorwp_title_feild-email">Email body</div>
	<div><?php echo $this->form->editor('mail_body',array('label' => '','required'=>false,'class'=>'calculatorwp_input_feild')); ?></div>

	<div>
	<center>
	<?php		
		echo calculatorwp_class('calculatorwp_mail_manager')->show_main_view($object->id);
	?>
	</center>
	</div>
	<br><br><br><br>
	<hr>	
	
<?php echo "<center>".$this->form->end(' Save ')."</center>"; ?>
<br>
<br>
</div>
<?php echo calculatorwp_class('calculatorwp_merge_tags')->display_tag_onsidebar(); ?>