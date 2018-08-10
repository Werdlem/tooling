<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$customer = $data->customer;
$reference = $data->ref;
$sales = $data->sales

echo $reference;
//$dal = new tooling();

//$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference);
