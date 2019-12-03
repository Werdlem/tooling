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
	<tr ng-repeat="x in sh.getSchedule">
		<td></td>
		<td></td>
		<td></td>
		</tr>
</table>
</div>