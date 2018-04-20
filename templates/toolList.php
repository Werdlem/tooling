<div ng-controller="toolList">

	<div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter Tool<br/>
       <input ng-model="search.tool_ref" style="width: 10em"></label>
    </div> 
    <div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter by Length<br/>
       <input ng-model="searchLength.length" style="width: 10em"></label>
    </div>
    <div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter by Width<br/>
       <input ng-model="searchWidth.width" style="width: 10em"></label>
    </div>
    <div id="filter" style="border: 1px solid #777; width: auto; text-align: center; float: left; padding: 5px">
        <label>Filter by Height<br/>
       <input ng-model="searchHeight.height" style="width: 10em"></label>
    </div>
<table class="table">
<thead>
	<th>Tool Ref</th>
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
<tr ng-repeat="x in getToolsList | filter:search:strict | filter:searchLength | filter:searchWidth | filter:searchHeight">
	<td><a href="/toolEdit?id={{x.id}}">{{x.tool_ref}}</a></td>
	<td>{{x.esc_ref}}</td>
	<td>{{x.location}}</td>
	<td>{{x.style}}</td>
	<td>{{x.flute}}</td>
	<td>{{x.length}}</td>
	<td>{{x.width}}</td>
	<td>{{x.height}}</td>
	<td>{{x.ktok_width}}</td>
	<td>{{x.ktok_length}}</td>
</tr>
</table>
</div>