<div style="width: 50%; border: 1px solid #d4d4d4; padding: 25px; border-radius: 5px; box-shadow: 10px 10px 10px #d4d4d4; margin: auto" >
<h3 style="text-align: center">Non Conformance Report</h3>
<h4>Customer Details</h4>
<div ng-controller="NonConformance as ncr">
	<p><span>Customer: {{ncr.getCustomerNcr[0].customer_name | uppercase}}</span></p>
	<p><span>Purchase Order: {{ncr.getCustomerNcr[0].po}}</span></p>
	<p><span>NCR Date: {{ncr.getCustomerNcr[0].date_opened}}</span></p>
	<p><span>NCR Raised By: {{ncr.getCustomerNcr[0].o_initials}}</span></p>
	<br/>
<div style="border-bottom: dashed #d4d4d4;"></div>
<h4>Description of Non Conformance</h4>
<div ng-repeat="x in ncr.getCustomerNcr">
	<p><strong>Sku: </strong>{{x.sku}} - {{x.desc1}} - <strong>{{x.problem | uppercase}}</strong></p>
	<p><strong>Comments: </strong>{{x.p_desc}}</p>
</div>
<br/>
<div style="border-bottom: dashed #d4d4d4;"></div>
<h4>Immediate Correction Taken/Required</h4>
<div ng-repeat="x in ncr.getCustomerNcr">
	<p><strong>Action Taken: </strong>{{x.sku}} - {{x.correction}}</p>
	</div>
<h4>Investigation</h4>
<div ng-repeat="x in ncr.getInvestigation">

	<span> {{x.investigation}} - {{x.initials}}</span>
</div>
<br/>
<div style="border-bottom: dashed #d4d4d4;"></div>
<h4>Planned Preventative Actions</h4>
<div ng-repeat="x in ncr.getReview">
	<span> {{x.review}} - {{x.reviewed_by}}</span>
	
</div>
<br/>
<div style="border-bottom: dashed #d4d4d4;"></div>
<h4>Closed Off By</h4>
<p><strong>Name: </strong> {{ncr.getCustomerNcr[0].closed_by | uppercase}}</p>
<p><strong>Date: </strong> {{ncr.getCustomerNcr[0].date_closed | uppercase}}</p>

</div>


