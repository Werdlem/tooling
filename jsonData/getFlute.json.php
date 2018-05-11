<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetchFlute = $dal->getFlute();
echo json_encode($fetchFlute);
