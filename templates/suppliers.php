<div ng-controller="suppliers as s">
	<select ng-model="selectedSupplier" ng-change="change()" ng-options="x.supplier_name for x in s.getSuppliers" ></select>
{{s.getSupplierPrices.price}}

</div>

