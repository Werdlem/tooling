<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$po = $data->po;
$sku = $data->sku;
$desc1 = $data->desc1;
$qty = $data->qty;
$customerName = $data->customerName;
$status= 'OPEN';

$dal = new ncr();
if ($data->nc == 'true'){
	
	$fetch = $dal->openNcr($po,$sku,$desc1,$qty,$id,$customerName, $status);
}
if($data->nc == 'false'){
	//$fetch = $dal->deleteNcr($id);
}
