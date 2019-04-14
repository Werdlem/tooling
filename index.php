<!DOCTYPE HTML>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="Css/tool_style.css"  type="text/css"/>
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
<?php require_once './DAL/DBConn.php'; ?>

</head>

<body ng-app="myApp">



<h1>Damasco / Postpack Tooling Register</h1>

<p>
	<nav class="navbar navbar-default">
	<div class="container-fluid">
	<div class="navbar-header">	</div>
	<ul class="nav navbar-nav">
	<li ng-controller="toolList as tl"><a href="/">Home <span class="badge badge-light">{{tl.getRecentTools.length}}</span></a>
  </li>
	<li><a href="/toolList">Tool List</a></li>
	<li><a href="/suppliers">Suppliers</a></li>
	<li><a href="/toolDimSearch">Tool Dim Search</a></li>
	<li><a href="/ctn_calculator">Carton Calculator</a></li>
	<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quotes
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        	<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">New Quote</a>
        		<ul class="dropdown-menu">
        		<li><a href="/newCustomer">New Customer</a></li>
        		<li><a href="/searchCustomer">Existing Customer</a></li>
        	</ul>
        	</li>
        	<!--<li><a href="/newCustomer">New Customer</a></li>
        	<li><a href="/searchCustomer">Search Customer</a></li>-->
        	<li><a href="/customerQuote">Pending Quotes</a></li>
        	<li><a href="/quotes">View Quotes</a></li>
       </ul>
   </li>
	
	<li><a href="/updates">Updates</a></li>
</ul>

</div>
</nav>
<div ng-view>
	
</div>
<script type="text/javascript">(function ($) {
    $(document).ready(function () {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });
})(jQuery);</script>
<script src="/restricted/myApp.js"></script>

<?php
include ('/templates/footer.html')
?>