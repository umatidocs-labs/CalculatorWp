<?php

require_once dirname(__FILE__).'/ticket_message/calculatorwp_message.php';
require_once dirname(__FILE__).'/notification/calculatorwp_notification.php';


calculatorwp_class('calculatorwp_notification')->init();
calculatorwp_class('calculatorwp_message')->init();