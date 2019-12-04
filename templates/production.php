<div ng-controller="getSchedule as sh">
	<style type="text/css">
		td{text-align: center}
	</style>

	<h1 style="text-align: center">Site Capacity</h1>
	<h3>Select Department: </h3><select ng-model="department" ng-options = "x.department for x in departments" ng-change="selectDepartment()" ></select>
	<div ng-show="department">
	<label>Department Capacity: {{department.capacity}} minutes per day</label>
	<label>Staff: ~{{department.staff}}</label>
	<label>Notes: {{department.notes}}</label>




		<table class="table" style="width: 30%">
		<tr>
		<th>Date</th>		
		<th>Capacity</th>
		<th>Time Remaining</th>
		
	</tr>
	<tr ng-repeat="x in sh.getSchedule">
		<td><a href="/productionDetails?date={{x.scheduleDate}}">{{x.scheduleDate}}</a> - {{x.scheduleDate | date:"EEEE"}} </td>
		
		<td>{{x.capacity | number: 0}}%</td>
		<td>{{x.remaining }} minutes</td>
		</tr>
</table>
</div>
</div>