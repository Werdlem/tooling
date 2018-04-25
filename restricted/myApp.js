var myApp = angular.module('myApp', ['ngRoute'])
.config(function($routeProvider, $locationProvider){
	$routeProvider.when("/", {
		templateUrl : "/templates/home.php"
	})
  .when("/updates", {
    templateUrl : "/templates/updates.php"
  })
	.when("/suppliers", {
		templateUrl : "/templates/suppliers.php"
	})
	.when("/toolEdit", {
		templateUrl : "/templates/toolEdit.php"
		})
	.when("/toolList", {
		templateUrl : "/templates/toolList.php"
  })
  .when("/toolDimSearch", {
    templateUrl : "/templates/toolDimSearch.php"
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
  
    $scope.id = $scope.toolId;
  $scope.added = function(){
    added = {
      added:1,
      id: $scope.id
     }
    $http({
      method: 'POST',
     url: './jsonData/toolAdded.json.php',
     data: added
    });
  };

$http({
      method:'GET',
      url:'../jsonData/getRecentTools.json.php'
       }).then((response)=>{
      this.getRecentTools=response.data;
    });

     $http({
      method:'GET',
      url:'./jsonData/getToolsList.json.php'
    }).then((response)=>{
      this.getToolsList=response.data;
    });

        //set the tolerance variable with the default of 25% 
      $scope.tolerance = 25;
     $scope.calcTolerance = function(){
      var tol = (($scope.tolerance * 1)/100);
      return tol;
     };    
//search for tool length using the range between specified tool lenth and 25% variance
    $scope.filterRangeLength = function(fieldName, minValue, maxValue){
      
       if (minValue === undefined) minValue = Number.MIN_VALUE;
       maxValue = (($scope.searchLength.length * $scope.calcTolerance()) + ($scope.searchLength.length * 1));

  return function predicateFunc(item) {
    return minValue <= item[fieldName] && item[fieldName] <= maxValue;
    };
     	
  };

  $scope.filterRangeWidth = function(fieldName, minValue, maxValue){
      
       if (minValue === undefined) minValue = Number.MIN_VALUE;
       maxValue = (($scope.searchWidth.width * $scope.calcTolerance()) + ($scope.searchWidth.width * 1));

  return function predicateFunc(item) {
    return minValue <= item[fieldName] && item[fieldName] <= maxValue;
    };
      
  };

 $scope.filterRangeHeight = function(fieldName, minValue, maxValue){
      
       if (minValue === undefined) minValue = Number.MIN_VALUE;
      maxValue = (($scope.searchHeight.height * $scope.calcTolerance()) + ($scope.searchHeight.height * 1));

  return function predicateFunc(item) {
    return minValue <= item[fieldName] && item[fieldName] <= maxValue;
    };
      
  };

  //end tool filter search
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

 myApp.controller('toolComments', function($scope, $location, $http, $route) {
 	this.search = $location.search();
  	id = this.search.id;
  	this.comment = {
  		id: id
  	};
 	$http({
 		method: 'POST',
 		url: './jsonData/getComments.json.php',
 		data: id
 	}).then((response)=>{
 		this.getComments = response.data;
 	});
 	//Add comments for selected tool

 	this.submit = ()=>{
 		$http({
 			method: 'POST',
 			url: './jsonData/addComment.json.php',
 			data: this.comment
 		}).then((response)=>{
 		$route.reload();

 	});
 	};
});

 myApp.controller('suppliers', function($scope, $http){
 	$http({
 		method: 'GET',
 		url: '/jsonData/getSuppliers.json.php'
 	}).then((response)=>{
      this.getSuppliers=response.data;
    });	
   
    $scope.change = ()=>{
    	id = $scope.selectedSupplier.supplier_id;
    	$http({
 		method: 'POST',
 		url: './jsonData/getSupplierPrices.json.php',
 		data: id
 	}).then(function(response){
 		$scope.getSupplierPrices = response.data;
 	});
 	id = $scope.selectedSupplier.supplier_id;
    	$http({
 		method: 'POST',
 		url: './jsonData/getBoard.json.php',
 		data: id
 	}).then(function(response){
 		$scope.getBoard = response.data;
 	});
    };

   });
