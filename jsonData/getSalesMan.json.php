<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = $dal->getSalesMan();
echo json_encode($fetch);
