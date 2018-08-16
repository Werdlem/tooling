<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$customer = $data->customer;
$reference = strtoupper($data->ref);
$sales = $data->sales;
$unitPrice = $data->data->unitPrice;
$totalPrice = $data->data->totalPrice;
$date = date("Y/m/d");
$ref = strtoupper($data->data->ref);
$qty = $data->data->qty;
$size = $data->data->size;
$description = strtoupper($data->data->description);

$dal = new tooling();

$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference);
