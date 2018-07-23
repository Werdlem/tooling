<form ng-controller="editTool as e" ng-submit="e.submit()" >	
	
	<input type="text"  hidden ng-model="e.getToolById.id" autofocus="autofocus" /></p>
	<p>Tool Ref: <input placeholder="Tool Ref" type="text" ng-model="e.getToolById.tool_ref" autofocus="autofocus" style="width:30%" /></p>
	<p>Alias: <input placeholder="Alias" type="text" ng-model="e.getToolById.tool_alias" autofocus="autofocus" style="width:30%" /></p>
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
KTOK Deckle: <input placeholder="KTOK Width" type="text" ng-model="e.getToolById.ktok_width" size="10" autofocus="autofocus" />
KTOK Chop: <input placeholder="KTOK Length" type="text" ng-model="e.getToolById.ktok_length" size="10" autofocus="autofocus" />
</p>
<button type="submit" id="submit" value="Submit" >Update</button>
</form>

<div>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</div>

<div ng-controller="toolComments as tc" >
	<form ng-submit="tc.submit()">
<h2>Add Comment</h2>

<input type="text" name="addComment" ng-model="tc.comment.addComment" size="50"> 


<button type="submit" id="submit" value="Submit" >Submit Text</button>
</form>

<h2>Comments</h2>
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
