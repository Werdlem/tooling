<?php

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$dal = new tooling();

if ($data->data->won > ''){
	$won = $data->data->won;
	$result = 'lost';
$details = '£'.number_format($data->data->amount,2);
$orderRef = $data->orderRef;
echo $result;
echo $details;
echo $orderRef;

$update = $dal->closeQuote($result, $details,$orderRef);
}

else
{
	$lost = $data->data->lost;
	$orderRef = $data->orderRef;
	$result = 'lost';
$details = $data->data->reasonSelect->reason;
echo $result;
echo $details;
$update = $dal->closeQuote($result, $details, $orderRef);

}
