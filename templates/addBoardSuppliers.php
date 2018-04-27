
<div ng-controller="sheetBoard as s">
	
      	<form id="add_sheetboard" ng-submit="s.addGrade()">
      		<h3>Add Sheetboard</h3>
      		<p><input placeholder="grade" type="text" ng-model="s.grade.grade" size="10" autofocus="autofocus" /> 
      			<input placeholder="flute" type="text" ng-model="s.grade.flute" size="5" autofocus="autofocus" /> 
      			<button type="submit" id="submit" value="Submit" >Submit</button>
      		</p>
      	</form>
      
      <br/>

	<h3>Add Supplier</h3>
	<form id="add_supplier" ng-submit="s.addSupplier()">
		<p><input placeholder="supplier name" type="text" ng-model="s.supplier.supplier" size="10" autofocus="autofocus" /> 
			<button type="submit" id="submit" value="Submit" >Submit</button>
		</p>
	</form>
<br/>

</div>
<br/>

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

