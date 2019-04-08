<div ng-controller="customer as c">
	<h3>Customer Details</h3>
	<style type="text/css">
		input{border:none; width: 200px;}
	</style>


<form ng-submit="c.submit()">
<p><label>Name: </label> <input type="" ng-model="c.getCustomers.customer"></p>
<p><input hidden disabled type="" ng-model="c.getCustomers.id"></p>
<p><label>Business Name: </label><input type="" ng-model="c.getCustomers.business"></p>
<p><label>Email: </label> <input type="" ng-model="c.getCustomers.Cemail"></p>
<p><label>Contact No: </label> <input type="" ng-model="c.getCustomers.contact_no"></p>
<p><label>Address Line 1:</label> <input type="" ng-model="c.getCustomers.address_line_1"></p>
<p><label>Address Line 2:</label> <input type="" ng-model="c.getCustomers.address_line_2"></p>
<p><label>Address Line 3:</label> <input type="" ng-model="c.getCustomers.address_line_3"></p>
<p><label>Postcode: </label> <input type="" ng-model="c.getCustomers.postcode"></p>
<p><button type="submit" id="submit" value="Submit" class="btn btn-info btn-sml">Update</button></p>
</form>
<br/><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sml">New Quote</button>
<table>
	<thead>
		<th>Past Orders</th>
	</thead>
	<tr ng-repeat="x in c.getPastQuotes">
		<td><a href="/viewQuote?qid={{x.quote_ref}}&cid={{c.getCustomers.id}}">{{x.quote_ref}}</a></td>
	</tr>


</table>

<div id="myModal" class="modal fade">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">New Customer</h2> 
      </div>
      <div class="modal-body">
<p ><input hidden disabled ng-model="c.getCustomers.id" placeholder="contact name" ></p>
<p><label>Salesman: </label><select ng-model="newQuote.details.sales_man" ng-options="x.sales_man for x in c.getSalesMan"></select></p>
<button type="button" class="btn btn-info btn-sml" ng-click="newQuote()" ng-show="newQuote.details.sales_man">Submit</button>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div>