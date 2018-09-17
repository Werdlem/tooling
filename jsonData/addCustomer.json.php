<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$customer = ucwords($data->data->details->customer);
$business = ucwords($data->data->details->business);
$address = ucwords($data->data->details->addressLine1);
$address = ucwords($data->data->details->addressLine2);
$address = ucwords($data->data->details->addressLine3);
$address = strtoupper($data->data->details->postCode);
$contact_no = $data->data->details->contact_no;
$email = strtolower($data->data->details->email);
$salesId = strtoupper($data->data->details->sales_man->salesId);
$date = date("Y-m-d");

//$addCustomer = $dal->addCustomer($customer,$business,$addressLine1,$addressLine2,$addressLine3,$postCode,$contact_no,$email,$salesId,$date);

