<div class = "wrap calculatorwp_input">

<center><h2 class="calculatorwp_main_title"> REPAY LOAN </h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->create($model->name); ?>

<hr>
	<div class="calculatorwp_title_feild">Loan Amount</div>
	<div class="calculatorwp_title_feild">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo esc_html($this->form->input('trans_amount', array('label' => '','class'=>'calculatorwp_input_feild'))); ?>
	</div>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo esc_html($this->form->hidden_input('parent_trans_id', array('value' => $sl_parent_trans->id ))); 
	echo esc_html($this->form->hidden_input('trans_id', array())); 
	
	echo esc_html(calculatorwp_class('calculatorwp_loan')->loan_summary(array('loan_id'=>$sl_parent_trans->id)));
?>
	
	<br>
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".esc_html($this->form->end(' Pay Loan '))."</center>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>