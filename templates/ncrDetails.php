<div ng-controller="NonConformance as ncr"><h1>Open Ncr</h1>

<table class="table" style="width: 50%">
	<tr>	
	<th>Order No</th>
	<th>Date Opened</th>
	</tr>
	<tr ng-repeat="x in ncr.getCustomerNcr">
		<td>{{x.po}}</td>
		
	</tr>
	</table>

	</div>
