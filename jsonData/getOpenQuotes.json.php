<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$value = json_decode(file_get_contents("php://input"));
$fetch = $dal->getOpenQuotes($value);
echo json_encode($fetch);

