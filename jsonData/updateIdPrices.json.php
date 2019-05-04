<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$price = $data->price;

$dal = new tooling();
$fetch = $dal->updateIdPrice($id,$price);
