<div ng-controller="productionSchedule as ps"><h1>Search Order</h1>

<h3>Order Search: <input type="" ng-model="findOrder" ng-change="searchSchedule()"></h3>
<p>"NB:for Postpack orders, please use the prefix 'p' followed by the order number and 'd' followed by the order number for damasco"</p>
<!--<button ng-click="showDetails()" class="btn btn-info btn-sml">Schedule</button>-->
<style type="text/css">
	.table{width: 50%}
</style>

<table class="table">
	<tr>
	<th>Order Id</th>
	<th>Customer Name</th>
	<th>SKU</th>
	<th>Qty</th>
    <th>Schedule Date</th>
    <th>Machine</th>
    <th>Duration</th>
	</tr>
	<tr ng-repeat="x in ps.getOrder">
		<td>{{x.order_id}}</td>
		<td>{{x.customer}}</td>
		<td>{{x.sku}}</td>
		<td>{{x.qty}}</td>
        <td>{{x.scheduleDate | date: 'dd-MM-yyyy'}}</td>
        <td>{{x.machine}}</td>
        <td>{{x.duration}} minutes</td>
		
	</tr>
	</table>


  

</div>
