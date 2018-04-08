var myApp = angular.module('myApp', ['ngRoute'])
.config(function($routeProvider, $locationProvider){
	$routeProvider.when("/", {
		templateUrl : "/templates/home.php"
	})
	.when("/suppliers", {
		templateUrl : "/templates/suppliers.php"
	})
	.when("/toolEdit", {
		templateUrl : "/templates/toolEdit.php"
		})
	.when("/toolList", {
		templateUrl : "/templates/toolList.php"
	});

	$locationProvider
	.html5Mode(true)
	.hashPrefix('!');
	
});

myApp.controller('addTool', function($scope, $http){
	this.tool = {};
	//Add a new tool

	this.submit = ()=>{
		$http({
			method: 'POST',
			url:'./jsonData/addTool.json.php',
			data: this.tool
		}).then((response)=>{
			window.location.replace("/");
		});

	};

});

myApp.controller('toolList', function($scope, $http) {

	$http({
      method:'GET',
      url:'../jsonData/getRecentTools.json.php',
      put: '15'
    }).then(function(response){
      $scope.getRecentTools=response.data;
    });

     $http({
      method:'GET',
      url:'./jsonData/getToolsList.json.php'
    }).then(function(response){
      $scope.getToolsList=response.data;
    });
});

 myApp.controller('editTool', function($scope, $location, $http) {
 	this.search = $location.search();
 	id = this.search.id;
 	$http({
 		method: 'POST',
 		url: './jsonData/getToolsById.json.php',
 		data: id
 	}).then((response)=>{
 		this.getToolById = response.data;

 	});
 	//Update the tool details
 	this.submit = ()=>{
 		$http({
 			method: 'POST',
 			url: './jsonData/updateTool.json.php',
 			data: this.getToolById
 		});
 	};
});

 myApp.controller('toolComments', function($scope, $location, $http) {
 	$scope.search = $location.search();
 	data = $scope.search.id;
 	$http({
 		method: 'POST',
 		url: './jsonData/getComments.json.php',
 		data: data
 	}).then(function(response){
 		$scope.getComments = response.data;
 	});
});

 myApp.controller('suppliers', function($scope, $http){
 	$scope.message = function(){
 		var mess = $scope.selectedSupplier.id;
 		return mess;
 	};
 	$http({
 		method: 'GET',
 		url: '/jsonData/getSuppliers.json.php'
 	}).then((response)=>{
      $scope.getSuppliers=response.data;
    });
 });
