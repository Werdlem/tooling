<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$text = $data->text;
$po = $data->id;

$dal = new ncr();
$addCustomer = $dal->addComment($text, $po);
