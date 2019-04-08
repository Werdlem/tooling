<div ng-controller="toolList as tl">
	<style type="text/css">
		input {width: 50%; border-top: none; border-right: none; border-bottom: 1px solid grey; border-left: 1px solid grey; text-align: center}
		th{text-align: center}
		td{text-align: center}
	</style>

	<div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter Tool<br/>
       <input ng-model="search.tool_ref" style="width: 10em; border: 1px solid grey" autofocus="autofocus"></label>
    </div> 

<table class="table">
<thead>
	<th>Tool Ref</th>
	<th>Alias</th>
	<th>Config</th>
		<th>ESC Ref</th>
		<th>Location</th>
		<th>Style</th>
		<th>Flute</th>
		<th>Length</th>
		<th>Width</th>
		<th>Height</th>
		<th>KTOK Width</th>
		<th>KTOK Length</th>
</thead>
<tr ng-repeat="x in tl.getToolsList | filter:search:strict">
	<td><a href="/toolQuote?id={{x.id}}">{{x.tool_ref}}</a></td>
	<td><input type="" ng-model="x.tool_alias"></td>
	<td><input type="" style="width: 12%" ng-model="x.config">UP</td>
	<td><input type="" ng-model="x.esc_ref"></td>
	<td><input type="" style="width: 50%" ng-model="x.location"></td>
	<td><input type="" style="width: 50%" ng-model="x.style"></td>
	<td><input type=""style="width: 20%" ng-model="x.flute"></td>
	<td><input type=""style="width: 50%" ng-model="x.length"></td>
	<td><input type=""style="width: 50%" ng-model="x.width"></td>
	<td><input type=""style="width: 50%" ng-model="x.height"></td>
	<td><input type="" style="width: 50%"ng-model="x.ktok_width"></td>
	<td><input type="" style="width: 50%"ng-model="x.ktok_length"></td>
	<td><a href="#" ng-click="edit()">update</span>
	<td><a href="/toolEdit?id={{x.id}}">edit</a></td>
</tr>
</table>
</div>