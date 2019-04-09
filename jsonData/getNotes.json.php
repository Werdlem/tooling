<?php
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
//$notes = $data->notes->notes;
$quoteRef = $data->ref;
$dal = new tooling();
$fetch = $dal->getNotes($quoteRef);
echo json_encode($fetch);