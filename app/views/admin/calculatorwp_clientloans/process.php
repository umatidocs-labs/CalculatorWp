<div class="calculatorwp_clientloans_process">

<div class="wrap">
    <center><h2 class="calculatorwp_main_title"> Mortgage Application </h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
   ?>
<center>
    
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 

    echo $this->form->create($model->name); 

    $calculatorwpLoansetting = mvc_model('calculatorwpLoansetting')->find_by_id($object->loan_setting_id);
    $product_name = $calculatorwpLoansetting->name;
    $product_term_period = $calculatorwpLoansetting->period_unit;

?>

    <div class="sl_process_body">       

        <table class="sl_table_mortgage_details">
            <tr class="calculatorwp_title_feild_app">
                <td>Stage</td>
                <td>

                    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */

                        $sl_client_loan_stage=unserialize( sl_client_loan_stage ) ; // echo $sl_client_loan_stage[$object->loan_stage];

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

                    <select name="data[calculatorwpClientloan][loan_stage]" class="sl_select_loanstage post-format">
                        <option value="0" > Update Stage </option>
                        <option value="1" <?php echo esc_html($ewm_Application); ?>>  Application </option>
                        <option value="3" <?php echo esc_html($ewm_Approve); ?>> Approve  </option>
                        <option value="2" <?php echo esc_html($ewm_Decline) ; ?>> Decline  </option>
                        <option value="4" <?php echo esc_html($ewm_Repayment); ?>> Repayment  </option>
                        <option value="5" <?php echo esc_html($ewm_Close); ?>> Close </option>
                    </select>

                    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
                        echo $this->form->end('Save Stage');
                    ?>

                </td>
            </tr>
            <tr class="calculatorwp_title_feild_app">
                
                <td>Mortgage Applicant</td>
                <td> <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
                    $calculatorwpClientaccount = mvc_model('calculatorwpClientaccount')->find_by_id($object->client_id);

                    echo '
                        Name: '. esc_html($calculatorwpClientaccount->firstname).' '.esc_html($calculatorwpClientaccount->middlename).' '.esc_html($calculatorwpClientaccount->lastname).' |
                        Acc No: '. esc_html($calculatorwpClientaccount->acc_number).' | 
                        Email: '. esc_html($calculatorwpClientaccount->email).'
                        <a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_clientaccounts', 'action' => 'edit','id' => $object->client_id)).'"> Open </a>'; ?>
                </td>
            </tr>
            <tr class="calculatorwp_title_feild_app">
                <td>Mortgage Amount</td>
                <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
                echo esc_html($calculatorwpLoansetting->currency).''.esc_html(number_format( $object->amount_needed, 2 ));
                ?></td>
            </tr>
            <tr class="calculatorwp_title_feild_app">
                    <td>Mortgage Period</td>
                    <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
                        $sl_term_period=[
                            'y'=>'Year(s)',
                            'm'=>'Month(s)',
                            'w'=>'Week(s)',
                            'd'=>'Day(s)'
                        ];

                        echo esc_html($object->term).' '.esc_html($sl_term_period[$product_term_period]);

                    ?>
                    </td>
                </tr>
            <tr class="calculatorwp_title_feild_app">
                    <td>Mortgage Product:</td>
                    <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 
                        echo esc_html($product_name).'
                        <a href="'.mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'edit','id' => $object->loan_setting_id)).'"> Open </a>'; ?>
                    </td>
            </tr>
            <tr class="calculatorwp_title_feild_app">
                <td>Application Date</td>
                <td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo esc_html($object->needed_by_date);?></td>
            </tr>
        </table>

        <!-- mortgage details -->

    </center>

    </div>

<center>

    <div class="sl_process_body">
        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
        echo calculatorwp_class('calculatorwp_raw_data')->display_form_data( [
            'object_type'   => 2,
            'object_id'     => $object_id
        ] ); ?>
    </div>

</center>
    <br>

</div><?php sl_hide_mitem(); ?>

</div>