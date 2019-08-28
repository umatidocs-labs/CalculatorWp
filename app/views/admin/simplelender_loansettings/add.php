<div class = "wrap simplelender_input">

    <center><h2 class="simplelender_main_title">NEW LOAN PRODUCT</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); 
$gflist= mvc_model("simplelenderGform");
?>

 
    <div class="simplelender_title_feild">Name</div>
	<div class="simplelender_title_feild" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">Currency</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	$currency_of_the_world= sl_currency_country ;
	$currency_of_the_world=maybe_unserialize($currency_of_the_world);
	echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>'USD' ,'label' => '','class'=>'simplelender_input_feild'));?></div>
	
	<div  class="simplelender_title_feild">Maximum Loan Amount</div>	
	<div class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'simplelender_input_feild'),  array('style' => ''));?></div>	

	<div class="simplelender_title_feild">Calculator Theme</div>
	<div>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
		
		$simplelender_calculator_themes=apply_filters('sl_get_calculator_themes',$simplelender_calculator_themes);
	
		//var_dump( $simplelender_calculator_themes);
		echo $this->form->select('calculator_theme', array('options' => $simplelender_calculator_themes, 'value'=>'simplelender_calculator_default_theme' ,'class'=>'simplelender_input_feild_f'));
	?>
	</div><br><br>
	<hr width="60%">
	<div class="simplelender_title_feild">Max Period</div>
	<div>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('label' => '','class'=>'simplelender_input_feild_small')); ?>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$Periodunit=sl_period_unit;
			$Periodunit=maybe_unserialize($Periodunit);
			echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>'y' ,'class'=>'simplelender_input_feild_small'));
			?>
	</div>
	<br><br> 	

	<div  class="simplelender_title_feild">Interest Rate</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'simplelender_input_feild')); ?></div>
	<br><br>
	<hr width="60%">
	
	<div class="simplelender_title_feild">Secondary Form( needs gravityforms plugin )</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('secondary_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></div>

	<div class="simplelender_title_feild">Goal Form( needs gravityforms plugin )</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></div>
	
	<br><br>
	<hr width="60%">
	
	<div class="simplelender_title_feild">Intro Header</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>
	
	<div class="simplelender_title_feild"><b>Intro Description</b> <br><span class='sl_description'> (Sell to the borrower (1) what is the product, what does it do; (2) why should the borrower use it, what are the benefits; and (3) how does it work, where can the borrower use it?)</span></div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->editor('main_title_description', array('placeholder' => 'Notes about the link','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => 'width: 200px;'));?></div>
	
	<div class="simplelender_title_feild">Show Repayment</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select('show_repayment', array('placeholder' => '','options' => ['1'=>'Show Repayments', '0'=>'Do not show Repayments'],'class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>
	
	<div  class="simplelender_title_feild">Submit Text<br><span class='sl_description'>(Will appear on the submit button on the loan calculator page)</span></div>	
	<div class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','value'=>'Yes! Get My Loan Now','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	<br><br>
	<hr width="60%">

	<?php if (simplelender_fs()->is_plan('growth')) : ?>
	<div>
		<div class="simplelender_title_feild">Mailchimp Group</div>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$simplelender_get_mailchimp_list_interest= apply_filters('simplelender_get_mailchimp_list_interest');
			echo $this->form->select('mailchimp_group', array('options' => $simplelender_get_mailchimp_list_interest, 'class'=>'simplelender_input_feild_small'));
			?>
	</div>
	<?php endif; ?>
	
	<div class="simplelender_title_feild">Notes</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => ''));?></div>
	
<br>	
<hr>
<br>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Add ')."</center>"; ?>
</div>