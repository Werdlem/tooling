<?php 

require_once ('../DAL/NcrConn.php');
$dal = new ncr();
$data = json_decode(file_get_contents("php://input"));
$orderId = $data->order_id;

$fetch = $dal->getReview($orderId);
echo json_encode($fetch);

