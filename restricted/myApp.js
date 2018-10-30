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
  })
   .when("/sendQuote", {
    templateUrl : "/templates/"
  })
  .when("/customerQuote", {
    templateUrl : "/templates/customerQuote.php"
  })
  .when("/quotes", {
    templateUrl : "/templates/quotes.php"
  })
  .when("/upload.php", {
    templateUrl : "/templates/upload.php"
  })
  .when("/newCustomer", {
    templateUrl : "/templates/newCustomer.php"
  })
  .when("/searchCustomer",{
    templateUrl : "/templates/searchCustomer.php"
  })
  .when("/customers", {
    templateUrl : "/templates/customers.php"
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

//CARTON CALCULATOR QUOTE APP
myApp.controller('ctnCalculator', function($scope, $http){

  $scope.calcBlankWidth = function(){
    var res = ($scope.width * $scope.styleSelect.panelW)+($scope.height*1)+($scope.fluteSelect.width * 2);
    return res
  }

  $scope.calcBlankLength = function(){
    var res = (($scope.length * $scope.configSelect.panelL)+($scope.width * $scope.configSelect.panelW)+($scope.fluteSelect.width * $scope.configSelect.creases)+($scope.glueFlap*1));
    return res
  }

  $scope.boardSqm = function(){
    var sqm = ($scope.calcBlankWidth()*$scope.calcBlankLength())/1000000;
    return sqm
  }

   $scope.totalSqm = function(){
    var sqm = ($scope.boardSqm()*$scope.qty);
    return sqm
  }

  $scope.cost = function(){
    var sqm = ((($scope.boardSqm()*$scope.price)/100)*$scope.configSelect.parts);
    return sqm
  }


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

 $scope.glueFlap = 40;
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
panelW: 2,
creases: 4,
},
{
  config: "2 Panel",
  parts:2,
  panelL: 1,
  panelW: 1,
  creases: 2
}];
})
//END
myApp.controller('customer', function($scope,$http,$location){
  //new customer quote 
 
  $scope.newQuote =()=>{   
      $http({
        method: 'POST',
        url: './jsonData/newQuote.json.php',
        data: {customerId:$scope.c.getCustomers.id,
    salesId:$scope.newQuote.details.sales_man.salesId,
    salesInitials:$scope.newQuote.details.sales_man.initials}
        });
    }
$http({
    method:'GET',
    url:'./jsonData/getSalesMan.json.php'
  }).then((response)=>{
    this.getSalesMan = response.data;
  });

this.search = $location.search()
    value = this.search,
  //Update the Customer details
  this.submit = ()=>{
    id = this.search.id;
    $http({
      method: 'POST',
      url: './jsonData/updateCustomer.json.php',
      data: this.getCustomers
    }).then((response)=>{
 this.results = response.data;
if((response.data) == "ERROR")
 {
   alert("There appears to be a problem, does the customer already exist?");
 }
 else{  
   alert("Customer Updated");
   window.location.replace("/customers?id="+id);
  }
});
}


    $http({
      method: 'POST',
      url: './jsonData/getCustomers.json.php', 
      data:  value
    }).then((response)=>{
    this.getCustomers = response.data;
  });


 id = this.search,
    $http({
      method: 'POST',
      url: './jsonData/getPastQuotes.json.php', 
      data:  id
    }).then((response)=>{
    this.getPastQuotes = response.data;
  });


 
$scope.searchCustomer=()=>{
  value = $scope.search;
  $http({
    method:'POST',
    url: "./jsonData/searchAllCustomers.json.php",
    data:  {customer:value}
    }).then((response)=>{
    this.customers = response.data;
  });
}

});

myApp.controller ('searchCustomer', function($scope,$http){
$scope.searchCustomer=()=>{
  value = $scope.search;
  $http({
    method:'POST',
    url: "./jsonData/searchAllCustomers.json.php",
    data:  {customer:value}
    }).then((response)=>{
    this.customers = response.data;
  });
}

});


myApp.controller ('newCustomer', function($scope,$http){

  this.details={};

$scope.searchCustomer = function(){
  id = $scope.search;
  window.location.replace("/customers?customer="+id);
}

$scope.addCustomer = function(){
 
  id = $scope.details.customer;
  $http({
  method: 'POST',
  url: './jsonData/addCustomer.json.php',
  data: this.details
}).then((response)=>{
 this.results = response.data;
if((response.data) == "1062 Duplicate Entry")
 {
   alert("There appears to be a problem, does the customer already exist?");
 }
 else{  
   alert("Customer added!");
   window.location.replace("/customers?customer="+id);
  }
});
}
});

myApp.controller('quotes', function($scope, $http){

  this.quote = {};
  this.x = {};
$scope.result = function(){
      $http({
        method: 'POST',
        url: './jsonData/quoteWonLost.json.php',
        data: {data: this.quote, ref: this.x.quote_ref}
      });
    };

  $scope.reasons=[{
    reason: "Reason A",
    id:1
  },
  {
  reason: "Reason B",
  id: 2
  }];

  $scope.status = [{
  name: "open",
  value: 1
},
{
  name: "closed",
  value: 2
 },
 {
 name: "pending",
 value: 0
}];

  $scope.change = ()=>{
    value = $scope.selectedStatus.value
  $http({
    method: 'POST',
    url: './jsonData/getOpenQuotes.json.php',
    data: value
  }).then((response)=>{
    this.getOpenQuotes = response.data;
  });
}

$http({
    method:'GET',
    url:'./jsonData/getSalesMan.json.php'
  }).then((response)=>{
    this.getSalesMan = response.data;
  });
});

myApp.controller('customerQuote', function($scope,$http){

  $http({
    method:'GET',
    url:'./jsonData/getSalesMan.json.php'
  }).then((response)=>{
    this.getSalesMan = response.data;
  });
this.newQuote={};
$scope.addCustomer = function(){
  $http({
  method: 'POST',
  url: './jsonData/addCustomer.json.php',
  data: {customer:$scope.newQuote.customer,
    data:this.newQuote}
});
};  

     $scope.remove = function(index, id) {
            $scope.deleteLine(id);{
       $scope.c.getCustomerQuotes.splice(index, 1);
                        
                        
                      }
                    }
//add new line to existing quote. function returns last inserted id for use when entering a new line
  $scope.addLine = function(quoteRef,curLine){
    $http({
              method: 'POST',
              url: './jsonData/addLine.json.php',
              data: {quoteRef}
            }).then((response)=>{
              this.getLastId = response.data;            
            var xx = $scope.c.getCustomerQuotes[$scope.c.getCustomerQuotes.length - 1] || {};
            if (!curLine || curLine === xx) {
              $scope.c.getCustomerQuotes.push({
                    id: this.getLastId               
                 });
           }
         });
        };

 $scope.sendQuote = function(){
    $http({
      method:'POST',
      url: './templates/sendQuote.php',
      data: {details:$scope.c.getCustomerQuotes, leadTime:$scope.leadTime, comment1: $scope.comment1, comment2: $scope.comment2, comment3: $scope.comment3}
  }).then((response)=>{
    this.response = alert(response.data);
    //window.location.replace("/customerQuote");
  });
  };  
  

   $scope.updateLine = function(id,ref, size, qty, unit_price,total_price,description,customerId,
    salesId,quoteRef,date){
 
   $http({
   method: 'POST',
    url: './jsonData/updateQuote.json.php',
    data: { id: id,
      size:size, 
      ref:ref,
      qty:qty, 
      unit_price:unit_price, 
      total_price:total_price, 
      description:description,
    salesId: salesId,
      quote_ref: quoteRef,
      customerId: customerId,
      date: date}
  }).then((response)=>{
    this.response = alert('Updated')
  });
 }  

 $scope.deleteLine = function(id){
 
   $http({
   method: 'POST',
    url: './jsonData/deleteLine.json.php',
    data: {id:id}
 });
 } 

 //get pending quotes customer list 
  $http({
    method: 'GET',
    url: './jsonData/getQuotesCustomers.json.php'
    }).then((response)=>{
    this.getCustomers = response.data;
  });
//get pending quotes for customers selected via the drop down on customerQuote.php
    $scope.change = ()=>{
      customer = $scope.selectedCustomer.quoteRef;
      $http({
    method: 'POST',
    url: './jsonData/getQuotes.json.php',
    data: {customer:customer}
  }).then((response)=>{
    this.getCustomerQuotes = response.data;
  });

};
 this.add={};
this.submit =()=>{
    $http({
      method: 'POST',
      url: '/jsonData/addToQuote.json.php',
    data: {data:this.add, 
      customer:$scope.selectedCustomer.customer, 
      ref: $scope.selectedCustomer.quote_ref,
      sales:$scope.selectedCustomer.sales}
  }).then((response)=>{
      this.getCustomerQuotes = response.data;
    });
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
    method:'GET',
    url:'./jsonData/getSalesMan.json.php'
  }).then((response)=>{
    this.getSalesMan = response.data;
  })

  $scope.salesMan = [{
  name: 'Neil Blanchard',
  initials: 'NB'
},
{
  name: 'Lewis Reid',
  initials: 'LR'

}];

//////////////////////////CARTON CALCULATOR//////////////

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

//SAVE SELECTED PRICE STRUCTURE TO QUOTE

$scope.newPrice = function(){
      var res = $scope.getSelected()[0]["price"];
      return res;
    }

$scope.unitPrice = function(){
      var res = ($scope.calcLabour()+(($scope.newPrice() * $scope.calcUnitSQM())/1000)+($scope.markUp/100)*($scope.calcLabour()+($scope.newPrice() * $scope.calcUnitSQM())/1000));
      return Math.floor(res*100)/100;
    }
$scope.totalPrice = function(){
  var total = ($scope.unitPrice() * $scope.qty);

  return total;
}
this.add={};
this.getToolById={}

this.submit = ()=>{
  $http({
  method: 'POST',
  url: '/jsonData/saveQuote.json.php',
  data: {grade:$scope.getSelected()[0]["grade"], 
         details: this.add,
         toolDetails: this.getToolById,
         unitPrice:$scope.unitPrice(),
         totalPrice:$scope.totalPrice(),
         qty: $scope.qty,
                      
}
});
};  


///END
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
    url: './jsonData/getQuotesCustomers.json.php'
    }).then((response)=>{
    this.getCustomers = response.data;
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
