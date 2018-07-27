<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

//tool data
$tool_ref = $data->toolDetails->tool_ref;
$config = $data->toolDetails->config;
$length = $data->toolDetails->length;
$width = $data->toolDetails->width;
$style = $data->toolDetails->style;


//material data
$supplier= $data->materials->supplierName;

$sqm = $data->sqm;

echo $sqm;
