<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$value = json_decode(file_get_contents("php://input"));
$value = $value->id;

$fetch = $dal->getCustomers($value);
echo json_encode($fetch);

