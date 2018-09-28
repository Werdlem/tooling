<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$value = json_decode(file_get_contents("php://input"));
$value = $value->customer;

$fetch = $dal->searchAllCustomers($value);
echo json_encode($fetch);

