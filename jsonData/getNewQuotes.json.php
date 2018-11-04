<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = $dal->getPendingQuotes();
echo json_encode($fetch);
