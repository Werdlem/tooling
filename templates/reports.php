<div ng-controller="quotes as q">	
<h1>Quote Reporting</h1>

<select ng-model="selectStatus" ng-options="x.name for x in status"><option value="" disabled selected>select status</option></select>
<select ng-model="selectSalesman" ng-options="x.sales_man for x in q.getSalesMan"></select>
<input type="date" ng-model="dateFrom"><input type="date" ng-model="dateTo">
<input ng-model="user" hidden="" >
<input type="button" ng-click="report()" class="btn btn-success" value="submit">
<p ng-if="getTotal() !== null">Total Quotes: {{getTotalQuotes()}}</p>
<p ng-if="getTotal() !== null">Total Sales: {{getTotal() | currency: '£'}}</p>
<table class="table" style="width: 60%">
	<thead>
	<tr>
	<th>Customer Name</th>
	<th>Business</th>
	<th>Quote Ref</th>
	<th>Order Id</th>
	<th>Date Opened</th>
	<th>Date Closed</th>
	<th>Details</th>

	
</tr>
<tr ng-repeat="a in q.getReports">
	<td>{{a.customer}}</td>
	<td>{{a.business}}</td>
	<td><a href="/viewQuote?qid={{a.qid}}&cid={{a.customerId}}">{{a.quoteRef}}</a></td>
		<td><a href='a.orderId' ng-model="po">{{a.orderId}}</a></td>
	<td>{{a.date}}</td>
	<td>{{a.dateClose}}</td>
	<td>{{a.details}}{{a.amount | currency: '£'}}</td>
</tr>
</thead>
</table>

</div>