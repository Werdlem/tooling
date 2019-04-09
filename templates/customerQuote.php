
<div ng-controller="customerQuote as c">	

	<h1>Pending Quotes</h1>
	<style type="text/css">
		@media print{
			body *{visibility: hidden}
			.CustomerQuote *{visibility: visible;}
			.CustomerQuoteHide *{display: none}
			.CustomerQuoteLogo *{display:;}
			.CustomerQuote input{border: none;}
			.CustomerQuote .headders{background-color: #fd6b6b}
		}
		.CustomerQuote{visibility: hidden;}
		.companyLogo{margin-left:auto; margin-right:0}
		.quotes input{width: 100%;box-sizing: border-box;height: 25px;border: none;text-align: center;}
		.headders{background-image: url('./Css/images/tableBG.jpg')}
		.table th,.table td{border:1px solid black; text-align: center; width: auto; overflow: hidden;word-wrap: break-word;}

	</style>
	<?php $date = date('d-m-Y') ?>



	<br/>
	<p>Customer: <select ng-model="selectedCustomer" ng-change="change()" ng-options="x.customer for x in c.getCustomers" ></select></p>

	<div class="CustomerQuoteHide">
		<h4>{{selectedCustomer.customer}}</h4>
		<h4>{{selectedCustomer.business}}</h4>
		<h4>{{selectedCustomer.address}}</h4>
		<h4>{{selectedCustomer.contact_no}}</h4>
		<h4>{{selectedCustomer.Cemail}}</h4>
		<br/>
		<p>Dear {{selectedCustomer.customer}}</p>

		<p>Please find below the quotation for the packaging we discussed:</p>
	</div>
	<div class="CustomerQuoteHide">

		<table class="table" ng-model="send_quote"  style="max-width: 2480px">
			<thead>
				<tr>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
					<th colspan="3" scope="colgroup"style="border:1px solid black"><h3>Quotation</h3></th>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.quoteRef}}</p></th>				
				</tr>
				
				<tr class="headders" style="">

					<th style="width: 50%">Product Description</th>
					<th style="width: 40%">Product Ref</th>
					<th style="width: 40%">Size</th>
					<th  style="width: 8%">Quantity</th>
					<th  style="width: 5%">Unit (£)</th>
					
				</tr>
		
			</thead>

			<tbody class="quotes">
				<tr ng-repeat="x in c.getCustomerQuotes">
					<td hidden ><input type="" ng-model="x.salesId"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.business"></td>

					<td><input maxlength="30" type=""ng-model="x.description"></td>
					<td><input maxlength="20" type="" ng-model="x.ref"></td>
					<td><input type="" ng-model="x.size"></td>
					<td><input type="" ng-model="x.qty"></td>
					<td><input type="" ng-model="x.unit_price"></td>
					
				</div>
				<td class="CustomerQuoteHide" style="border: none"><img src="/css/images/update.png" style="width:20px; height:20px" ng-click="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.total_price,x.description,selectedCustomer.customerId,selectedCustomer.salesId,selectedCustomer.quoteRef,selectedCustomer.date)" data-toggle="tooltip" data-placement="top" title="Update"></td> 

				<td class="CustomerQuoteHide" style="border: none"><img src="/css/images/icon-delete.gif" data-toggle="tooltip" data-placement="top" title="delete" ng-click="remove($index,x.id)"></td>

			</tr>
			
			<th colspan="5" class="CustomerQuoteHide"><input ng-show="selectedCustomer" type="button" ng-click="addLine(selectedCustomer.quoteRef)" class="btn btn-primary addnew pull-right" value="Add New"></th>

		</tr>
		<th colspan="5" scope="colgroup" style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
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
	<p>{{selectedCustomer.sales_man}}</p>
</div>
<p><img src="/css/images/email.png" data-toggle="tooltip" data-placement="top" title="Email Quote" style="width:5%; height:5%" ng-click="sendQuote(c.getCustomerQuotes, selectedCustomer.email)" ng-show="selectedCustomer && leadTime"> &nbsp

	<img src="/css/images/pdf.png" style="width:3%; height:3%" ng-show="selectedCustomer && leadTime" onclick="print()" ng-click="printQuote()"></p>
<script type="text/javascript">function print(){
window.print()</script>

</form>
<div class="CustomerQuote">

	<div class="CustomerQuoteLogo" style="size: 80%; line-height: 5px" id="CustQuote" >
		<div id="logo" style="text-align: right; margin-top: -150px">
			<img src="/css/images/ppack.png" >
			<p>Postpack Ltd, Hollis Road,Grantham, NG31 7QH</p>
			<p>Tel: 0845 071 0754</p>
			<p>Email: sales@postpack.co.uk</p>
		</div>
	</div>
	<div class="CustomerQuote">
		<h4>{{selectedCustomer.customer}}</h4>
		<h4>{{selectedCustomer.business}}</h4>
		<h4>{{selectedCustomer.address}}</h4>
		<h4>{{selectedCustomer.contact_no}}</h4>
		<h4>{{selectedCustomer.Cemail}}</h4>
		<br/>
		<p>Dear {{selectedCustomer.customer}}</p>

		<p>Please find below the quotation for the packaging we discussed:</p>
	</div>

		<table class="table" ng-model="send_quote"  style="max-width: 2480px">
			<thead>
				<tr>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
					<th colspan="3" scope="colgroup"style="border:1px solid black"><h3>Quotation</h3></th>
					<th colspan="1" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.quoteRef}}</p></th>				
				</tr>
				
				<tr class="headders" style="">

					<th style="width: 50%">Product Description</th>
					<th style="width: 40%">Product Ref</th>
					<th style="width: 40%">Size</th>
					<th  style="width: 8%">Quantity</th>
					<th  style="width: 5%">Unit (£)</th>
					
				</tr>
		
			</thead>

			<tbody class="quotes">
				<tr ng-repeat="x in c.getCustomerQuotes">
					<td hidden ><input type="" ng-model="x.salesId"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.quote_ref"></td>
					<td hidden> <input type="" ng-model="x.business"></td>

					<td><input maxlength="30" type=""ng-model="x.description"></td>
					<td><input maxlength="20" type="" ng-model="x.ref"></td>
					<td><input type="" ng-model="x.size"></td>
					<td><input type="" ng-model="x.qty"></td>
					<td><input type="" ng-model="x.unit_price"></td>
					
				</div>
				</tr>
			
			<th colspan="5" class="CustomerQuoteHide"><input ng-show="selectedCustomer" type="button" ng-click="addLine(selectedCustomer.quoteRef)" class="btn btn-primary addnew pull-right" value="Add New"></th>

		</tr>
		<th colspan="5" scope="colgroup" style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
	</tbody>
</table>

<p>Delivery lead time for the above: <input type="text" ng-model="leadTime" col="10" ng-required="true"></p>
<p>Delivery Charges: <input type="text" ng-model="deliveryCharges" col="10" ng-required="true"></p>
</div>
<div class="CustomerQuote">

	<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
	<p>Kind Regards,</p>
	<p>{{selectedCustomer.sales_man}}</p>
</div>
</div>
</div>