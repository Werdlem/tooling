<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));



$customer = ucwords($data->details->customer->customer);
$business = ucwords($data->details->customer->business);
$address = ucwords($data->details->customer->address);
$email = ucwords($data->details->customer->email);
$contact_no = $data->details->customer->contact_no;

$style = $data->toolDetails->style;

$ref = $data->toolDetails->tool_ref;
$flute = $data->toolDetails->flute;
$length = $data->toolDetails->length;
$width = $data->toolDetails->width;
$height = $data->toolDetails->height;
$qty= $data->qty;
$unitPrice = $data->unitPrice;
$totalPrice = $data->totalPrice;


$grade = strtoupper($data->grade);

if(!$data->details->customer->sales){
$sales = $data->details->name->name;
}
else{
	$sales = $data->details->customer->sales;
}

$date = date('Y-m-d');
$quoteDate = date('dmYHi');

$size = $length.'x'.$width.'x'.$height.'mm';
$description = $style.' '.$grade.' '.$flute;

if(!$data->details->customer->quote_ref){

	$reference= $data->details->name->initials.$quoteDate;
}
else{
	
$reference=$data->details->customer->quote_ref;

};


echo $reference;

$dal = new tooling();

$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference,$business,$address,$email,$contact_no);
