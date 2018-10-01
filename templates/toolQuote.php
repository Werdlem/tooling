<form ng-controller="toolQuote as e" ng-submit="e.submit()">	
	<p>Tool Ref: <Label>{{e.getToolById.tool_ref}} </Label></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" ng-model="e.getToolById.esc_ref" size="5" disabled autofocus="autofocus" /></p>
<p>Location: <input placeholder="Location" type="text" ng-model="e.getToolById.location" size="5" disabled autofocus="autofocus" /></p>
<p>
Config: <input placeholder="Config" type="text" ng-model="e.getToolById.config" size="5" ng-disabled="e.getToolById.tool_id"  autofocus="autofocus" />
Style: <input placeholder="Style" type="text" ng-model="e.getToolById.style" size="5" ng-disabled="e.getToolById.tool_id"  autofocus="autofocus" />
Flute: <input id="filter" placeholder="Flute" type="text" ng-model="e.getToolById.flute" ng-disabled="e.getToolById.tool_id" oninput="this.value = this.value.toUpperCase()" size="5"  autofocus="autofocus"  />
</p>
<p>
Length: <input placeholder="Length" type="text" ng-model="e.getToolById.length" size="5" ng-disabled="e.getToolById.tool_id" autofocus="autofocus" />
Width: <input placeholder="Width" type="text" ng-model="e.getToolById.width" size="5" ng-disabled="e.getToolById.tool_id" autofocus="autofocus" />
Height: <input placeholder="Height" type="text" ng-model="e.getToolById.height" size="5" ng-disabled="e.getToolById.tool_id" autofocus="autofocus"/>
</p>
<p>
KTOK Deckle: <input placeholder="KTOK Width" type="text" ng-model="e.getToolById.ktok_width" ng-disabled="e.getToolById.tool_id" size="10" autofocus="autofocus" />
KTOK Chop: <input placeholder="KTOK Length" type="text" ng-model="e.getToolById.ktok_length" ng-disabled="e.getToolById.tool_id" size="10" autofocus="autofocus" /></p>
<p>
Trim Deckle: <input type="number" ng-model="trimWidth"  style="width:40px">
Trim Chop: <input type="number" ng-model="trimLength" style="width:40px">

Mark Up: <input type="number" ng-model="markUp" style="width:50px">
</p>
<p>Quantity: <input type="number" ng-model="qty" style="width:100px"></p>
<p>Labour @ {{calcLabour() | currency: '£'}} per run</p>
<p>Markup @ {{markUp}}%</p>
<div style="border: 1px solid grey; width: 23%; padding-left: 25px; background-color: #e0e0e0">
<h3>Filter</h3>
<p>Grade: <select id="filter" ng-model="selectGrade" ng-options="x.grade for x in e.getGrade"></select></p>
<p>Supplier: <select id="filter" ng-model="selectSupplier" ng-options="x.supplier_name for x in e.getSuppliersName"><option></option></select></p>
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
	
	<tr ng-repeat="x in e.getSuppliers | filter:e.getToolById.flute:true | filter:selectGrade.grade:true | filter:selectSupplier.supplier_name:strict" ng-hide="calcSQM() < x.min || calcSQM() > x.max" >
		
<td><input type="checkbox" ng-model="x.checked" ng-true-value="1" ng-false-value="0"></td>
<td>{{x.supplierName}}</td>
<td>{{x.flute}}</td>
<td>{{x.grade}}</td>
<td style="text-align: center; border: solid 1px grey">{{x.min}}<input hidden class="sqm" ng-model="x.min" disabled /></td>
<td style="text-align: center;border: solid 1px grey">{{x.max}}<input hidden class="sqm" ng-model="x.max" disabled></td>
<td style="border: solid 1px grey" >{{x.price}}</td>
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

</tr>
<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" ng-click="saveQuote = true">Save Quote</button></td>
</table>

<!-- Modal -->
<div id="myModal" class="modal fade" ng-show="saveQuote">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Save Quote</h4>
      </div>
      <div class="modal-body">
       
      

<form name="quote" ng-submit="e.submit()">
	<p>Existing Customer: <input type="checkbox" ng-model="checked"></p>
<p><select ng-show="checked" ng-model="e.add.customer" ng-options="x.customer for x in e.getCustomers">

</select></p>
<p ><input ng-hide="checked" ng-model="e.add.customer.customerId" placeholder="contact" required></p>
<p ><input ng-hide="checked" ng-model="e.add.customer.customer" placeholder="contact" required></p>
<p><input ng-hide="checked"  ng-model="e.add.customer.contact_no" placeholder="contact number"></p>
<p><input ng-hide="checked" ng-model="e.add.customer.business" name="email" placeholder="business"></p>
<p><input ng-hide="checked" ng-model="e.add.customer.email" name="" placeholder="email" required></p>
<p><input ng-hide="checked"  ng-model="e.add.customer.address" name="" placeholder="address"></p>
<p><input placeholder="unitPrice" type="text" ng-model="unitPrice() | currency: '£'" size="10" autofocus="autofocus" /></p>
<p><input placeholder="totalPrice" type="text" ng-model="totalPrice() | currency:'£'" size="10" autofocus="autofocus" />
<p><input placeholder="qty" type="text" ng-model="qty" size="10" autofocus="autofocus" /></p>
<p><select ng-model="e.add.sales" ng-options="x.sales_man for x in e.getSalesMan" ng-hide="checked"></select></p>
<p><input type="" ng-model="e.add.customer.quoteRef" ng-show="checked"></p>
<button ng-disabled="quote.$invalid">Save</button>
</p>

</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
<!--END MODAL-->
</form>