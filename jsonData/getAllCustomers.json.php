<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();

$fetch = $dal->getAllCustomers();
echo json_encode($fetch);

