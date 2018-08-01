<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$fetch = 'success';
print(json_encode($fetch));


