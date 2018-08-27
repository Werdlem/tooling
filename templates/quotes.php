<div ng-controller="quotes as q">	
<h1>Open/Closed/Pending Quotes</h1>

<select ng-change="change()" ng-model="selectedStatus" ng-options="x.name for x in status"></select>
<select id="filter" ng-model="selectedSalesMan" ng-options="x.sales_man for x in q.getSalesMan"></select>


<table class="table" style="width: 30%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Quote Ref</th>
	<th>Email</th>
	<th>Sales Man</th>
</tr>
<tr ng-repeat="x in q.getOpenQuotes |filter:selectedSalesMan.sales_man:strict">
	<td>{{x.customer}}</td>
	<td>{{x.quote_ref}}</td>
	<td>{{x.email}}</td>
	<td>{{x.sales_man}}</td>
</tr>
</thead>
</table>
