<div ng-controller="searchCustomer as c">	
<style type="text/css">
	.table{width: 50%}
</style>
	

<h1>Search Customers</h1>
<p><input type="" ng-model="search"> <button type="button" class="btn btn-info btn-sml" ng-click="searchCustomer()">Search</button></p>
	<br/>

	<table class="table table-sm">
		
		<thead>
			<th>Name</th>
			<th>Business</th>
			<th>Contact No</th>
		</thead>
		<tr ng-repeat="x in c.customers">
			<td> <a href="/customers?customer={{x.customer}}&id={{x.id}}">{{x.customer}}</a></td>
			<td>{{x.business}}</td>
			<td>{{x.contact_no}}</td>
		</tr>

	</table>
</div>

