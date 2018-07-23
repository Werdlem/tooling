
<?php 
require_once '../DAL/DBConn.php'; 
$toolDal = new tooling();

?>

<style type="text/css">
	td{text-align: center; padding-left: 10px}
	th{padding-left: 10px; text-align: center;}

</style>
<div ng-controller="addTool as a">
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
       
      

<form id="add_Tool" ng-submit="a.submit()">

<p><input placeholder="Tool Ref" type="text" ng-model="a.tool.tool_ref" size="10" autofocus="autofocus" /></p>
<p><input placeholder="Alias" type="text" ng-model="a.tool.tool_alias" size="10" autofocus="autofocus" /></p>
<p><input placeholder="ESC Ref" type="text" ng-model="a.tool.esc_ref" size="5" autofocus="autofocus" /></p>
<p><input placeholder="Location" type="text" ng-model="a.tool.location" size="5" autofocus="autofocus" /></p>
<p>
<input placeholder="Config" type="text" ng-model="a.tool.config" size="5" autofocus="autofocus" />
<input placeholder="Style" type="text" ng-model="a.tool.style" size="5" autofocus="autofocus" />
<input placeholder="Flute" type="text" ng-model="a.tool.flute" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="Length" type="text" ng-model="a.tool.length" size="5" autofocus="autofocus" />
<input placeholder="Width" type="text" ng-model="a.tool.width" size="5" autofocus="autofocus" />
<input placeholder="Height" type="text" ng-model="a.tool.height" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="KTOK Deckle" type="text" ng-model="a.tool.ktok_width" size="10" autofocus="autofocus" />
<input placeholder="KTOK Chop" type="text" ng-model="a.tool.ktok_length" size="10" autofocus="autofocus" />
</p>
<p>
<input type="hidden" type="text" ng-model="a.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
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

<div id="tool-entry"  ng-controller="toolList as tl">

<!--show the last 10 tools added-->
<form method="post"></form>
<table class="table">
	<thead>
		<tr class="heading">
		<th>Added</th>
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
	
 <tr ng-repeat="tool in tl.getRecentTools">

 	
 	<td>
		<input type="checkbox" ng-model="tool.added" ng-change="added(tool)">{{tool.add}}

	</td>
	<h2>Number of new tools: {{tl.getRecentTools.length}} </h2>
	<td ng-model="toolId"><a href="/toolEdit?id={{tool.id}}">{{tool.tool_ref}}</a></td>
	<td>{{tool.esc_ref}}</td>
	<td>{{tool.location}}</td>
	<td>{{tool.style}}</td>
	<td>{{tool.flute}}</td>
	<td>{{tool.length}}</td>
	<td>{{tool.width}}</td>
	<td>{{tool.height}}</td>
	<td>{{tool.ktok_width}}</td>
	<td>{{tool.ktok_length}}</td>


</tr>
</table>
</div>





