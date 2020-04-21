<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));

$reason = $data->reason;
$description = $data->description;
$id = $data->id;
$initials = strtoupper($data->initials);
$correction = strtoupper($data->corrective);

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Europe/London'));
$newDate = $date->format('Y-m-d H:i:s');  // outputs ‘2020-04-07 00:00:00’

$dal = new ncr();
$update = $dal->ncrDescription($reason,$description,$newDate,$correction,$initials,$id);
