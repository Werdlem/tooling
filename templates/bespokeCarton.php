<div ng-controller="autobox">

	<p><label>Length: <input type="" ng-model="length"></label></p>
	<p><label>Width: <input type="" ng-model="width"></label></p>
	<p><label>Height: <input type="" ng-model="height"></label></p>


	<p><label>Style: </label><select ng-model="selectedStyle" ng-options="x.style for x in styles"></select></p>
		<p><label>Config: </label><select ng-model="selectedPanel" ng-options="x.config for x in config"></select></p>
			<p><label>Flute: </label><select ng-model="selectedFlute" ng-options="x.flute for x in flutes"></select></p>
<h2>Board Size</h2>
<label>{{deckle()}} x {{chop()}}</label>
<h2>Blade Setup</h2>
<p><label>Blade 1: <span>{{blade1()}}</span></label></p>
<p><label>Blade 2: <span>{{blade2()}}</span></label></p>
</div>