<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$data = json_decode(file_get_contents("php://input"));
$customer = $data->customer;

$fetch = $dal->getQuotes($customer);
echo json_encode($fetch);

