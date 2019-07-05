<div ng-controller="toolList as tl">

	<div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label style="position: left;">Filter Ref: 
       <input ng-model="search.tool_ref" style="width: 10em" autofocus="autofocus"></label>
   		<label style="text-align:left;">Filter All: <input ng-model="find" style="width: 10em; float: right;" ></label>
       
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
<tr ng-repeat="x in tl.getToolsList | filter:search |filter:find:strict">
	<td><a href="/toolQuote?id={{x.id}}">{{x.tool_ref}}</a></td>
	<td>{{x.tool_alias}}</td>
	<td>{{x.config}} UP</td>
	<td>{{x.esc_ref}}</td>
	<td>{{x.location}}</td>
	<td>{{x.style}}</td>
	<td>{{x.flute}}</td>
	<td>{{x.length}}</td>
	<td>{{x.width}}</td>
	<td>{{x.height}}</td>
	<td>{{x.ktok_width}}</td>
	<td>{{x.ktok_length}}</td>
	<td><a href="/toolEdit?id={{x.id}}">Edit</a></td>
</tr>
</table>
</div>