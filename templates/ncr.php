<div ng-controller="NonConformance as ncr" style="width: 70%; border: 1px solid #d4d4d4; padding: 10px; border-radius: 5px; box-shadow: 10px 10px 10px #d4d4d4; margin: auto" >

	<h3 style="text-align: center">Raise NCR</h3>

<h4>Order Search: <input type="" ng-model="findOrder" ng-change="searchOrder()"></h4>
<p>"NB:for Postpack orders, please use the prefix 'p' followed by the order number and 'd' followed by the order number for damasco"</p>
<style type="text/css">
	.table{width: 100%; text-align: left;}
	textarea{width: 350px}
	img{display:none;}	
</style>
<p>Customer: <span>{{ncr.getOrder[0].customer}}</span></p>
<p>Order Number: <span>{{ncr.getOrder[0].order_id}}</span></p>
<p>Order Date: <span>{{ncr.getOrder[0].order_date}}</span></p>

<p ng-show="ncr.getOrder[0].order_id">Entire Order? No: <input type="radio" ng-model="YesNo" Value="no"> Yes: <input type="radio" ng-model="YesNo" value="yes"> </p>
<div ng-switch="YesNo">
	<div ng-switch-when="no">
<table class="table">
	<tr>
	<th></th>
	<th>SKU</th>
	<th>Description</th>
	<th>Qty</th>
	<th>Despatched</th>
	<th>Reason</th>
    </tr>
	<tr ng-repeat="x in ncr.getOrder">
		<th><input type="checkbox" name="check" ng-model="nc" ng-change="addNCRline(nc,x)"></th>
		<td ng-model="x.sku">{{x.sku}}</td>
		<td ng-model="x.desc1">{{x.desc1}}</td>
		<td ng-model="x.qty">{{x.qty}}</td>
		<td ng-model="x.qty">{{x.despatch}}</td>

			<td width="500px" style="position: right;">
				<div ng-show="nc">
					<p><label>Issue: </label><select ng-model="y.details" ng-options="y.details for y in options" ng-change="updateLine(y,x)"> 
		</select> </p>
		
	
			<p><label>Description: </label><input type="text" ng-model="p_desc"  placeholder="Please give short description of non-conformance" ng-change="updatePdesc(x,p_desc)" ></p>
			<p><label>Action Taken: </label><select ng-model="y.details" ng-options="y.details for y in corrective" ng-change="updateLine(y,x)">
			</select></p>
			<!--<textarea ng-model="corrective"   placeholder="Corrective action taken (if any)" class="" ></textarea>
			<img src="/Css/images/tick.png" style="width: 5%;" ng-style="myStyle">  ng-click="saved()"-->


	
	<!--<p><input type="button" name="" class="btn btn-info btn-sm" ng-disabled="initials == null" value="Add Line" ng-click="updateLine(reason,description,x,corrective,initials)" ></button></p>-->
</div>
</td>
</tr>
</table>
</div>
<div ng-switch-when="yes">
	<table class="table">
		<tr>
			
		</tr>
		<tr>
	<td>
			<label>Issue: </label><select ng-model="y.details" ng-options="y.details for y in entireOrder"></select>
			<p><label>Description: </label><input type="text" ng-model="description"  placeholder="Please give short description of non-conformance" ></p>
			<p><label>Corrective action: </label><select ng-model="z.details" ng-options="z.details for z in corrective"></select></p>
			<p>Initials: <input type="text" ng-model="initial" style="width: 20px" maxlength="2">&nbsp
	<input type="button" name=""  ng-click="addNCRlineEntire(y,z,description,initial)" class="btn btn-info btn-sm" ng-disabled="initial ==null" ng-model="completed" value="Raise NCR" ></button></p>
</td>
</tr>
</div>
	</table>