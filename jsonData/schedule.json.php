<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$order = $data->order_id;
$sku = $data->sku;
$qty = $data->qty;
$department = $data->department->name;
$duration = $data->duration;
$itemId = $data->itemId;
$customer = $data->customer;
$scheduleDate = $data->scheduleDate;

$scheduleDate = new DateTime($data->scheduleDate);
$scheduleDate->setTimezone(new DateTimeZone('Europe/London'));
$d =  $scheduleDate->format('Y-m-d');  // outputs ‘2020-04-07 00:00:00’




//echo $scheduleDate->format('Y-m-d H:i:s');  // outputs ‘2020-04-07 00:00:00’
$fetch = $dal->schedule($order,$sku, $qty, $department, $duration,$d,$itemId, $customer);
echo json_encode($fetch);
