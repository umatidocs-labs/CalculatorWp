<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */

require_once dirname(__FILE__) . '/constants.php';

class calculatorwp_raw_data
{

    public function init()
    {
        $this->load_hooks();
    }

    public function load_hooks()
    {
        add_shortcode('calculatorwp_raw_data_display', array($this, "display_form_data"));
    }

    //-----------------------------------Custom Form ----------------------------------------------------------------------------------------------

    public static function save_custom_value()
    {
    }

    //===================== Gravity Form Parser ======================================
    public function create_raw_data_key_if_absent($param)
    { // form from table

        foreach ($param as $key => $value) {

            //key table id key_name table_id //values table id key_id value
            $key_count = mvc_model("calculatorwpDatKey")->count( [ "conditions" => [
                'form_id' => $value->formId,
                'key_id' => $value->id,
            ] ] );

            if ($key_count == 0) { // key does not exist

                //create key and return key id
                $key_id = mvc_model("calculatorwpDatKey")->create( [
                    "name" => $value->label,
                    "key_id" => $value->id,
                    "form_id" => $value->formId,
                ] );
            }
        }
    }

    public function create_raw_data_value($param)
    {

        //get table keys
        $key_list = mvc_model("calculatorwpDatKey")->find( [ "conditions" => [
            'form_id' => $param["form"]["form_id"],
        ] ] );

        //insert values each under a key
        if ( count($key_list) > 0 ) {
            foreach ( $key_list as $key_value ) {

                //create value and associate it with parent key
                if ( isset( $param['form'][$key_value->key_id] ) ) {

                    $val_key = mvc_model("calculatorwpDatValue")->create([
                        "form_id" => $param["form"]["form_id"],
                        "key_id" => $key_value->key_id,
                        "object_type" => $param["object_type"],
                        "object_id" => $param['object_id'],
                        "data_value" => $param['form'][$key_value->key_id],
                    ]);
                }

            }
        }
    }

    //===================== Form builder Parser ======================================
    /*
        'entry'
        'form'
        'object_type'
        'object_id'
    */
    public static function process_single_form_builder_submission( $param = [] ){
        
        // create // transform form ids into form values to do under unhouse keys
        calculatorwp_raw_data::fb_create_raw_data_key_if_absent( $param );

        calculatorwp_raw_data::fb_create_raw_data_value( $param );

        return true;

    }

    public static function fb_create_raw_data_key_if_absent( $param = [] )
    { // form from table

        $new_param_list = [];
        // var_dump($_FILES);

        foreach ( $param['entry'] as $key => $value ) {

            // var_dump( $value );
 
            //key table id key_name table_id // values table id key_id value
            $key_count = mvc_model("calculatorwpDatKey")->count( [ "conditions" => [
                'form_id' =>  $param['form_id'] ,
                'key_id' => $key ,
            ] ] ) ;
 
            if ( $key_count == 0 ) { // key does not exist //create key and return key id

                if(is_string( $value['title'] ) ) {
                    $key_id = mvc_model("calculatorwpDatKey")->create( [
                        "name"      => $value['title'],
                        "key_id"    => $key,
                        "form_id"   => $param['form_id'],
                    ] ) ;
                }
            }

        }

        $param['entry'] = $new_param_list;

        return $param;

    }
 
    public static function fb_create_raw_data_value( $param = [] )
    {
 
        //get table keys
        $key_list = mvc_model("calculatorwpDatKey")->find( [ "conditions" => [
            'form_id' => $param["form_id"],
        ] ] );
 
        //insert values each under a key
        if ( count( $key_list ) > 0 ) {

            if ( !function_exists( 'wp_handle_upload' ) ) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
            }

            foreach ( $key_list as $key_value ) {

                //Create value and associate it with parent key
                if ( isset( $param['entry'][$key_value->key_id] ) ) {

                    if( $param['entry'][ $key_value->key_id ]['type'] == 'file' ){
                        $sl_data_value = calculatorwp_raw_data::sl_process_attachment_image_file( $param[ 'entry' ][ $key_value->key_id ][ 'val' ] );
                    }
                    else{
                        $sl_data_value = $param['entry'][$key_value->key_id]['val'] ;
                    }

                    $val_key = mvc_model("calculatorwpDatValue")->create( [
                        "form_id"       => $param["form_id"],
                        "key_id"        => $key_value->key_id,
                        "object_type"   => $param["object_type"],
                        "object_id"     => $param['object_id'],
                        "data_value"    => $sl_data_value,
                    ] );

                    unset( $sl_data_value );

                }
            }
        }
    }

    public static function sl_process_attachment_image_file( $sl_val )
    {
        $file_urls = [];
        $uploadedfile = $_FILES[ $sl_val ] ;

        // var_dump( $sl_val );

        // var_dump( $_FILES[ $sl_val ] );
        
        // Processing
        $uploadedfile['name'] = md5( mt_rand() ) .'-'. sanitize_file_name( $uploadedfile['name'] );
        $upload_overrides = array(
            'test_form' => false,
        );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        // $trd = wp_parse_url( $file_location );
        // $file_l = substr_replace( get_home_path(), "", -1 ) . '' . $trd['path'];
        // $file_attr = $movefile;
                
        /*
            var_dump( $movefile );
            array(3) {
                ["file"]    => string(112) "/var/www/html/streamlinemortgage/wp-content/uploads/2024/01/98dfebbecb0400c77061d2f036ee0995Untitled-design1.png"
                ["url"]     => string(109) "http://streamlinemortgage.com/wp-content/uploads/2024/01/98dfebbecb0400c77061d2f036ee0995Untitled-design1.png"
                ["type"]    => string(9) "image/png"
            }
        */

        $s_movefile = maybe_serialize( $movefile );

        return $s_movefile;

    }
 
    //================================================================================== 
    
    //save primary form more data as raw data
    public static function fb_create_primary_form_raw_data_value($param = [])
    {

        $param_e = $param['entry'];

        //get table keys
        $key_list = mvc_model("calculatorwpDatKey")->find( [
            "conditions" => [
                'form_id' => $param["form_id"],
            ]
        ] );

        //insert values each under a key
        if ( count( $key_list ) > 0 ) {

            foreach ( $key_list as $key_id => $key_value ) {

                //create value and associate it with parent key
                if ( isset( $param_e[$key_id] ) ) {
                    $val_key = mvc_model("calculatorwpDatValue")->create( [
                        "form_id" => $param['form_id'],
                        "key_id" => $key_id,
                        "object_type" => $param["object_type"],
                        "object_id" => $param['object_id'],
                        "data_value" => $param_e[$key_id],
                    ] ) ;
                }
            }
        }
    }

    //save primary form more data as raw data
	public static function create_primary_form_raw_data_value( $param = [] ){

		$param_e = $param['entry'];

		//create raw key if absent
		foreach ($param_e as $key => $value){

            //key table id key_name table_id
            //values table id key_id value
            $key_count = mvc_model("calculatorwpDatKey")->count(["conditions"=>[

                'form_id'=>"p1",
                'key_id'=> $key

            ]]);
            
            if($key_count == 0){//key does not exist

                //create key and return key id
                $key_id = mvc_model("calculatorwpDatKey")->create([
                    "name"=>$key,
                    "key_id"=>$key,
                    "form_id"=>"p1"
                ]);

            }

        }

        //get table keys
        $key_list = mvc_model("calculatorwpDatKey")->find(["conditions"=>[
            'form_id'=> "p1"
        ]]);
			
        //insert values each under a key
        if( count($key_list) > 0 ){
            foreach ($key_list as $key_value) {

                //create value and associate it with parent key
                if (isset($param_e[$key_value->key_id])) {
                    $val_key= mvc_model("calculatorwpDatValue")->create([
                        "form_id"=>"p1",
                        "key_id" => $key_value->key_id,
                        "object_type"=> $param["object_type"],
                        "object_id"=> $param['object_id'],
                        "data_value" => $param_e[$key_value->key_id]
                    ]);
                }

            }

        }

    }

    //Display data on admin side
    public function display_form_data($param)
    {

        $html_data = '<table class="sl_table_mortgage_details">';

        $calculatorwpDatValue = mvc_model('calculatorwpDatValue')->find( array( 'conditions' => array(
            'object_type'   => $param['object_type'],
            'object_id'     => $param['object_id'],
        ) ) );

        foreach ( $calculatorwpDatValue as $keyvalue ) {

            if ( !is_int( strpos( $keyvalue->data_value, 'http' ) ) ) { // echo $keyvalue->data_value ;
                $keyvalue_data_value = $keyvalue->data_value ;
            } else { // echo $keyvalue->data_value ;

                $keyvalue_data_value = maybe_unserialize( $keyvalue->data_value ) ;
                // var_dump($keyvalue_data_value );
                $_link_name = '' ;
                if( is_array( $keyvalue_data_value ) ){

                    $_link_name = $keyvalue_data_value ["url"];

                }
                else{
                    $_link_name = $keyvalue_data_value ;
                }

                $keyvalue_data_value = '<a target="_blank" class="sl_open_file_location" href="' . $_link_name . '"> Open </a>';

            }

            $html_data .= '<tr class="calculatorwp_title_feild calculatorwp_title_feild_app" >
                <td>
                    ' . mvc_model('calculatorwpDatKey')->find_one(array('conditions' => array('form_id' => $keyvalue->form_id, 'key_id' => $keyvalue->key_id)))->name . '
                </td>
                <td>
                    ' . $keyvalue_data_value . '
                </td>
            </tr>';
        }

        $html_data .= '</table>';

        return $html_data;
    }
}
