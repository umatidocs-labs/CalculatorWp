<div class="cwp_wrap cwp_coms_wrap_outer">

<div class = "wrap calculatorwp_input"  id="calculatorwp_webhook_input">

<center><h3 class="calculatorwp_main_title"> New Email </h3></center>

<?php echo $this->form->create($model->name); ?>

	<div class="calculatorwp_title_feild-email">
		<div class="sl_title_line"> Activate Email </div>
		<div class="sl_title_line_content">
		<?php echo $this->form->checkbox_input('notification_is_active',array('label' => '','value'=>1,'class'=>'calculatorwp_input_feild_email')); ?>
		</div>
	</div>
	<div class="calculatorwp_title_feild-email">
		<div class="sl_title_line"> Name </div>
		<?php  echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild_email')); ?>
	</div>
	<div class="calculatorwp_title_feild-email">
		<div class="sl_title_line">Trigger </div>
		<?php  
			$calculatorwp_array_output=[
				"calculatorwp_login"=>"Login",
				"calculatorwp_signup"=>"Signup",
				"calculatorwp_loan_application"=>"Loan Application",
				"calculatorwp_loan_status_change"=>"Loan Status Change",
				"calculatorwp_new_transaction"=>"New Transaction"
			];
			echo $this->form->select('webhook_trigger_action', array( 'value' => $object->webhook_trigger_action,'options'=> $calculatorwp_array_output , 'class'=>'calculatorwp_input_feild_email', ));
		?>
	</div><br><br><br>

	<div class="calculatorwp_email_wrap">

		<div class="calculatorwp_email_title"><center>EMAIL</center></div>

		<div class="calculatorwp_title_feild-email email_d">
			<div class="calculatorwp_title_feild_title">Send Email</div>
			<div class="calculatorwp_title_feild_body_right">
				<?php echo $this->form->checkbox_input('mail_active',array('label' => '','class'=>'calculatorwp_input_feild_mail')); ?>
			</div>
		</div>
		<div class="calculatorwp_title_feild-email email_d">
			<div class="calculatorwp_title_feild_title">
				Email Subject
			</div>
			<div class="calculatorwp_title_feild_body_right email_d">
				<?php echo $this->form->input('mail_subject',array('label' => '','class'=>'calculatorwp_input_feild')); ?>
			</div>
		</div>

		<div class="calculatorwp_title_feild-email">Email Body</div>
		<div class="calculatorwp_title_feild-email"><?php echo $this->form->editor('mail_body',array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>

		<div class="calculatorwp_title_feild-email">
		<center>
		<?php
			echo calculatorwp_class('calculatorwp_mail_manager')->show_main_view(0);
		?>
		</center>
		</div>
	
	</div>

<br>
<hr>
<?php echo "<center >".$this->form->end(' Add ')."</center>"; ?>

</div>
<?php echo calculatorwp_class('calculatorwp_merge_tags')->display_tag_onsidebar(); ?>

</div>