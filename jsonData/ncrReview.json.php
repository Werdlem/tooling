<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$text = $data->text;
$po = $data->id;
$field = $data->field;
$date = new DateTime();
$date->setTimezone(new DateTimeZone('Europe/London'));
$newDate = $date->format('Y-m-d H:i:s');  // outputs ‘2020-04-07 00:00:00’
$date = $data->date;
$dal = new ncr();

if ($field == 'investigation'){
	$investigation = $dal->closeInvestigation($po,$text, $newDate);
}

if ($field == 'review'){
	$review = $dal->review($text, $newDate,$po);
	echo $po;
}

//$addCustomer = $dal->addComment($text, $po, $field, $newDate,$date);
