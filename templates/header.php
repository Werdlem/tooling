<!DOCTYPE HTML>

<head>
<div ng-controller="toolingController as tool" ng-app="tooling">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/tool_style.css"  type="text/css"/>

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/dateInput.css" />

<script src="Jquery/jquery-ui.min.js"></script> 
<script src="js/bootstrap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Damasco/Postpack Tooling</title>

</head>

<body>



<h1>Damasco / Postpack Tooling Register</h1>
<?php require_once './DAL/DBConn.php';?>
<p>
	
	<a href="?action=tooling">Home</a> | 
	<a href="?action=toolList">Tool List</a> |
	<a href="?action=suppliers">Suppliers</a>

