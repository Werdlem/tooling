<div ng-controller="specSheet as ss">
	<h3>Spec Sheets awaiting QA approval</h3>
	<table class="table" style="width: 60%">
		<tr>
			<th>Customer Name</th>
			<th>Prodct Ref</th>
			<th>Product Type</th>
			<th>Date added</th>
			<th>File Path</th>
		</tr>
		<tr ng-repeat="x in ss.getSpecSheets">
			<td><a href="/QaNewProduct?id={{x.id}}&ref={{x.toolRef}}">{{x.customerName}}</td>
			<td>{{x.toolRef}}</td>
			<td>{{x.productRange}}</td>
			<td>{{x.date}}</td>
			<td>{{x.filePath}}</td>
			
		</tr>
	</table>
</div>