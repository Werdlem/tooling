<div ng-controller="viewQuote as vq">	
	{{vq.getQuoteById.quoteRef}}
<table class="table">
	<tr>
		<th>Quote Ref</th>
	</tr>
	<tr ng-repeat="x in vq.getQuoteById">
		<td>
			{{x.ref}}
		</td>
		<td>
			{{x.description}}
		</td>
		<td>{{x.qty}}
		</td>
		<td>
			{{x.unit_price}}
		</td>
	</tr>
</table>
</div>