<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$dal = new tooling();

$fetch = $dal->addLineWebPrice($id);
echo $id;
