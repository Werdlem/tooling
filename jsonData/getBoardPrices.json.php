<?php 

require_once ('../DAL/DBConn.php');

$dal = new tooling();
$fetch = $dal->getBoardPrices();
echo json_encode($fetch);
