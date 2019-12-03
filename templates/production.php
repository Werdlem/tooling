<div ng-controller="getSchedule as sh">
	<style type="text/css">
		td{text-align: center}
	</style>

	<h1>Site Capacity</h1>
	<select ng-model="department" ng-options = "x.department for x in machines" ng-change="selectDepartment()"></select>

		<table class="table">
		<tr>
		<th>Date</th>
		<th>Department</th>
		<th>Capacity</th>
		
	</tr>
	<tr ng-repeat="x in sh.getSchedule">
		<td><a href="/productionDetails?date={{x.scheduleDate}}">{{x.scheduleDate}}</a> - {{x.scheduleDate | date:"EEEE"}} </td>
		<td>{{x.machine}}</td>
		<td>{{x.capacity | number: 0}}%</td>
		</tr>
</table>
</div>