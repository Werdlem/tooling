<?php 

require_once ('../DAL/DBConn.php');
$id = json_decode(file_get_contents("php://input"));
$id = $id->id;
$dal = new tooling();
$fetch = $dal->getQuoteById($id);
print (json_encode($fetch));

