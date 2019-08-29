<?php

// recieve api details  and call function process_loan_application_response()
function simplelender_listen_for_api_response(){
    if(isset($_POST['loan_application_id'])){
        !isset($_POST['loan_application_id'])? $_POST['loan_application_id']='':$_POST['loan_application_id'];
        !isset($_POST['more_information'])? $_POST['more_information']='':$_POST['more_information'];
        !isset($_POST['status'])? $_POST['status']='':$_POST['status'];
        !isset($_POST['redirect_url'])? $_POST['redirect_url']='':$_POST['redirect_url'];

        simplelender_process_loan_application_response(array(
            'loan_application_id'=>$_POST['loan_application_id'],
            'more_information'=>$_POST['more_information'],
            'status'=>$_POST['status'],
            'redirect_url'=>$_POST['redirect_url']
            ));
    }
}

add_action('init','simplelender_listen_for_api_response');

function simplelender_process_loan_application_response($param=''){
    
    //update loan application information
    mvc_model('simplelenderClientloan')->find_by_id($param['loan_application_id'])->update([
        'status'=>$param['status']
    ]);

    //(create this table)add multiple more infor section/ add a button
    mvc_model('simplelenderClientloaninfo')->add([
        'more_info'=>$param['more_information'],
        'redirect_url'=>$param['redirect_url'],
        'loan_application_id'
        ]);
    //do notification
    sl_do_notification(array('info'=>$param['more_information'],'click_url'=>$url_to_relevant_url));
    
}

if(simplelender_fs()->is_plan('growth')){
    //webhook code
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    //if (class_exists('simplelenderWebhook')) { simplelender-webhooks-master
    if (is_plugin_active(WP_SIMPLELENDER__PLUGIN_DIR.'/simplelender-by-umatidocs-com.php') || is_plugin_active(WP_SIMPLELENDER__PLUGIN_DIR.'/simplelender-by-umatidocs-com.php') || is_plugin_active(WP_SIMPLELENDER__PLUGIN_DIR.'/simplelender-by-umatidocs-com.php')) {
    
    require_once dirname(__FILE__).'/events/simplelender_events_manager.php';

    if(isset($_GET['id'])){
        if($_GET['id']=='simplelender_doanload_logs' ){
            add_action( 'admin_init', 'simplelender_csv_export' );
        }
    }

    function simplelender_csv_export() {
        
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
                
            $SimplelenderWebhookLog = mvc_model('SimplelenderWebhookLog')->find();
            $simplelender_retry=array('first attempt','retry');
            $simplelender_log_type=array(1=>'Notification trigger',2=>'Notification modification');             
            $simplelender_successful=array('failed','successful');
                
            foreach ($SimplelenderWebhookLog as $value) {
                array_push($data_rows ,
                    [$value->id,mvc_model('SimplelenderWebhook')->find_by_id($value->webhook_id)->name ,$simplelender_successful[$value->successful],$simplelender_retry[$value->retry],$simplelender_log_type[$value->log_type],$value->timestamp]
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
}

function simplelender_get_mailchimp_list($data=[]){
        //$param : name/ email
        
        // API to mailchimp ########################################################
        $apiKey = get_option('simplelender_mailchimp_api_key');

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

function simplelender_get_mailchimp_list_interest($param=''){
    $apiKey = get_option('simplelender_mailchimp_api_key');
    $listId = get_option('simplelender_mailchimp_list');

    //$param : name/ email
    if (isset($listId)) {
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
            var_dump($result);
            $html_code=[];
            foreach ($result['categories'] as $key => $value) {
                $html_code[$value['id']] = $value['title'];
            }
        }
        else{
            $html_code=[];
        }

        return $html_code;
    }
add_filter("simplelender_get_mailchimp_list_interest","simplelender_get_mailchimp_list_interest");

function simplelender_send_to_mailchimp($data=[]){
        //$param : name/ email
        // API to mailchimp ########################################################
        $apiKey = get_option('simplelender_mailchimp_api_key');
        $listId = get_option('simplelender_mailchimp_list');

        $memberId = md5(strtolower($data['email']));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

        $json = json_encode([
            'email_address' => $data['email'],
            'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
            'merge_fields'  => [
                'FNAME'     => $data['firstname'],
                'LNAME'     => $data['lastname']
            ],
            //"interests"=>[$data['interest']=>true]
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
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
var_dump( $result);
        return $httpCode;
    }


//mailchimp Api

define('SL_THEME', 'hdhd');
function simplelender_SettingsInit()
{
    // register a new setting for "wporg" page
    register_setting('simplelender', 'simplelender_mailchimp_api_key');
    register_setting('simplelender', 'simplelender_mailchimp_list');

    // register a new section in the "wporg" page
    add_settings_section(
        'simplelender_section',
        __('Settings', SL_THEME),
        'simplelender_SectionInput',
        'simplelender'
    );

    // register a new field in the "simplelender_section" section, inside the "wporg" page
    add_settings_field(
        'simplelender_mailchimp_api_key',
        __('Mailchimp API Key', SL_THEME),
        'simplelender_mailchimp_APIkeyField',
        'simplelender',
        'simplelender_section',
        array(
            'label_for' => 'simplelender_mailchimp_api_key',
            'class' => 'simplelender-row',
            'simplelender_custom_data' => 'custom'
        )
    );
    // register a new field in the "simplelender_section" section, inside the "wporg" page
    add_settings_field(
        'simplelender_mailchimp_list',
        __('Mailchimp List', SL_THEME),
        'simplelender_MailchimpList',
        'simplelender',
        'simplelender_section',
        array(
            'label_for' => 'simplelender_mailchimp_list',
            'class' => 'simplelender-row',
            'simplelender_custom_data' => 'custom'
        )
    );

}

function simplelender_mailchimp_APIkeyField($args)
{
    $path = get_option('simplelender_mailchimp_api_key');
    $var = esc_attr($args['label_for']);
    
?>
    <input type="text" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">
    <p class="description"><?php _e('From Mailchimp.', SL_THEME); ?></p>

<?php   
}

function simplelender_MailchimpList($args)
{
    $path = get_option('simplelender_mailchimp_list');
    $MailchimpList = simplelender_get_mailchimp_list();

    //var_dump($MailchimpList);
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
    <p class="description"><?php _e('From Mailchimp.', SL_THEME); ?></p>
<span id="simplelender_manager_interest">
<?php

//echo judylinks_class('simplelender_manager')->get_mailchimp_list_interest(['list_id'=>$path]);
return "</span>";
}

add_action('admin_init', 'simplelender_SettingsInit');

}
?>