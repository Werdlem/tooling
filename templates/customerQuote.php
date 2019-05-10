<div ng-controller="customerQuote as c">	

	<h1>Pending Quotes</h1>
	<style type="text/css">
	body{font-size: 14px}
		@media print{
			body *{visibility: hidden;}
			.CustomerQuote *{visibility: visible;}
			.CustomerQuoteHide *{display: none}
			.CustomerQuoteLogo *{display:;}
			.CustomerQuote input{border: none;}
			.CustomerQuote .headders{background-color: #fd6b6b}
			.damasco{background-color:#6b9bfd !important}
		.postpack{background-color:#fd6b6b !important}
		}
		.CustomerQuote{visibility: hidden ;}
		.companyLogo{margin-left:auto; margin-right:0}
		.quotes input{width: 100%;box-sizing: border-box;height: 25px;border: none;text-align: center;}
		.damasco{background-color:#6b9bfd;}
		.postpack{background-color:#fd6b6b}
		.pImage{height: 25%; width: 25%}
		.dImage{height: 50%; width: 50%}
		.table th{border:1px solid black; text-align: center;  word-wrap:break-word;}
		.table td{border:1px solid black; text-align: center; word-wrap:break-word;}
		.table td:nth-child(1){word-wrap:break-word; width: 100%; max-width: 1px}
		.table>thead>tr>th {vertical-align: bottom; border-bottom: 1px solid black;}
		img{width: 20px; height:20px;}
		</style>
	<?php $date = date('d-m-Y') ?>
	<br/>
	<p>Business: <select ng-model="selectedCustomer" ng-change="change()" ng-options="x.business for x in c.getCustomers" ></select> 
		<button ng-show="selectedCustomer" class="btn btn-warning" ng-click="deleteQuote()" style="padding: 1px 6px;">delete quote</button> &nbsp
		Company: <select ng-model="selectedCompany" ng-options="x.name for x in company" ng-init="selectedCompany = company[1]"></select></p>

	<div class="CustomerQuoteHide">
		<h4>{{selectedCustomer.customer}}</h4>
		<h4>{{selectedCustomer.business}}</h4>
		<h4>{{selectedCustomer.address}}</h4>
		<h4>{{selectedCustomer.contact_no}}</h4>
		<h4>{{selectedCustomer.Cemail}}</h4>
		<br/>
		<p><input type="text" ng-model='selectedCustomer.customer'></p>

		<p>We are delighted to quote for your packaging requirements as follows;</p>
	</div>
	<div class="CustomerQuoteHide">

		<table class="table" ng-model="send_quote"  style="max-width: 2480px">
			<thead>
				<tr>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
					<th colspan="4" scope="colgroup"style="border:1px solid black"><h3>Quotation</h3></th>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.quoteRef}}</p></th>				
				</tr>
				
				<tr class="{{selectedCompany.style}}">

					<th style="width: 50%">Product Description</th>
					<th style="width: 20%">Product Ref</th>
					<th style="width: 20%">Size</th>
					<th style="width: 5%">Quantity</th>
					<th style="width: 15%">Unit</th>
					<th style="width: 5%">Price</th>
					<th style="width: 20px; height: 20px">Del</th>
					
				</tr>
		
			</thead>

			<tbody class="quotes">
				<tr ng-repeat="x in c.getCustomerQuotes">
					<td hidden> <input type="" ng-model="x.salesId"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.Qid"></td>
					<td hidden> <input type="" ng-model="x.business"></td>

					<td><input type="text" type=""ng-model="x.description" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					<td><input type="text" maxlength="20" type="" ng-model="x.ref" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					<td><input type="text" ng-model="x.size" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					<td><input type="text" ng-model="x.qty" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					<td><input type="text" ng-model="x.unit" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					<td><input type="text" ng-model="x.unit_price" ng-change="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.unit,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)"></td>
					
				
				<td><img src="/Css/images/icon-delete.gif" ng-click="remove($index,x.id)"></td>

			</tr>
			
			<th colspan="6" class="CustomerQuoteHide"><input ng-show="selectedCustomer" type="button" ng-click="addLine(selectedCustomer.quoteRef)" class="btn btn-primary addnew pull-right" value="Add New"></th>

		</tr>
		<th colspan="6" scope="colgroup" style="border:1px solid black; font-size: 10px">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotations are valid for 30 days from above date and are subject to our terms and contions of sale, copies of which are avaliable on request. Additional tooling/plate charges may apply for diecuts and printed products. Stock can be held by us for call off as requested by prior agreement.</th>
	</tbody>
</table>


<p>Delivery lead time for the above: <input type="text" ng-model="leadTime" col="10" ng-required="true"></p>
<p>Delivery Charges: <input type="text" ng-model="deliveryCharges" col="10" ng-required="true"></p>
</div>
<div class="CustomerQuoteHide">
	<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment1"></textarea></p>

	<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment2"></textarea></p>

	<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment3"></textarea></p>
</div>
<div class="CustomerQuoteHide">

	<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
	<p>Kind Regards,</p>
	<p><img ng-src="{{selectedCustomer.sig}}" style="width: 120px; height: 70px"></p>
	<p>{{selectedCustomer.sales_man}}</p>
</div>
<p><button type="button" class="btn btn-primary"  onclick="print()">Preview</button>
<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Email Quote" style="width:5%; height:5%" ng-click="sendQuote(c.getCustomerQuotes, selectedCustomer.email)" ng-show="selectedCustomer && leadTime && deliveryCharges">Email</button> &nbsp
	<button type="button" class="btn btn-primary" ng-show="selectedCustomer && leadTime && deliveryCharges" onclick="print()" ng-click="printQuote()">PDF</button></p>
<script type="text/javascript">function print(){

window.print()
}
</script>

</form>
<div class="CustomerQuote">

	<div class="CustomerQuoteLogo" style=" margin-top: -320px;" id="CustQuote" >	</div>	
			<img ng-src="{{selectedCompany.logo}}" class="{{selectedCompany.imageStyle}}">
			<div id="address" style="text-align: right;float: right;line-height: 5px; margin-top: 10px" >
			<p>{{selectedCompany.address}}</p>
			<p>{{selectedCompany.tel}}</p>
			<p>{{selectedCompany.email}}</p>
		</div>		
		<p style="padding-top: 50px">{{selectedCustomer.customer}}</p>

		<p>We are delighted to quote for your packaging requirements as follows;</p>
	

		<table class="table" ng-model="send_quote"  style="max-width: 2480px">
			<thead>
				<tr>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
					<th colspan="4" scope="colgroup"style="border:1px solid black"><h1>Quotation</h1></th>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.quoteRef}}</p></th>				
				</tr>
				
				<tr class="{{selectedCompany.style}}">

					<th style="width: 45%">Product Description</th>
					<th style="width: 40%">Product Ref</th>
					<th style="width: 55%">Size</th>
					<th  style="width: 8%">Quantity</th>
					<th  style="width: 8%">Unit</th>
					<th  style="width: 5%">Price</th>
					
				</tr>
		
			</thead>

			<tbody class="quotes">
				<tr ng-repeat="x in c.getCustomerQuotes">
					<td hidden ><input type="" ng-model="x.salesId"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.business"></td>

					<td style="vertical-align: middle;">{{x.description}}</td>
					<td style="vertical-align: middle;">{{x.ref}}</td>
					<td style="vertical-align: middle;">{{x.size}}</td>
					<td style="vertical-align: middle;">{{x.qty}}</td>
					<td style="vertical-align: middle;">{{x.unit}}</td>
					<td style="vertical-align: middle;">{{x.unit_price | currency: '£'}}</td>
			</tr>

			
			
		<th colspan="6" scope="colgroup" style="border:1px solid black;font-size: 10px; line-height: 10px">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotations are valid for 30 days from above date and are subject to our terms and contions of sale, copies of which are avaliable on request. Additional tooling/plate charges may apply for diecuts and printed products. Stock can be held by us for call off as requested by prior agreement.</th>
	</tbody>
</table>

<p style="vertical-align: top;">Delivery lead time for the above: {{leadTime}}</p>
<p>Delivery Charges:{{deliveryCharges}}</p>

<div class="CustomerQuote">

	<p>I look forward to receiving your comments and would be delighted to answer any questions you may have.</p>
	<p>Kind Regards,</p>
	<p><img ng-src="{{selectedCustomer.sig}}" style="width: 120px; height: 70px"></p>
	<p style="padding-top: 20px">{{selectedCustomer.sales_man}}</p>
</div>


<div id="footer" class="CustomerQuote" style="text-align: center; vertical-align: bottom; padding-top: 100px;"hidden>
	<p>POSTPACK LIMITED</p>
	<P>Registered in England No:444 6988. VAT Reg No: 796 7468 51. Registered Office: Unit 4, Hollis Road, Grantham, Lincolnshire. NG31 7QH. For payment details & options, please contact sales@postpack.co.uk.</P>
	</div>
</div>
</div>