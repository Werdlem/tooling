<h1>Carton Calculator</h1>
<div ng-controller="toolQuote as e">
<p>Style: <select ng-model="styleSelect" ng-options="x.style for x in ctnStyle" ng-init="styleSelect = ctnStyle[0]"> </select>
Config: <select ng-model="configSelect" ng-options="x.config for x in ctnConfig" ng-init="configSelect = ctnConfig[0]"></select>
Colour: <select ng-model="colourSelect" ng-options="x.colour for x in ctnColour"></select></p>
<p> Dimms:
<input placeholder="length" ng-model="length" size="4">&nbsp<input placeholder="width" ng-model="width" size="4">&nbsp<input placeholder="height" ng-model="height" size="4">
Qty: <input ng-model="qty" size="4"></p>
<p>Labour: <input ng-model="hours" placeholder="hours" size="4">

<h3>Results</h3>
<p><strong>Board Size: </strong><span ng-if="calcBoardWidth() !==null">{{calcBoardWidth() + ' x '}}</span><span ng-if="calcBoardLength() !==null">{{calcBoardLength()}}</span></p>
<p><strong>Board sqm: </strong> {{boardSqm()}}</p>
<p><strong>Board Cost: </strong> {{colourSelect.cost | currency: '£'}}</p>
<p><strong>Qty Per Sheet:</strong> <span ng-if="calcQtyPerSheet() !==null"> {{calcQtyPerSheet() }}</span></p>
<p><strong>Total Sheets:</strong> {{totalSheets() | number: 2}}</p>
<p><strong>Board Cost: </strong> <span ng-if="boardCost() !==null">{{boardCost() | currency: '£'}}</p>
<p><strong>Labour:</strong> {{calcLabour() | currency: '£'}}</p>
<p><strong>Total Cost incl Labour:</strong> <span ng-if="calcLabour() !==null">{{ calcLabour() + boardCost() | currency: '£'}}</p>
<p style="color: red; font-size: 125%"><strong>Cost per unit:</strong><span ng-if="calcCostPerUnit() !==null"> {{calcCostPerUnit() | currency: '£'}}</p>
<script src="./restricted/cartonCalculator.js"></script>
</div>