<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$customer = $data->newsCustomer;

$style = $toolDetails->style;

$ref = $toolDetails->tool_ref;
$flute = $toolDetails->flute;
$length = $toolDetails->length;
$width = $toolDetails->width;
$height = $toolDetails->height;
$qty= $data->qty;
$unitPrice = $data->unitPrice;
$totalPrice = $data->totalPrice;

$grade = $data->grade;


$sales = $data->data->sales->name;
$date = date('Y-m-d');
$quoteDate = date('dmYHi');

$size = $length.'x'.$width.'x'.$height.'mm';
$description = $style.' '.$grade.' '.$flute;


$reference= $data->data->sales->initials.$quoteDate;

echo $reference;
echo $customer;
$dal = new tooling();

$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference);
