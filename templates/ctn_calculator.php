<style type="text/css">
option {
	border: 1px solid grey; background-color: white; color: #5cb85c;
}
.btn-success.active, .btn-success.focus, .btn-success:active, .btn-success:focus, .btn-success:hover, .open>.dropdown-toggle.btn-success {background-color: white; color: black}
.form-control{width: 5%; display: inline}
</style>
<div ng-controller="ctnCalculator as ctn">
<div id="ctnConfig" style="width: 100%; margin-right: 0px; padding-left: 20px">
<h1>Carton Calculator</h1>

<p>Style: <select class="btn btn-success dropdown-toggle" ng-model="styleSelect" ng-options="x.style for x in ctnStyle" ng-init="styleSelect = ctnStyle[0]"> </select> <img ng-src="{{styleSelect.image}}" style="width: 10%; height: 10%"></p>
<p>Config: <select class="btn btn-success dropdown-toggle" ng-model="configSelect" ng-options="x.config for x in ctnConfig" ng-init="configSelect = ctnConfig[0]"></select> <img ng-src="{{configSelect.image}}" ></p>
<p>Grade: <select class="btn btn-success dropdown-toggle" ng-model="gradeSelect" ng-options="x.grade for x in ctn.getGrade"></select></p>
<p>Flute: <select class="btn btn-success dropdown-toggle" ng-model="fluteSelect" ng-options="x.flute for x in ctn.getFlute"></select></p>

<p> Dimensions:
<input class="form-control" placeholder="length" ng-model="length" >mm&nbsp<input class="form-control" placeholder="width" ng-model="width" >mm&nbsp<input class="form-control" placeholder="height" ng-model="height" >mm</p>
<p>Qty: <input class="form-control" ng-model="qty" size="4"></p>
<!--<p>Cost: <input class="form-control" ng-model="price" placeholder="cost" size="4"></p>
<p>Mark up</p>
Mark UpRange <input type="range" name="range" ng-model="value" ng-min="min" ng-max="max">
number: <input type="number" ng-model="value">-->

<div id="results" style="border: 1px solid grey; width: 20%; float: right; margin-top:-570px; padding-left: 5px; margin-right: 650px; border-radius: 10px">
<h3>Results</h3>
<p><strong>Board Size: </strong><span ng-if="calcBlankWidth() !==null">{{calcBlankWidth() + ' x '}}</span><span ng-if="calcBlankLength() !==null">{{calcBlankLength()}}</span></p>
<p><strong>Board sqm: </strong> <span ng-if="boardSqm() !==null">{{boardSqm()}}</span></p>
<p><strong>Sheets: </strong>{{sheets()}}</p>
<p><strong>£ Per Carton: </strong>{{materialsCost() | currency: '£'}}</p>
<p><strong>Labour:</strong><span ng-if="ctnLabour() !==null"> {{ctnLabour() | number: 1}} days</span></p>
<p><strong>Labour Cost @ <span ng-if="ctnCategory() !== null">{{ctnCategory().people}} </span> Staff: </strong><span>{{calcCtnLabourCost() | currency: '£'}}</span></p>
<p><strong>Carton cost per unit:</strong> <span ng-if="materialsCost() !== null">{{materialsCost() | currency: '£'}}</span></p>
<p><strong>Total sqm: </strong>{{totalSqm() | number: 3}}sqm</p>
</div>
</div>
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

<table class="table"  ng-controller="toolQuote as e">
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
	
	<tr ng-repeat="x in e.getSuppliers | filter:gradeSelect.grade:true | filter:fluteSelect.flute:true" ng-hide="totalSqm() < x.min || totalSqm() > x.max"  >
		
<td><input type="checkbox" ng-model="x.checked" ng-true-value="1" ng-false-value="0"></td>
<td>{{x.supplierName}}</td>
<td>{{x.flute}}</td>
<td>{{x.grade}}</td>
<td style="text-align: center; border: solid 1px grey">{{x.min}}<input hidden class="sqm" ng-model="x.min" disabled /></td>
<td style="text-align: center;border: solid 1px grey">{{x.max}}<input hidden class="sqm" ng-model="x.max" disabled></td>
<td style="border: solid 1px grey" >{{x.price}}</td>
<td style="border:solid 1px grey; text-align: left;">{{(x.min - calcQtyReq())/calcUnitSQM() | number:0}}</td>

<!--OPERATIONS-->
<td class="operations">{{sheets()}}</td>
<td class="operations">{{boardSqm() * (x.price/1000) | currency:'£'}}</td>
<td class="operations">{{totalSqm() * (x.price/1000)  |currency: '£'}}</td>

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

</div>

<!--<p><button type="button" class="btn btn-info btn-sml" ng-click="addToQuote()">Add</button></p>-->
<strong><p style="text-align: center; font-size: 20px">PLEASE NOTE: PRICES SHOWN ABOVE DO NOT INCLUDE VAT & MARGIN.</strong>



