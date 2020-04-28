<div ng-controller="NonConformance as ncr"><h1>Search Order</h1>

<h3>Order Search: <input type="" ng-model="findOrder" ng-change="searchOrder()"></h3>
<p>"NB:for Postpack orders, please use the prefix 'p' followed by the order number and 'd' followed by the order number for damasco"</p>
<style type="text/css">
	.table{width: 80%; text-align: left;}
	textarea{width: 350px}
</style>
<p>Customer: <span>{{ncr.getOrder[0].customer}}</span></p>
<p>Order Number: <span>{{ncr.getOrder[0].order_id}}</span></p>
<p>Order Date: <span>{{ncr.getOrder[0].order_date}}</span></p>
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
		<th><input type="checkbox" ng-model="x.nc" ng-change="nc(x)"></th>
		<td ng-model="x.sku">{{x.sku}}</td>
		<td ng-model="x.desc1">{{x.desc1}}</td>
		<td ng-model="x.qty">{{x.qty}}</td>
		<td ng-model="x.qty">{{x.despatch}}</td>

		<td width="500px" style="position: right;"><div ng-show="x.nc"><select ng-model="reason" ng-options="x.reason for x in options" ng-change="updateLine(reason,description,x,corrective,initials)">	
		</select>
	
			<textarea ng-model="description" ng-change="updateLine(reason,description,x,corrective,initials)" placeholder="Please give short description of non-conformance" ></textarea>
			<textarea ng-model="corrective" ng-change="updateLine(reason,description,x,corrective,initials)" placeholder="Corrective action taken (if any)" ></textarea>


	<p><input type="text" ng-model="initials" placeholder="initials" maxlength="2" size="2" style="width: 40px" ng-change="updateLine(reason,description,x,corrective,initials)">{{initials}}</p>
</td>
   		
	</tr>
	</table>
{{initials}}
	<input type="button" name="" onClick="window.location.reload()" class="btn btn-info btn-sm"  ng-model="completed" value="Completed" ></button>
	</div>
	</div>
