<?php

// recieve api details  and call function process_loan_application_response()

function calculatorwp_listen_for_api_response(){
    if(isset($_POST['loan_application_id'])){
        !isset($_POST['loan_application_id'])? $_POST['loan_application_id']='':$_POST['loan_application_id'];
        !isset($_POST['more_information'])? $_POST['more_information']='':$_POST['more_information'];
        !isset($_POST['status'])? $_POST['status']='':$_POST['status'];
        !isset($_POST['redirect_url'])? $_POST['redirect_url']='':$_POST['redirect_url'];

        calculatorwp_process_loan_application_response(array(
            'loan_application_id'=>$_POST['loan_application_id'],
            'more_information'=>$_POST['more_information'],
            'status'=>$_POST['status'],
            'redirect_url'=>$_POST['redirect_url']
            ));
    }
}

add_action('init','calculatorwp_listen_for_api_response');

    function calculatorwp_process_loan_application_response($param=''){
        
        //update loan application information
        mvc_model('calculatorwpClientloan')->find_by_id($param['loan_application_id'])->update([
            'status'=>$param['status']
        ]);

        mvc_model('calculatorwpClientloaninfo')->add([
            'more_info'=>$param['more_information'],
            'redirect_url'=>$param['redirect_url'],
            'loan_application_id'
            ]);
        //do notification
        sl_do_notification(array('info'=>$param['more_information'],'click_url'=>$url_to_relevant_url));
        
    }

    //webhook code
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
    // if (is_plugin_active(WP_calculatorwp__PLUGIN_DIR.'/calculatorwp-by-umatidocs-com.php') || is_plugin_active(WP_calculatorwp__PLUGIN_DIR.'/calculatorwp-by-umatidocs-com.php') || is_plugin_active(WP_calculatorwp__PLUGIN_DIR.'/calculatorwp-by-umatidocs-com.php')) {
    
    require_once dirname(__FILE__).'/events/calculatorwp_events_manager.php';

    if(isset($_GET['id'])){
        if($_GET['id']=='calculatorwp_doanload_logs' ){
            add_action( 'admin_init', 'calculatorwp_csv_export' );
        }
    }

    function calculatorwp_csv_export() {
        
        ob_start();
        $domain = $_SERVER['SERVER_NAME'];
        $filename = 'users-' . $domain . '-' . time() . '.csv';
        
        $header_row = array(
            'Email',
            'Name'
        );
        $data_rows = array();
        global $wpdb;
        $array=[
            'Id','Webhook Name','Executed successful','First attempt or Retry','Log Type','Time'
            ];
                
            $calculatorwpWebhookLog = mvc_model('calculatorwpWebhookLog')->find();
            $calculatorwp_retry=array('first attempt','retry');
            $calculatorwp_log_type=array(1=>'Notification trigger',2=>'Notification modification');             
            $calculatorwp_successful=array('failed','successful');
                
            foreach ($calculatorwpWebhookLog as $value) {
                array_push($data_rows ,
                    [$value->id,mvc_model('calculatorwpWebhook')->find_by_id($value->webhook_id)->name ,$calculatorwp_successful[$value->successful],$calculatorwp_retry[$value->retry],$calculatorwp_log_type[$value->log_type],$value->timestamp]
                );
            }
                
        $fh = @fopen( 'php://output', 'w' );
        fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( 'Content-Description: File Transfer' );
        header( 'Content-type: text/csv' );
        header( "Content-Disposition: attachment; filename={$filename}" );
        header( 'Expires: 0' );
        header( 'Pragma: public' );
        fputcsv( $fh, $array );
        foreach( $data_rows as $data_row ) {
            fputcsv( $fh, $data_row );
        }
        fclose( $fh );    
        ob_end_flush();    
        die();
    }

    function calculatorwp_get_mailchimp_list($data=[]){
            //$param : name/ email
            // error_log('result22');
            // API to mailchimp ########################################################
            $apiKey = get_option('calculatorwp_mailchimp_api_key');

            $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
            $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/';

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $result=json_decode($result,true);
            // error_log($result);
            $lists_exist= false;
            if (is_array($result)) {
                $arrayobj = new ArrayObject($result);        
                $lists_exist= $arrayobj->offsetExists('lists');
            }
            
            if( $lists_exist === true ) {
                $return_var = $result['lists'];
            }
            else{
                $return_var = 'hallo';
            }
            
            return $return_var;
        }

    function calculatorwp_get_mailchimp_list_interest($param=''){

        $apiKey = get_option('calculatorwp_mailchimp_api_key');
        $listId = get_option('calculatorwp_mailchimp_list');

        if ( isset($listId) ) {
        // API to mailchimp ########################################################
                $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
                $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/'.$listId.'/interest-categories';

                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                $result=json_decode($result,true);
                $html_code=[];

                if(is_array($result)){
                    if(array_key_exists('categories',$result)){
                        if(is_array($result['categories'])){

                            if(count( $result['categories'] ) > 0 ){
                                foreach ($result['categories'] as $key => $value) {
                                    $html_code[$value['id']] = $value['title'];				
                                }
                            }
                            else{
                                $html_code[0] = 'No Mailchimp Groups Create';
                            }

                        }
                    }
                }

            }
            else{
                $html_code=[];
            }

            return $html_code;
        }
    add_filter("calculatorwp_get_mailchimp_list_interest","calculatorwp_get_mailchimp_list_interest");

    function calculatorwp_send_to_mailchimp($data=['email'=>'','status'=>'','firstname'=>'','lastname'=>'']){

        // API to mailchimp ########################################################
        $apiKey = get_option('calculatorwp_mailchimp_api_key');
        $listId = get_option('calculatorwp_mailchimp_list');

        if (isset($listId) && isset($apiKey)) {

            $memberId = md5(strtolower($data['email']));
            $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
            $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

            // @todo :  add interests if they are added.
            $json = json_encode([

                'email_address' => $data['email'],
                'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
                'merge_fields'  => [
                    'FNAME'     => $data['firstname'],
                    'LNAME'     => $data['lastname']
                ],
            ]);

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

            $result = curl_exec($ch); 
            error_log($result);           
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
           
            return $httpCode;
        }
    }

    add_action('calculatorwp_send_to_mailchimp','calculatorwp_send_to_mailchimp');
    //mailchimp Api

    define('SL_THEME', 'hdhd');

    function calculatorwp_SettingsInit()
    {
        // register a new setting for "wporg" page
        register_setting('calculatorwp', 'calculatorwp_mailchimp_api_key');
        register_setting('calculatorwp', 'calculatorwp_mailchimp_list');

        // register a new section in the "wporg" page
        add_settings_section(
            'calculatorwp_section',
            __('Settings', SL_THEME),
            'calculatorwp_SectionInput',
            'calculatorwp'
        );

        // register a new field in the "calculatorwp_section" section, inside the "wporg" page
        add_settings_field(
            'calculatorwp_mailchimp_api_key',
            __('Mailchimp API Key', SL_THEME),
            'calculatorwp_mailchimp_APIkeyField',
            'calculatorwp',
            'calculatorwp_section',
            array(
                'label_for' => 'calculatorwp_mailchimp_api_key',
                'class' => 'calculatorwp-row',
                'calculatorwp_custom_data' => 'custom'
            )
        );
        // register a new field in the "calculatorwp_section" section, inside the "wporg" page
        add_settings_field(
            'calculatorwp_mailchimp_list',
            __('Mailchimp List', SL_THEME),
            'calculatorwp_MailchimpList',
            'calculatorwp',
            'calculatorwp_section',
            array(
                'label_for' => 'calculatorwp_mailchimp_list',
                'class' => 'calculatorwp-row',
                'calculatorwp_custom_data' => 'custom'
            )
        );

    }

    function calculatorwp_mailchimp_APIkeyField($args)
    {
        $path = get_option('calculatorwp_mailchimp_api_key');
        $var = esc_attr($args['label_for']);
        
        ?>
            <input type="text" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">
            <p class="get_mailchimp_description"><?php _e('Get API Key From Mailchimp: <a href="https://mailchimp.com/help/about-api-keys/">Click Here</a> .', SL_THEME); ?></p>

        <?php   
    }

    function calculatorwp_MailchimpList($args)
    {
        $path = get_option('calculatorwp_mailchimp_list');
        $MailchimpList = calculatorwp_get_mailchimp_list();

        $Html_string='';
        if (is_array($MailchimpList)) {
            if (count($MailchimpList)>0) {
                foreach ($MailchimpList as  $key => $value) {

                    $Html_string .= '<option value="'.$value["id"].'"';
                    
                    if ($value["id"]==$path) {
                        $Html_string .= "selected='selected' ";
                    }

                    $Html_string .= '>'.$value["name"].'</option>';
                }
            }
            else{
                $Html_string = 'Please add a valid mailchimp key above, save it then make sure you have created lists in your mailchimp account then reload this page' ;
            }
        }
        else{
            $Html_string = 'Please add a mailchimp key above, save it then make sure you have created lists in your mailchimp account then reload this page' ;
        }
        
        $var = esc_attr($args['label_for']);
        if (is_array($MailchimpList)) {
        ?>
            <select id="<?php echo $var?>" class="large-text" value="<?php echo $path;?>"  name="<?php echo $var?>">
                <?php
            } 
            echo $Html_string;
            if (is_array($MailchimpList)) {
            ?>
            </select>
            <?php } ?>
            <p class="description"><?php // _e('From Mailchimp.', SL_THEME); ?></p>
        <span id="calculatorwp_manager_interest">
        <?php

        return "</span>";
    }

    add_action('admin_init', 'calculatorwp_SettingsInit');


calculatorwp_send_to_mailchimp();



add_action( 'wp_ajax_sl_form_load_content', 'sl_form_load_content' );
add_action( 'wp_ajax_nopriv_sl_form_load_content', 'sl_form_load_content' );
function sl_form_load_content(){

    echo json_encode( [
        'post_title' => get_post_field( 'post_title',  $_POST['form_id'] ),
        'formData' => get_post_field( 'post_content',  $_POST['form_id'] )
    ] );

    wp_die();

}

add_action( 'wp_ajax_sl_update_form_builder', 'sl_update_form_builder' );
add_action( 'wp_ajax_nopriv_sl_update_form_builder', 'sl_update_form_builder' );

function sl_update_form_builder(){

    if( $_POST['form_id'] == 0 ){
        // do new posts
        // create a new group id, and return it
        $post_data = [
            'post_title' => $_POST['form_name'],
            'post_status' => 'active',
            'post_content' => $_POST['form_data'],
            'post_type' => 'mortgagetable',
            'post_parent' => '',
        ] ;

        $new_post_id = wp_insert_post( $post_data, $wp_error );

    }
    else{
        // update post
        // 'form_id'
        $post_data = [
            'ID'            => $_POST['form_id'],
            'post_title'    => $_POST['form_name'],
            'post_status'   => 'active',
            'post_content'  => $_POST['form_data'],
            'post_type'     => 'mortgagetable',
            'post_parent'   => '',
        ] ;

        $new_post_id = wp_update_post( $post_data, $wp_error );

    }

    $posts_ = get_posts( [
        'post_status' => 'active',
        'post_type' => 'mortgagetable',
    ] );

    $mortgagetables = [];
    foreach( $posts_ as $single_p ){
        array_push( $mortgagetables , ['id'=>$single_p->ID, 'post_name' => $single_p->post_title ] );
    }

    echo json_encode( [ 
        'table_id' => $new_post_id,
        'mortgage_tables' => $mortgagetables
    ] );

    wp_die();

}

add_shortcode( 'sl_render_details_l', 'sl_render_details_l');
function sl_render_details_l(){
    return '
        <div id="render-container"></div>
        hallo
    ';
}

?>

