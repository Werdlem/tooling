
<div ng-controller="sheetboard as sb">
	
      	<form id="add_sheetboard" ng-submit="sb.submit()">
      		<h3>Add Sheetboard</h3>
      		<p><input placeholder="sheetboard" type="text" ng-model="sheetboard" size="10" autofocus="autofocus" /> <input placeholder="flute" type="text" ng-model="flute" size="5" autofocus="autofocus" /> <button type="submit" id="submit" value="Submit" >Submit</button>
      		</p>
      	</form>
      </div>
      <br/>

<div ng-controller="suppliers as s">
	<h3>Add Supplier</h3>
	<form id="add_supplier" ng-submit="s.submit()">
		<p><input placeholder="supplier name" type="text" ng-model="supplier" size="10" autofocus="autofocus" /> <button type="submit" id="submit" value="Submit" >Submit</button>
		</p>
	</form>
</div>
<br/>

<div ng-controller="priceband as pb">
	<h3>Add Price Band</h3>
	<form id="add_priceBand" ng-submit="s.submit()">
		<p><input placeholder="Price" type="text" ng-model="price" size="10" autofocus="autofocus" /> <input placeholder="Price Band" type="text" ng-model="priceBand" size="10" autofocus="autofocus" />
			<select ng-controller="suppliers as s">
				<option></option>
			</select>

		<button type="submit" id="submit" value="Submit" >Submit</button>
		</p>
	</form>
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

