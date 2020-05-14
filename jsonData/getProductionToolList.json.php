<?php 

require_once ('../DAL/DBConn.php');

$dal = new tooling();
$fetch = $dal->getProTools();
echo json_encode($fetch);
