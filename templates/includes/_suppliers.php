  {{myUrl.id}}
  {{myUrl.supplier}}
	
<table class="table">
<thead>
	<th>Grade</th>
	<th>Flute</th>
	<th>Price Band</th>
	<th>Price</th>
</thead>


       <input id='filter' type="text" ng-model="search.supplier_id" style="width: 10em" ng-value="2" value="2" />

   
 
<tr ng-repeat="x in getBoardPrices | filter:myUrl.id:strict">
	<td>{{x.supplier_id}}</td>
		<td>{{x.grade}}</td>
	<td>{{x.flute}}</td>
	<td>{{x.price_band}}</td>
	<td>{{x.price}}</td>
	

</tr>
</table>
	


