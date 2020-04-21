<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$name = $data->name;
$po = $data->id;
$date = new DateTime();
$date->setTimezone(new DateTimeZone('Europe/London'));
$newDate = $date->format('Y-m-d H:i:s');  // outputs ‘2020-04-07 00:00:00’
$dal = new ncr();

$closeNcr = $dal->closeNcr($name, $newDate, $po);
