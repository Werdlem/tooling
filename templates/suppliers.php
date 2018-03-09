<?php 
$toolDal = new tooling();
?>
<style type="text/css">
	td{text-align: center; padding-left: 10px}
	th{padding-left: 10px; text-align: center;}

</style>
<div ng-controller="toolingController as tool" ng-app="tooling">
<form id="add_supplier" method="post" action="?action=action&addSupplier">
<div id="tool-entry">
<p><input placeholder="Supplier Name" type="text" name="supplier_name" size="10" autofocus="autofocus" /></p>

<p>
<button type="submit" id="addSupplier" name="addSupplier" value="addSupplier">Submit</button>
</p>
</div>

<!--show the last 10 tools added-->
<h2>Suppiers List</h2>
<table class="table">
	<thead>
		<tr class="heading">
		<th>Supplier Name</th>
		</tr>
	</thead>
	
 <tr ng-repeat="x in getSuppliers">
 	
	<td><a href="?action=suppliers&id={{x.supplier_id}}&supplier={{x.supplier_name}}">{{x.supplier_name}}</td>
	</tr>
</table>
</form>
</div>
<?php include 'includes/_suppliers.php';?>