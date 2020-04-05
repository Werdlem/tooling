<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$date = date('Y-m-d',strtotime($data->date));
$dep = $data->dep;
$fetch = $dal->getCapacity($date, $dep);
echo json_encode($fetch);
