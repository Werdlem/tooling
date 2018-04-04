<div ng-controller="editTool" >
	<div ng-repeat="x in getToolById">
	<p>Tool Ref: <input placeholder="Tool Ref" type="text" name="tool_ref" size="10" autofocus="autofocus" value="{{x.tool_ref}}" /></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" name="esc_ref" size="5" autofocus="autofocus" value="{{x.esc_ref}}" /></p>
<p>Location: <input placeholder="Location" type="text" name="location" size="5" autofocus="autofocus" value="{{x.location}}"/></p>
<p>
Config: <input placeholder="Config" type="text" name="config" size="5" autofocus="autofocus" value="{{x.config}}"/>
Style: <input placeholder="Style" type="text" name="style" size="5" autofocus="autofocus" value="{{x.style}}"/>
Flute: <input placeholder="Flute" type="text" name="flute" size="5" autofocus="autofocus" value="{{x.flute}}" />
</p>
<p>
Length: <input placeholder="Length" type="text" name="length" size="5" autofocus="autofocus" value="{{x.length}}"/>
Width: <input placeholder="Width" type="text" name="width" size="5" autofocus="autofocus" value="{{x.width}}"/>
Height: <input placeholder="Height" type="text" name="height" size="5" autofocus="autofocus" value="{{x.height}}"/>
</p>
<p>
KTOK Width: <input placeholder="KTOK Width" type="text" name="ktok_width" size="10" autofocus="autofocus" value="{{x.ktok_width}}"/>
KTOK Length: <input placeholder="KTOK Length" type="text" name="ktok_length" size="10" autofocus="autofocus" value="{{x.ktok_width}}" />
</p>