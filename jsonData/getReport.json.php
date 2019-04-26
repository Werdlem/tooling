<?php 
date_default_timezone_set("Europe/London");
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$sales = $data->sales;
$status = $data->status;
$timeFrom = strtotime($data->dateFrom);
$timeTo = strtotime($data->dateTo);
$dal = new tooling();

///echo $sales;
$dateFrom = date("Y-m-d H:i:s ", $timeFrom);
$dateTo = date("Y-m-d 23:59:59 ", $timeTo);
$fetch = $dal->getReport($sales, $status, $dateFrom, $dateTo);
print(json_encode($fetch));

