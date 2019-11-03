<?php 

require_once ('../DAL/DBConn2.php');
$dal = new tartarus();
$fetch = $dal->getSchedule();
echo(json_encode($fetch));
