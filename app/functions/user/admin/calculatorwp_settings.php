<?php
    
    require_once dirname(__FILE__).'/calculatorwp_webhook_manager.php';
    require_once dirname(__FILE__).'/calculatorwp_mail_manager.php';
    calculatorwp_class('calculatorwp_mail_manager')->init();
    calculatorwp_class('calculatorwp_webhook_manager')->init();
    function calculatorwpSettingsInit()
    {
        // register a new setting for "wporg" page
        register_setting('calculatorwp', 'calculatorwp_allow_retrys');
    	//register_setting('calculatorwp', 'calculatorwp_number_of_retrys');
        register_setting('calculatorwp', 'calculatorwp_parameter_encoding_type');
    	
        // register a new section in the "wporg" page
        add_settings_section(
            'calculatorwp_section',
            __('Settings', 'calculatorwp_settings'),
            'calculatorwpSectionInput',
            'calculatorwp'
        );
    	
        // allow the user to enable or disable retries.
        add_settings_field(
            'calculatorwp_allow_retrys',
            'Allow retrys',
            'calculatorwpAllowRetrys',
            'calculatorwp',
            'calculatorwp_section',
            array(
                'label_for' => 'calculatorwp_allow_retrys',
                'class' => 'calculatorwp-row',
                'calculatorwp_custom_data' => 'custom'
            )
        );
    }

    function calculatorwpSectionInput($args)
    {
    ?>
        <p id="<?php echo esc_attr($args['id']); ?>">
            <?php esc_html_e('Use this page to change your settings.', 'calculatorwp_settings'); ?>
        </p>
    <?php
    }

    function calculatorwpAllowRetrys($args)
    {
        $path = get_option('calculatorwp_allow_retrys');
        $var = esc_attr($args['label_for']);
    ?>
        <select name="<?php echo $var?>" id="<?php echo $var?>" class="large-text" >
    		<option class="" value="yes" <?php ($path=='yes' || !isset($path))? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >Yes</option>
            <option class="" value="no"  <?php ($path=='no')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >No</option>
        </select>
    <?php
    }

    function calculatorwpOptionsPage()
    {
        // add top level menu page
        add_submenu_page(
            'options-general.php',
            'calculatorwp',
            'calculatorwp',
            'manage_options',
            'calculatorwp',
            'calculatorwpOptionsPageHTML'
        );
    }

    //add_action('admin_menu', 'calculatorwpOptionsPage');

    function calculatorwpOptionsPageHTML()
    {
        /**
         * Check user capabilities
         */
        if (!current_user_can('manage_options')) {
            return;
        }
    ?>

    <div class="wrap">
    <div class="wrap calculatorwp_input" style="
        border-radius:5px;
        padding:30px;
        margin:20px;
        background:#fff;">
            	
    	<hr>
        <form action="options.php" method="post">
            <?php
            settings_fields('calculatorwp');
            do_settings_sections('calculatorwp');
            ?><br><br>
    		<center id='final' >
    	<input class="wp-core-ui button-primary" type="submit" name="submit" id="submit" value="Save Settings">
    </center>
        </form>
    </div>
    </div>
    <?php
    }

    ?>
