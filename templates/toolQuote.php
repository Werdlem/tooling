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

Mark Up: <input type="number" ng-model="markUp" style="width:50px">
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
.table{ width: 100% }
	td{ text-align: center }
	th{text-align: center;}
	th.sqm{border: 1px solid black;}
	input.sqm{width: 100%}

.operations{
	background-color: #d5f9ff;
	border: 1px solid black;
}
	
</style>

<table class="table">
	<col>
<colgroup span="7"></colgroup>
<tr>
	<th colspan="8" scope="colgroup" style="border-top: none"></th>
	<th colspan="13" scope="colgroup"style="border:1px solid black"> Costing</th>
</tr>
	 <col>
  <colgroup span="2"></colgroup>
  <colgroup span="2"></colgroup>
  <tr>   
  	<th colspan="1" scope="colgroup" style="border-top: none"></th>
    <th colspan="3" scope="colgroup" style="border-top: none"></th>
    <th colspan="2" scope="colgroup"style="border:1px solid black"> SQM Breaks</th>
   
    <th colspan="2" scope="colgroup" style="border:1px solid black">Price Break</th>
    <th class="operations" colspan="3" scope="colgroup" style="border:1px solid black">Operations</th>
   
    <th colspan="5" scope="colgroup" style="border:1px solid black">Per Unit</th>
    
    <th colspan="5" scope="colgroup" style="border:1px solid black">Order Total</th>
   
    </tr>
    <tr style="background-color:#e4e4e4; border:1px solid black;">
    	<th style="border-top:1px solid black;"></th>
    	<th style="border-top:1px solid black;">Supplier</th>
		<th>Flute</th>
		<th>Grade</th>
		<th class="sqm">Sqm Min</th>
		<th class="sqm">Sqm Max</th>		
		<th style="border-top:  solid 1px black;border: solid 1px black;width: 5%">Price</th>
		<th style=" border: solid 1px black; width: 5%">Pieces Required</th>

		<th class="operations">Sheets</th>
		<th class="operations">£ per Sheet</th>
		<th class="operations">Total</th>
		
		<th style=" border: solid 1px black;">Sqm</th>
		<th style=" border: solid 1px black;">Materials</th>		
		<th style=" border: solid 1px black;">Labour</th>
		<th style=" border: solid 1px black;">Margin</th>
		<th style=" border: solid 1px black;width: 5%;background-color:#f1ebff">Unit Total</th>	
			
		<th style=" border: solid 1px black;">Sqm</th>
		<th style=" border: solid 1px black;">Materials</th>		
		<th style=" border: solid 1px black;">Labour</th>
		<th style=" border: solid 1px black;">Margin</th>
		<th style=" border: solid 1px black;width: 5%;background-color:#f1ebff">Total</th>
		<tr>
	
	</thead>
	<tr ng-repeat="x in e.getSuppliers | filter:e.getToolById.flute:true | filter:selectGrade.grade:true | filter:selectSupplier.supplier_name:strict" ng-hide="calcSQM() < x.min || calcSQM() > x.max">
<td><input type="checkbox" ng-model="x.checked" ng-true-value="1" ng-false-value="0"></td>
<td>{{x.supplierName}}</td>
<td>{{x.flute}}</td>
<td>{{x.grade}}</td>
<td style="text-align: center; border: solid 1px grey">{{x.min}}<input hidden class="sqm" ng-model="x.min" disabled /></td>
<td style="text-align: center;border: solid 1px grey">{{x.max}}<input hidden class="sqm" ng-model="x.max" disabled></td>
<td style="border: solid 1px grey">{{x.price}}</td>
<td style="border:solid 1px grey; text-align: left;">{{(x.min - calcQtyReq())/calcUnitSQM() | number:0}}</td>

<!--OPERATIONS-->
<td class="operations">{{qty/e.getToolById.config | number:3}}</td>
<td class="operations">{{calcSheetSQM() * (x.price/1000) | currency:'£'}}</td>
<td class="operations">{{calcSQM() * (x.price/1000)  |currency: '£'}}</td>

<!--PER UNIT CALCULATIONS-->
<td style=" border: solid 1px grey;">{{calcUnitSQM() | number: 2}}sqm</td>
<td style=" border: solid 1px grey;">{{(x.price * calcUnitSQM())/1000 |dropDigits |currency: '£'}}</td>
<td style=" border: solid 1px grey;">{{calcLabour()|dropDigits |currency: '£'}}</td>
<td style=" border: solid 1px grey;">{{(markUp/100)*(calcLabour()+(x.price * calcUnitSQM())/1000)|dropDigits |currency: '£'}}</td>
<td style=" border: solid 1px grey;background-color:#f1ebff; font-weight: bold">{{calcLabour()+((x.price * calcUnitSQM())/1000)+(markUp/100)*(calcLabour()+(x.price * calcUnitSQM())/1000)|dropDigits |currency: '£'}}</td>
<!--ORDER TOTAL CALCULATIONS-->
<td style=" border: solid 1px grey;">{{calcUnitSQM() * qty | number: 2}}sqm</td>
<td style=" border: solid 1px grey;">{{((x.price * calcUnitSQM())/1000 | dropDigits) * qty |currency: '£'}}</td>
<td style=" border: solid 1px grey;">{{calcLabour()*qty |dropDigits|currency:'£'}}</td>
<td style=" border: solid 1px grey;">{{(markUp/100)*(calcLabour()+(x.price * calcUnitSQM())/1000|dropDigits)*qty|currency:'£'}}</td>
<td style=" border: solid 1px grey;background-color:#f1ebff;font-weight: bold">{{(calcLabour()+((x.price * calcUnitSQM())/1000)+(markUp/100)*(calcLabour()+(x.price * calcUnitSQM())/1000)|dropDigits)*qty |currency: '£'}}</td>
{{calcCostPerUnit()}}
</tr><pre>{{getSelected()}}</pre>
</tr>
</table>
</form>
