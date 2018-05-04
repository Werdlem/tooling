<div ng-controller="suppliers as sp">
<h2>Select Supplier</h2>
	<select  ng-model="selectedSupplier" ng-change="change()" ng-options="x.supplier_name for x in sp.getSuppliers" ></select>
	<select ng-model="flute">
		<option></option>
		<option>B</option>
		<option>C</option>
		<option>E</option>
		<option>EB</option>
		<option>BC</option>
	</select>
	
<table class="table">
	<thead>
		<tr class="heading">
			<th>Flute</th>
			<th>Price</th>
			<th>Grade</th>
			<th>From</th>
			<th>To</th>
		</tr>
	</thead>
	<tr ng-repeat="x in getSupplierPrices | filter: flute:true | orderBy:'min'">
		<td>{{x.flute}}</td>
		<td>{{x.price}}</td>
		<td>{{x.grade}}</td>
		<td>{{x.min}}</td>
		<td>{{x.max}}</td>
</table>


</div>

