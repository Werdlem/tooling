<?php 
$toolDal = new tooling();
?>
<style type="text/css">
	td{text-align: center; padding-left: 10px}
	th{padding-left: 10px; text-align: center;}

</style>


<form id="add_Tool" method="post" action="?action=action&addTool">

<p><input placeholder="Tool Ref" type="text" name="tool_ref" size="10" autofocus="autofocus" /></p>
<p><input placeholder="Alias" type="text" name="tool_alias" size="10" autofocus="autofocus" /></p>
<p><input placeholder="ESC Ref" type="text" name="esc_ref" size="5" autofocus="autofocus" /></p>
<p><input placeholder="Location" type="text" name="location" size="5" autofocus="autofocus" /></p>
<p>
<input placeholder="Config" type="text" name="config" size="5" autofocus="autofocus" />
<input placeholder="Style" type="text" name="style" size="5" autofocus="autofocus" />
<input placeholder="Flute" type="text" name="flute" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="Length" type="text" name="length" size="5" autofocus="autofocus" />
<input placeholder="Width" type="text" name="width" size="5" autofocus="autofocus" />
<input placeholder="Height" type="text" name="height" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="KTOK Deckle" type="text" name="ktok_width" size="10" autofocus="autofocus" />
<input placeholder="KTOK Chop" type="text" name="ktok_length" size="10" autofocus="autofocus" />
</p>
<p>
<input type="hidden" type="text" name="date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
<p>
<button type="submit" id="addTool1" name="submit" value="add">Submit</button>
</p>
</form>

<div ng-controller="toolList">
<!--show the last 10 tools added-->
<h2>Last 5 entries</h2>
<table class="table">
	<thead>
		<tr class="heading">
		<th>Tool Reff</th>
		<th>ESC Ref</th>
		<th>Location</th>
		<th>Style</th>
		<th>Flute</th>
		<th>Length</th>
		<th>Width</th>
		<th>Height</th>
		<th>KTOK Width</th>
		<th>KTOK Length</th>

	</tr>
	</thead>
	
 <tr ng-repeat="x in getRecentTools">
 	
	<td><a href="?action=toolEdit&id={{x.id}}">{{x.tool_ref}}</a></td>
	<td>{{x.esc_ref}}</td>
	<td>{{x.location}}</td>
	<td>{{x.style}}</td>
	<td>{{x.flute}}</td>
	<td>{{x.length}}</td>
	<td>{{x.width}}</td>
	<td>{{x.height}}</td>
	<td>{{x.ktok_width}}</td>
	<td>{{x.ktok_length}}</td>
	<td><a href="?action=toolEdit&id={{x.id}}" name="update">Edit</a></td>
</tr>
</table>
</div>





