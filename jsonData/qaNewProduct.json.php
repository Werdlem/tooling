<?php 


$data = json_decode(file_get_contents("php://input"));

if($data->productRange == 'New Tool'){

$tool_ref = strtoupper($data->toolRef);
$location = strtoupper($data->location);
$config = $data->config;
$style = $data->style;
$flute = strtoupper($data->flute);
$length = $data->length;
$width = $data->width;
$height = $data->height;
$ktok_width = $data->deckle;
$ktok_length = $data->chop;
$date = $data->date;
$esc_ref = $data->esc_ref;
$tool_alias = strtoupper($data->alias);
$loadpoint = $data->loadpoint;
$custom = $data->custom;
$qaInitials = $data->QaInitials;

//require_once ('../DAL/specConn.php');
//$dal = new productSpec();
//
require_once ('../DAL/DBConn.php');
$toolRegister = new tooling();
$tool = $toolRegister->addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref, $tool_alias, $loadpoint, $custom);
$spec = $toolRegister->qaSpec($qaInitials, $esc_ref,$location, $tool_ref);
echo 'added to tool register';
}

elseif (($data->productRange == 'Tape') or ($data->productRange == 'Finished Carton')){
	require_once ('../DAL/specConn.php');
	$qaInitials = strtoupper($data->initials);
	$esc_ref = $data->esc_ref;
	$location = strtoupper($data->location);
	$tool_ref = strtoupper($data->toolRef);
echo 'Not Added to register';

		$dal = new productSpec();
		$spec = $dal->qaSpec($qaInitials, $tool_ref);
}
else{
	require_once ('../DAL/specConn.php');
	$qaInitials = strtoupper($data->initials);

	$productRef = strtoupper($data->toolRef);
	$productAlias = strtoupper($data->alias);
	echo 'clap clap, well done';

		$dal = new productSpec();
		$spec = $dal->qaSpec($qaInitials, $productRef);
		$addAlias = $dal->addAlias($productRef, $productAlias);
	
}

