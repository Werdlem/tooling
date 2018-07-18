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
KTOK Length: <input placeholder="KTOK Length" type="text" ng-model="e.getToolById.ktok_length" disabled size="10" autofocus="autofocus" /></p>
<p>

Trim Width: <input type="number" ng-model="trimWidth"  style="width:40px">
Trim Length: <input type="number" ng-model="trimLength" style="width:40px">

Mark Up: <input type="number" ng-model="markUp" style="width:40px">
</p>
<p>Quantity: <input type="number" ng-model="qty" style="width:100px"></p>
<p>Labour @ {{calcLabour() | currency: '£'}} per run</p>
<p>Markup @ {{markUp}}%</p>
<div style="border: 1px solid grey; width: 23%; padding-left: 25px; background-color: #e0e0e0">
<h3>Filter</h3>
<p>Grade: <select id="filter" ng-model="selectGrade" ng-options="x.grade for x in e.getGrade"></select>
Supplier: <select id="filter" ng-model="selectSupplier" ng-options="x.supplier_name for x in e.getSuppliersName"><option></option></select>
</p>
</div>
<br/>

<style>
.table{ width: 80% }
	td{ text-align: center }
	th{text-align: center;}
	th.sqm{width: 10%; border: 1px solid grey;}
	input.sqm{width: 100%}
	
</style>

<table class="table">

	 <col>
  <colgroup span="2"></colgroup>
  <colgroup span="2"></colgroup>
  <tr>
   
    <th colspan="3" scope="colgroup"></th>
    <th colspan="2" scope="colgroup"style="border:1px solid grey"> SQM Breaks</th>
   
    <th colspan="2" scope="colgroup" style="border:1px solid grey">Price Break</th>
    <th colspan="1" scope="colgroup"></th>
    <th colspan="2" scope="colgroup" style="border:1px solid grey">Per Unit</th>
    <th colspan="1" scope="colgroup"></th>
    <th colspan="2" scope="colgroup" style="border:1px solid grey">Order Total</th>
   
    </tr><tr style="background-color:#e4e4e4; border:1px solid grey;">
    	<th style="border-top:1px solid grey;">Supplier</th>
		<th>Flute</th>
		<th>Grade</th>
		<th class="sqm">Sqm Min</th>
		<th class="sqm">Sqm Max</th>		
		<th style="border-top:  solid 1px grey;border: solid 1px grey;width: 5%">Price</th>
		<th style=" border: solid 1px grey; width: 5%">Pieces Required</th>
		<th>Sqm Per Break</th>
		<th style=" border: solid 1px grey;">Cost</th>
		<th style=" border: solid 1px grey;">Sqm</th>
		<th>Qty per SQM Break</th>		
		<th style=" border: solid 1px grey;">Sqm</th>
		<th style=" border: solid 1px grey;">Cost</th>
		<tr>
	
	</thead>
	<tr ng-repeat="x in e.getSuppliers | filter:e.getToolById.flute:true | filter:selectGrade.grade:true | filter:selectSupplier.supplier_name:strict" ng-hide="calcSQM() < x.min || calcSQM() > x.max">

<td>{{x.supplierName}}</td>
<td>{{x.flute}}</td>
<td>{{x.grade}}</td>
<td style="text-align: center; border: solid 1px grey"><input class="sqm" ng-model="x.min" disabled /></td>
<td style="text-align: center;border: solid 1px grey"><input class="sqm" ng-model="x.max" disabled></td>
<td style="border: solid 1px grey">{{x.price}}</td>
<td style="border:solid 1px grey; text-align: left;">{{(x.min - calcQtyReq())/calcUnitSQM() | number:0}}</td>
<td>{{calcSQM() - x.min | number:2}}</td>
<td style=" border: solid 1px grey;">{{((((x.price * calcUnitSQM())/1000) + calcLabour()))*(1 + (markUp/100)) |dropDigits |currency: '£'}}</td>
<td style=" border: solid 1px grey;">{{calcUnitSQM() | number: 2}}sqm</td>
<td>{{qty- ((x.min - calcQtyReq())/calcUnitSQM())| number:0}}</td>
<td style=" border: solid 1px grey;">{{calcSQM() | number:2}}sqm</td>
<td style=" border: solid 1px grey;">{{((((x.price * calcUnitSQM())/1000) + calcLabour()))*(1 + (markUp/100))*qty | dropDigits| currency: '£' }}</td>

{{calcCostPerUnit()}}

</tr>
</table>
</form>
