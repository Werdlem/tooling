<div ng-controller="specSheet as np" style="width: 70%;border-radius: 5px;  box-shadow: 10px 10px 20px #d4d4d4; padding: 20px;margin: auto">

	<h3>Product Spec Sheet QA</h3>
<form id="" ng-submit="np.specSubmit()">

<p>Customer Name: <input placeholder="Customer Name" type="text" ng-model="np.getSpecById.customerName" disabled size="10" autofocus="autofocus" /></p>
<p>Tool Name: <input placeholder="Alias" type="text" ng-model="np.getSpecById.toolRef" size="10" disabled autofocus="autofocus" /></p>
<p>Tool Alias: <input placeholder="Alias" type="text" ng-model="np.getSpecById.alias" size="10" disabled autofocus="autofocus" /></p>
<p>Tool Manufacturer Refrence: <input placeholder="Manu Ref" type="text" ng-model="np.getSpecById.esc_ref" size="5" autofocus="autofocus" /></p>
<p>Racking Location<input placeholder="Location" type="text" ng-model="np.getSpecById.location" size="5" autofocus="autofocus" /></p>
<div style="border: 2px dashed #a2a2a2; padding:5px; background-color:#d4d4d4; border-radius: 5px">

<h4>Tool / Product Details</h4>
		<p><strong>Internals </strong></p>
	L: <input placeholder="Length" type="text" ng-model="np.getSpecById.length" disabled size="5" autofocus="autofocus" />
W: <input placeholder="Width" type="text" ng-model="np.getSpecById.width" disabled size="5" autofocus="autofocus" />

H: <input placeholder="Height" type="text" ng-model="np.getSpecById.height" disabled size="5" autofocus="autofocus" />
<br/>
<p><strong> Knife To Knife</strong></p>
Deckle: <input placeholder="KTOK Deckle" type="text" ng-model="np.getSpecById.deckle" disabled size="10" autofocus="autofocus" />
Chop: <input placeholder="KTOK Chop" type="text" ng-model="np.getSpecById.chop" disabled size="10" autofocus="autofocus" />


<p><strong>Configuration</strong>
<input placeholder="Config" type="text" ng-model="np.getSpecById.config" disabled size="5" autofocus="autofocus" />
<strong>Style</strong>
<input placeholder="Style" type="text" ng-model="np.getSpecById.style" disabled size="5" autofocus="autofocus" /> <strong>Flute: <input disabled placeholder="Flute" type="text" ng-model="np.getSpecById.flute" size="5" autofocus="autofocus" /></strong></p>

<p><strong>Material Details</strong></p>
<input placeholder="Material" type="text" ng-model="np.getSpecById.material" disabled autofocus="autofocus" /></p>

<p>Loadpoint Tool: <input type="checkbox" ng-model="np.getSpecById.loadpoint" /></p>
<p>Custom Design Tool: <input type="checkbox" ng-model="np.getSpecById.custom" /></p>
<p>Materials: <input type="checkbox" ng-model="np.getSpecById.materials" /></p>
<p>
<input type="hidden" type="text" ng-model="np.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>

<li style="display: inline; line-height: 20px "><a href="{{np.getSpecById.filePath}}" target="_blank">{{np.getSpecById.filePath}}</a> </li>
</div>
<br/>
<p>
	<input type="text" ng-model="np.getSpecById.initials"></p>
<button type="submit" id="submit" class="btn btn-primary" value="Submit" >Submit</button>
</p>

</form>
