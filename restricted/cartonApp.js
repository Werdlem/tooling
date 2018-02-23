var app = angular.module('quoteApp', []);
app.controller('styleController', function($scope, $http) {
    
        $scope.margin =[{
          ref: 'Nil',
    	margin: 0
    },
    {
          ref: '10%',
      margin: .10
    },
    {
      ref: '20%',
    	margin: .20
    },
    {
      ref: '30%',
     	margin: .30
     },
     {
      ref: '40%',
     	margin:.40
     },
      {
        ref: '50%',
     	margin: .50
     },
      {
        ref: '60%',
     	margin: .60
     },
      {
        ref: '70%',
     	margin: .70
     },
      {
        ref: '80%',
     	margin: .80
     },
      {
        ref: '90%',
     	margin: .90
     },
      {
        ref: '100%',
     	margin: 1
     },
     {
        ref: '125%',
      margin: 1.25
     },
     {
        ref: '150%',
      margin: 1.5
     },
     {
        ref: '175%',
      margin: 1.75
     },
     {
        ref: '200%',
      margin: 2
     }];

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

     $scope.salesMen=[{
      name: "Mark Reid"
     },
     {
       name: "Steve Chambers"
     },
      {
        name: "Lewis Reid"
      },
      {
         name: "Neil Blanchard"
      },
      {
       name: "Shane Munton"
      }];  
    $scope.machineTrim = 100;
    $scope.today = new Date();
    $scope.panelTrim = 7;
    $scope.glueFlap = 40;
    $scope.labour = 10;
    $scope.date = new Date();
    $scope.delivery = .45;
    $scope.math = window.Math;
    $scope.company=[{
                name: "Postpack",
                logo: "/Css/images/postpack.png",
                address: "Hollis Road, Grantham Lincolnshire NG31 7QH",
                contact: "Tel: 0845 071 0754 Fax: 0845 071 0759",
                email: " Email: sales@postpack.co.uk"
              },
              {
                name: "Damasco",
                logo: "/Css/images/dam.png",
                address: "Hollis Road, Grantham Lincolnshire NG31 7QH",
                contact: "Tel: 0845 071 0754 Fax: 0845 071 0759",
                email: " Email: sales@damasco.co.uk"
              }];


       //**********************JOB SHEET CALCULATIONS*********************************//

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
      
      //Carton Grade Specs

    $scope.cartonGrade = function(){
      var grade = $scope.selectedGrade.grade.substr(0, 4)+ '/' + $scope.selectedFlute.flute + '/' + $scope.selectedGrade.grade.substr(5, 4);
     
     return grade;
           
    };

    //CALCULATE DECKLE

      $scope.boardDeckle = function(){
      var res =($scope.calcChopCrease1()* 2 +(+$scope.height) + (+$scope.selectedFlute.width * $scope.selectedStyle.creaseDeckle));      
      if(isNaN(res)){
        return null;
      }
      return res;
    };


       
        // calculate the chop length
    $scope.boardChop = function(){
    	var res =(($scope.selectedStyle.length * $scope.length )+($scope.selectedStyle.width * $scope.width) + (+$scope.selectedFlute.width * $scope.selectedStyle.creaseChop));
    	if (isNaN(res)){
        return null;
      }
      return res;
    };

    
   $scope.setupConfig = function(){
     var res = $scope.cartonConfigChop();
      if ($scope.cartonConfigChop() > 1300){
       var length = $scope.calcDeckleLength();
       var width = $scope.calcDeckleWidth();
       return ("2 Panel carton");
      }

      var length = $scope.calcDeckleLength();
       var width = $scope.calcDeckleWidth();
       return ("4 Panel Carton");
     }


    //CALCULATE CARTON CONFIG
   $scope.cartonConfigChop = function(){
      var res = (($scope.boardChop() / $scope.selectedPanelConfig.score) - $scope.panelTrim + (+$scope.selectedStyle.glueFlap))
     if(isNaN(res)){
          return null;
        }
        
        return res;
    };

    //highlight board that is too big for us to process

    $scope.boardChopMax = function(){
      var res = $scope.cartonConfigChop();
      
      if((res) > 2300){
        return{ color: "red"}
      }
    }


        // calculate the square Meter per carton
    $scope.calcSqMperBox = function(){
       if ($scope.selectedPanelConfig.config == "2 Panel"){
        var res = ($scope.boardDeckle() * $scope.cartonConfigChop() * 2)
         /1000000;
       }
       else{
        var res = $scope.boardDeckle() * $scope.cartonConfigChop()
         /1000000;
       }
        if(isNaN(res)){
          return null;
        }
         
        return res;
    };
        // calculate the square meters of total carton quantity
    $scope.calcSqMperBoxQty = function(){
        var res = $scope.calcSqMperBox() * $scope.qty;
        if (isNaN(res)) {
            return null;
        }
        return res;
    };

    //calculate number of sheetboard based on carton configuration
    $scope.calQtyReq = function(){
      var res = $scope.cartonConfigChop();
      if ($scope.selectedPanelConfig.config == '2 Panel'){
        return $scope.qty * 2;      
      }
      return $scope.qty;
     }

     //calculate board cost for total sqm of carton
$scope.calcBoardCost = function(){
      var res = ($scope.calculateCostPerUnit() * $scope.qty);
      if(isNaN(res)){
        return null;
      }
      return res;
      };

      //calculate cost of the order
 $scope.calculateCost = function(){
      var res =($scope.calculateCostPerUnit()) * $scope.qty;
          if(isNaN(res)){
            return null;
          }
          return res;
    };

    //calculate cost per unit based on sqm

$scope.calculateCostPerUnit = function(){
      var res =(($scope.cost / 1000) * $scope.calcSqMperBox());
          if(isNaN(res)){
            return null;
          }
          return Math.round(res * 100)/100;
    };

    //calculate total cost per unit (labour+margin+materials)

    $scope.calcSaleCostPerUnit = function(){
      var res = $scope.calcTotalCostPerUnit() + $scope.calcMarginPerUnit();
          if(isNaN(res)){
            return null;
          }
          return res;
    };
    $scope.calcTotalCostPerUnit = function(){
      var res = ($scope.calculateCost() + $scope.calcLabour())/$scope.qty;
          if(isNaN(res)){
            return null;
          }
          return Math.round(res * 100)/100;
    };

    //calculate the total margin 

    $scope.calculateMargin = function(){
      var res= $scope.calcMarginPerUnit() * $scope.qty;
      if(isNaN(res)){
        return null;
      }
      return res;
    };

    //calculate margin per unit

    $scope.calcMarginPerUnit = function(){
      var res= $scope.calcTotalCostPerUnit() * $scope.selectedMargin.margin;
      if(isNaN(res)){
        return null;
      }
      return Math.round(res*100)/100;
    };

    // calculate total ex vat - total margin + total labour + total delivery + materials cost total

     $scope.calcTotal = function(){
      var res = ($scope.calculateCost() + $scope.calcLabour());
      if(isNaN(res)){
        return null;
      }
      return res;
    };

     $scope.calcSaleCostTotal = function(){
      var res = ($scope.calculateCost() + $scope.calculateMargin()+ $scope.calcLabour());
      if(isNaN(res)){
        return null;
      }
      return res;
    };

    //calculate time per carton based on category and quantity per hour

    $scope.calcTime = function(){
      var res = ($scope.qty / $scope.selectedCategory.qtyPerHour);
      if(isNaN(res)){
        return null;
      }
      return res;
    };

    //calculate the labour * time taken for job

    $scope.calcLabour = function(){
      var res = ($scope.labour * $scope.labourTime);
      if(isNaN(res)){
        return res;
      }
      return res;
    }

    //calculate labour per unit

     $scope.calcLabourPerUnit = function(){
      var res = (($scope.labour * $scope.labourTime) / $scope.qty);
      if(isNaN(res)){
        return res;
      }
      return Math.round(res *100)/100;
    }

    //calculate delivery per unit

    $scope.calcDelivery = function(){
      var res = $scope.delivery * $scope.miles * 2;
      if(isNaN(res)){
        return null;
      }
      return res;
    }

            // calculate the Chop creasing positions
    $scope.calcChopCrease1 = function(){
     var res = ($scope.width * $scope.selectedStyle.breadth + (+$scope.selectedFlute.width / 2));
      if(isNaN(res)){
        return null;
      }
      return Math.ceil(res);
      }
    // check whether Chop Crease 1 is greater than 600mm

    $scope.checkChopCrease1 = function(){
        var res = $scope.calcChopCrease1();

      if((res) > 600){
        return{ color: "red"}
      }
    }

    $scope.calcChopCrease2 = function(){
      var res = (($scope.selectedFlute.width *2) +(+$scope.height));
      
      if (isNaN(res)){
        return null;
      }
      return Math.ceil(res)
    };

    $scope.glueFlap = function(){
      var res = $scope.selectedCategory.glueFlap;
        if(isNaN(res)){
          return null;
        }
        return res + ' (Crease 1)';
    };
    $scope.calcDeckleLength = function(){
      var res = (($scope.selectedFlute.width * 1 ) + (+$scope.length));
       if (isNaN(res)){
        return null;
       }
       return res;
     };
     $scope.calcDeckleWidth = function(){
      var res = (($scope.selectedFlute.width * 1 ) + (+$scope.width));
      if(isNaN(res)){
        return null;
      }
      return res;
      };

     //Calculate internal Dimms
     $scope.internalDimms = function(){
      var res = $scope.selectedCarton.length + "x" + $scope.selectedCarton.width + "x" + $scope.selectedCarton.height;
      if (isNaN(res)){
        return null;
      }
      return res;
     }

      
              // END

          // Calculate the sheetboard blank size
    $scope.sheetBoardSize = function(){
        var res = $scope.boardDeckle();
        if (isNaN(res)) {
            return null;
        }
        return res;
    };

    $scope.quoteRefGroup = function(){

      return $scope.quotes;

    };

    //calculate the total quote amount

    $scope.calcQuoteTotal = function(){
      var res = $scope.quoteTotal
       
      return res;
    };
 

    $scope.printSheet = function(jobSheet) {
  var printContents = document.getElementById(jobSheet).innerHTML;
  var popupWin = window.open('', '_blank', 'width=600,height=600');
  popupWin.document.open();
  popupWin.document.write('<html><head><link rel="stylesheet" type="text/css"/></head><body onload="window.print()">' + printContents + '</body></html>');
  popupWin.document.close();
};

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
