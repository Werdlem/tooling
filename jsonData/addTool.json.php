<?php 


$data = json_decode(file_get_contents("php://input"));

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
$materials = $data->materials;
$initials = $data->initials;

if($materials == false){
require_once ('../DAL/DBConn.php');
$dal = new tooling();
$fetch = $dal->addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref, $tool_alias, $loadpoint, $custom);
$spec = $dal->qaSpec($initials, $tool_ref);
echo 'added to tool register';
}
else
{
	require_once ('../DAL/specConn.php');
	echo $initials;
		$dal = new productSpec();
		$spec = $dal->qaSpec($initials, $tool_ref);
	echo 'not addedd to tool register';
}

