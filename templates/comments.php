<div ng-controller="toolComments as tc"  ng-submit="tc.submit()">
<h2>Comments</h2>

<input type="text" name="addShout" ng-model="tc.comment.comment" size="50"> 
<input type="text" name="id" ng-model="tc.getComments.tool_id" >

<button type="submit" id="submit" value="Submit" >Submit Text</button>

<h1>Comments</h1>
<table class="table">
	<tr>
		<th>Comments</th>
		<th>Date</th>
	</tr>	
	<tr ng-repeat="x in tc.getComments">

	<td>{{x.comments}}</td>
	<td>{{x.date}}</td>
</tr>
</table>
</div>