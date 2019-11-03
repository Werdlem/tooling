<?php 

require_once ('../DAL/DBConn.php');
$dal = new tartarus();
$fetch = $dal->getSchedule();
echo(json_encode($fetch));
