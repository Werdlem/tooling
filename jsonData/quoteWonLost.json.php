<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$won = $data->won;
$id = $data->id;
if($data->added == ''){
	$added = 0;
}
else{
	$added = $data->added;
}

echo $id;
echo $added;
$dal = new tooling();
//$fetch = $dal->toolAdded($id, $added);

