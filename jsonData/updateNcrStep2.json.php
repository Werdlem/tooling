<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new ncr();

$reason = $data->reason;

//$fetch = $dal->updateNcr($description,$id,$size,$qty,$unit_price,$unit,$ref,$salesId,$customerId,$date,$qid);
