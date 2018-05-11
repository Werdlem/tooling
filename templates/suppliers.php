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
	</tr>
</table>
</div>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" ng-click="addPriceBreak = true">Add Supplier Price Break</button>

<!-- Modal -->
<div id="myModal" class="modal fade" ng-show="addPriceBreak" ng-controller="priceBreak as pb">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Add Price Break</h2>supplier - {{selectedSupplier.supplier_name}}
      </div>
      <div class="modal-body">
<form id="add_Price_Break" ng-submit="">

<p>Flute: <select ng-model="selectedFlute" ng-options="x.flute for x in pb.getFlute"></select></p>
<p>Grade: <select ng-model="selectedGrade" ng-options="x.grade for x in pb.getGrade"></select></p>
<p>Price: <input type="text" name="price" size="5"></p>
<p>Low: <input type="text" ng-model="" size="5" autofocus="autofocus" /></p>
<p>High: <input type="text" ng-model="" size="5" autofocus="autofocus" /></p>
<p>
<button type="submit" id="submit" value="Submit">Submit</button>
</p>

</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div>


