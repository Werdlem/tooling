<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$id = $data->id;
$qty = $data->qty;
$ref = strtoupper($data->ref);
$size = $data->size;
$total_price = $data->total_price;
$unit_price = $data->unit_price;
$customer = $data->customer;
$description = strtoupper($data->description);
$sales = $data->sales;
$quote_ref = $data->quote_ref;
$date = date('Y-m-d');

if ($id == null){
$fetch = $dal->addLine($customer,$description,$id,$size,$qty,$unit_price,$total_price,$ref,$sales, $quote_ref,$date);
}
else{

$fetch = $dal->updateLine($customer,$description,$id,$size,$qty,$unit_price,$total_price,$ref);
}