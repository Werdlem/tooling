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
  }).when("/viewQuote", {
    templateUrl : "/templates/viewQuote.php"
  });


  $locationProvider
  .html5Mode(true)
  .hashPrefix('!');

});

// CUSTOM FILTERs. DROPS DIGITS AFTER 2 DECIMAL PLACES. FOR USE WHEN DISPLAYING FIGURES AS CURRENCY
myApp.filter('dropDigits', function() {
  return function(floatNum) {
    return String(floatNum)
    .split('.')
    .map(function (d, i) { return i ? d.substr(0, 2) : d; })
    .join('.');
  };
});

myApp.filter('dateToISO', function() {
  return function(input) {
    input = new Date(input).toISOString();
    return input;
  };
  });

myApp.filter('sales', function(){
  
})


myApp.controller('viewQuote', function($scope, $location, $http){

 this.search = $location.search();
 qid = this.search.qid;
 cid = this.search.cid;
 $scope.orderRef = qid;

 $scope.lost = [{
  reason: 'Price too high'
},
{
  reason: 'Lead Time'
},
{
  reason: 'Quote took too long'
},
{
  reason: 'No Customer Response'
}];

this.quote = {};

$scope.save = ()=>{

  $http({
  method: 'POST',
  url: './jsonData/quoteClose.json.php',
  data: {data: this.quote}
});
}

$http({
  method: 'POST',
  url: './jsonData/getQuoteByRef.json.php',
  data: cid
}).then((response)=>{
  this.getCustomers = response.data;
});


 $http({
   method: 'POST',
   url: './jsonData/getQuotesById.json.php',
   data: {id: qid}
 }).then((response)=>{
   this.getQuoteById = response.data;

 });

  });

//CARTON CALCULATOR QUOTE APP
myApp.controller('ctnCalculator', function($scope, $http){

 $http({
  method: 'GET',
  url: '/jsonData/getAllSupplierBoardPrices.json.php'
}).then((response)=>{
  this.getSuppliers=response.data;
}); 


   $scope.labourCost = 10;

   $scope.value = 10;
   $scope.min = 1;
   $scope.max = 150;
   Fwidth = 0;
   $scope.margin = 100;


   $scope.addToQuote =()=>{
     $http({
      method:'POST',
      url: '',
      data: {style:$scope.styleSelect.style, grade:$scope.gradeSelect.grade, flute:$scope.fluteSelect.flute, length:$scope.length, width:$scope.width, height:$scope.height, qty:$scope.qty, cost:$scope.cost()}
    });
   };

   $scope.labourCost = 10;


   $scope.calcBlankWidth = function(){
    var res = ($scope.width * $scope.styleSelect.panelW)+($scope.height*1)+($scope.fluteSelect.width) * 2;
    return res
  }

  $scope.calcBlankLength = function(){
    var res = (($scope.length * $scope.configSelect.panelL)+($scope.width * $scope.configSelect.panelW)+($scope.fluteSelect.width * $scope.configSelect.creases)+($scope.glueFlap*1));
    return res
  }

  $scope.boardSqm = function(){

   var sqm = (($scope.calcBlankWidth()*$scope.calcBlankLength())/1000000)*($scope.configSelect.parts);
   if(isNaN(sqm)){

    return 'null';
  }
  return sqm
}

$scope.sheets = function(){
  var shts = ($scope.qty * $scope.configSelect.parts);
  if (isNaN(shts)){
    return 'null';
  }

  return shts
}

$scope.totalSqm = function(){
  var sqm = ($scope.boardSqm()*$scope.qty);
  if(isNaN(sqm)){
    return 'null';
  }
  return sqm
}

$scope.ctnLabourPerPerson = function(){
  var labour = (($scope.qty/8)/$scope.ctnCategory().people);
  return labour;
}

$scope.qtyPerDay = function(){
 var qty = ($scope.ctnCategory().time * 8)
 return qty;
}

$scope.ctnLabour = function(){
  var labour = ((($scope.qty) / ($scope.ctnCategory().qty))*($scope.configSelect.labour));
  return labour;
}

$scope.ctnLabourUnit = function(){
  var labour = ($scope.calcCtnLabourCost()/ $scope.ctnCategory().people)/$scope.qty;
  return labour;
}

$scope.ctnTotalLabour = function(){
  var labour = ($scope.calcCtnLabourCost()/ $scope.ctnCategory().people)/$scope.qty;
  return labour;
}

$scope.materialsCost = function(){
  var cost = ((($scope.boardSqm()*$scope.price)/1000)+ $scope.calcCtnLabourCost()/$scope.qty);
  if(isNaN(cost)){
    return 'null';
  }
  return (Math.round(cost *100)/100);
}

$scope.calcCtnLabourCost = function(){
  var ctnLabour = (($scope.ctnLabour() * 8) * ($scope.ctnCategory().people * $scope.labour));
  return ctnLabour;
}

$scope.cost = function(){
  var cost = ((($scope.boardSqm()*$scope.price)/1000)+$scope.calcCtnLabourCost());
  if(isNaN(cost)){
    return 'null';
  }
  return (Math.round(cost *100)/100);
}

$scope.ctnCategory = function(){
  var sqm = $scope.boardSqm();

  if(isNaN(sqm)){
    return 'null';
  }

  if(sqm < 1) {
    labour = {
      size: 'Sml',
      people: 1,
      qty: 850
    };
    return labour;
  }
  if(sqm > 1 && sqm < 3) {

    labour = {
      size: 'Med',
      people: 2,
      qty: 800
    };
    return labour;
  }
  if(sqm > 3 && sqm < 4) {
   labour = {
        //3M + long board
        size: 'Lrg',
        people: 3,
        qty: 700
      };
      return labour;
    }
    if(sqm > 4 && sqm < 8.5) {
     labour = {
      size: 'Xlrg',
      people: 4,
      qty: 220
    };
    return labour;
  }

}

$scope.ctnCat = [{
  cat: "SMALL",
  labour: 1
},
{
  style: "MEDIUM",
  labour: 2
}];


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
  panelW: 1,
  image: "Css/images/0201C.png"
},
{
  style: "0203",
  panelW: 2,
  image: "Css/images/0203C.png"
}];

$scope.ctnConfig =[{
  config: "4 Panel",
  image: "Css/images/02014P.png",
  labour: 1,
  parts: 1,
  panelL: 2,
  panelW: 2,
  creases: 4,
},
{
  config: "2 Panel",
  image: "Css/images/02012P.png",
  labour:1.4,
  parts: 2,
  panelL: 1,
  panelW: 1,
  creases: 2
}];

$scope.fluteSelect = [{
  flute: 'B',
  width: 0
}];

});
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
      }).then((response)=>{
        window.location.replace("/customerQuote")
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

  $http({
    method:'GET',
    url: "./jsonData/getAllCustomers.json.php"
  }).then((response)=>{
    this.allCustomers = response.data;
  });

});


myApp.controller ('newCustomer', function($scope,$http){

  this.details={};

  $scope.searchCustomer = function(){
    id = $scope.search;
    window.location.replace("/customers?id="+id);
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

 
 

 $http({
  method: 'POST',
  url: './jsonData/getOpenQuotes.json.php',
  data: 1
}).then((response)=>{
  this.getOpenQuotes = response.data;
});

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
    data: {details:$scope.c.getCustomerQuotes, leadTime:$scope.leadTime, comment1: $scope.comment1, comment2: $scope.comment2, comment3: $scope.comment3, 
      email:$scope.selectedCustomer.Cemail,
      salesEmail:$scope.selectedCustomer.sales_email,
      sales_man:$scope.selectedCustomer.sales_man,
      customer:$scope.selectedCustomer.customer,
      deliveryCharges:$scope.deliveryCharges}
    }).then((response)=>{
      this.response = alert(response.data);
      window.location.replace("/customerQuote");
    });
  };  

  $scope.printQuote = function(){
    $http({
      method:'POST',
      url: './jsonData/printQuote.json.php',
      data: {ref:$scope.selectedCustomer.quoteRef}
    }).then((response)=>{
      this.response = alert("printed");
      location.reload();
      
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
  url: './jsonData/getNewQuotes.json.php'
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

myApp.controller('toolQuote', function($scope, $location, $http, $route) {

  $scope.count = 0;
  $scope.myFunctB = function(){
    $scope.imgB = "/css/images/update.png";
  };
  $scope.myFunctW = function(){
    $scope.imgW = "/css/images/update.png";
  }
  $scope.myFunctC = function(){
    $scope.imgC = "/css/images/update.png";
  }
  $scope.myFunctG = function(){
    $scope.imgG = "/css/images/update.png";
  }


  this.search = $location.search();
  tool_id = this.search.id;

  $http({
    method: 'POST',
    url:'/jsonData/getPrices.json.php',
    data: tool_id
  }).then((response)=>{
    this.getPrices = response.data;
  });

  $scope.addLine = function(tool_id,curLine){
    $http({
      method: 'POST',
      url: './jsonData/addLineWebPrice.json.php',
      data: {id}
    }).then((response)=>{
      this.getLastId = response.data;            
      var xx = $scope.e.getPrices[$scope.e.getPrices.length - 1] || {};
      if (!curLine || curLine === xx) {
        $scope.e.getPrices.push({
          id: this.getLastId
        });
      }
    });
  };

  this.colour={};

  $scope.updatePrices = function(){
    $http({
      method: 'POST',
      url: './jsonData/updatePrices.json.php',
      data: {colours:this.e.getPrices, id: tool_id}
    }).then((response)=>{
      $route.reload();
    });
  };

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

$scope.ctnPPU = function(){
  //var ppu = $scope.ctnLabour()+(($scope.newPrice() * $scope.boardSqm())/1000)+($scope.margin/100)*($scope.ctnLabour()+($scope.newPrice() * $scope.boardSqm())/1000)
var ppu = (($scope.newPrice() * $scope.boardSqm())/1000)+($scope.ctnLabourUnit())+(($scope.ctnLabourUnit()+($scope.newPrice() * $scope.boardSqm())/1000) * $scope.margin/100)
  return ppu;
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
}).then((response)=>{
 location.reload();
});
};


this.saveCtnQuote=()=>{
  $http({
    method: 'POST',
    url: '/jsonData/saveCtnQuote.json.php',
    data: {grade:$scope.getSelected()[0]["grade"], 
    details: this.add,
    flute: $scope.fluteSelect.flute,
    style: $scope.styleSelect.style,
    length: $scope.length,
    width:$scope.width,
    height: $scope.height,
    qty: $scope.qty, 
    price: $scope.ctnPPU(),
  }
}).then((response)=>{
 location.reload();
});
}

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
  url: './jsonData/getNewQuotes.json.php'
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