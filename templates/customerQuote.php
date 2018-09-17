<div ng-controller="customerQuote as c">	

	<h1>Pending Quotes</h1>
<style type="text/css">
.quotes input{
	width: 100%;
    box-sizing: border-box;
    padding: 2px 5px;
    height: 25px;
    border: none;
    text-align: center;
}
	.headders{background-color: #fd6b6b}
	.table th,.table td{border:1px solid black; text-align: center}
	
</style>
<?php $date = date('d-m-Y') ?>
<button type="button" class="btn btn-info btn-sl" data-toggle="modal" data-target="#myModal" ng-click="saveQuote = true">New Quote</button>


<br/>
<!-- Modal -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">New Customer</h2> 
      </div>
      <div class="modal-body">
<p ><input ng-model="newQuote.details.customer" placeholder="contact name" ></p>
<p><input  ng-model="newQuote.details.contact_no" placeholder="contact number"></p>
<p><input ng-model="newQuote.details.business" name="email" placeholder="business name"></p>
<p><input ng-model="newQuote.details.email" name="" placeholder="email" ></p>
<p><input  ng-model="newQuote.details.address" name="" placeholder="address"></p>
<p><select ng-model="newQuote.details.sales_man" ng-options="x.sales_man for x in c.getSalesMan">
<select ng-model="newQuote.salesId" ng-options="x.sales_man for x in c.getSalesMan"> </select></p>
<button type="button" class="btn btn-info btn-lg" ng-click="addCustomer()" >Save</button>
</p>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
   </h2>

</div><br/>




<p>Customer: <select ng-model="selectedCustomer" ng-change="change()" ng-options="x.customer for x in c.getQuotesCustomers" ></select></p>
<h4>{{selectedCustomer.customer}}</h4>
<h4>{{selectedCustomer.business}}</h4>
<h4>{{selectedCustomer.address}}</h4>
<h4>{{selectedCustomer.contact_no}}</h4>
<h4>{{selectedCustomer.email}}</h4>
<br/>
<br/>

<p>Dear {{selectedCustomer.customer}}</p>

<p>Please find below the quotation for the packaging we discussed:</p>

		<table class="table" ng-model="send_quote">
			<thead>
			<tr>
				<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
				<th colspan="3" scope="colgroup"style="border:1px solid black"><h3>Quotation</h3></th>
				<th colspan="2" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.quote_ref}}</p></th>				
			</tr>
			<tr class="headders">
				
				<th>Product Description</th>
				<th>Product Ref</th>
				<th>Size</th>
				<th>Quantity</th>
				<th>Unit</th>
				<th>Price</th>
			</tr>
		</thead>

		<tbody class="quotes">
			<tr ng-repeat="x in c.getCustomerQuotes">
				<td hidden ><input type="" ng-model="x.salesId"></td>
				<td hidden> <input type="" ng-model="x.quote_ref"></td>
				<td hidden> <input type="" ng-model="x.quote_ref"></td>
				<td hidden> <input type="" ng-model="x.business"></td>
				
			<td ><input type="" ng-model="x.description"></td>
			<td><input type="" ng-model="x.ref"></td>
			<td><input type="" ng-model="x.size"></td>
			<td><input type="" ng-model="x.qty"></td>
			<td><input type="" ng-model="x.unit_price "></td>
			<td><input type="" ng-model="x.total_price = x.unit_price*x.qty |currency: '£'"></td>
			<td><img src="/css/images/update.png" style="width:20px; height:20px" ng-click="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.total_price,x.description,x.customer,x.salesId,x.quote_ref,x.address,x.business)" data-toggle="tooltip" data-placement="top" title="Update"></td> 

			<td><img src="/css/images/icon-delete.gif" data-toggle="tooltip" data-placement="top" title="delete" ng-click="remove($index,x.id)"></td>

		</tr>
			
			<th colspan="6"><input ng-show="selectedCustomer" type="button" ng-click="addLine()" class="btn btn-primary addnew pull-right" value="Add New"></th>

		</tr>
		<th colspan="6" scope="colgroup"style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
	</tbody>

		</table>
		<p>Delivery lead time for the above: <input type="text" ng-model="leadTime" col="10" ng-required="true">.</p>
		<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment1"></textarea></p>

		<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment2"></textarea></p>

		<p><textarea rows="2" style="width: 900px" placeholder="Additional comments" ng-model="comment3"></textarea></p>

		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind Regards,</p>
		<p>{{selectedCustomer.sales_man}}</p>
<p><img src="/css/images/email.png" data-toggle="tooltip" data-placement="top" title="Email Quote" style="width:5%; height:5%" ng-click="sendQuote(c.getCustomerQuotes)" ng-show="selectedCustomer && leadTime"></p>

</form>

</div>

