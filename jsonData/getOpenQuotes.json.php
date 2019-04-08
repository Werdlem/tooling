<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$data = json_decode(file_get_contents("php://input"));
$value = $data->value;
$query = $data->query;
$fetch = $dal->$query($value);
echo json_encode($fetch);

