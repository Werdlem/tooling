var myApp = angular.module('myApp', ['ngRoute','ngFileUpload'])
.config(function($routeProvider, $locationProvider){
	$routeProvider.when("/", {
		templateUrl : "/templates/home.php"
	})
  .when("/production", {
    templateUrl : "/templates/production.php"
  })
  .when("/capacity", {
    templateUrl : "/templates/capacity.php"
  })
  .when("/viewMachine", {
    templateUrl : "/templates/viewMachine.php"
  });


  $locationProvider
  .html5Mode(true)
  .hashPrefix('!');

});


// CUSTOM FILTERs. DROPS DIGITS AFTER 2 DECIMAL PLACES. FOR USE WHEN DISPLAYING FIGURES AS CURRENCY
myApp2.filter('dropDigits', function() {
  return function(floatNum) {
    return String(floatNum)
    .split('.')
    .map(function (d, i) { return i ? d.substr(0, 2) : d; })
    .join('.');
  };
});

myApp.controller('machine', function($scope,$http,$location){

	
	this.search = $location.search();
	machine = this.search.machine;
	date = this.search.date;
	$scope.MachineName = this.search.machine;
	$scope.date = this.search.date;

	$http({
		method:'POST',
		url:'./jsonData/productionSchedule/getMachineData.json.php',
		data:{machine: machine, 
			date:date}
	}).then((response)=>{
		this.getMachineData = response.data;
	});
})

myApp.controller('capacity',function($scope,$http, $location){
		$scope.search =()=>{

			$http({
		method:'POST',
		url:'./jsonData/productionSchedule/getCapacity.json.php',
		data: $scope.dateSelect
	}).then((response)=>{
		this.getCapacity = response.data;
	});
}
});


myApp.controller('getSchedule',function($scope, $http){

	$http({
		method:'GET',
		url:'./jsonData/productionSchedule/getSchedule.json.php'
		}).then((response)=>{
			this.getSchedule = response.data;
		});
	});
myApp.controller('productionSchedule', function($scope, $http, $route){

$scope.schedule =()=>{
	$http({
		method:'POST',
		url:'./jsonData/productionSchedule/schedule.json.php',
		data: {order_id:$scope.details.order_id,
			sku:$scope.details.sku, 
			qty:$scope.details.qty, 
			machine:$scope.machine, 
			duration:$scope.duration, 
			scheduleDate:$scope.scheduleDate}
		}).then((response)=>{
			$('#myModal').modal('hide');
		});

}

	$scope.machines=[{
		id: 1,
		name: 'Machine 1',
		capacity: 480
	},
	{
		id: 2,
		name: 'Machine 2',
		capacity: 480
	},
	{
		id: 3,
		name: 'Machine 3',
		capacity: 480
	},
	{
		id: 4,
		name: 'Machine 4',
		capacity: 480
	},
	{
		id: 5,
		name: 'Machine 5',
		capacity: 480
	},
	{
		id: 6,
		name: 'Machine 6',
		capacity: 480
	},
	{
	id: 7,
	name: 'Autobox',
	capacity: 480},
	{
		id: 8,
		name: 'Loadpoint',
		capacity: 480
	}];

	$scope.showDetails = function(x){
		$scope.details = x;
		$('#myModal').modal('show');
	}

	$scope.search=()=>{
		value = $scope.searchOrder;

	$http({
		method:'POST',
		url:'./jsonData/productionSchedule/productionSchedule.json.php',
		data: {order:value}
		}).then((response)=>{
			this.getSchedule = response.data;
		});
}
});
