<div class = "cwp_coms_wrap_outer">
<center><h3 class="calculatorwp_main_title">Mailchimp Settings</h3></center>

<table class="calculatorwp_list_table">
    <tr style="width:100%;">
    <td class="" >
<?php 

function calculatorwp_SectionInput($args)
{
    ?>
    <p id="<?php echo esc_attr($args['id']); ?>">
        <?php esc_html_e('Authentication settings for received API data.', SL_THEME); ?>
    </p>
    <?php
}

function ads_show_settings() {
    return 'ads_show_settings';
}

function calculatorwp_OptionsPageHTML()
{
    /**
     * Check user capabilities
     */
    if (!current_user_can('manage_options')) {
        echo 'You do not have permission to manage options: Please talk to your admin';
        return;
    }

    ?>

<div class="wrap">
     <form action="options.php" method="post">
        <?php
            settings_fields('calculatorwp');
            do_settings_sections('calculatorwp');

            add_settings_section(
                'calculatorwp',
                'Extra Settings',
                'ads_description',
                'discussion'
            );

            // Register a callback
            register_setting(
                'discussion',
                'ads',
                'trim'
            );

            // Register the field for the "avatars" section.
            add_settings_field(
                'ads',
                'Test field',
                'ads_show_settings',
                'discussion',
                'ads_id',
                array ( 'label_for' => 'ads_id' )
            );

            submit_button('Save Settings');

        ?>

    </form>
</div>

<?php

}

calculatorwp_OptionsPageHTML();

?>
    </td>
    </tr>
</table>

</center>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */    ?>