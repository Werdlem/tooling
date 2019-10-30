<?php 

require_once ('../DAL/DBConn.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$order = $data->order_id;
$sku = $data->sku;
$qty = $data->qty;
$machine = $data->machine->name;
$duration = $data->duration;
$scheduleDate = date('Y-m-d H:i:s',strtotime($data->scheduleDate));
$fetch = $dal->schedule($order,$sku, $qty, $machine, $duration,$scheduleDate);
echo json_encode($fetch);
