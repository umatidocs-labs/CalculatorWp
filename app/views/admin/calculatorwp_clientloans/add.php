<div class="calculatorwp_clientloans_index">

	<center><h3 class="calculatorwp_main_title"> Create Loan Application </h3></center>

	<div class = " calculatorwp_input">

	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

	<table class="form-table">
	<tbody>
	<tr>
		<td class="calculatorwp_title_feild">Loan Amount</td>
		<td class="calculatorwp_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '','class'=>'calculatorwp_input_feild')); ?></td>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">Client Account number</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '','class'=>'calculatorwp_input_feild')); ?></td>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">Loan Product</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '','class'=>'calculatorwp_input_feild')); ?></td>
	</tr>
	</tbody>
	</table>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Start ')."</center>"; ?>
	<br>
	</div><?php sl_hide_mitem(); ?>

</div>