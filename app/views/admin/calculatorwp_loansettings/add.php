<div class = "calculatorwp_loansettings_edit">

    <center><h3 class="calculatorwp_main_title">New Loan Product</h3></center>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo $this->form->create($model->name); 
	$gflist= mvc_model("calculatorwpGform");
?>

<table class="calculatorwp_list_table">
<tbody>
	<tr>
		<td class="calculatorwp_title_feild">Product Name</td>
		<td class="calculatorwp_title_feild" ><?php 
		/* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
		echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild')); ?></td>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">Currency</td>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$currency_of_the_world= sl_currency_country ;
			$currency_of_the_world=maybe_unserialize($currency_of_the_world);
			echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>'USD' ,'label' => '','class'=>'calculatorwp_input_feild'));?>
		</td>
	</tr>
	<tr>
		<td  class="calculatorwp_title_feild">Maximum Loan Amount</td>	
		<td class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => ''));?></td>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">Calculator Theme</td>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			$calculatorwp_calculator_themes=[];
			$calculatorwp_calculator_themes=apply_filters('sl_get_calculator_themes',$calculatorwp_calculator_themes);
			echo $this->form->select('calculator_theme', array('options' => $calculatorwp_calculator_themes, 'value'=>'calculatorwp_calculator_default_theme' ,'class'=>'calculatorwp_input_feild_f'));
		?>
		</td>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">Max Period</td>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('label' => '','class'=>'calculatorwp_input_feild_small')); ?>
		</td>
		</tr>
	<tr>
		<td class="calculatorwp_title_feild"></td>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
				$Periodunit=sl_period_unit;
				$Periodunit=maybe_unserialize($Periodunit);
				echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>'y' ,'class'=>'calculatorwp_input_feild_small'));
			?>
		</td>
	</tr>
	<tr>
			<td class="calculatorwp_title_feild">Interest Rate(%)</td>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'calculatorwp_input_feild')); ?></td>
	</tr>
	<tr>
			<td class="calculatorwp_title_feild">Borrower Details Form( <a href="<?php echo admin_url( 'admin.php?page=gf_edit_forms'); ?>" target="_blank">Create a form</a> )</td>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
			//var_dump($gflist);
			//$newg = $gflist->find();
			//var_dump($newg);
				echo $this->form->select_from_model( 'secondary_form' , $gflist , [] , array('label' => '','class'=>'calculatorwp_input_feild'));
				?>
			</td>
	</tr>
	<tr>
			<td class="calculatorwp_title_feild">Spending Goal Form( <a href="<?php echo admin_url( 'admin.php?page=gf_edit_forms'); ?>" target="_blank">Create a form</a> )</td>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'calculatorwp_input_feild'));?></td>
	</tr>
</tbody>
</table>

<table class="calculatorwp_list_table">

	<tr>
		<td class="calculatorwp_title_feild">Intro Header</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?> </td>
	</tr>
</table>

<table class="calculatorwp_list_table">
	<tr>
		<td class="calculatorwp_title_feild">Intro Description <br><span class='sl_description'> </span></td>
	</tr>
	<tr>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->editor('main_title_description', array('required'=>false,'placeholder' => 'Notes about the link','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => 'width: 200px;'));?>
		</td>
	</tr>
</table>

<table class="calculatorwp_list_table">
	<tr>
		<td  class="calculatorwp_title_feild">Submit button Text</td>	
		<td class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','value'=>'Yes! Get My Loan Now','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?></td>	
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">
			Mailchimp Group
		</td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$calculatorwp_get_mailchimp_list_interest= apply_filters('calculatorwp_get_mailchimp_list_interest','hallo');
			if (is_array($calculatorwp_get_mailchimp_list_interest)) {
				echo $this->form->select('mailchimp_group', array('options' => $calculatorwp_get_mailchimp_list_interest, 'value'=>'','class'=>'calculatorwp_input_feild_small'));
			}
			else{
				// echo 'Please Connect Mailchimp to Select a List';
			}
			?>		
		</td>
	</tr>

</table>

<table class="calculatorwp_list_table">

<tr>
		<td class="calculatorwp_title_feild">Notes(Only seen by admin)</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => ''));?></td>
</tr>
</tbody>
</table>

<input type="hidden" name="data[calculatorwpLoansetting][show_repayment]" value="1">
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Add ')."</center>"; ?>
</div>
</div>