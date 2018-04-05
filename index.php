<!DOCTYPE HTML>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/tool_style.css"  type="text/css"/>

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/dateInput.css" />

<script src="Jquery/jquery-ui.min.js"></script> 
<script src="js/bootstrap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>

<title>Damasco/Postpack Tooling</title>
<base href="tooling.web/">

</head>
<?php require_once './DAL/DBConn.php'; ?>
<body ng-app="myApp">



<h1>Damasco / Postpack Tooling Register</h1>
<p>
	<a href="/">main</a> |
	<a href="/tooling">Home</a> | 
	<a href="/toolList">Tool List</a> |
	<a href="/suppliers">Suppliers</a>

<div ng-view>
	
</div>

<script src="/restricted/myApp.js"></script>
</body>
