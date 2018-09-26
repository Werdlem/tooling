<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$customer = ucwords($data->customer);
$business = ucwords($data->business);
$addressLine1 = ucwords($data->addressLine1);
$addressLine2 = ucwords($data->addressLine2);
$addressLine3 = ucwords($data->addressLine3);
$postCode = strtoupper($data->postCode);
$contact_no = $data->contact_no;
$email = strtolower($data->email);
$date = date("Y-m-d");

$addCustomer = $dal->addCustomer($customer,$business,$addressLine1,$addressLine2,$addressLine3,$postCode,$contact_no,$email,$date);

