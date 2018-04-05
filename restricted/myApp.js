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

	
$scope.submit = function(){
	data={
		tool_ref: $scope.tool_ref,
		esc_ref: $scope.esc_ref,
		location: $scope.location,
		config: $scope.config,
		style: $scope.style,
		flute: $scope.flute,
		length: $scope.length,
		width: $scope.width,
		height: $scope.height,
		ktok_width: $scope.ktok_width,
		ktok_length: $scope.ktok_length
	}
	$http({
		method: 'POST',
		url:'./jsonData/addTool.json.php',
		data: data
	}).success(function(data){
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
