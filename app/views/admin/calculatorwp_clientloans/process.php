<div class="calculatorwp_clientloans_process">

<div class="wrap">
    <center><h2 class="calculatorwp_main_title"> Loan Application </h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
   ?>
<center>
<table class="loan_stages">
    <tr>
		<td class="calculatorwp_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'process','id' => $object->id)).'">Process</a>'; ?>
		</td>
		<td class="calculatorwp_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'more_loan_info','id' => $object->id)).'">Loan Details</a>'; ?>
		</td>
		<td class="calculatorwp_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'goal_info','id' => $object->id)).'">Goals</a>'; ?>
		
		</td>
	</tr>
</table>
    
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<br>
<table>
    <tr class="calculatorwp_title_feild_app">
            <td>Loan Applicant:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit','id' => $object->client_id)).'">'.mvc_model('calculatorwpClientaccount')->find_by_id($object->client_id)->firstname.'</a>'; ?></td>
        </tr>
	<tr class="calculatorwp_title_feild_app">
            <td>Loan Amount:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->amount_needed; ?></td>
        </tr>
    <tr class="calculatorwp_title_feild_app">
            <td>Loan Period:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */

                $sl_term_period=[
                    'y'=>'Year(s)',
                    'm'=>'Month(s)',
                    'w'=>'Week(s)',
                    'd'=>'Day(s)'
                ];

                $calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($object->loan_setting_id);
                $product_name = $calculatorwpLoansetting->name;
                $product_term_period = $calculatorwpLoansetting->period_unit;
                echo $object->term.' '.$sl_term_period[$product_term_period];

            ?>
            </td>

        </tr>
	<tr class="calculatorwp_title_feild_app">
            <td>Loan Product:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'edit','id' => $object->loan_setting_id)).'">'.$product_name.'</a>'; ?></td>
        </tr>	
	<tr class="calculatorwp_title_feild_app">
        <td>Application Date:</td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->needed_by_date;?></td>
    </tr>
	
	<tr class="calculatorwp_title_feild_app">
        <td><b>Current Stage:</b></td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
        $sl_client_loan_stage=unserialize(sl_client_loan_stage);
        // echo $sl_client_loan_stage[$object->loan_stage]; 
        $ewm_loan_stage = $object->loan_stage ;

        $ewm_Application = 'false';
        $ewm_Approve = 'false';
        $ewm_Decline = 'false';
        $ewm_Repayment = 'false';
        $ewm_Close = 'false';

        var_dump( $ewm_loan_stage );
        
        if( $ewm_loan_stage == "1" ){
            $ewm_Application = 'checked';
        }
        elseif( $ewm_loan_stage == "3"){
            $ewm_Approve = 'true';
        }
        elseif( $ewm_loan_stage == "2"){ 
            $ewm_Decline = 'true';
        }
        elseif( $ewm_loan_stage == "4"){
            $ewm_Repayment = 'true';
        }
        elseif( $ewm_loan_stage == "5"){
            $ewm_Close = 'true';
        }

        ?>
                <div class="calculatorwp_ns_single">
                    <input name="data[calculatorwpClientloan][loan_stage]" class="post-format" id="calculatorwpClientloan_loan_stage_select" value="1" type="radio" checked="<?php echo $ewm_Application; ?>">Application<br>
                </div>
                <div class="calculatorwp_ns_single">
                    <input name="data[calculatorwpClientloan][loan_stage]" class="post-format" id="calculatorwpClientloan_loan_stage_select" value="3" type="radio" checked="<?php echo $ewm_Approve; ?>">Approve<br>
                </div>
                <div class="calculatorwp_ns_single">
                    <input name="data[calculatorwpClientloan][loan_stage]" class="post-format" id="calculatorwpClientloan_loan_stage_select" value="2" type="radio" checked="<?php echo $ewm_Decline; ?>">Decline<br>
                </div>
                <div class="calculatorwp_ns_single">
                    <input name="data[calculatorwpClientloan][loan_stage]" class="post-format" id="calculatorwpClientloan_loan_stage_select" value="4" type="radio" checked="<?php echo $ewm_Repayment; ?>">Repayment<br>
                </div>
                <div class="calculatorwp_ns_single">
                    <input name="data[calculatorwpClientloan][loan_stage]" class="post-format" id="calculatorwpClientloan_loan_stage_select" value="5" type="radio" checked="<?php echo $ewm_Close; ?>">Close<br>
                </div>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?></td>
      
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?></td>
        </tr>
</table>
</center>
<br>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<center>'.$this->form->end('Update').'</center>';  ?>

</div>
<?php //sl_hide_mitem(); ?>
</div>