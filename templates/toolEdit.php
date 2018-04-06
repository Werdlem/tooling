<form ng-submit="submit()" ng-controller="editTool" >
	
	<div ng-repeat="x in getToolById">
	<input type="text"  hidden ng-model="tool_ref=x.id" autofocus="autofocus" /></p>
	<p>Tool Ref: <input placeholder="Tool Ref" type="text" ng-model="tool_ref=x.tool_ref" autofocus="autofocus" value="{{x.tool_ref}}" style="width:40%" /></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" ng-model="esc_ref" size="5" autofocus="autofocus" /></p>
<p>Location: <input placeholder="Location" type="text" ng-model="location=x.location" size="5" autofocus="autofocus" value="{{x.location}}"/></p>
<p>
Config: <input placeholder="Config" type="text" ng-model="config=x.config" size="5" autofocus="autofocus" value="{{x.config}}"/>
Style: <input placeholder="Style" type="text" ng-model="style=x.style" size="5" autofocus="autofocus" value="{{x.style}}"/>
Flute: <input placeholder="Flute" type="text" ng-model="flute=x.flute" size="5" autofocus="autofocus" value="{{x.flute}}" />
</p>
<p>
Length: <input placeholder="Length" type="text" ng-model="length=x.length" size="5" autofocus="autofocus" value="{{x.length}}"/>
Width: <input placeholder="Width" type="text" ng-model="width=x.width" size="5" autofocus="autofocus" value="{{x.width}}"/>
Height: <input placeholder="Height" type="text" ng-model="height=x.height" size="5" autofocus="autofocus" value="{{x.height}}"/>
</p>
<p>
KTOK Width: <input placeholder="KTOK Width" type="text" ng-model="ktok_width=x.ktok_width" size="10" autofocus="autofocus" value="{{x.ktok_width}}"/>
KTOK Length: <input placeholder="KTOK Length" type="text" ng-model="ktok_length=x.ktok_length" size="10" autofocus="autofocus" value="{{x.ktok_width}}" />
</p>
<button type="submit" id="submit" value="Submit" >Update</button>
</form>

<div ng-controller="toolComments">
<h1>Comments</h1>
<table class="table">
	<tr>
		<th>Comments</th>
		<th>Date</th>
	</tr>	
	<tr ng-repeat="x in getComments">

	<td>{{x.comments}}</td>
	<td>{{x.date}}</td>
</tr>
</table>
</div>
</div>
