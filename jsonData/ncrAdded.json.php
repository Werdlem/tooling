<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$added = $data->added;
$id = $data->id;
$po = $data->po;
$sku = $data->sku;
$desc1 = $data->desc1;
$qty = $data->qty;


$dal = new ncr();
//$fetch = $dal->openNcr($po,$sku,$desc1,$qty,$id);

