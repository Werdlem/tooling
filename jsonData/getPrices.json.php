<?php 

require_once ('../DAL/DBConn.php');
$tool_id = json_decode(file_get_contents("php://input"));
$dal = new tooling();
$fetch = $dal->getPrices($tool_id);
print(json_encode($fetch));
