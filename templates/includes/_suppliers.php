<table class="table">
<thead>
	<th>Grade</th>
	<th>Flute</th>
	<th>Price Band</th>
	<th>Price</th>
</thead>


      

   
 
<tr ng-model="selectedSupplier_id" ng-repeat="x in getBoardPrices">
	<td>{{x.supplier_id}}</td>
		<td>{{x.grade}}</td>
	<td>{{x.flute}}</td>
	<td>{{x.price_band}}</td>
	<td>{{x.price}}</td>
	

</tr>
</table>
	


