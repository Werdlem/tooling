<?php
 
//define('DB_HOST', 'localhost');define('DB_NAME', 'tooling'); define('DB_USER', 'root');define('DB_PASSWORD', 'root');
//define('DB_HOST', 'localhost');define('DB_NAME', 'tooling'); define('DB_USER', 'root');define('DB_PASSWORD', '');
define('DB_HOST', 'sqlserver2'); define('DB_NAME', 'ppkstock'); define('DB_USER', 'ppkstock'); define('DB_PASSWORD', 'ppkstock');

define('SMTP_HOST', 'mail');
define('SMTP_PORT', 25);

$EMAIL_ORDERS_TO = array('sales@postpack.co.uk' => 'Postpack'); $EMAIL_ORDERS_CC = array('despatch@postpack.co.uk' => 'PostPack Despatch'); $EMAIL_ORDERS_FROM = array('despatch@postpack.co.uk' => 'PostPack Despatch');

