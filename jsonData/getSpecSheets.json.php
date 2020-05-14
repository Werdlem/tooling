<?php 

require_once ('../DAL/specConn.php');
$data = json_decode(file_get_contents("php://input"));
$toolRef = $data->toolRef;
$dal = new productSpec();
//$toolRef = 'LOVE TOWELS BOX';
$fetch = $dal->getSpecSheet($toolRef);
echo json_encode($fetch);

