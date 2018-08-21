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
	th,td{border:1px solid black; text-align: center}
	
</style>
<?php $date = date('d-m-Y') ?>

Customer: <select ng-model="selectedCustomer" ng-change="change()" ng-options="x.customer for x in c.getQuotesCustomers" ></select>
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
				<td hidden><input type="" ng-model="x.sales"></td>
				<td hidden> <input type="" ng-model="x.quote_ref"></td>
				
			<td ><input type="" ng-model="x.description"></td>
			<td><input type="" ng-model="x.ref"></td>
			<td><input type="" ng-model="x.size"></td>
			<td><input type="" ng-model="x.qty"></td>
			<td><input type="" ng-model="x.unit_price "></td>
			<td><input type="" ng-model="x.total_price = x.unit_price*x.qty |currency: '£'"></td>
			<td><img src="/css/images/update.png" style="width:20px; height:20px" ng-click="updateLine(x.id,x.ref, x.size, x.qty, x.unit_price,x.total_price,x.description,x.customer,x.sales,x.quote_ref)" data-toggle="tooltip" data-placement="top" title="Update"></td> 

			<td><img src="/css/images/icon-delete.gif" data-toggle="tooltip" data-placement="top" title="delete" ng-click="deleteLine(x.id)"></td>

		</tr>
			
			<th colspan="6"><input ng-show="selectedCustomer" type="button" ng-click="addLine()" class="btn btn-primary addnew pull-right" value="Add New"></th>

		</tr>
		<th colspan="6" scope="colgroup"style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
	</tbody>

		</table>
		<p>Delivery lead time for the above: <input type="text" ng-model="leadTime" col="10">.</p>

		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind Regards,</p>
		<p>{{selectedCustomer.sales}}</p>
<p><img src="/css/images/email.png" data-toggle="tooltip" data-placement="top" title="Email Quote" style="width:5%; height:5%" ng-click="sendQuote(c.getCustomerQuotes)" ng-show="selectedCustomer"></p>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" ng-click="addLine = true">Add Product</button>


<!-- Modal -->
<form id="add_new_line" ng-submit="c.submit()">
<div id="myModal" class="modal fade" ng-show="addLine">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Add New Line</h2>
        
      </div>
      <div class="modal-body">
      	<p><input type=""  ng-model="selectedCustomer.customer"></p>
      	<p><input type="" hidden ng-model="selectedCustomer.reference"></p>
      	<p><input type="" hidden ng-model="selectedCustomer.sales"></p>
      	<p><input placeholder="ref" type="text" ng-model="c.add.ref" size="10" autofocus="autofocus" /></p>
      	<p><input placeholder="description" type="text" ng-model="c.add.description" size="10" autofocus="autofocus" /></p>
<p><input placeholder="size" type="text" ng-model="c.add.size" size="10" autofocus="autofocus" /></p>
<p><input placeholder="qty" type="text" ng-model="c.add.qty" size="10" autofocus="autofocus" /></p>
<p><input placeholder="unitPrice" type="text" ng-model="c.add.unitPrice" size="10" autofocus="autofocus" /></p>
<p><input disabled placeholder="totalPrice" type="text" ng-value="c.add.unitPrice*c.add.qty" size="10" autofocus="autofocus" /></p>
<p><input placeholder="date" hidden type="text" ng-model="c.add.date" size="10" autofocus="autofocus" /></p>
<button type="submit" id="submit" value="Submit" >Save</button>
</div>
</form>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div>


</div>
