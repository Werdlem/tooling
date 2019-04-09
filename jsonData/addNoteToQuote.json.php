<?php
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$notes = strtoupper($data->notes->notes);
$quoteRef = $data->quoteRef;
$dal = new tooling();
$newQuote = $dal->addNoteToQuote($quoteRef, $notes);