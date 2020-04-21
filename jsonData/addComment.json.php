<?php 

require_once ('../DAL/ncrConn.php');
$data = json_decode(file_get_contents("php://input"));
$comment = strtoupper($data->text);

$dal = new ncr();
$fetch = $dal->addComment($comment);

