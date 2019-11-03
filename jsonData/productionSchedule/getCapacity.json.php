<?php 

require_once ('../DAL/DBConn.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$date = $data;
$fetch = $dal->getCapacity($date);
echo(json_encode($fetch));
