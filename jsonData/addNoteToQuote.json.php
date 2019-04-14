<?php
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$notes = $data->notes->notes;
$quoteRef = $data->quoteRef;
$date = date('d/m/Y');
echo $date;
$dal = new tooling();
$newQuote = $dal->addNoteToQuote($quoteRef, $notes, $date);