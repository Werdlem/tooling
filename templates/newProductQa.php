<div ng-controller="specSheet as np" style="width: 70%;border-radius: 5px;  box-shadow: 10px 10px 20px #d4d4d4; padding: 20px;margin: auto">

	<h3>Product Spec Sheet QA</h3>
<form id="" ng-submit="np.specSubmit()">

<p>Customer Name: <input placeholder="Customer Name" type="text" ng-model="np.getSpecById.customerName" disabled size="10" autofocus="autofocus" /></p>
<p>Tool Name: <input placeholder="Alias" type="text" ng-model="np.getSpecById.toolRef" size="10" disabled autofocus="autofocus" /></p>
<p>Tool Alias: <input placeholder="Alias" type="text" ng-model="np.getSpecById.alias" size="10" disabled autofocus="autofocus" /></p>
<div ng-show="np.getSpecById.productRange =='Tool'">
<p>Tool Manufacturer Refrence: <input placeholder="Manu Ref" type="text" ng-model="np.getSpecById.esc_ref" size="5" autofocus="autofocus" /></p>
<p>Racking Location: <input placeholder="Location" type="text" ng-model="np.getSpecById.location" size="5" autofocus="autofocus" /></p></div>
<p>Product Description: <textarea placeholder="Manu Ref" type="text" ng-model="np.getSpecById.description" size="5" autofocus="autofocus" rows="5" style="width: 60%" /></p></textarea>
<div style="border: 2px dashed #a2a2a2; padding:5px; background-color:#d4d4d4; border-radius: 5px">



	<div ng-show="np.getSpecById.productRange == 'New Tool'">
		<p><strong>Internals </strong></p>
	L: <input placeholder="Length"  ng-model="np.getSpecById.length" disabled autofocus="autofocus" />
W: <input placeholder="Width"  ng-model="np.getSpecById.width" size="5" disabled autofocus="autofocus" />
H: <input placeholder="Height"  ng-model="np.getSpecById.height" size="5" disabled autofocus="autofocus"/>
<br/>
<br/>
<p><strong> Knife To Knife</strong></p>
Deckle: <input placeholder="deckle"  ng-model="np.getSpecById.deckle" disabled size="10" autofocus="autofocus" />
Chop: <input placeholder="chop"  ng-model="np.getSpecById.chop" size="10" disabled autofocus="autofocus" />
<br/><br/>

<p><strong>Configuration</strong>
<input placeholder="up"  ng-model="np.getSpecById.config" disabled style="width: 30px" autofocus="autofocus" />
<strong>Style</strong>

<input placeholder="Style"  ng-model="np.getSpecById.style" disabled size="5" autofocus="autofocus" /> <strong>Flute: <input placeholder="Flute" disabled ng-model="np.getSpecById.flute" size="5" autofocus="autofocus"  /></strong></p>

<p><strong>Material Details</strong></p>
<input placeholder="Material" type="text" ng-model="np.getSpecById.material" disabled autofocus="autofocus" /></p>

<p>Loadpoint Tool: <input type="checkbox" ng-model="np.getSpecById.loadpoint" /></p>
<p>Custom Design Tool: <input type="checkbox" ng-model="np.getSpecById.custom" /></p>
</div>

<div ng-show="np.getSpecById.productRange == 'Printed Board'">	
<p><strong> Sheet Size</strong></p>
Deckle: <input placeholder="deckle"  ng-model="np.getSpecById.deckle" size="10" disabled autofocus="autofocus" />
Chop: <input placeholder="chop"  ng-model="np.getSpecById.chop" size="10" disabled autofocus="autofocus" />

<p><strong>Material Spec: </strong></p>
Grade: <input placeholder="Material" type="text" ng-model="np.getSpecById.material" disabled autofocus="autofocus" /> Flute: <input placeholder="Flute" disabled type="text" ng-model="np.getSpecById.flute" size="5" autofocus="autofocus"  /> Configuration: 
<input placeholder="up"  ng-model="np.getSpecById.config" style="width: 35px" disabled autofocus="autofocus" /></p></p>
</div>

<div ng-show="np.getSpecById.productRange == 'Tape'">		
<p><strong> Size</strong></p>
Width: <input placeholder="width"  ng-model="np.getSpecById.deckle" disabled size="10" autofocus="autofocus" />
Length: <input placeholder="length"  ng-model="np.getSpecById.chop" disabled size="10" autofocus="autofocus" />

<p><strong>Material Details</strong></p>
Grade: <input placeholder="Material" type="text" ng-model="np.getSpecById.material" disabled autofocus="autofocus" /></p>
</div>

<div ng-show="np.getSpecById.productRange == 'Finished Carton'">
		<p><strong>Internals </strong></p>
	L: <input placeholder="Length"  ng-model="np.getSpecById.length" disabled  autofocus="autofocus" />
W: <input placeholder="Width"  ng-model="np.getSpecById.width" size="5" disabled autofocus="autofocus" />
H: <input placeholder="Height"  ng-model="np.getSpecById.height" size="5" disabled autofocus="autofocus"/>
<br/>
<br>

Style: <input placeholder="Style"  ng-model="np.getSpecById.style" size="5" disabled autofocus="autofocus" /> </p>

<p><strong>Material Details</strong></p>
Grade: <input placeholder="Material" type="text" ng-model="np.getSpecById.material" disabled autofocus="autofocus" /> Flute: <input disabled="" placeholder="Flute" type="text" ng-model="np.getSpecById.flute" size="5" autofocus="autofocus"  /></p>
</div>
</div>


<p>
<input type="hidden" type="text" ng-model="np.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>

<li style="display: inline; line-height: 20px "><a ng-href="pdf/{{np.getSpecById.filePath}}" target="_blank">{{np.getSpecById.filePath}}</a> </li>



<br/>
<p>
	<input type="text" ng-model="np.getSpecById.initials"></p>
<button type="submit" id="submit" class="btn btn-primary" value="Submit" >Submit</button>
</p>
<iframe style="width: 100%;"height="1000"src="{{np.getSpecById.filePath}}"></iframe>
</form>
</div>