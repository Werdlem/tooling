var app = angular.module('quoteApp', []);
app.controller('styleController', function($scope, $http) {
    
       $scope.panelConfig=[{
      config: "2 Panel",
      score: 2,
      length: 2,
      width:2
    },
    {
      config: "4 Panel",
      score: 1,
      length: 2,
      width:2
     }];

    
    $scope.machineTrim = 100;
    $scope.today = new Date();
    $scope.panelTrim = 5;
    $scope.glueFlap = 40;
    $scope.labour = 10;
    $scope.date = new Date();
    $scope.delivery = .45;
    $scope.math = window.Math;
   

       //**********************JOB SHEET CALCULATIONS*********************************//

       $scope.cartonJsDeckleSpec = function(){
        var res = $scope.calcTram2();
        if (isNaN(res)){
          return null;
        }
        return res;
       }

       $scope.cartonJsChopSpec = function(){
        var res = $scope.calcJsDeckleLength();
        if (isNaN(res)){
          return null;
        }
        return res;
       }

       $scope.selectCartonStyle = function(){
      var res = $scope.selectedCarton.style;

      return res;
     };

       //DECKLE JOB SHEET

        $scope.calcJsDeckleLength = function(){
      var res = (($scope.selectedCarton.fluteWidth * 1 ) + (+$scope.length));
       if (isNaN(res)){
        return null;
       }
       return res;
     };


     $scope.calcJsDeckleWidth = function(){
      var res = (($scope.selectedCarton.fluteWidth * 1 ) + (+$scope.width));
      if(isNaN(res)){
        return null;
      }
      return res;
      };

    //CHOP TRAM

     $scope.calcTram1 = function(){
     var res = ($scope.width * $scope.selectedCarton.breadth) + (+$scope.selectedCarton.fluteWidth) / 2 ;
      if(isNaN(res)){
        return null;
      }
     return Math.ceil(res)
    };

    $scope.calcTram2 = function(){
      var res = (($scope.selectedCarton.fluteWidth * 2) + (+$scope.height));
      if(isNaN(res)){
        return null;
      }
      return Math.ceil(res)
    };

    $scope.chopSlotL = function(){
      var res = (($scope.selectedCarton.length *1) + (+$scope.selectedCarton.fluteWidth*1 ));
      if (isNaN(res)){
        return null;
      }
      return res;
     }

     $scope.chopSlotW = function(){
      var res = (($scope.selectedCarton.width *1) + (+$scope.selectedCarton.fluteWidth*1 ));
      if (isNaN(res)){
        return null;
      }
      return res;
     }

    //**********************JOB SHEET CALCULATIONS END*********************************//
      
      

      // JSON DB data of carton styles
    $http({
        method: 'GET',
        url: './jsonData/styles.json.php'
    }).then(function(response){
        $scope.styles = response.data;
    });

     // JSON DB data of board fluting
    $http({
    	method: 'GET',
    	url: './jsonData/flutes.json.php'
    }).then(function(response){
    	$scope.flutes=response.data;
    });

    // JSON DB data of board grades
    $http({
    	method: 'GET',
    	url: './jsonData/grades.json.php'
    }).then(function(response){
    	$scope.grades=response.data;
    });

     // JSON DB data of board Liners
    $http({
      method: 'GET',
      url: './jsonData/liners.json.php'
    }).then(function(response){
      $scope.liners=response.data;
    });

    $http({
      method: 'GET',
      url: './jsonData/finish.json.php'
    }).then(function(response){
      $scope.finish=response.data;
    });

    $http({
      method: 'GET',
      url: './jsonData/category.json.php'
    }).then(function(response){
      $scope.category=response.data;
    });

    $http({
      method: 'GET',
      url: './jsonData/cartons.json.php'
    }).then(function(response){
      $scope.cartons=response.data;
    });

    //JSON DB QUOTE RETREIVAL

    $http({
      method:'GET',
      url:'./jsonData/quotes.json.php'
    }).then(function(response){
      $scope.quotes=response.data;
    });
    $http({
      method:'GET',
      url:'./jsonData/quoteRefs.json.php'
    }).then(function(response){
      $scope.quoteRefs=response.data;
    });


});
