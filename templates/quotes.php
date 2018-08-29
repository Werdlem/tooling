<div ng-controller="quotes as q">	
<h1>Open/Closed/Pending Quotes</h1>

<select ng-change="change()" ng-model="selectedStatus" ng-options="x.name for x in status"></select>
<select id="filter" ng-model="selectedSalesMan" ng-options="x.sales_man for x in q.getSalesMan"></select>


<table class="table" style="width: 50%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Quote Ref</th>
	<th>Email</th>
	<th>Sales Man</th>
	<th>Lost</th>
	<th>Won</th>
</tr>
<tr ng-repeat="x in q.getOpenQuotes |filter:selectedSalesMan.sales_man:strict">
	<td>{{x.customer}}</td>
	<td ng-model="quote.x.quote_ref">{{x.quote_ref}}</td>
	<td>{{x.email}}</td>
	<td>{{x.sales_man}}</td>
	<td><input ng-hide="quote.won" type="checkbox" ng-model="quote.lost" ></td>
	<td><input ng-hide="quote.lost"  type="checkbox" ng-model="quote.won" ng-change="result(quote)"></td>
	<td><select ng-show="quote.lost" ng-model="quote.selectedReason" ng-change="result(quote)"" ng-options="x.reason for x in reasons"></select></td>
</tr>
</thead>
</table>
</div>
