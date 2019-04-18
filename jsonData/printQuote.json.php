<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

$ref = $data->ref;
$comment_1 = $data->comment1;
$comment_2 = $data->comment2;
$comment_3 = $data->comment3;


$fetch = $dal->printQuote($ref,$comment_1,$comment_2, $comment_3);
