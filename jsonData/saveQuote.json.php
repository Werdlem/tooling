<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));



$customer = ucwords($data->details->customer->customer);
$business = ucwords($data->details->customer->business);
$address = ucwords($data->details->customer->address);
$email = strtolower($data->details->customer->email);
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

if(!$data->details->customer->salesId){
$salesId = $data->details->sales->id;
}
else{
	$salesId = $data->details->customer->salesId;
}

$date = date('Y-m-d');
$quoteDate = date('dmYHi');

$size = $length.'x'.$width.'x'.$height.'mm';
$description = $style.' '.$grade.' '.$flute;

if(!$data->details->customer->quote_ref){

	$reference= $data->details->sales->initials.$quoteDate;
}
else{
	
$reference=$data->details->customer->quote_ref;

};


echo $reference;

$dal = new tooling();

//$addQuote = $dal->addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$salesId,$date,$reference,$business,$address,$email,$contact_no);
