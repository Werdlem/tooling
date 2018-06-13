<?php 

require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = $dal->getAllSupplierBoardPrices();
print (json_encode($fetch));
