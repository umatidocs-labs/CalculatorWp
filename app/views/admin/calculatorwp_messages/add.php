<div class="cwp_coms_wrap_outer">
<div class = "wrap calculatorwp_input">

    <center><h2 class="calculatorwp_main_title">NEW LOAN PRODUCT</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); 
$gflist= mvc_model("calculatorwpGform");
?>

<hr>
<br>
  
    <div class="calculatorwp_title_feild">Name</div>
	<div calculatorwp_title_feild><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>
	
	<div  class="calculatorwp_title_feild">Maximum Loan Amount</div>	
	<div class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	<div  class="calculatorwp_title_feild">Interest Rate(% P.A.)</div>
	<div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('value' => '10','label' => '','class'=>'calculatorwp_input_feild')); ?>
	</div>
	<div class="calculatorwp_title_feild">Currency</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	$currency_of_the_world= sl_currency_country ;
	$currency_of_the_world=maybe_unserialize($currency_of_the_world);

	echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>$object->currency ,'label' => '','class'=>'calculatorwp_input_feild'));?></div>

	<div class="calculatorwp_title_feild">Max Period</div>
	<div>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('value' => '12','label' => '','class'=>'calculatorwp_input_feild')); ?>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$Periodunit=sl_period_unit;
			$Periodunit=maybe_unserialize($Periodunit);
			echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>$object->period_unit ,'class'=>'calculatorwp_input_feild'));?>
	</div>
	<div class="calculatorwp_title_feild">Secondary form</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('secondary_form',$gflist, array(), array('label' => '','class'=>'calculatorwp_input_feild'));?></div>
	
	<div class="calculatorwp_title_feild">Goal form</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form',$gflist, array(), array('label' => '','class'=>'calculatorwp_input_feild'));?></div>
	
	<div class="calculatorwp_title_feild">Notes</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the link','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => 'width: 200px;'));?></div>
	
<br>	
<hr>
<br>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Add ')."</center>"; ?>
</div>
</div>