<div ng-controller="suppliers as s">
	<select ng-model="selectedSupplier" ng-change="change()" ng-options="x.supplier_name for x in s.getSuppliers" ></select>
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
			<th>Grade</th>
			<th>Price band</th>
		</tr>
	</thead>
	<tr ng-repeat="x in getSupplierPrices | filter: flute:true | orderBy:'price_band'">
		<td>{{x.flute}}</td>
		<td>{{x.grade}}</td>
		<td>{{x.price_band}}</td>
</table>


</div>

