<div ng-controller="customer as c">

<input ng-model="search.customer">
<button type="button" class="btn btn-info btn-lg" ng-click="searchCustomer()">Search</button>


<table class="table">
<thead>
	<th>Name</th>
	
</thead>
<tr ng-repeat="x in c.getCustomers">
	
	<td>{{x.customer}}</td>
	<td>Edit</td>
</tr>
</table>
</div>