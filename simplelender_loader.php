<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class simplelenderLoader extends MvcPluginLoader {

    var $db_version = '1.3.02';
    var $tables = array();

    function activate() {
    
        // This call needs to be made to activate this app within WP MVC
        
        $this->activate_app(__FILE__);
        
        // Perform any databases modifications related to plugin activation here, if necessary

        require_once ABSPATH.'wp-admin/includes/upgrade.php';
    
        add_option('simplelender_db_version', $this->db_version);
        
        global $wpdb;
        $t_prefix=$wpdb->prefix;
        // Use dbDelta() to create the tables for the app here
        if ( simplelender_fs()->is_plan('growth') ) {      
            $sql = ["
              CREATE TABLE `".$t_prefix."simplelender_account` (
                `id` int(11) NOT NULL,
                `name` varchar(32) NOT NULL,
                `parent_id` int(20) DEFAULT NULL,
                `Type` enum('Asset','Liability','Equity') NOT NULL,
                `space_individualtype` int(3) NOT NULL,
                `system_user` int(3) NOT NULL,
                `space_id` int(11) DEFAULT NULL,
                `related_user_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              INSERT INTO `".$t_prefix."simplelender_account` (`id`, `name`, `parent_id`, `Type`, `space_individualtype`, `system_user`, `space_id`, `related_user_id`) VALUES
              (1, 'Money', NULL, 'Asset', 1, 1, NULL, NULL),
              (2, 'Cash payment', 1, 'Asset', 1, 1, NULL, NULL),
              (3, 'Mobile payment', 1, 'Asset', 1, 1, NULL, NULL),
              (4, 'Bank payment', 1, 'Asset', 1, 1, NULL, NULL),
              (5, 'Interests Earned', NULL, 'Asset', 1, 1, NULL, NULL),
              (6, 'Loan', NULL, 'Asset', 1, 1, NULL, NULL),
              (7, 'Fee', NULL, 'Asset', 1, 1, NULL, NULL);
              ","
              CREATE TABLE `".$t_prefix."simplelender_api_key` (
                `id` int(11) NOT NULL,
                `display_name` varchar(200) DEFAULT NULL,
                `api_name` int(200) DEFAULT NULL,
                `display_on_frontend` int(1) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_api_value` (
                `id` int(11) NOT NULL,
                `key_id` int(11) DEFAULT NULL,
                `loan_application_id` int(11) DEFAULT NULL,
                `time_of_reception` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `value` varchar(1500) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_client_account` (
                `id` int(11) NOT NULL,
                `acc_number` varchar(25) NOT NULL,
                `mobilenumber` varchar(20) NOT NULL,
                `firstname` varchar(35) DEFAULT NULL,
                `middlename` varchar(35) DEFAULT NULL,
                `lastname` varchar(35) DEFAULT NULL,
                `email` varchar(100) DEFAULT NULL,
                `wp_user_id` int(11) DEFAULT NULL,
                `status` tinyint(1) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","

              CREATE TABLE `".$t_prefix."simplelender_client_loan` (
                `id` int(11) NOT NULL,
                `amount_needed` int(11) DEFAULT NULL,
                `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `needed_by_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `issue_date` timestamp NULL DEFAULT NULL,
                `fully_settled_date` timestamp NULL DEFAULT NULL,
                `term` int(11) DEFAULT '1',
                `term_period` varchar(3) DEFAULT NULL,
                `loan_setting_id` int(11) DEFAULT NULL,
                `loan_stage` int(3) DEFAULT '1',
                `client_id` varchar(200) DEFAULT NULL,
                `goal_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_dat_key` (
                `id` int(11) NOT NULL,
                `name` varchar(110) NOT NULL,
                `key_id` varchar(200) NOT NULL,
                `form_id` varchar(200) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_dat_value` (
                `id` int(11) NOT NULL,
                `form_id` varchar(20) NOT NULL,
                `key_id` varchar(100) NOT NULL,
                `object_type` int(3) NOT NULL,
                `object_id` int(3) NOT NULL,
                `data_value` varchar(500) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_d_entry` (
                `id` int(11) NOT NULL,
                `bs_account` int(3) NOT NULL,
                `dr_cr` int(1) NOT NULL,
                `trans_amount` int(11) NOT NULL,
                `trans_type` int(2) NOT NULL COMMENT '1->loan issue 2 -> loan repayment',
                `trans_id` int(11) NOT NULL,
                `parent_trans_id` int(20) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","       
              CREATE TABLE `".$t_prefix."simplelender_loan_setting` (
                `id` int(11) NOT NULL,
                `name` varchar(50) NOT NULL,
                `notes` varchar(100) DEFAULT NULL,
                `max_amount` int(11) NOT NULL,
                `interest_type` int(11) DEFAULT NULL,
                `interest_rate` int(11) DEFAULT NULL,
                `reminder_time_before` varchar(4) NOT NULL,
                `repayment_method` int(3) NOT NULL,
                `penalties` int(11) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `period_unit` varchar(2) NOT NULL DEFAULT 'm',
                `max_period_number` int(20) NOT NULL,
                `main_title_text` varchar(200) DEFAULT NULL,
                `main_title_description` varchar(5000) DEFAULT NULL,
                `secondary_form` int(15) DEFAULT NULL,
                `goal_form` int(15) DEFAULT NULL,
                `currency` varchar(5) DEFAULT NULL,
                `webhook_trigger_action` varchar(200) DEFAULT NULL,
                `button_text` varchar(200) DEFAULT NULL,
                `show_repayment` int(1) DEFAULT NULL,
                `calculator_theme` varchar(200) DEFAULT NULL,
                `mailchimp_group` varchar(50) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_mail_recipients` (
                `id` int(11) NOT NULL,
                `webhook_id` int(11) DEFAULT NULL,
                `type` varchar(150) DEFAULT NULL,
                `recipient` varchar(150) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_message` (
                `id` int(11) NOT NULL,
                `message` mediumtext,
                `sender_id` int(11) DEFAULT NULL,
                `status` int(3) NOT NULL COMMENT '1->sent 2=>read',
                `send_time` timestamp NULL DEFAULT NULL,
                `read_time` timestamp NULL DEFAULT NULL,
                `ticket_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_notifications` (
                `id` int(11) NOT NULL,
                `message` varchar(500) DEFAULT NULL,
                `user_id` int(11) DEFAULT NULL,
                `status` int(2) DEFAULT NULL COMMENT '1=>created, 2=>seen,3=>deleted',
                `time_created` timestamp NULL DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","

              CREATE TABLE `".$t_prefix."simplelender_spending_goal` (
                `id` int(11) NOT NULL,
                `name` varchar(150) NOT NULL,
                `description` varchar(500) NOT NULL,
                `email` varchar(200) DEFAULT NULL,
                `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_ticket` (
                `id` int(11) NOT NULL,
                `creation_time` timestamp NULL DEFAULT NULL,
                `close_time` timestamp NULL DEFAULT NULL,
                `status` int(2) DEFAULT NULL,
                `ticket_id` varchar(100) DEFAULT NULL,
                `loan_id` int(11) DEFAULT NULL,
                `client_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_webhooks` (
                `id` int(11) NOT NULL,
                `notification_is_active` tinyint(4) NOT NULL DEFAULT '0',
                `name` varchar(150) DEFAULT NULL,
                `webhook_trigger_action` varchar(250) DEFAULT NULL,
                `mail_active` tinyint(4) DEFAULT NULL,
                `mail_subject` varchar(150) DEFAULT NULL,
                `mail_body` varchar(5000) DEFAULT NULL,
                `webhook_active` tinyint(4) DEFAULT NULL,
                `args_encoding` tinyint(4) DEFAULT NULL COMMENT '1 => ''Form-encoded body'' 2 => ''JSON-encoded body'' 3 => ''URL parameters encoded (no body)''',
                `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `last_time_event_is_triggered` datetime NOT NULL,
                `number_of_times_event_was_trigger` int(11) NOT NULL DEFAULT '0',
                `unsuccessful_attempts_to_send_webhook` int(11) NOT NULL DEFAULT '0'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_webhook_args` (
                `id` int(11) NOT NULL,
                `webhook_id` int(11) DEFAULT NULL,
                `key_name` varchar(150) DEFAULT NULL,
                `value` longtext,
                `type` varchar(10) DEFAULT 'body'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_webhook_events` (
                `id` int(11) NOT NULL,
                `webhook_id` int(11) NOT NULL,
                `args` longtext,
                `processed_successfully` tinyint(4) NOT NULL COMMENT '0->pending process 1->done 2-> failed 3->to be retried'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE `".$t_prefix."simplelender_webhook_logs` (
                `id` int(11) NOT NULL,
                `webhook_event_id` int(11) DEFAULT NULL,
                `successful` int(1) DEFAULT NULL COMMENT '1->successful 2->failiure',
                `retry` int(1) DEFAULT NULL COMMENT '0->first_attempt 1->retry',
                `log_type` int(1) DEFAULT NULL COMMENT '1->notification event 2->notification modification',
                `schedule_id` int(11) DEFAULT NULL,
                `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `finally_done` int(1) DEFAULT NULL,
                `webhook_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","

              CREATE TABLE `".$t_prefix."simplelender_webhook_urls` (
                `id` int(11) NOT NULL,
                `webhook_id` int(11) DEFAULT NULL,
                `type` varchar(100) DEFAULT NULL,
                `url` varchar(250) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_account`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_api_key`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_api_value`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_client_account`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `acc_number` (`acc_number`),
                ADD KEY `id` (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_client_loan`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_dat_key`
                ADD PRIMARY KEY (`id`),
                ADD KEY `id` (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_dat_value`
                ADD PRIMARY KEY (`id`),
                ADD KEY `id` (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_d_entry`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_mail_recipients`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_message`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_notifications`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_spending_goal`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_ticket`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhooks`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhook_args`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhook_events`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhook_logs`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhook_urls`
                ADD PRIMARY KEY (`id`);
              ","
              ALTER TABLE `".$t_prefix."simplelender_account`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
              ","
              ALTER TABLE `".$t_prefix."simplelender_api_key`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
              ","
              ALTER TABLE `".$t_prefix."simplelender_api_value`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
              ","
              ALTER TABLE `".$t_prefix."simplelender_client_account`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_client_loan`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_dat_key`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_mail_recipients`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
              ","
              ALTER TABLE `".$t_prefix."simplelender_message`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_notifications`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
              ","
              ALTER TABLE `".$t_prefix."simplelender_spending_goal`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_ticket`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhooks`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              ","
              ALTER TABLE `".$t_prefix."simplelender_webhook_args`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `period_unit` varchar(2) NOT NULL DEFAULT 'm' AFTER `repayment_method`;
              ","          
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `main_title_text` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `main_title_description` varchar(5000) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `currency` varchar(5) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `webhook_trigger_action` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `button_text`  varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `show_repayment` int(1) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `calculator_theme` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `mailchimp_group`  varchar(50) DEFAULT NULL AFTER `repayment_method`;
             COMMIT;"];
        }
        else{
          $sql = ["
            CREATE TABLE `".$t_prefix."simplelender_account` (
              `id` int(11) NOT NULL,
              `name` varchar(32) NOT NULL,
              `parent_id` int(20) DEFAULT NULL,
              `Type` enum('Asset','Liability','Equity') NOT NULL,
              `space_individualtype` int(3) NOT NULL,
              `system_user` int(3) NOT NULL,
              `space_id` int(11) DEFAULT NULL,
              `related_user_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            INSERT INTO `".$t_prefix."simplelender_account` (`id`, `name`, `parent_id`, `Type`, `space_individualtype`, `system_user`, `space_id`, `related_user_id`) VALUES
            (1, 'Money', NULL, 'Asset', 1, 1, NULL, NULL),
            (2, 'Cash payment', 1, 'Asset', 1, 1, NULL, NULL),
            (3, 'Mobile payment', 1, 'Asset', 1, 1, NULL, NULL),
            (4, 'Bank payment', 1, 'Asset', 1, 1, NULL, NULL),
            (5, 'Interests Earned', NULL, 'Asset', 1, 1, NULL, NULL),
            (6, 'Loan', NULL, 'Asset', 1, 1, NULL, NULL),
            (7, 'Fee', NULL, 'Asset', 1, 1, NULL, NULL);
            ","
            CREATE TABLE `".$t_prefix."simplelender_api_key` (
              `id` int(11) NOT NULL,
              `display_name` varchar(200) DEFAULT NULL,
              `api_name` int(200) DEFAULT NULL,
              `display_on_frontend` int(1) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_api_value` (
              `id` int(11) NOT NULL,
              `key_id` int(11) DEFAULT NULL,
              `loan_application_id` int(11) DEFAULT NULL,
              `time_of_reception` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `value` varchar(1500) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_client_account` (
              `id` int(11) NOT NULL,
              `acc_number` varchar(25) NOT NULL,
              `mobilenumber` varchar(20) NOT NULL,
              `firstname` varchar(35) DEFAULT NULL,
              `middlename` varchar(35) DEFAULT NULL,
              `lastname` varchar(35) DEFAULT NULL,
              `email` varchar(100) DEFAULT NULL,
              `wp_user_id` int(11) DEFAULT NULL,
              `status` tinyint(1) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","

            CREATE TABLE `".$t_prefix."simplelender_client_loan` (
              `id` int(11) NOT NULL,
              `amount_needed` int(11) DEFAULT NULL,
              `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `needed_by_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `issue_date` timestamp NULL DEFAULT NULL,
              `fully_settled_date` timestamp NULL DEFAULT NULL,
              `term` int(11) DEFAULT '1',
              `term_period` varchar(3) DEFAULT NULL,
              `loan_setting_id` int(11) DEFAULT NULL,
              `loan_stage` int(3) DEFAULT '1',
              `client_id` varchar(200) DEFAULT NULL,
              `goal_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_dat_key` (
              `id` int(11) NOT NULL,
              `name` varchar(110) NOT NULL,
              `key_id` varchar(200) NOT NULL,
              `form_id` varchar(200) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_dat_value` (
              `id` int(11) NOT NULL,
              `form_id` varchar(20) NOT NULL,
              `key_id` varchar(100) NOT NULL,
              `object_type` int(3) NOT NULL,
              `object_id` int(3) NOT NULL,
              `data_value` varchar(500) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_d_entry` (
              `id` int(11) NOT NULL,
              `bs_account` int(3) NOT NULL,
              `dr_cr` int(1) NOT NULL,
              `trans_amount` int(11) NOT NULL,
              `trans_type` int(2) NOT NULL COMMENT '1->loan issue 2 -> loan repayment',
              `trans_id` int(11) NOT NULL,
              `parent_trans_id` int(20) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","       
            CREATE TABLE `".$t_prefix."simplelender_loan_setting` (
              `id` int(11) NOT NULL,
              `name` varchar(50) NOT NULL,
              `notes` varchar(100) DEFAULT NULL,
              `max_amount` int(11) NOT NULL,
              `interest_type` int(11) DEFAULT NULL,
              `interest_rate` int(11) DEFAULT NULL,
              `reminder_time_before` varchar(4) NOT NULL,
              `repayment_method` int(3) NOT NULL,
              `penalties` int(11) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `period_unit` varchar(2) NOT NULL DEFAULT 'm',
              `max_period_number` int(20) NOT NULL,
              `main_title_text` varchar(200) DEFAULT NULL,
              `main_title_description` varchar(5000) DEFAULT NULL,
              `secondary_form` int(15) DEFAULT NULL,
              `goal_form` int(15) DEFAULT NULL,
              `currency` varchar(5) DEFAULT NULL,
              `webhook_trigger_action` varchar(200) DEFAULT NULL,
              `button_text` varchar(200) DEFAULT NULL,
              `show_repayment` int(1) DEFAULT NULL,
              `calculator_theme` varchar(200) DEFAULT NULL,
              `mailchimp_group` varchar(50) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_mail_recipients` (
              `id` int(11) NOT NULL,
              `webhook_id` int(11) DEFAULT NULL,
              `type` varchar(150) DEFAULT NULL,
              `recipient` varchar(150) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_message` (
              `id` int(11) NOT NULL,
              `message` mediumtext,
              `sender_id` int(11) DEFAULT NULL,
              `status` int(3) NOT NULL COMMENT '1->sent 2=>read',
              `send_time` timestamp NULL DEFAULT NULL,
              `read_time` timestamp NULL DEFAULT NULL,
              `ticket_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_notifications` (
              `id` int(11) NOT NULL,
              `message` varchar(500) DEFAULT NULL,
              `user_id` int(11) DEFAULT NULL,
              `status` int(2) DEFAULT NULL COMMENT '1=>created, 2=>seen,3=>deleted',
              `time_created` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","

            CREATE TABLE `".$t_prefix."simplelender_spending_goal` (
              `id` int(11) NOT NULL,
              `name` varchar(150) NOT NULL,
              `description` varchar(500) NOT NULL,
              `email` varchar(200) DEFAULT NULL,
              `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_ticket` (
              `id` int(11) NOT NULL,
              `creation_time` timestamp NULL DEFAULT NULL,
              `close_time` timestamp NULL DEFAULT NULL,
              `status` int(2) DEFAULT NULL,
              `ticket_id` varchar(100) DEFAULT NULL,
              `loan_id` int(11) DEFAULT NULL,
              `client_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_webhooks` (
              `id` int(11) NOT NULL,
              `notification_is_active` tinyint(4) NOT NULL DEFAULT '0',
              `name` varchar(150) DEFAULT NULL,
              `webhook_trigger_action` varchar(250) DEFAULT NULL,
              `mail_active` tinyint(4) DEFAULT NULL,
              `mail_subject` varchar(150) DEFAULT NULL,
              `mail_body` varchar(5000) DEFAULT NULL,
              `webhook_active` tinyint(4) DEFAULT NULL,
              `args_encoding` tinyint(4) DEFAULT NULL COMMENT '1 => ''Form-encoded body'' 2 => ''JSON-encoded body'' 3 => ''URL parameters encoded (no body)''',
              `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `last_time_event_is_triggered` datetime NOT NULL,
              `number_of_times_event_was_trigger` int(11) NOT NULL DEFAULT '0',
              `unsuccessful_attempts_to_send_webhook` int(11) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_webhook_args` (
              `id` int(11) NOT NULL,
              `webhook_id` int(11) DEFAULT NULL,
              `key_name` varchar(150) DEFAULT NULL,
              `value` longtext,
              `type` varchar(10) DEFAULT 'body'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_webhook_events` (
              `id` int(11) NOT NULL,
              `webhook_id` int(11) NOT NULL,
              `args` longtext,
              `processed_successfully` tinyint(4) NOT NULL COMMENT '0->pending process 1->done 2-> failed 3->to be retried'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            CREATE TABLE `".$t_prefix."simplelender_webhook_logs` (
              `id` int(11) NOT NULL,
              `webhook_event_id` int(11) DEFAULT NULL,
              `successful` int(1) DEFAULT NULL COMMENT '1->successful 2->failiure',
              `retry` int(1) DEFAULT NULL COMMENT '0->first_attempt 1->retry',
              `log_type` int(1) DEFAULT NULL COMMENT '1->notification event 2->notification modification',
              `schedule_id` int(11) DEFAULT NULL,
              `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `finally_done` int(1) DEFAULT NULL,
              `webhook_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","

            CREATE TABLE `".$t_prefix."simplelender_webhook_urls` (
              `id` int(11) NOT NULL,
              `webhook_id` int(11) DEFAULT NULL,
              `type` varchar(100) DEFAULT NULL,
              `url` varchar(250) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_account`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_api_key`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_api_value`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_client_account`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `acc_number` (`acc_number`),
              ADD KEY `id` (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_client_loan`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_dat_key`
              ADD PRIMARY KEY (`id`),
              ADD KEY `id` (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_dat_value`
              ADD PRIMARY KEY (`id`),
              ADD KEY `id` (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_d_entry`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_loan_setting`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_mail_recipients`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_message`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_notifications`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_spending_goal`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_ticket`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhooks`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhook_args`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhook_events`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhook_logs`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhook_urls`
              ADD PRIMARY KEY (`id`);
            ","
            ALTER TABLE `".$t_prefix."simplelender_account`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
            ","
            ALTER TABLE `".$t_prefix."simplelender_api_key`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            ","
            ALTER TABLE `".$t_prefix."simplelender_api_value`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            ","
            ALTER TABLE `".$t_prefix."simplelender_client_account`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_client_loan`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_dat_key`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_loan_setting`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_mail_recipients`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            ","
            ALTER TABLE `".$t_prefix."simplelender_message`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_notifications`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
            ","
            ALTER TABLE `".$t_prefix."simplelender_spending_goal`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_ticket`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhooks`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
            ","
            ALTER TABLE `".$t_prefix."simplelender_webhook_args`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
              COMMIT;"];
        }
        
    
        foreach ($sql as $single_sql) {
            $wpdb->query($single_sql);
        }
        
    }

    function deactivate() {
    
        // This call needs to be made to deactivate this app
        
        $this->deactivate_app(__FILE__);
        
        // Perform any databases modifications related to plugin deactivation here, if necessary
    
    }

}

?>