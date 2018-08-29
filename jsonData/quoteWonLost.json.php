<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$won = $data->data->won;
$lost = $data->lost;
$ref = $data->ref;
if($data->won == ''){
	$won = 0;
}
else{
	$added = $data->won;
}

echo $ref;
echo $added;
$dal = new tooling();
//$fetch = $dal->toolAdded($id, $added);

