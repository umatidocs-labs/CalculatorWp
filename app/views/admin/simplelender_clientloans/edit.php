<div class = "wrap simplelender_input">

<center><h2 class="simplelender_main_title"> MANAGE LOAN FLOW</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	<div class="simplelender_title_feild">Loan Amount</div>
	<div class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '','class'=>'simplelender_input_feild')); ?></div>
	
	<div class="simplelender_title_feild">Client Account number</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '','class'=>'simplelender_input_feild')); ?></div>
	
	<div class="simplelender_title_feild">Loan Product</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '','class'=>'simplelender_input_feild')); ?></div>
<br>
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')."<br> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>