<div ng-controller="specSheet as np" style="width: 70%;border-radius: 5px;  box-shadow: 10px 10px 20px #d4d4d4; padding: 20px;margin: auto">
	<style type="text/css">
		p{font-weight: bold}
		span{font-weight: normal;}
	</style>
	<form>
	<p style="text-align: center">Select Specification Sheet: <select ng-model="selectSpecSheet" ng-options="x.toolRef for x in np.getSpecSheetList" ng-change="change()"></select></p>
	<div ng-show="selectSpecSheet">
	<h3 style="text-align: center">Product Specification Sheet</h3>
<p>Customer Name: <span> {{np.getSpecSheet.customerName}}</span>
<p>Product Name: <span>{{selectSpecSheet.toolRef}}</span></p>
<p>Product Alias: <span>{{selectSpecSheet.alias}}</span></p>

<div style="border: 2px dashed #a2a2a2; padding:5px; background-color:#d4d4d4; border-radius: 5px">

<div ng-show="selectSpecSheet.productRange == 'New Tool'">

				<p>Tool Manufacturer Refrence: <span>{{selectSpecSheet.esc_ref}}</span></p>
				<p>Racking Location: <span>{{selectSpecSheet.location}}</span></p>
				<h4>Tool / Product Details</h4>
				
				<p><strong>Internals </strong></p>
				<p>L:<span>{{selectSpecSheet.length}}</span>&nbsp
				W: <span>{{selectSpecSheet.width}} </span>&nbsp
				H: <span>{{selectSpecSheet.height}} </span></p>

				<p><strong> Knife To Knife</strong></p>
				<p>Deckle: <span>{{selectSpecSheet.deckle}}</span> &nbsp
				<p>Chop: <span>{{selectSpecSheet.chop}}</span></p>
</div>



<p>Configuration: <span>{{selectSpecSheet.config}} up</span> &nbsp
Style: <span>{{selectSpecSheet.style}}</span> &nbsp
Flute: <span>{{selectSpecSheet.flute}}</span></p>

<p>Material Details <span>{{selectSpecSheet.material}}</span></p>


<p>
<input type="hidden" type="text" ng-model="np.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
</div>
</p>
<iframe style="width: 100%;"height="1000" src="{{np.getSpecSheet.filePath}}"></iframe>{{selectSpecSheet.filePath}}
</div>
</div>
</form>