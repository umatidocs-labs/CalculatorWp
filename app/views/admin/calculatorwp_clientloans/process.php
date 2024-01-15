<div class="calculatorwp_clientloans_process">

<div class="wrap">
    <center><h2 class="calculatorwp_main_title"> Mortgage Application </h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
   ?>
<center>
<table class="loan_stages">
    <tr>
		<td class="calculatorwp_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'process','id' => $object->id)).'">Process</a>'; ?>
		</td>
		<td class="calculatorwp_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'more_loan_info','id' => $object->id)).'">Mortgage Details</a>'; ?>
		</td>
		<td class="calculatorwp_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="calculatorwp_application_top_a" href="'.mvc_admin_url(array('controller' => 'calculatorwp_clientloans', 'action' => 'goal_info','id' => $object->id)).'">Tasks</a>'; ?>
		
		</td>
	</tr>
</table>
    
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<div class="sl_process_body">

<br>
<table>
    <tr class="calculatorwp_title_feild_app">
            <td>Mortgage Applicant:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit','id' => $object->client_id)).'">'.mvc_model('calculatorwpClientaccount')->find_by_id($object->client_id)->firstname.'</a>'; ?></td>
        </tr>
	<tr class="calculatorwp_title_feild_app">
            <td>Mortgage Amount:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->amount_needed; ?></td>
        </tr>
    <tr class="calculatorwp_title_feild_app">
            <td>Mortgage Period:</td>
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
            <td>Mortgage Product:</td>
            <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'edit','id' => $object->loan_setting_id)).'">'.$product_name.'</a>'; ?></td>
        </tr>	
	<tr class="calculatorwp_title_feild_app">
        <td>Application Date:</td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->needed_by_date;?></td>
    </tr>
	
	<tr class="calculatorwp_title_feild_app">
        <td><b>Current Stage:</b></td>
        <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
        $sl_client_loan_stage=unserialize( sl_client_loan_stage );
        // echo $sl_client_loan_stage[$object->loan_stage]; 
        $ewm_loan_stage = $object->loan_stage ;

        $ewm_Application    = '';
        $ewm_Approve        = '';
        $ewm_Decline        = '';
        $ewm_Repayment      = '';
        $ewm_Close          = '';

        if( $ewm_loan_stage == "1" ){
            $ewm_Application = 'selected';
        }
        elseif( $ewm_loan_stage == "3"){
            $ewm_Approve = 'selected';
        }
        elseif( $ewm_loan_stage == "2"){ 
            $ewm_Decline = 'selected';
        }
        elseif( $ewm_loan_stage == "4"){
            $ewm_Repayment = 'selected';
        }
        elseif( $ewm_loan_stage == "5"){
            $ewm_Close = 'selected';
        }

        ?>

            <div class="calculatorwp_ns_single">

                <select name="data[calculatorwpClientloan][loan_stage]" class="post-format">
                    <option value="0" > Update Stage </option>
                    <option value="1" <?php echo $ewm_Application; ?>>  Application </option>
                    <option value="3" <?php echo $ewm_Approve; ?>> Approve  </option>
                    <option value="2" <?php echo $ewm_Decline ; ?>> Decline  </option>
                    <option value="4" <?php echo $ewm_Repayment; ?>> Repayment  </option>
                    <option value="5" <?php echo $ewm_Close; ?>> Close </option>
                </select>

            </div>

			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?></td>
      
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?></td>
        </tr>
</table>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<center>'.$this->form->end('Update').'</center>';  ?>

</center>
<br>
</div>
</div>
<?php //sl_hide_mitem(); ?>
</div>