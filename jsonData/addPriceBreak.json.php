<?php 
require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));
$cost = $data->cost;
$high = $data->high;
$low = $data->low;
$flute = $data->flute->flute;
$fluteId = $data->flute->id;
$gradeId = $data->grade->id;
$supplierId = $data->selectedSupplier->supplier_id;

$dal = new tooling();
$addPriceBreak = $dal->addPriceBreak($fluteId,$gradeId,$cost,$low,$high,$supplierId);