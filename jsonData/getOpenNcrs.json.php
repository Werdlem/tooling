<?php 

require_once ('../DAL/ncrConn.php');
$dal = new ncr();
$data = json_decode(file_get_contents("php://input"));
$status = $data->status;
$fetch = $dal->getNcrs($status);
echo json_encode($fetch);
