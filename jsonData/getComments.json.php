<?php 

require_once ('../DAL/DBConn.php');
$id = json_decode(file_get_contents("php://input"));
$dal = new tooling();
$fetch = $dal->getComments($id);
echo json_encode($fetch);
