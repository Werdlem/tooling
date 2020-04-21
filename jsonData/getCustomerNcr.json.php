<?php 

require_once ('../DAL/NcrConn.php');
$dal = new ncr();
$data = json_decode(file_get_contents("php://input"));
$orderId = $value->order_id;

$fetch = $dal->getCustomerNcr($orderId);
echo json_encode($fetch);

