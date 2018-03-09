<?php 

require_once ('../DAL/DBConn.php');

$dal = new tooling();
$fetch = $dal->getSuppliers();
echo json_encode($fetch);
