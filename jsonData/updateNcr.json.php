<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$qty = $data->qty;
$ref = strtoupper($data->ref);
$size = $data->size;
$unit = $data->unit;
$unit_price = $data->unit_price;
$customerId = $data->customerId;
$description = strtoupper($data->description);
$salesId = $data->salesId;
$quote_ref = $data->quote_ref;
$date = $data->date;
$id = $data->id;
$qid = $data->qid;

//$fetch = $dal->updateNcr($description,$id,$size,$qty,$unit_price,$unit,$ref,$salesId,$customerId,$date,$qid);
