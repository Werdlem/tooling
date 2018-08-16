<!DOCTYPE HTML>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/tool_style.css"  type="text/css"/>

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/dateInput.css" />


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
<!-- Latest compiled and minified CSS -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title>Damasco/Postpack Tooling</title>
<base href="/">

</head>
<?php require_once './DAL/DBConn.php'; ?>
<body ng-app="myApp">



<h1>Damasco / Postpack Tooling Register</h1>
<p>
	
	<a href="/">Home</a> | 
	<a href="/toolList">Tool List</a> |
	<a href="/suppliers">Suppliers</a> |
	<a href="/toolDimSearch">Tool Dim Search</a> |
	<a href="/ctn_calculator">Carton Calculator</a> | 
	<a href="/customerQuote">Pending Quotes</a> |
	<a href="/updates">Updates</a>


<div ng-view>
	
</div>

<script src="/restricted/myApp.js"></script>

<?php
include ('/templates/footer.html')
?>
</body>
