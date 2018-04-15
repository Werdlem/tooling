<?php 

require_once ('../DAL/DBConn.php');
$id = json_decode(file_get_contents("php://input"));
$dal = new tooling();
$fetch = $dal->getBoardPrices();
print(json_encode($fetch));
