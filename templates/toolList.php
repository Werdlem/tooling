<div ng-controller="toolingController as tool" ng-app="tooling">

	<div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter Tools<br/>
       <input ng-model="search.tool_ref" style="width: 10em"></label>
    </div>
<table class="table">
<thead>
	<th>Tool Ref</th>
	<th>Location</th>
	<th>Config</th>
</thead>
<tr ng-repeat="x in getToolsList | filter:search:strict">
	<td><a href="?action=toolEdit&id={{x.id}}">{{x.tool_ref}}</a></td>
	<td>{{x.location}}</td>
	<td>{{x.config}} Up</td>
</tr>
</table>