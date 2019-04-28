<div ng-controller="quotes as q">	
<h1>Quote Reporting</h1>

<select ng-model="selectStatus" ng-options="x.name for x in status"><option value="" disabled selected>select status</option></select>
<select ng-model="selectSalesman" ng-options="x.sales_man for x in q.getSalesMan"></select>
<input type="date" ng-model="dateFrom"><input type="date" ng-model="dateTo">
<input ng-model="user" hidden="" >
<input type="button" ng-click="report()" class="btn btn-success" value="submit">
<table class="table" style="width: 60%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Business</th>
	<th>Quote Ref</th>
	<th>Date Opened</th>
	<th>Date Closed</th>
	<th>Details</th>

	
</tr>
<tr ng-repeat="a in q.getReports">
	<td>{{a.customer}}</td>
	<td>{{a.business}}</td>
	<td>{{a.quoteRef}}</td>
	<td>{{a.date}}</td>
	<td>{{a.dateClose}}</td>
	<td>{{a.details}}</td>

</tr>
</thead>
</table>
</div>