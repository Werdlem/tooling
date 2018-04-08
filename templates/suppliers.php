<div ng-controller="suppliers as s">
	<select ng-model="selectedSupplier" ng-options="x.supplier_name for x in getSuppliers" ></select>

	{{message}}
</div>

