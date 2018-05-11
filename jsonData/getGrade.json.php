<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetchFlute = $dal->getGrade();
echo json_encode($fetchFlute);
