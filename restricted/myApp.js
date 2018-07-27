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
	})
  .when("/ctn_calculator", {
    templateUrl : "/templates/ctn_calculator.php"
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

//////////////////////////CARTON CALCULATOR//////////////

$scope.boardLength = 1690;
 $scope.boardWidth = 1674;
 $scope.labour = 10;
 $scope.ctnStyle = [{
  style: "0201",
  panelW: 1
},
{
  style: "0203",
  panelW: 2
 }];

 $scope.ctnConfig =[{
config: "4 Panel",
parts: 1,
panelL: 2,
panelW: 2
},
{
  config: "2 Panel",
  parts:2,
  panelL: 1,
  panelW: 1
}];

       $scope.calcBoardWidth = function(){
      var res = (($scope.width * $scope.styleSelect.panelW) + ($scope.height *1)+12); 
      if(isNaN(res)){
        return null;
      } 
      if ((res) > $scope.boardWidth){
        return "Too Big";
      }   
     
      return res;
     };

     $scope.calcBoardLength = function(){
      var res = (($scope.width * $scope.configSelect.panelW) + ($scope.length * $scope.configSelect.panelL) + 40+13);
      if(isNaN(res)){
        return null;
      } 
       if ((res) > $scope.boardLength){
        return "Too Big";
      }   

      return res;
     };

     $scope.boardDimms = function(){
      var res = ($scope.calcBoardWidth() + ('mm x ')+ $scope.calcBoardLength()+('mm'));
      if (isNaN(res)){
        return null;
      }
      return res;
     };
     $scope.calcWPerSheet = function(){
      var res = ($scope.boardWidth / $scope.calcBoardWidth()) ;
      if(isNaN(res)){
        return null;
      }
     return Math.floor(res);
     };

     $scope.calcLPerSheet = function(){
      var res = ($scope.boardLength / $scope.calcBoardLength()) ;
      if(isNaN(res)){
        return null;
      }
      return Math.floor(res);
     };

     $scope.calcQtyPerSheet = function(){
      var res = ($scope.calcWPerSheet() * $scope.calcLPerSheet()) / $scope.configSelect.parts;
      if(isNaN(res)){
        return null;
      }
      return res;
     };

     $scope.calcLabourPerUnit = function(){
      var res = $scope.calcLabour() / $scope.qty
      return res;
     }
     $scope.calcCostPerUnit = function(){
      
      var res = ($scope.colourSelect.cost / $scope.calcQtyPerSheet())+ $scope.calcLabourPerUnit();
      return res;
    
     };
     $scope.totalSheets = function(){
      var res = $scope.qty / $scope.calcQtyPerSheet()
      if (isNaN(res)){
        return null;
      }
      return res
     } 

     $scope.boardSqm = function(){
      var sqm = ($scope.calcBoardWidth() * $scope.calcBoardLength())/1000000;
      return sqm
     };
/////END/////
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


$scope.getSelected = function() {
  var ar = this.e.getSuppliers.filter(
    function (value) {
      if (value.checked == 1) {
        return true;
      } else {
        return false;
      }
    });

  return ar;
}; 

$scope.newPrice = function(){
      var res = $scope.getSelected();
      return res;
    }


this.submit = ()=>{
  $http({
  method: 'POST',
  url: '/jsonData/saveQuote.json.php',
  data: {materials:$scope.getSelected()[0], toolDetails: $scope.e.getToolById, unit:$scope.unit}
});
};  

this.search = $location.search();
    id = this.search.id;
    $scope.trimWidth = 25;
    $scope.trimLength = 25;
    $scope.labourPrice = 16;
    $scope.markUp = 100;

    $scope.price = $scope.selectedLine;

    $scope.calcLabourPerRun = function(){
      var run = ($scope.labourPrice / $scope.e.getToolById.config)
      return run;
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
