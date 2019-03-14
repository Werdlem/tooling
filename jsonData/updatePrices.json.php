<?php 

require_once ('../DAL/DBConn.php');
$data = json_decode(file_get_contents("php://input"));

$brown = $data->colours->brown;
$white = $data->colours->white;
$black = $data->colours->black;
$red = $data->colours->red;
$green = $data->colours->green;
$orange = $data->colours->orange;
$yellow = $data->colours->yellow;
$blue = $data->colours->blue;
$purple = $data->colours->purple;
$gold = $data->colours->gold;
$silver = $data->colours->silver;
$limegreen = $data->colours->limegreen;
$pink = $data->colours->pink;

$id = $data->id;

$dal = new tooling();
$fetch = $dal->insertPrices($brown, $white,$black,$red,$green, $orange, $yellow, $blue, $purple, $gold, $silver, $limegreen, $pink,$id);

