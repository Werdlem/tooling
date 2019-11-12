<div ng-controller="getSchedule as sh">
	<style type="text/css">
		td{text-align: center}
	</style>

	<input type="date" ng-model="scheduleDate">

	<table class="table">
		<tr>
		<th>Schedule Date</th>
		<th>Order id</th>
		<th>Sku</th>
		<th>Qty</th>
		<th>Machine</th>
		<th>Duration (minutes)</th>
		
	</tr>
	<tr ng-repeat="x in sh.getSchedule">
		<td>{{x.scheduleDate | date:"EEEE 'the' d"}}</td>
		<td>{{x.order_id}}</td>
		<td>{{x.sku}}</td>
		<td>{{x.qty}}</td>
		<td>{{x.machine}}</td>
		<td>{{x.duration}}</td>
		</tr>
</table>
</div>