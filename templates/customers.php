<div ng-controller="customer as c">
	<h3>Customer Details</h3>
	<style type="text/css">
		input{border:none; width: 200px;}
	</style>

<p><label>Name: </label> <input type="" ng-model="c.getCustomers.customer"></p>
<p><label>id:</label><input type="" ng-model="c.getCustomers.id"></p>
<p><label>Business Name: </label><input type="" ng-model="c.getCustomers.business"></p>
<p><label>Email: </label> <input type="" ng-model="c.getCustomers.email"></p>
<p><label>Contact No: </label> <input type="" ng-model="c.getCustomers.contact_no"></p>
<p><label>Address Line 1:</label> <input type="" ng-model="c.getCustomers.address_line_1"></p>
<p><label>Address Line 2:</label> <input type="" ng-model="c.getCustomers.address_line_2"></p>
<p><label>Address Line 3:</label> <input type="" ng-model="c.getCustomers.address_line_3"></p>
<p><label>Postcode: </label> <input type="" ng-model="c.getCustomers.postcode"></p>

<table>
	<thead>
		<th>Past Orders</th>
	</thead>
	<tr ng-repeat="x in c.getQuotes">
		<td>{{x.quote_ref}}</td>
	</tr>


</table>

</div>