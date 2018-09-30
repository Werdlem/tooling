<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$qty = $data->qty;
$ref = strtoupper($data->ref);
$size = $data->size;
$total_price = $data->total_price;
$unit_price = $data->unit_price;
$customer = $data->customer;
$description = strtoupper($data->description);
$salesId = $data->salesId;
$quote_ref = $data->quote_ref;
$id = $data->id;

$fetch = $dal->updateLine($description,$id,$size,$qty,$unit_price,$total_price,$ref);
