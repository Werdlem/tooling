<div ng-controller="quotes as q">	
<h1>Open/Closed/Pending Quotes</h1>

<select ng-change="change()" ng-model="selectedStatus" ng-options="x.name for x in status"></select>
<select id="filter" ng-model="selectedSalesMan" ng-options="x.sales_man for x in q.getSalesMan"></select>


<table class="table" style="width: 60%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Quote Ref</th>
	<th>Email</th>
	<th>Salesman</th>
	<th>Emailed</th>
	<th>Printed</th>
	<th>Date Opened</th>
</tr>
<tr ng-repeat="x in q.getOpenQuotes |filter:selectedSalesMan.sales_man:strict">
	<td><a href="/viewQuote">{{x.customer}}</td>
	<td>{{x.quoteRef}}</td>
	<td>{{x.email}}</td>
	<td>{{x.sales_man}}</td>
	<td><input type="checkbox" ng-checked="x.email==1" disabled></td>
	<td><input type="checkbox" ng-checked="x.print==1" disabled></td>
	<td>{{x.date}}</td>
</tr>
</thead>
</table>
</div>
