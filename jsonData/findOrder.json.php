<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$order = $data->order;
$fetch = $dal->findOrder($order);
echo json_encode($fetch);
