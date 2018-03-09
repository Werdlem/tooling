<?php 

require_once('DAL/DBConn.php');



$toolingDAL = new tooling();

//add/update new tool to the DB
if(isset($_POST['submit'])){
$tool_ref = strtoupper($_POST['tool_ref']);
$location = strtoupper($_POST['location']);
$config = strtoupper($_POST['config']);
$style = strtoupper($_POST['style']);
$flute = strtoupper($_POST['flute']);
$length = $_POST['length'];
$width = $_POST['width'];
$height = $_POST['height'];
$ktok_width = $_POST['ktok_width'];
$ktok_length = $_POST['ktok_length'];
$date = $_POST['date']; 
$esc_ref = $_POST['esc_ref'];



if ($_POST['submit']=='add'){
$toolingDAL->addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref);	
header("location:?action=tooling");
}
if ($_POST['submit']=='update'){
	$id = $_POST['id'];
	$toolingDAL->updateTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref, $id);
	header("location:?action=toolEdit&id=".$id);
	}
if ($_POST['submit']=='shoutBox'){
	$id = $_POST['id'];
	$shout = strtoupper($_POST['shoutBox']);
	$toolingDAL->addShout($shout, $id);
	header("location:?action=toolEdit&id=".$id);
}
}
if(isset($_POST['addSupplier'])){
	$supplier = strtoupper($_POST['supplier_name']);
	$toolingDAL ->addSupplier($supplier);
	header("location:?action=suppliers");

}