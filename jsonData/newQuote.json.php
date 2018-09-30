<?php
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$salesId = $data->salesId;
$customerId = $data->customerId;
$date = date('Y-m-d');
$quoteRef = $data->salesInitials.date('dmy').$customerId;

echo $date;
echo $salesId;
echo $customerId;
echo $quoteRef;
$dal = new tooling();
$newQuote = $dal->newQuote($customerId, $salesId, $quoteRef);