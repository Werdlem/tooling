<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$sales = $data->sales;
$status = $data->status;
$dateFrom = $data->dateFrom;
$dateTo = $data->dateTo;
$dal = new tooling();
$fetch = $dal->getToolById($id);
print (json_encode($fetch));

