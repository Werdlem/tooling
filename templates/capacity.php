<div ng-controller="capacity as c">

	<h1>Machine Capacity</h1>
	<style type="text/css">
		td{text-align: center}
	</style>
	Select Date: <input type="date" ng-model="dateSelect" ng-change="search()">
	{{dateSelect}}
	

	<table class="table">
		<tr>
		<th>Machine</th>
		<th>Capacity remainig (min)</th>
		<th>Capacity</th>
		
	</tr>
	<tr ng-repeat="x in c.getCapacity">
		<td><a href="/viewMachine?machine={{x.machine}}&date={{dateSelect | date: 'yyyy-MM-dd'}}">{{x.machine}}</a></td>	
		<td>{{x.minutes}}</td>
		<td>{{x.capacity | number: 0}}%</td>
		
	</tr>
</table>
</div>