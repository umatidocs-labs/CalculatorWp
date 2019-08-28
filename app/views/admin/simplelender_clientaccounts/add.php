<div class = "wrap simplelender_input">

<center><h2 class="simplelender_main_title"> CREATE CLIENT </h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	
	<div class="simplelender_title_feild">Account Number</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('acc_number', array('placeholder' => '', 'label' => '', 'class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	<div class="simplelender_title_feild">First Name</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('firstname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	<div class="simplelender_title_feild">Middle Name</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('middlename', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	<div class="simplelender_title_feild">Last Name</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('lastname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	<div class="simplelender_title_feild">Email</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('email', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
	
	<div class="simplelender_title_feild">Mobile Number</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('mobilenumber', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></div>	
	
<br>
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Create Client ')."</center>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>