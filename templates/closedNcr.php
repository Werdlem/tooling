<div ng-controller="NonConformance as ncr"><h1>Open Ncr's</h1>

<table class="table" style="width: 50%">
	<tr>	
	<th>Order No</th>
	<th>Date Closed</th>
	</tr>
	<tr ng-repeat="x in ncr.getClosedNcrs">
		<td ng-model="x.sku"><a href="/closedNcrDetails?orderId={{x.po}}">{{x.po}}</td>
		<td ng-model="x.date_closed">{{x.date_closed}}</td>	
	</tr>
	</table>

	</div>
