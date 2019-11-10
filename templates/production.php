<div ng-controller="getSchedule as sh">
	<style type="text/css">
		td{text-align: center}
	</style>

	<input type="date" ng-model="scheduleDate">
	{{date}}

	<table class="table">
		<tr>
		<th>Complete</th>
		<th>Order id</th>
		<th>Sku</th>
		<th>Qty</th>
		<th>Machine</th>
		<th>Duration (minutes)</th>
		<th>Schedule Date</th>
	</tr>
	<tr ng-repeat="x in sh.getSchedule | filter:date:strict">
		<td><input type="checkbox" name=""></td>
		<td>{{x.order_id}}</td>
		<td>{{x.sku}}</td>
		<td>{{x.qty}}</td>
		<td>{{x.machine}}</td>
		<td>{{x.duration}}</td>
		<td>{{x.scheduleDate}}</td>
	</tr>
</table>
</div>