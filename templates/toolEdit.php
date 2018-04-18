<form ng-controller="editTool as e" ng-submit="e.submit()" >	
	
	<input type="text"  hidden ng-model="e.getToolById.id" autofocus="autofocus" /></p>
	<p>Tool Ref: <input placeholder="Tool Ref" type="text" ng-model="e.getToolById.tool_ref" autofocus="autofocus" style="width:40%" /></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" ng-model="e.getToolById.esc_ref" size="5" autofocus="autofocus" /></p>
<p>Location: <input placeholder="Location" type="text" ng-model="e.getToolById.location" size="5" autofocus="autofocus" /></p>
<p>
Config: <input placeholder="Config" type="text" ng-model="e.getToolById.config" size="5" autofocus="autofocus" />
Style: <input placeholder="Style" type="text" ng-model="e.getToolById.style" size="5" autofocus="autofocus" />
Flute: <input placeholder="Flute" type="text" ng-model="e.getToolById.flute" size="5" autofocus="autofocus"  />
</p>
<p>
Length: <input placeholder="Length" type="text" ng-model="e.getToolById.length" size="5" autofocus="autofocus" />
Width: <input placeholder="Width" type="text" ng-model="e.getToolById.width" size="5" autofocus="autofocus" />
Height: <input placeholder="Height" type="text" ng-model="e.getToolById.height" size="5" autofocus="autofocus"/>
</p>
<p>
KTOK Width: <input placeholder="KTOK Width" type="text" ng-model="e.getToolById.ktok_width" size="10" autofocus="autofocus" />
KTOK Length: <input placeholder="KTOK Length" type="text" ng-model="e.getToolById.ktok_length" size="10" autofocus="autofocus" />
</p>
<button type="submit" id="submit" value="Submit" >Update</button>
</form>

<div ng-controller="toolComments as tc" >
	<form ng-submit="tc.submit()">
<h2>Comments</h2>

<input type="text" name="addComment" ng-model="tc.comment.addComment" size="50"> 


<button type="submit" id="submit" value="Submit" >Submit Text</button>
</form>

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

<?php //include ('./comments.php'); ?>
</div>
