<?php 

require_once ('../DAL/ncrConn.php');
$dal = new ncr();
$fetch = $dal->getOpenNcrs();
echo json_encode($fetch);
