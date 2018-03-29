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
		});

	$locationProvider
	.html5Mode(true)
	.hashPrefix('!');
	
});

myApp.controller('mainController', function($scope, $http) {

	$http({
      method:'GET',
      url:'../jsonData/getRecentTools.json.php'
    }).then(function(response){
      $scope.getRecentTools=response.data;
    });

  });

 myApp.controller('editTool', function($scope, $location, $http) {
 	$scope.search = $location.search();

 	 });
