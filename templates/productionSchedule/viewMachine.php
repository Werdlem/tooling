<div ng-controller="machine as m">

	<h1>{{MachineName}} Capacity @ {{date | date:'dd-MM-yyyy'}}</h1>
	<style type="text/css">
		td{text-align: center}
		.table{width: 30%}
	</style>

	<table class="table">
		<tr>
			<th>Sku</th>
			<th>Qty</th>
			<th>Time</th>
		</tr>
		<tr ng-repeat="x in m.getMachineData">
			<td>{{x.sku}}</td>
			<td>{{x.qty}}</td>
			<td>{{x.duration}} min</td>
			</tr>
	</table>
	
</div>