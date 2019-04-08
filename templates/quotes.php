<div ng-controller="quotes as q">	
<h1>Open/Closed/Pending Quotes</h1>

<select ng-change="change()" ng-model="selectedStatus.status" ng-options="x.name for x in status"></select>
<select ng-model="selectSalesman" ng-change="selectSales()" ng-options="x.sales_man for x in q.getSalesMan"></select>

<table class="table" style="width: 60%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Quote Ref</th>
	<th>Email</th>
	<th>Salesman</th>
	<th>Emailed</th>
	<th>Printed</th>
	<th>Date Created</th>
	
</tr>
<tr ng-repeat="x in q.getOpenQuotes | filter:selectSalesman.sales_man:strict">
	<td>{{x.customer}}</td>
	<td><a href="/viewQuote?qid={{x.quoteRef}}&cid={{x.customerId}}">{{x.quoteRef}}</a></td>
	<td>{{x.Cemail}}</td>
	<td>{{x.sales_man}}</td>
	<td><input type="checkbox" ng-checked="x.email==1" disabled></td>
	<td><input type="checkbox" ng-checked="x.print==1" disabled></td>
	<td>{{x.date | dateToISO | date:'dd/M/yyyy'}}</td>

</tr>
</thead>
</table>
</div>
