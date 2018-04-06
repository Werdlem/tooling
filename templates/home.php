
<?php 
require_once '../DAL/DBConn.php'; 
$toolDal = new tooling();

?>

<style type="text/css">
	td{text-align: center; padding-left: 10px}
	th{padding-left: 10px; text-align: center;}

</style>
<div ng-controller="addTool">
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" ng-click="addTool = true">Add Tool</button>

<!-- Modal -->
<div id="myModal" class="modal fade" ng-show="addTool">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Add New Tool</h4>
      </div>
      <div class="modal-body">
       
      

<form id="add_Tool" ng-submit="submit()">

<p><input placeholder="Tool Ref" type="text" ng-model="tool_ref" size="10" autofocus="autofocus" /></p>
<p><input placeholder="ESC Ref" type="text" ng-model="esc_ref" size="5" autofocus="autofocus" /></p>
<p><input placeholder="Location" type="text" ng-model="location" size="5" autofocus="autofocus" /></p>
<p>
<input placeholder="Config" type="text" ng-model="config" size="5" autofocus="autofocus" />
<input placeholder="Style" type="text" ng-model="style" size="5" autofocus="autofocus" />
<input placeholder="Flute" type="text" ng-model="flute" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="Length" type="text" ng-model="length" size="5" autofocus="autofocus" />
<input placeholder="Width" type="text" ng-model="width" size="5" autofocus="autofocus" />
<input placeholder="Height" type="text" ng-model="height" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="KTOK Width" type="text" ng-model="ktok_width" size="10" autofocus="autofocus" />
<input placeholder="KTOK Length" type="text" ng-model="ktok_length" size="10" autofocus="autofocus" />
</p>
<p>
<input type="hidden" type="text" ng-model="date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
<p>
<button type="submit" id="submit" value="Submit" >Submit</button>
</p>

</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<div id="tool-entry"  ng-controller="toolList">
<!--show the last 10 tools added-->
<form method="post"></form>
<h2>Last 15 Entries</h2>
<table class="table">
	<thead>
		<tr class="heading">
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

	</tr>
	</thead>
	
 <tr ng-repeat="x in getRecentTools" >
 	
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





