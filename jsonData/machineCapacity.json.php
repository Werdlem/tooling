<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$data = json_decode(file_get_contents("php://input"));
$machine = $data->machine;
$date = $data->date;

$fetch = $dal->machineCapacity($machine, $date);
echo(json_encode($fetch));
