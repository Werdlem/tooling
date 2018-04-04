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
 	$scope.search = $location.search();
 	data = $scope.search.id;
 	$http({
 		method: 'POST',
 		url: './jsonData/getToolsById.json.php',
 		data: data
 	}).then(function(response){
 		$scope.getToolById = response.data;
 	});
});
