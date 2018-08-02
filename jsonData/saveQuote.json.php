<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$customer = $data->data->customer;
$ref = $data->tool_ref;
$style = $data->style;
$grade = $data->grade;
$flute = $data->flute;
$length = $data->length;
$width = $data->width;
$height = $data->height;
$qty= $data->qty;
$unitPrice = $data->unitPrice;
$totalPrice = $data->totalPrice;
$sales = $data->data->sales->name;
$date = date('Y-m-d');
$quoteDate = date('dmYHi');

$size = $length.'x'.$width.'x'.$height.'mm';
$description = $style.' '.$grade.' '.$flute;


$reference= $data->data->sales->initials.$quoteDate;

echo $reference;
echo $customer;
//$dal = new tooling();

//$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference);
