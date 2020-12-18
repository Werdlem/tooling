<?php 

require_once ('../DAL/specConn.php');
$id = json_decode(file_get_contents("php://input"));
$dal = new productSpec();
$fetch = $dal->getSpecById($id);
print (json_encode($fetch));

