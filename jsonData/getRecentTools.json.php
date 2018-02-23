<?php 

require_once ('../DAL/DBConn.php');

$dal = new tooling();
$fetch = $dal->getRecentTools();
echo json_encode($fetch);
