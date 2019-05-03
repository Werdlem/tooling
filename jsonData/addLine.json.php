<?php 
date_default_timezone_set("Europe/London");
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$quoteRef = $data->quoteRef;
$unit = 'Each';
$dal = new tooling();
$date = date("Y-m-d h:i:s");

$fetch = $dal->addLine($quoteRef, $unit,$date);

