<?php 

require_once ('../DAL/specConn.php');
$data = json_decode(file_get_contents("php://input"));

$product = $data->selectProduct->id;

if($product == 1){
$customerName = strtoupper($data->customerName);
$toolRef = strtoupper($data->tool_ref);
$alias = strtoupper($data->tool_alias);
$description = strtoupper($data->description);
$length = $data->length;
$width = $data->width;
$height = $data->height;
$deckle = $data->deckle;
$chop = $data->chop;
$config = $data->config;
$style = $data->style;
$flute = strtoupper($data->flute);
$material = strtoupper($data->material);
$furtherComments = strtoupper($data->furtherComments);
$productRange = $data->selectProduct->product;
$initials = strtoupper($data->initials);
$loadpoint = $data->loadpoint;
$custom = $data->custom;

	$dal = new productSpec();
	
$fetch = $dal->addSpec($customerName, $toolRef,$alias,$description,$length,$width,$height,$deckle,$chop,$config,$style,$flute,$material,$furtherComments,$productRange, $initials,$loadpoint, $custom);
}
elseif($product == 2){
	$customerName = strtoupper($data->customerName);
$toolRef = strtoupper($data->tool_ref);
$alias = strtoupper($data->selectedAlias->tool_ref);
$description = strtoupper($data->description);
$length = (NULL);
$width = (NULL);
$height = (NULL);
$deckle = $data->deckle;
$chop = $data->chop;
$config = $data->config;
$style = (NULL);
$flute = strtoupper($data->flute);
$material = strtoupper($data->material);
$furtherComments = strtoupper($data->furtherComments);
$productRange = $data->selectProduct->product;
	$product = $data->selectProduct->id;
	$initials = strtoupper($data->initials);

	$dal = new productSpec();
	echo $alias;
	
$fetch = $dal->addSpec($customerName, $toolRef,$alias,$description,$length,$width,$height,$deckle,$chop,$config,$style,$flute,$material,$furtherComments,$productRange, $initials);
	
}

elseif($product == 3){
	$customerName = strtoupper($data->customerName);
$toolRef = strtoupper($data->tool_ref);
$alias = strtoupper($data->tool_alias);
$description = strtoupper($data->description);
$length = (NULL);
$width = (NULL);
$height = (NULL);
$deckle = $data->deckle;
$chop = $data->chop;
$config = (null);
$style = (NULL);
$flute = (null);
$material = strtoupper($data->material);
$furtherComments = strtoupper($data->furtherComments);
$productRange = $data->selectProduct->product;
	$product = $data->selectProduct->id;
	$initials = strtoupper($data->initials);

	$dal = new productSpec();
	
$fetch = $dal->addSpec($customerName, $toolRef,$alias,$description,$length,$width,$height,$deckle,$chop,$config,$style,$flute,$material,$furtherComments,$productRange, $initials);
}
elseif($product == 4){
	$customerName = strtoupper($data->customerName);
$toolRef = strtoupper($data->tool_ref);
$alias = strtoupper($data->tool_alias);
$description = strtoupper($data->description);
$length = $data->length;
$width = $data->width;
$height = $data->height;
$deckle = (null);
$chop = (null);
$config = (null);
$style = $data->style;
$flute = strtoupper($data->flute);
$material = strtoupper($data->material);
$furtherComments = strtoupper($data->furtherComments);
$productRange = $data->selectProduct->product;
$initials = strtoupper($data->initials);

	$dal = new productSpec();
	
$fetch = $dal->addSpec($customerName, $toolRef,$alias,$description,$length,$width,$height,$deckle,$chop,$config,$style,$flute,$material,$furtherComments,$productRange, $initials);
};


