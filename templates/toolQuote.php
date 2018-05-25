<form ng-controller="toolQuote as e">	
	
	<input type="text"  hidden ng-model="e.getToolById.id" autofocus="autofocus" /></p>
	<p>Tool Ref: <Label>{{e.getToolById.tool_ref}} </Label></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" ng-model="e.getToolById.esc_ref" size="5" disabled autofocus="autofocus" /></p>
<p>Location: <input placeholder="Location" type="text" ng-model="e.getToolById.location" size="5" disabled autofocus="autofocus" /></p>
<p>
Config: <input placeholder="Config" type="text" ng-model="e.getToolById.config" size="5" disabled autofocus="autofocus" />
Style: <input placeholder="Style" type="text" ng-model="e.getToolById.style" size="5" disabled autofocus="autofocus" />
Flute: <input id="filter" placeholder="Flute" type="text" ng-model="e.getToolById.flute" size="5" disabled autofocus="autofocus"  />
</p>
<p>
Length: <input placeholder="Length" type="text" ng-model="e.getToolById.length" size="5" disabled autofocus="autofocus" />
Width: <input placeholder="Width" type="text" ng-model="e.getToolById.width" size="5" disabled autofocus="autofocus" />
Height: <input placeholder="Height" type="text" ng-model="e.getToolById.height" size="5" disabled autofocus="autofocus"/>
</p>
<p>
KTOK Width: <input placeholder="KTOK Width" type="text" ng-model="e.getToolById.ktok_width" disabled size="10" autofocus="autofocus" />
KTOK Length: <input placeholder="KTOK Length" type="text" ng-model="e.getToolById.ktok_length" disabled size="10" autofocus="autofocus" />
</p>
Qty: <input type="" ng-model="qty">
<p><span ng-if="calcSQM() !== null"><label>{{calcSQM() | number:2}}</label> total square Meters for job {{calcQty()}}</span></p>
<br/>

<div ng-repeat="x in e.getSuppliers | filter:e.getToolById.flute:true">
<table class="table">
<tr>
<td>{{x.supplierName}}</td>
<td>{{x.flute}}</td>
<td>{{x.grade}}</td>
<td>{{x.price}}</td>
<td>£{{(x.price * calcSQM())/1000 | number: 2}}</td>
</tr>
</table>

</div>