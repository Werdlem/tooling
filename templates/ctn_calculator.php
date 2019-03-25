</style>
<div ng-controller="ctnCalculator as ctn">
<div id="ctnConfig" style="width: 100%; margin-right: 0px; padding-left: 20px">
<h1>Carton Calculator</h1>

<p>Style: <select ng-model="styleSelect" ng-options="x.style for x in ctnStyle" ng-init="styleSelect = ctnStyle[0]"> </select> <img ng-src="{{styleSelect.image}}" style="width: 10%; height: 10%"></p>
<p>Config: <select ng-model="configSelect" ng-options="x.config for x in ctnConfig" ng-init="configSelect = ctnConfig[0]"></select> <img ng-src="{{configSelect.image}}" ></p>
<p>Grade: <select ng-model="gradeSelect" ng-options="x.grade for x in ctn.getGrade"></select></p>
<p>Flute: <select ng-model="fluteSelect" ng-options="x.flute for x in ctn.getFlute"></select></p>

<p> Dimms:
<input placeholder="length" ng-model="length" size="4">&nbsp<input placeholder="width" ng-model="width" size="4">&nbsp<input placeholder="height" ng-model="height" size="4">
Qty: <input ng-model="qty" size="4"></p>
<p>Cost: <input ng-model="price" placeholder="cost" size="4"></p>
<p>Mark up</p>
Mark UpRange <input type="range" name="range" ng-model="value" ng-min="min" ng-max="max">
number: <input type="number" ng-model="value">

<div id="results" style="border: 1px solid grey; width: 20%; float: right; margin-top:-610px; padding-left: 5px; margin-right: 650px; border-radius: 10px">
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

<!--<p><button type="button" class="btn btn-info btn-sml" ng-click="addToQuote()">Add</button></p>-->
<strong><p style="text-align: center; font-size: 20px">PLEASE NOTE: PRICES SHOWN ABOVE DO NOT INCLUDE VAT & MARGIN.</strong>



