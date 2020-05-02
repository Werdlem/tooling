
<div style="width: 60%; border: 1px solid #d4d4d4; padding: 10px; border-radius: 5px; box-shadow: 10px 10px 10px #d4d4d4; margin: auto" >
	<h3 style="text-align: center">Edit Tool</h3>
	<form ng-controller="editTool as e" ng-submit="e.submit()" >	
	
	<input type="hidden" ng-model="e.getToolById.id"/></p>
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

<h3>Uploads:</h3>
<ul ng-repeat="x in vq.getUploads">
  <li style="display: inline; line-height: 20px "><a href="{{x.filePath}}" target="_blank">{{x.filePath}}</a> @ {{x.date | date: 'MM/dd/yyyy'}}</li>
 </ul>
 Drop File:
    <div ngf-drop ngf-select ng-model="files" class="drop-box" 
        ngf-drag-over-class="'dragover'" ngf-multiple="true" ngf-allow-dir="true"
        accept="image/*,application/pdf" 
        ngf-pattern="'image/*,application/pdf'">Drop pdfs or images here or click to upload</div>
    <div ngf-no-file-drop>File Drag/Drop is not supported for this browser</div>
    <ul>
        <li ng-repeat="f in files" style="font:smaller">{{f.name}} {{f.$error}} {{f.$errorParam}}</li>
    </ul>
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
