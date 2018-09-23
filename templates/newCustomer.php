<div ng-controller="newCustomer as c">	

	<h1>New Customer</h1>
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
	.form-control{width: 30%}

	
</style>

<form>

<p><input class="form-control" ng-model="newQuote.details.customer" placeholder="contact name" ></p>
<p><input class="form-control"  ng-model="newQuote.details.contact_no" placeholder="contact number"></p>
<p><input class="form-control" ng-model="newQuote.details.business" name="email" placeholder="business name"></p>
<p><input class="form-control" ng-model="newQuote.details.email" name="" placeholder="email" ></p>
<p><input class="form-control"  ng-model="newQuote.details.addressLine1" name="" placeholder="address line 1"></p>
<p><input class="form-control" ng-model="newQuote.details.addressLine2" name="" placeholder="address line 2"></p>
<p><input class="form-control" ng-model="newQuote.details.addressLine3" name="" placeholder="address line 3"></p>
<p><input class="form-control" ng-model="newQuote.details.postCode" name="" placeholder="post code"></p>
<p><select class="form-control" ng-model="newQuote.details.sales_man" ng-options="x.sales_man for x in salesMan"></select></p>
{{salesMan}}
<button type="button" class="btn btn-info btn-lg" ng-click="addCustomer()" >Save</button>
