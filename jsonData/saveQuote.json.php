<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));



$customerId = ucwords($data->details->customer->customerId);
$quoteRef = ucwords($data->details->customer->quoteRef);

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
$salesId = $data->details->sales->salesId;
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

$addQuote = $dal->addQuote($customerId,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$salesId,$date,$quoteRef,$business,$address,$email,$contact_no);
