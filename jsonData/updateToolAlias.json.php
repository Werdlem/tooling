<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$tool_alias = strtoupper($data->tool_alias);
$location = strtoupper($data->location);
$config = $data->config;
$style = $data->style;
$flute = strtoupper($data->flute);
$length = $data->length;
$width = $data->width;
$height = $data->height;
$ktok_width = $data->ktok_width;
$ktok_length = $data->ktok_length;
$date = $data->date;
$esc_ref = $data->esc_ref;
$id = $data->id;
$tool_alias = strtoupper($data->tool_alias);

$dal = new tooling();
$fetch = $dal->updateTool($tool_alias,$id);
