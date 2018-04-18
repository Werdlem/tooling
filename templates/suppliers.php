<div ng-controller="suppliers as s">

	<h2>Add Supplier</h2>
	<input type="text" name="addSupplier"> <button type="submit" name="addSupplier" id="addSupplier" value="addSupplier">Submit</button>
	<h2>Select Supplier</h2>
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
	<tr ng-repeat="x in s.getSupplierPrices | filter: flute:true | orderBy:'price_band'">
		<td>{{x.flute}}</td>
		<td>{{x.grade}}</td>
		<td>{{x.price_band}}</td>
</table>


</div>

