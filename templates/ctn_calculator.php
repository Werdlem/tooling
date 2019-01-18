<h1>Carton Calculator</h1>
<div ng-controller="ctnCalculator as ctn">
<p>Style: <select ng-model="styleSelect" ng-options="x.style for x in ctnStyle" ng-init="styleSelect = ctnStyle[0]"> </select>
Config: <select ng-model="configSelect" ng-options="x.config for x in ctnConfig" ng-init="configSelect = ctnConfig[0]"></select>
Grade: <select ng-model="gradeSelect" ng-options="x.grade for x in ctn.getGrade"></select></p>
Flute: <select ng-model="fluteSelect" ng-options="x.flute for x in ctn.getFlute"></select></p>

<p> Dimms:
<input placeholder="length" ng-model="length" size="4">&nbsp<input placeholder="width" ng-model="width" size="4">&nbsp<input placeholder="height" ng-model="height" size="4">
Qty: <input ng-model="qty" size="4"></p>
<p>Cost: <input ng-model="price" placeholder="cost" size="4"></p>

<h3>Results</h3>
<p><strong>Board Size: </strong><span ng-if="calcBlankWidth() !==null">{{calcBlankWidth() + ' x '}}</span><span ng-if="calcBlankLength() !==null">{{calcBlankLength()}}</span></p>
<p><strong>Board sqm: </strong> {{boardSqm()}}</p>
<p><strong>Labour:</strong><span ng-if="ctnLabour() !==null"> {{ctnLabour() | number: 1}}hrs</span></p>
<p><strong>Total sqm: </strong><input type="" ng-model="totalSqm" /> {{totalSqm() | number: 3}}sqm</p>
<p><strong>Carton Cost: </strong> {{cost()| currency: '£'}}each</p>
<p><strong>Total Cost: </strong>{{cost()*qty | currency: '£'}}</p>

<p><button type="button" class="btn btn-info btn-sml" ng-click="addToQuote()">Search</button></p>
</div>