<?php
$filename = $_FILES['file']['name'];

  $meta = $_POST;
  $destination = $meta['targetPath'] . $filename;
$specRef = $meta['specRef'];

  move_uploaded_file($_FILES['file']['tmp_name'],$destination );
echo $destination;
echo $specRef;
  require_once ('../DAL/specConn.php');
$dal = new productSpec();
$upload = $dal->addFile($specRef,$destination);