<div class = "wrap calculatorwp_input">

<center><h2 class="calculatorwp_main_title"> MANAGE LOAN FLOW</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	<div class="calculatorwp_title_feild">Amount</div>
	<div class="calculatorwp_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('trans_amount', array('label' => '','class'=>'calculatorwp_input_feild')); ?></div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->hidden_input('parent_trans_id', array('label' => '','class'=>'calculatorwp_input_feild')); ?>
	
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')."<br> <a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_clientloans', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>