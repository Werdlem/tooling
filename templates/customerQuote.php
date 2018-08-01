<div ng-controller="customerQuote as c">	
<style type="text/css">
	
	.headders{background-color: #fd6b6b}
	th,td{border:1px solid black; text-align: center}
	
</style>
<?php $date = date('d-m-Y') ?>

Customer: <select ng-model="selectedCustomer" ng-change="change()" ng-options="x.customer for x in c.getQuotesCustomers" ></select>
<br/>
<br/>

		<table class="table">
			<thead>
			<tr>
				<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p> <?php echo $date?></p></th>
				<th colspan="3" scope="colgroup"style="border:1px solid black">Quotation</th>
				<th colspan="2" scope="colgroup"style="border:1px solid black">Quote Ref: <p>{{selectedCustomer.reference}}</p></th>				
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
			<tr ng-repeat="x in c.getCustomerQuotes">
			<td>{{x.style}} {{x.grade}}{{x.flute}}</td>
			<td>{{x.tool_ref}}</td>
			<td>{{x.length}} x {{x.width}} x {{x.height}}mm</td>
			<td>{{x.qty}}</td>
			<td>{{x.unit_price}}</td>
			<td>{{x.total_price}}</td>
		</tr>
		<th colspan="6" scope="colgroup"style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
		</table>

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
      	<p><input type="" hidden ng-model="selectedCustomer.customer"></p>
      	<p><input type="" hidden ng-model="selectedCustomer.reference"></p>
      	<p><input type="" hidden ng-model="selectedCustomer.sales"></p>
      	<p><input placeholder="ref" type="text" ng-model="tool_ref" size="10" autofocus="autofocus" /></p>
      	<p><input placeholder="description" type="text" ng-model="style" size="10" autofocus="autofocus" /></p>
<p><input placeholder="length" type="text" ng-model="length" size="10" autofocus="autofocus" /></p>
<p><input placeholder="width" type="text" ng-model="width" size="10" autofocus="autofocus" /></p>
<p><input placeholder="height" type="text" ng-model="height" size="10" autofocus="autofocus" /></p>
<p><input placeholder="qty" type="text" ng-model="qty" size="10" autofocus="autofocus" /></p>
<p><input placeholder="unitPrice" type="text" ng-model="unitPrice" size="10" autofocus="autofocus" /></p>
<p><input placeholder="totalPrice" type="text" ng-model="totalPrice" size="10" autofocus="autofocus" /></p>
<p><input placeholder="date" type="text" ng-model="date" size="10" autofocus="autofocus" /></p>
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
