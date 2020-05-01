<div ng-controller="specSheet as np">
<form id="" ng-submit="np.specSubmit()">

<p><input placeholder="Tool Ref" type="text" ng-model="np.getSpecById.toolRef" size="10" autofocus="autofocus" /></p>
<p><input placeholder="Alias" type="text" ng-model="np.getSpecById.alias" size="10" autofocus="autofocus" /></p>
<p><input placeholder="ESC Ref" type="text" ng-model="np.getSpecById.esc_ref" size="5" autofocus="autofocus" /></p>
<p><input placeholder="Location" type="text" ng-model="np.getSpecById.location" size="5" autofocus="autofocus" /></p>

<p>
<input placeholder="Config" type="text" ng-model="np.getSpecById.config" size="5" autofocus="autofocus" />
<input placeholder="Style" type="text" ng-model="np.getSpecById.style" size="5" autofocus="autofocus" />
<input placeholder="Flute" type="text" ng-model="np.getSpecById.flute" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="Length" type="text" ng-model="np.getSpecById.length" size="5" autofocus="autofocus" />
<input placeholder="Width" type="text" ng-model="np.getSpecById.width" size="5" autofocus="autofocus" />
<input placeholder="Height" type="text" ng-model="np.getSpecById.height" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="KTOK Deckle" type="text" ng-model="np.getSpecById.deckle" size="10" autofocus="autofocus" />
<input placeholder="KTOK Chop" type="text" ng-model="np.getSpecById.chop" size="10" autofocus="autofocus" />
</p>
<p>Loadpoint Tool: <input type="checkbox" ng-model="np.getSpecById.loadpoint" /></p>
<p>Custom Design: <input type="checkbox" ng-model="np.getSpecById.custom" /></p>
<p>
<input type="hidden" type="text" ng-model="np.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>

<li style="display: inline; line-height: 20px "><a href="{{np.getSpecById.filePath}}" target="_blank">{{np.getSpecById.filePath}}</a> </li>
<p>
<button type="submit" id="submit" value="Submit" >Submit</button>
</p>

</form>
</div>