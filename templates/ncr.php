<div ng-controller="NonConformance as ncr"><h1>Search Order</h1>

<h3>Order Search: <input type="" ng-model="findOrder" ng-change="searchOrder()"></h3>
<p>"NB:for Postpack orders, please use the prefix 'p' followed by the order number and 'd' followed by the order number for damasco"</p>
<style type="text/css">
	.table{width: 80%; text-align: left;}
	textarea{width: 350px}
</style>

<table class="table">
	<tr>
	<th></th>	
	<th>SKU</th>
	<th>Description</th>
	<th>Qty</th>
	<th>Reason</th>
    </tr>
	<tr ng-repeat="x in ncr.getOrder">
		<th><input type="checkbox" ng-model="x.nc" ng-change="nc(x)"></th>
		<td ng-model="x.sku">{{x.sku}}</td>
		<td ng-model="x.desc1">{{x.desc1}}</td>
		<td ng-model="x.qty">{{x.qty}}</td>

		<td width="500px" style="position: right;"><div ng-show="x.nc"><select ng-model="reason" ng-options="x.reason for x in options" ng-change="updateLine(reason,description,x,initials)">	
		</select>
		{{reason.reason}}
	<textarea ng-model="description" ng-change="updateLine(reason,description,x,initials)" placeholder="Please give short description of non-conformance" ></textarea>


	<p><input type="text" ng-model="initials" placeholder="initials" maxlength="2" size="2" style="width: 40px" ng-change="updateLine(reason,description,x,initials)"></p>
</td>
</div>   		
	</tr>
	</table>
	<input type="button" name="" onClick="window.location.reload()" value="Completed">
	</script>
	</div>
