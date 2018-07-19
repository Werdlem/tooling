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
  .when("/toolQuote", {
    templateUrl : "/templates/toolQuote.php"
    })
  .when("/toolDimSearch", {
    templateUrl : "/templates/toolDimSearch.php"
	});


	$locationProvider
	.html5Mode(true)
	.hashPrefix('!');
	
});

// CUSTOM FILTER. DROPS DIGITS AFTER 2 DECIMAL PLACES. FOR USE WHEN DISPLAYING FIGURES AS CURRENCY
myApp.filter('dropDigits', function() {
    return function(floatNum) {
        return String(floatNum)
            .split('.')
            .map(function (d, i) { return i ? d.substr(0, 2) : d; })
            .join('.');
    };
});


myApp.controller('priceBreak', function($scope, $http){
  
  
    $http({ 
      method: 'GET',
     url:'./jsonData/getFlute.json.php'
    }).then((response)=>{
      this.getFlute=response.data;
      });

     $http({ 
      method: 'GET',
     url:'./jsonData/getGrade.json.php'
    }).then((response)=>{
      this.getGrade=response.data;
      });

this.price = {};
this.submit =()=>{
    $http({
      method: 'POST',
      url: './jsonData/addPriceBreak.json.php',
    data: this.price
  }).then((response)=>{
$route.reload();
});
};
 });

myApp.controller('sheetBoard', function($scope, $http){
  this.grade = {};
  this.addGrade = ()=>{
    $http({
    method: 'POST',
      url:'./jsonData/addSheetBoard.json.php',
      data: this.add
    });
   };

   this.supplier = {};
  this.addSupplier = ()=>{
    $http({
    method: 'POST',
      url:'./jsonData/addSheetBoard.json.php',
      data: this.supplier
    });
   };

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
    this.tool = {};
    $scope.added = function(tool){
      $http({
        method: 'POST',
        url: './jsonData/toolAdded.json.php',
        data: {id: tool.id, added: tool.added}
      });
    };

$http({
      method:'GET',
      url:'../jsonData/getRecentTools.json.php'
       }).then((response)=>{
      this.getRecentTools=response.data.map(function(tool){
        tool.added = tool.added == "1";
        return tool;
      });
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

 myApp.controller('toolQuote', function($scope, $location, $http) { 

  $http({
    method: 'GET',
    url: '/jsonData/getAllSupplierBoardPrices.json.php'
  }).then((response)=>{
      this.getSuppliers=response.data;
    }); 


    $http({
    method: 'GET',
    url: '/jsonData/getSuppliers.json.php'
  }).then((response)=>{
      this.getSuppliersName=response.data;
    }); 


  $scope.getSelected = function () {
  var ar = this.e.getSuppliers.filter(
    function (value) {
      if (value.checked == 1) {
        return true;
      } else {
        return false;
      }
    });
    
  console.log(ar);
  return ar;
};

  this.search = $location.search();
    id = this.search.id;
    $scope.trimWidth = 25;
    $scope.trimLength = 25;
    $scope.labourPrice = 16;
   // $scope.labour = $scope.e.getToolById.config;
    $scope.markUp = 20;

    $scope.calcLabourPerRun = function(){
      var run = ($scope.labourPrice / $scope.e.getToolById.config)
      return run;
    }

  
    $scope.calcCostPerUnit = function(){
      var res = ($scope.e.getSuppliers.min);
      return res;
    }

   $scope.calcLabour = function(){
      var labour = ($scope.labourPrice / $scope.e.getToolById.config)/100;

      return labour;
    }

     $scope.calcUnitSQMWidth = function(){
    var sqm = (($scope.e.getToolById.ktok_width*1)+($scope.trimWidth*1));
    if(isNaN(sqm)){
      return null;
    };
    return sqm;

  };

  $scope.calcUnitSQMLength = function(){
    var sqm = (($scope.e.getToolById.ktok_length*1)+($scope.trimLength*1));
    if(isNaN(sqm)){
      return null;
    };
    return sqm;

  };
    
  $http({
    method: 'POST',
    url: './jsonData/getToolsById.json.php',
    data: id
  }).then((response)=>{
    this.getToolById = response.data;

  });

  $http({ 
      method: 'GET',
     url:'./jsonData/getGrade.json.php'
    }).then((response)=>{
      this.getGrade=response.data;
      });

  $scope.calcQty = function(){
    var qty = $scope.qty / $scope.e.getToolById.config;
    if (isNaN(qty)){
      return null;
      };
      return qty;
  };

   $scope.calcSQM = function(){
   var sqm = (((($scope.e.getToolById.ktok_width*1)+ ($scope.trimWidth*1)) * (($scope.e.getToolById.ktok_length*1)+($scope.trimLength*1)))/1000000) * $scope.calcQty();
   if (isNaN(sqm)){
    return null;
   };
   return sqm;
   };
   $scope.calcSheetSQM = function(){
   var sqm = (((($scope.e.getToolById.ktok_width*1)+ ($scope.trimWidth*1)) * (($scope.e.getToolById.ktok_length*1)+($scope.trimLength*1)))/1000000);
   if (isNaN(sqm)){
    return null;
   };
   return sqm;
   };

   $scope.calcQtyReq = function(){
   var sqm = (((($scope.e.getToolById.ktok_width*1)+ ($scope.trimWidth*1)) * (($scope.e.getToolById.ktok_length*1)+($scope.trimLength*1)))/1000000) * 0;
   if (isNaN(sqm)){
    return null;
   };
   return sqm;
   };


  $scope.calcUnitSQM = function(){
    var sqm = ((((($scope.e.getToolById.ktok_width*1)+ ($scope.trimWidth*1)) * (($scope.e.getToolById.ktok_length*1)+($scope.trimLength*1)))/1000000) / $scope.e.getToolById.config);
    if(isNaN(sqm)){
      return null;
    };
    return sqm;

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
