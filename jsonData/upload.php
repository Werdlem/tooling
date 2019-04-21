<?php
$filename = $_FILES['file']['name'];

  $meta = $_POST;
  $destination = $meta['targetPath'] . $filename;
$qid = $meta['qid'];

  move_uploaded_file($_FILES['file']['tmp_name'],$destination );
echo $destination;
echo $qid;
  require_once ('../DAL/DBConn.php');
$dal = new tooling();
$upload = $dal->addFile($qid,$destination);