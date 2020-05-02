<?php 

require_once ('../DAL/specConn.php');
$data = json_decode(file_get_contents("php://input"));

$dal = new productSpec();
$fetch = $dal->getSpecSheetList();
echo json_encode($fetch);

