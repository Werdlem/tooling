<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$po = $data->po;
$sku = $data->sku;
$desc1 = $data->desc1;
$customerName = $data->customerName;
$status= 'OPEN';
$issue= $data->issue;
$action=$data->action;
$initials=$data->initials;
       
$dal = new ncr();
if ($data->nc == 'true'){
	
	$fetch = $dal->openNcrEntirePo($id,$po,$sku,$desc1,$customerName,$status,$issue,$action,$initials);
}
if($data->nc == 'false'){
	//$fetch = $dal->deleteNcr($id);
}
