<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$ref = $data->ref;


$fetch = $dal->printQuote($ref);
