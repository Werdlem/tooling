<div ng-controller="editTool">

<?php 

$id = 652;


require_once '../DAL/DBConn.php'; 
$toolDal = new tooling();

	$getTool = $toolDal->getToolById($id);

	print json_encode($getTool);




