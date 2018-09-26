<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$customer = $data->customer;
echo $customer;
$dal = new tooling();

$fetch = $dal->getCustomers($customer);
echo json_encode($fetch);
