<div ng-controller="capacity as c">

	<h1>Production Capacity</h1>
	<style type="text/css">
		td{text-align: center}
	</style>
	Select Date: <input type="date" ng-model="dateSelect" ng-change="search()">

	

	<table class="table">
		<tr>
	
		<th>Capacity remainig (min)</th>
		<th>Capacity</th>
		
	</tr>
	<tr ng-repeat="x in c.getCapacity">
		<td>{{x.minutes}}</td>
		<td>{{x.capacity | number: 0}}%</td>
				
	</tr>
</table>
</div>