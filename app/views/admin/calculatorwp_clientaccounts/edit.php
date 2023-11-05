<div class="calculatorwp_client_acc_edit">

<center><h3 class="calculatorwp_main_title" > Edit Borrower Details </h3></center>

<div class = "">
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>
<table class="form-table">
<tbody>
	<tr>
		<td class="calculatorwp_title_feild">Account Number</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('acc_number', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;')); ?>
	</tr>
	<tr>
		<td class="calculatorwp_title_feild">First Name</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('firstname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
	</tr><tr>
		<td class="calculatorwp_title_feild">Middle Name</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('middlename', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
	</tr><tr>
		<td class="calculatorwp_title_feild">Last Name</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('lastname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
	</tr><tr>
		<td class="calculatorwp_title_feild">Email</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('email', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
	</tr><tr>
		<td class="calculatorwp_title_feild">Mobile Number</td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('mobilenumber', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
	</tr>	
</tbody>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')."<br> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>"; ?>
<br><?php sl_hide_mitem(); ?>
</div>
</div>