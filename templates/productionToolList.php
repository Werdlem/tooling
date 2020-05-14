<div ng-controller="toolList as tl">

	<div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label style="position: left;">Filter Ref: 
       <input ng-model="search.tool_ref" style="width: 10em" autofocus="autofocus"></label>
   		<label style="text-align:left;">Filter All: <input ng-model="find" style="width: 10em; float: right;" ></label>
       
    </div> 


<table class="table" style="width: ">
<thead>
	<th>Tool Ref</th>
	<th>Alias</th>
	<th>Config</th>
	<th>Location</th>
		
</thead>
<tr ng-repeat="x in tl.list | filter:search |filter:find:strict">
	<td><a href="/toolQuote?id={{x.id}}">{{x.tool_ref}}</a></td>
	<td><input type="" style="width: 50%" ng-model="x.tool_alias" ng-change="updateTool(x.tool_alias)"></td>	
	<td>{{x.config}} UP</td>
	<td>{{x.location}}</td>
	
</tr>
</table>
</div>