<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$comment = strtoupper($data->addComment);
$id = $data->id;

$dal = new tooling();
$fetch = $dal->updatePrices($comment, $id);

