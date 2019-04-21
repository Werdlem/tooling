<?php 

require_once ('../DAL/DBConn.php');
$qid = json_decode(file_get_contents("php://input"));
$dal = new tooling();
$fetch = $dal->getFiles($qid);
print (json_encode($fetch));

