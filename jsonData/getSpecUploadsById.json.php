<?php 

require_once ('../DAL/specConn.php');
$id = json_decode(file_get_contents("php://input"));
$id = $id->ref;
$dal = new productSpec();
$fetch = $dal->getSpecUploadsById($id);
print (json_encode($fetch));