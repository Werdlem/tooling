<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$value = json_decode(file_get_contents("php://input"));
$department = $value->department;
//echo $department;
$fetch = $dal->getSchedule($department);
echo json_encode($fetch);
