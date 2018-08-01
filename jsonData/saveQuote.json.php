<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$customer = '';
$reference = '';
if($customer = $data->customer ===null){
		$customer = $data->customer2;
}
	else{
		$customer = $data->customer;
};
$quoteRef = '';

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
$sales = $data->sales;
$date = date('Y-m-d');
$quoteDate = date('dmYHi');

$size = $length.'x'.$width.'x'.$height.'mm';
$description = $style.' '.$grade.' '.$flute;


if ($reference = $data->reference === null){

$reference= $data->quoteRef.$quoteDate;
}else{
$reference = $data->reference;
}

echo $reference;
$dal = new tooling();

$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference);
