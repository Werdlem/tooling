<?php
date_default_timezone_set("Europe/London");
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

if ($data->data->won > ''){
	$won = $data->data->won;
	$result = 'won';
$details = $data->data->amount;
$qid = $data->qid;
$won = 'closeQuoteWon';
echo $result;
echo $details;
echo $qid;

$update = $dal->$won($result, $details,$qid);
}
 if
	($data->data->inactive > ''){
		$inactive = $data->data->inactive;
		$result = 'inactive';
		$inactive = 'inactive';
		$reminder = date('Y-m-d');
		$qid = $data->qid;
		$update = $dal->$inactive($result, $reminder, $qid);
echo $result;
echo $reminder;
		
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
