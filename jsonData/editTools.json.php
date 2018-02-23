<?php 

require_once ('../DAL/DBConn.php');
$id= 28;
$dal = new tooling();
$fetch = $dal->getToolById($id);
echo json_encode($fetch);
