<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = $dal->getToolById($id);
echo json_encode($fetch);
