<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$customer = ucwords($data->data->details->customer);
$business = ucwords($data->data->details->business);
$address = ucwords($data->data->details->address);
$contact_no = $data->data->details->contact_no;
$email = strtolower($data->data->details->email);
$salesId = strtoupper($data->data->details->sales_man->salesId);
$date = date("Y-m-d");
$quote_ref = $data->data->details->sales_man->initials.date('dmYHi');

$addCustomer = $dal->addCustomer($customer,$business,$address,$contact_no,$email,$salesId,$date,$quote_ref);

