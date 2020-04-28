<h1 style="text-align: center">Non Conformance Report</h1>
<h2>Customer Details</h2>
<div ng-controller="NonConformance as ncr">
	<p><span>Customer: {{ncr.getCustomerNcr[0].customer_name | uppercase}}</span></p>
	<p><span>Purchase Order: {{ncr.getCustomerNcr[0].po}}</span></p>
	<p><span>NCR Date: {{ncr.getCustomerNcr[0].date_opened}}</span></p>
	<p><span>NCR Raised By: {{ncr.getCustomerNcr[0].o_initials}}</span></p>

<h2>Description of Non Conformance</h2>
<div ng-repeat="x in ncr.getCustomerNcr">
	<p><strong>Sku: </strong>{{x.sku}} - {{x.desc1}} - <strong>{{x.problem | uppercase}}</strong></p>
	<p><strong>Comments: </strong>{{x.p_desc}}</p>
</div>

<h2>Immediate Correction Taken/Required</h2>
<div ng-repeat="x in ncr.getCustomerNcr">
	<p><strong>Action Taken: </strong>{{x.sku}} - {{x.correction}}
	</div>
<h2>Investigation</h2>
<div ng-repeat="x in ncr.getInvestigation">

	<span> {{x.investigation}} - {{x.initials}}</span>
</div>

<h2>Planned Preventative Actions</h2>
<div ng-repeat="x in ncr.getInvestigation">

	<span> {{x.review}} - {{x.reviewed_by}}</span>
</div>
	

<h3>Closed Off By</h3>
<p><strong>Name: </strong> {{ncr.getCustomerNcr[0].closed_by | uppercase}}
<p><strong>Date: </strong> {{ncr.getCustomerNcr[0].date_closed | uppercase}}


