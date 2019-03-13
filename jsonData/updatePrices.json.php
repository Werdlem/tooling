<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$brown = $data->colours->brown;
$white = $data->colours->white;
$black = $data->colours->black;
$red = $data->colours->red;
$id = $data->id;

$dal = new tooling();
$fetch = $dal->insertPrices($id,$brown, $white,$black,$red);

