<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

if ($data->data->won > ''){
	$won = $data->data->won;
	$result = 'won';
$details = number_format($data->data->amount,2);
$qid = $data->qid;
$won = 'closeQuoteWon';
echo $result;
echo $details;
echo $qid;

$update = $dal->$won($result, $details,$qid);
}

else
{
	$lost = $data->data->lost;
	$qid = $data->qid;
	$result = 'lost';
$details = $data->data->reasonSelect->reason;
$lost = 'closeQuoteLost';
echo $result;
echo $details;
$update = $dal->$lost($result, $details, $qid);

}
