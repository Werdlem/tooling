<div ng-controller="getSchedule as sh">
	<style type="text/css">
		td{text-align: center}
	</style>

	<h1>Details</h1>
			<table class="table">
		<tr>
		<th>Order Id</th>
		<th>Customer</th>
		<th>Sku</th>
		<th>Qty</th>
		
	</tr>
	<tr ng-repeat="x in sh.getScheduleDetails">
		<td>{{x.order_id}}</td>
		<td>{{x.customer}}</td>
		<td>{{x.sku}}</td>
		<td>{{x.qty}}</td>
		</tr>
</table>
</div>