<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();
//$quoteRef = $data->quoteRef.'-RQ'.(date("dm"));
$qid = $data->qid;
date_default_timezone_set('Europe/London');
$quoteRef = $data->initials.(date("dmyhis"));

echo $quoteRef;



$update = $dal->requote($quoteRef,$qid);
