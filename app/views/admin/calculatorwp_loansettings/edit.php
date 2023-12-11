<div class = "calculatorwp_loansettings_edit">

    <center>
    	<h3 class="calculatorwp_main_title"> Manage Loan Product</h3>
    </center>

	<div class="calculatorwp_main_title calculatorwp_main_title_shortcode">

		<h4>Shortcodes</h4>

		<table>
			<tr>
				<td>
					Display a Single Loan ( <?php echo $object->name; ?> ) : 
				</td>				
				<td class="sl_shortcode_details_l">
					<span class="sl_shortcode_details"> 
						[streamlinemortgage product=<?php echo $object->id; ?> ]
					</span> 
				<td>
			</tr>
			<tr>
				<td>Display all Loans :</td>
				<td  class="sl_shortcode_details_l"><span class="sl_shortcode_details">[streamlinemortgage_all_loans]</span></td>
			</tr>
			<tr>
				<td>
					Borrower Login/Signup :
				</td>
				<td class="sl_shortcode_details_l">
					<span class="sl_shortcode_details">[sl_user_login]</span>
				</td>
			</tr>
		</table>
	</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name);
	$gflist= mvc_model("calculatorwpGform");
?>

<table class="calculatorwp_list_table">
<tr>
    <td class="calculatorwp_title_feild">
		Product Name
	</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild')); ?>
	</td>
	
</tr>
<tr>
	<td class="calculatorwp_title_feild">Currency
	<?php 
			
		// echo '<br>Pro feature <a href="'. admin_url( 'admin.php?page=mvc_calculatorwp_clientloannotes-pricing') .'">See Pricing</a>';
	
	?>
	</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$currency_of_the_world= sl_currency_country ;
			$currency_of_the_world=maybe_unserialize($currency_of_the_world);
			echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>$object->currency ,'label' => '','class'=>'calculatorwp_input_feild'));
		?>
	</td>
</tr>
<tr>
	<td  class="calculatorwp_title_feild">
		Maximum Loan Amount
	</td>	
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => ''));?>
	</td>
</tr>
<tr>
	<td class="calculatorwp_title_feild">Calculator Theme</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
		$calculatorwp_calculator_themes =[];
		$calculatorwp_calculator_themes=apply_filters('sl_get_calculator_themes',$calculatorwp_calculator_themes);
		echo $this->form->select('calculator_theme', array('options' => $calculatorwp_calculator_themes, 'class'=>'calculatorwp_input_feild_f', 'value'=>$object->calculator_theme ));
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
			echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>$object->period_unit ,'class'=>'calculatorwp_input_feild_small'));
		?>
	</td>
</tr>
<tr>
	<td class="calculatorwp_title_feild">Interest Rate</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'calculatorwp_input_feild')); ?>
	</td>
</tr>
<tr>
	<td class="calculatorwp_title_feild">Borrower Details Form </td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('secondary_form', $gflist , array(), array('label' => '','class'=>'calculatorwp_input_feild'));?>
	</td>
</tr>

<!-- <tr>
	<td class="calculatorwp_title_feild">
		Spending Goal Form
	</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'calculatorwp_input_feild'));?>
	</td>
</tr> -->

</table>

<table class="calculatorwp_list_table ">
<tr>
	<td class="calculatorwp_title_feild">Product Header</td>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
</tr>
</table>
<table class="calculatorwp_list_table ">
<tr>
	<td class="calculatorwp_title_feild">Product Description</td>
</tr>
<tr>
	<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->editor('main_title_description', array('placeholder' => 'Notes about the link','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => ''));?> </td>
</tr>
</table>
<table class="calculatorwp_list_table ">
<tr>
	<td  class="calculatorwp_title_feild">Submit Button Text</td>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
</tr>
	<tr>
		<td class="calculatorwp_title_feild">Mailchimp Group
		<?php			
			echo '<br>To show groups <a href="'. admin_url( 'admin.php?page=mvc_calculatorwp_mailchimps') .'">Add API key</a>';
		?>
		</td>
		<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$calculatorwp_get_mailchimp_list_interest= apply_filters('calculatorwp_get_mailchimp_list_interest','hallo');
			if(is_array($calculatorwp_get_mailchimp_list_interest)){
				if(count($calculatorwp_get_mailchimp_list_interest)>0){
					echo $this->form->select('mailchimp_group', array('options' => $calculatorwp_get_mailchimp_list_interest, 'value'=>$object->mailchimp_group,'class'=>'calculatorwp_input_feild'));
				}
				else{
					echo "Please add API key";
				}				
			}
			else{
				echo "Please add API key";
			}
		?>
		</td>
		
	</tr>
</table>
<table class="calculatorwp_list_table ">
	<tr>
		<td class="calculatorwp_title_feild">Notes</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => ''));?>
	</tr>
</table>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')." <br><a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>"; ?>
</div>
</div>