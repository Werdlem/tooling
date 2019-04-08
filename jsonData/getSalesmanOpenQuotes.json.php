<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = json_decode(file_get_contents("php://input"));
$value = $fetch->sales;
$fetch = $dal->getSalesmanOpenQuotes($value);
echo json_encode($fetch);

