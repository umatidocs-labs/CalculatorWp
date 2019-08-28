<div class="wrap simplelender_input">
    <center><h2 class="simplelender_main_title"> VIEW LOAN APPLICATION </h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
    //echo "<a class='loan_transactions_link' href=".mvc_admin_url(array('controller' => 'admin_simplelender_dentries' , 'action' => 'transaction_list','id'=>$object->id)).">Transactions for this Loan</a><br>";
?>
<center>
<table class="loan_stages">
    <tr>
		<td class="simplelender_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'process','id' => $object->id)).'">Process</a>'; ?>
		</td>
		<td class="simplelender_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'more_loan_info','id' => $object->id)).'">More Loan Info</a>'; ?>
		</td>
		<td class="simplelender_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'goal_info','id' => $object->id)).'">Goal Info</a>'; ?>
		
		</td>
	</tr>
</table>
    
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<br>
<table>
    <tr class="simplelender_title_feild">
            <td><b>Loan Applicant:</b></td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_simplelender_clients', 'action' => 'edit','id' => $object->client_id)).'">'.mvc_model('simplelenderClientaccount')->find_by_id($object->client_id)->firstname.'</a>'; ?></td>
        </tr>
	<tr class="simplelender_title_feild">
            <td><b>Loan Amount:</b></td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->amount_needed; ?></td>
        </tr>
	<tr class="simplelender_title_feild">
            <td><b>Loan Product:</b></td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => 'edit','id' => $object->loan_setting_id)).'">'.mvc_model('simplelenderLoansetting')->find_by_id($object->loan_setting_id)->name.'</a>'; ?></td>
        </tr>	
	<tr class="simplelender_title_feild">
        <td><b>Application Date:</b></td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->needed_by_date;?></td>
    </tr>
	
	<tr class="simplelender_title_feild">
        <td><b>Current Stage:</b></td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
        $sl_client_loan_stage=unserialize(sl_client_loan_stage);
        echo $sl_client_loan_stage[$object->loan_stage]; ?></td>
    </tr>
	
	<tr class="simplelender_title_feild">
            <td><b>Next Step >></b></td>
            <td>
			<input name="data[simplelenderClientloan][loan_stage]" class="post-format" id="simplelenderClientloan_loan_stage_select" value="1" type="radio">Application<br>			
			<input name="data[simplelenderClientloan][loan_stage]" class="post-format" id="simplelenderClientloan_loan_stage_select" value="3" type="radio">Approve<br>
			<input name="data[simplelenderClientloan][loan_stage]" class="post-format" id="simplelenderClientloan_loan_stage_select" value="2" type="radio">Decline<br>
			<input name="data[simplelenderClientloan][loan_stage]" class="post-format" id="simplelenderClientloan_loan_stage_select" value="4" type="radio">Repayment<br>
			<input name="data[simplelenderClientloan][loan_stage]" class="post-format" id="simplelenderClientloan_loan_stage_select" value="5" type="radio">Close<br>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo '<a href="'.mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => '','id' => $object->id)).'">'.mvc_model('simplelenderLoansetting')->find_by_id($object->loan_setting_id)->name.'</a>'; ?></td>
      
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo $this->form->select_from_model('loan_stage',$loan_stage, array(), array('label' => ''));?></td>
        </tr>
</table>
</center>
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<center>'.$this->form->end('>> Process >>').'</center>';  ?>
	


</div>