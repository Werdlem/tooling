<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$qty = $data->qty;
$ref = strtoupper($data->ref);
$size = $data->size;
$total_price = $data->total_price;
$unit_price = $data->unit_price;
$customer = $data->customer;
$description = strtoupper($data->description);


$dal = new tooling();
$fetch = $dal->updateLine($customer,$description,$id,$size,$qty,$unit_price,$total_price,$ref);
