<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$value = json_decode(file_get_contents("php://input"));
$date = $value->date;
//echo $department;
$fetch = $dal->getScheduleDetails($date);
echo json_encode($fetch);
