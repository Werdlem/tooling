<div ng-controller="suppliers as sp" style="width: 60%; border: 1px solid #d4d4d4; padding: 10px; border-radius: 5px; box-shadow: 10px 10px 10px #d4d4d4; margin: auto">
<h2>Select Supplier</h2>
	<select  ng-model="selectedSupplier" ng-change="change()" ng-options="x.supplier_name for x in sp.getSuppliers" ></select> 
	<select ng-model="flute">
		<option>Flute</option>
		<option>B</option>
		<option>C</option>
		<option>E</option>
		<option>EB</option>
		<option>BC</option>
	</select>

	<select ng-model="selectGrade" ng-options="x.grade for x in sp.getGrade"></select>
		<!--<option ng-selected>Grade</option>
		<option>125K125T</option>
		<option>125W125T</option>
		<option>150K150T</option>
		<option>150W150T</option>
		<option>150W150K</option>
		<option>150W150W</option>
		<option>200K200T</option>
		<option>300K300T</option>
	</select>-->

	
<table class="table">
	<thead>
		<tr class="heading">
			<th>Flute</th>
			<th>Grade</th>		
			<th>From</th>
			<th>To</th>
			<th>Price</th>
		</tr>
	</thead>
	<tr ng-repeat="x in getSupplierPrices | filter: flute:true | filter: selectGrade.grade:true">

		<td>{{x.flute}}</td>
		<td>{{x.grade}}</td>
		<td>{{x.min}}</td>
		<td>{{x.max}}</td>
		<td><input type="text" ng-model="x.price" size="5" ng-change="updatePrice(x.id,x.price)"></td>
		
		
	</tr>
</table>

<button type="button" class="btn btn-info btn-sl" data-toggle="modal" data-target="#myModal" ng-click="addPriceBreak = true">Add Supplier Price Break</button>


<!-- Modal -->
<div id="myModal" class="modal fade" ng-show="addPriceBreak" ng-controller="priceBreak as pb">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Add Price Break</h2>
        
      </div>
      <div class="modal-body">
<form id="add_Price_Break" ng-submit="pb.submit()">
<p> Supplier: <select ng-model="pb.price.selectedSupplier" ng-options="x.supplier_name for x in sp.getSuppliers"></select></p>
<p>Flute: <select ng-model="pb.price.flute" ng-options="x.flute for x in pb.getFlute"></select></p>
<p>Grade: <select ng-model="pb.price.grade" ng-options="x.grade for x in pb.getGrade"></select></p>
<p>Price: <input type="text" ng-model="pb.price.cost" name="price" size="5"></p>
<p>Low: <input type="text" ng-model="pb.price.low" size="5" autofocus="autofocus" /></p>
<p>High: <input type="text" ng-model="pb.price.high" size="5" autofocus="autofocus" /></p>
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
</div>
<br/>



