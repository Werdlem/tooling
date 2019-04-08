<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$customer = ucwords($data->customer);
$business = ucwords($data->business);
$addressLine1 = ucwords($data->address_line_1);
$addressLine2 = ucwords($data->address_line_2);
$addressLine3 = ucwords($data->address_line_3);
$postCode = strtoupper($data->postcode);
$contact_no = $data->contact_no;
$email = strtolower($data->Cemail);
$id = $data->id;
$dal = new tooling();
$addCustomer = $dal->updateCustomer($customer,$business,$addressLine1,$addressLine2,$addressLine3,$postCode,$contact_no,$email,$id);
