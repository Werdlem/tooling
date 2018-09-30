<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$quoteRef = $data->quoteRef;
$dal = new tooling();

$fetch = $dal->addLine($quoteRef);
