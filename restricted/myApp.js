var myApp = angular.module('myApp', ['ngRoute','ngFileUpload', 'ngCookies'])
.config(function($routeProvider, $locationProvider, $provide){
  var DEFAULT_TIMEZONE = 'GMT';
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
  }).when("/uploads", {
    templateUrl : "/templates/viewQuote.php"
  }).when("/reports", {
    templateUrl : "/templates/reports.php"
  }).when("/orderSchedule", {
    templateUrl : "/templates/orderSched.php"
  }).when("/scheduleList", {
    templateUrl : "/templates/production.php"
  }).when("/capacity", {
    templateUrl : "/templates/capacity.php"
  }).when("/viewMachine", {
    templateUrl : "/templates/viewMachine.php"
  }).when("/orderSearch", {
    templateUrl : "/templates/orderSearch.php"
  }).when("/productionDetails", {
    templateUrl : "/templates/productionDetails.php"
  }).when("/ncr", {
    templateUrl : "/templates/ncr.php"
  }).when("/openNcr", {
    templateUrl : "/templates/openNcr.php"
  }).when("/ncrDetails", {
    templateUrl : "/templates/ncrDetails.php"
  }).when("/closedNcr", {
    templateUrl : "/templates/closedNcr.php"
  }).when("/closedNcrDetails", {
    templateUrl : "/templates/closedNcrDetails.php"
  }).when("/newProduct", {
    templateUrl : "/templates/newProduct.php"
  }).when("/newProductQa",{
    templateUrl : "/templates/pendingSpecSheetList.php"
  }).when("/QaNewProduct",{
    templateUrl : "/templates/newProductQa.php"
  }).when("/specSheet",{
    templateUrl : "/templates/productSpecSheet.php"
  }).when("/productionToolList",{
    templateUrl: "/templates/productionToolList.php"
  }).when("/bespokeCarton",{
    templateUrl: "/templates/bespokeCarton.php"
  });


  $locationProvider
  .html5Mode(true)
  .hashPrefix('!');

});

myApp.filter('inchFilter', function() {
  return function(input) {
    return Math.floor(input * 0.0393701);
  };
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

myApp.controller('autobox', function($scope){

  $scope.styles=[{
    style: '0201',
    panel: 2,
    nPanel:1

  },
  {
    style: '0203',
    panel: 1,
    nPanel:2
  },
  {
  style: '0200',
  panel: 2,
  nPanel:0.5
}];

  $scope.config=[{
    config: '1 Piece',
    panels: 4
  },
  {
    config: '2 Piece',
    panels: 2
  }];

  $scope.flutes=[{
    flute: 'BC',
    width: 6
  },
  {
    flute: 'EB',
    width: 4
  },
  {
    flute: 'B',
    width: 3
  }];

$scope.newDeckle = function(){
  var dec = ($scope.width / $scope.selectedStyle.panel+($scope.height*1)+ ($scope.selectedFlute.width*2));
  return dec;
}
  $scope.blade1 = function(){
    var b1 = ($scope.width/$scope.selectedStyle.panel)+$scope.selectedFlute.width;

    if (b1 < '60'){
      return 'Too small';
    }
    else if (b1 > '445'){
      return 'too big';
    }
    else{
    return b1;
  }
  }

  $scope.blade2 = function(){
    var b2 = ($scope.height*1) + $scope.selectedFlute.width;
    return b2;
  }

  $scope.panel1 = function(){
    var p1 = (($scope.length*1) + ($scope.selectedFlute.width));
    return p1
  }

   $scope.panel2 = function(){
    var p2 = (($scope.width*1) + ($scope.selectedFlute.width));
    return p2
  }
   
   $scope.panel4 = function(){
    var p4 = ($scope.width*1);
    return p4
  }

  $scope.deckle = function(){
    var dec = ($scope.blade1() *2)+$scope.blade2();
    return dec;
  }

  $scope.chop = function(){
    if($scope.selectedPanel.config == '2 Piece')
    {
    var chop = ($scope.panel1() + $scope.panel4())+30;
    return chop;
  }
  else{
    var chop = (($scope.panel1()*2) + ($scope.panel2() + $scope.panel4()))+30;
    return chop;
  }
}
});

myApp.controller('specSheet', function($scope, $location, $http, $timeout,$compile, Upload){

  $http({
    method: 'GET',
    url: './jsonData/getProductionToolList.json.php'
  }).then((response)=>{
    this.list = response.data;

  });
   $scope.products=[{
    id: 1,
    product: 'New Tool'
  },
  {
    id:2,
    product: 'Printed Board'
  },
  {
    id: 3,
    product: 'Tape'
  },{
    id: 4,
    product: 'Finished Carton'
  }];


$scope.change = ()=>{
   toolRef = $scope.selectSpecSheet.toolRef;
   $http({
     method: 'POST',
     url: './jsonData/getSpecSheets.json.php',
     data: {toolRef:toolRef}
   }).then((response)=>{
     this.getSpecSheet = response.data;
   });
 }

  $http({
    method: 'GET',
    url: './jsonData/getSpecSheetList.json.php'
  }).then((response)=>{
    this.getSpecSheetList = response.data
  });

  this.getSpecById = {};
  //Add a new tool

  this.specSubmit = ()=>{
    $http({
      method: 'POST',
      url:'./jsonData/qaNewProduct.json.php',
      data: this.getSpecById
    }).then((response)=>{
    // window.location.replace("/");
   })
    ;

  };

this.search = $location.search();
 id = this.search.id;
 ref = this.search.ref;

$http({
   method: 'POST',
   url: './jsonData/getSpecById.json.php',
   data: id
 }).then((response)=>{
   this.getSpecById = response.data;

 });

 //getting multiple qa artwork

 $http({
   method: 'POST',
   url: './jsonData/getSpecUploadsById.json.php',
   data: {ref:ref}
 }).then((response)=>{
   this.getSpecUploadsById = response.data;

 });


  $http({
    method: 'POST',
    url: '/jsonData/getPendingSpecs.json.php'    
    }).then((response)=>{
       this.getSpecSheets = response.data;
    });

  this.pro = {}

  this.submit = ()=>{
    $http({
      method: 'POST',
      url:'./jsonData/addProductSpec.json.php',
      data: this.pro
    }).then((response)=>{
      this.response = response.data;
      if(response.data == 'Success!'){
        alert('success')
     }
      window.location.reload()
    })
;

  };

  $scope.$watch('files', function () {
  $scope.upload($scope.files);
});
 $scope.$watch('files', function () {
  if ($scope.file != null) {
    $scope.files = [$scope.file]; 
  }
});
 $scope.log = '';
  $scope.upload = function (files) {
  if (files && files.length) {
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      if (!file.$error) {
        Upload.upload({
         url: './jsonData/specUpload.php',
         method:'POST',
         file:file,          
         data: {'specRef' :$scope.np.pro.tool_ref, 
         'QaSpecRef':$scope.np.getSpecById.toolRef,
          'targetPath':'../uploads/'
         }
       }).then(function (resp) {
        $timeout(function() {
          $scope.log = 'file: ' +
          resp.config.data.file.name +
          ', Response: ' + JSON.stringify(resp.data) +
          '\n' +location.reload()+ $scope.log;
        });
      }, null, function (evt) {
        var progressPercentage = parseInt(100.0 *
          evt.loaded / evt.total);
        $scope.log = 'progress: ' + progressPercentage + 
        '% ' + evt.config.data.file.name + '\n' + 
        $scope.log;
      });
     }
   }
 }
}
})

myApp.controller('NonConformance', function($scope,$http,$location, $route){

  $scope.close =(name, ncr)=>{
  $http({
    method: 'POST',
    url: '/jsonData/ncrClose.json.php',
    data: {name:name,
    id:$scope.ncr.getCustomerNcr[0].po,}
    }).then((response)=>{
       window.location.assign("openNcr");
    });
  };
this.search = $location.search();
 id = this.search.orderId; 


  $scope.investigationComment = (investigation,ncr)=>{
    $http({
      method:'POST',
      url:'./jsonData/investigation.json.php',
      data: {text: investigation, 
        id:$scope.ncr.getCustomerNcr[0].po,
        field: 'investigation',
        date:'i_date'
       }
    }).then((response)=>{
       $route.reload();
    });
  }
  $scope.investigationReview = (review,ncr)=>{
    $http({
      method:'POST',
      url:'./jsonData/ncrReview.json.php',
      data: {text: review, 
        id:$scope.ncr.getCustomerNcr[0].po,
        field: 'review',
        date:'i_date',       
       }
    }).then((response)=>{
       $route.reload();
    });
  }
  $scope.prevent = (preventative,ncr)=>{    
    $http({
      method:'POST',
      url:'./jsonData/investigation.json.php',
      data: {text: preventative, 
        id:$scope.ncr.getCustomerNcr[0].po,
        field: 'preventative',
        date: 'p_date'}
    })
  }

  $http({   
    method: 'POST',
    url:'./jsonData/getInvestigation.json.php',
    data: {order_id:id}
  }).then((response)=>{
    this.getInvestigation = response.data;
    });

   $http({   
    method: 'POST',
    url:'./jsonData/getReview.json.php',
    data: {order_id:id}
  }).then((response)=>{
    this.getReview = response.data;
    });

 $http({   
    method: 'POST',
    url:'./jsonData/getCustomerNcr.json.php',
    data: {order_id:id}
  }).then((response)=>{
    this.getCustomerNcr = response.data;
    });

  $http({
    method:'POST',
    url: './jsonData/getOpenNcrs.json.php',
    data:{status: 'CLOSED'}
  }).then((response)=>{
      this.getClosedNcrs = response.data;
    });

  $http({
    method:'POST',
    url: './jsonData/getOpenNcrs.json.php',
    data:{status: 'OPEN'}
  }).then((response)=>{
      this.getNcrs = response.data;
    });

  $scope.entireOrder=[
  {
    id:6,
    field:'problem',
    details: 'Late Delivery'
  },
  {
    id:7,
    field:'problem',
    details: 'NightFreight'
  },
  {
    id:8,
    field:'problem',
    details: 'DPD'
  },
  {
    id:9,
    field:'problem',
    details: 'Yodel'
  },
  {
    id:10,
    field:'problem',
    details: 'Courier Charge'
  },
  {
    id:11,
    field:'problem',
    details: 'Other'
  }];

  $scope.options=[{
    id: 1,
    field:'problem',
    details: 'Not Received'
  },
  {
    id:2,
    field:'problem',
    details:'Damaged'
  },
  {
    id:3,
    field:'problem',
    details:'Incorrect Qty'

  },
  {
  id:4,
  field:'problem',
    details:'Incorrect Product'

  },
  {
    id:5,
    field:'problem',
    details: 'Faulty Product'
  }];

  $scope.corrective=[{
    id:1,
    field:'correction',
    details: 'Refund'
  },
  {
    id:2,
    field:'correction',
    details: 'Replacement'
  }];

  $scope.addNCRline = (nc,x)=>{
    $http({
      method: 'POST',
      url: './jsonData/ncrAdded.json.php',
      data: {nc:nc,
        id: x.item_id,
        po: x.order_id, 
        added: x.nc,
        sku: x.sku,
        desc1: x.desc1,
        qty: x.qty,
        customerName: x.customer}
    });
  };
  $scope.addNCRlineEntire = (y,z,description,initial,getOrder)=>{
    $http({
      method: 'POST',
      url: './jsonData/ncrAddEntirePo.json.php',
      data: {nc:'true',
        id: this.getOrder[0].item_id,
        po: this.getOrder[0].order_id, 
        added: null,
        sku: 'ENTIRE ORDER',
        desc1: description,
        qty: null,
        customerName:this.getOrder[0].customer,
        issue:y.details.details,
        action:z.details.details,
        initials: initial}
    }).then((response)=>{
      this.getResponse = response.data;
      if (this.getResponse == 'success'){
        alert('Success');
        window.location.reload();
      }
    });
  };

  $scope.searchOrder =()=>{
  // $scope.findOrder = 'P236001';
  $http({
    method:'POST',
    url:'./jsonData/findOrder.json.php',
    data: {order:$scope.findOrder}
    }).then((response)=>{
      this.getOrder = response.data;
    });
  }
$scope.saved = ()=>{
 alert("Ncr Saved");
 window.location.reload();
}

  $scope.updateLine =(y,x,z)=>{

  $http({
    method:'POST',
    url:'./jsonData/updateNcrStep2.json.php',
    data: {field:y.details.field,
      details:y.details.details,
      id:x.item_id}
  })
  }
  
  $scope.updatePdesc =(x,p_desc)=>{

  $http({
    method:'POST',
    url:'./jsonData/updateNcrStep2.json.php',
    data: {field:'p_desc',
      details:p_desc,
      id:x.item_id}
  })
  }

})


myApp.controller('machine', function($scope,$http,$location){

  
  this.search = $location.search();
  machine = this.search.machine;
  date = this.search.date;
  $scope.MachineName = this.search.machine;
  $scope.date = this.search.date;

  $http({
    method:'POST',
    url:'./jsonData/getMachineData.json.php',
    data:{machine: machine, 
      date:date}
  }).then((response)=>{
    this.getMachineData = response.data;
  });
})

myApp.controller('capacity',function($scope,$http, $location){
    $scope.search =()=>{

      $http({
    method:'POST',
    url:'./jsonData/getCapacity.json.php',
    data: $scope.dateSelect
  }).then((response)=>{
    this.getCapacity = response.data;
  });
}
});


myApp.controller('getSchedule',function($scope, $http, $location){

  this.search = $location.search();
 date = this.search.date;
 $scope.date = this.search.date;

$http({
    method:'POST',
    url:'./jsonData/getScheduleDetails.json.php',
    data: {date:date}
    }).then((response)=>{
      this.getScheduleDetails = response.data;
    });

 
 $scope.selectDepartment =()=>{

  $http({
    method:'POST',
    url:'./jsonData/getSchedule.json.php',
    data: {department:$scope.department.department,
      capacity: $scope.department.capacity}
    }).then((response)=>{
      this.getSchedule = response.data;
    });
  }
    $scope.departments=[{
   
    department: 'Factory',
    capacity: 1440,
    staff: 5,
    machines: 5,
    notes: '2 machines reserved for postpack website orders. Remaining 3 machines are avaliable for scheduling with account customers taking priority over "one-off" orders'
  },
  {
 
  department: 'Autobox',
  capacity: 480,
  staff: 2,
  machines: 1,
  notes: 'NA'
},
 
  {

    department: 'Loadpoint',
    capacity: 480,
    staff:1,
    machines: 1,
    notes: 'Machine used for quantities in excess of 700 units. Scheduled jobs will be run until job is completed. Machine will not stopped mid-job!!'
  
  }];
  });
myApp.controller('productionSchedule', function($scope, $http, $route){

$scope.capacity =()=>{
  date = new Date($scope.scheduleDate).toUTCString();
     $http({
    method:'POST',
    url:'./jsonData/getCapacity.json.php',
    data: {date:date,
      dep:$scope.department.name}
  }).then((response)=>{
    this.getCapacity = response.data;
  });
}


  $scope.capacityCheck = ()=>{
    var cap = ($scope.ps.getMachineCapacity.capacity*1) + ($scope.duration*1);
    if((cap) = null){
      cap = 1440;
      return cap;
    }
    return cap;
  }

  $scope.checkMachine =()=>{
    machine = $scope.machine.name;
    date = $scope.scheduleDate;
    capacity = $scope.machine.capacity;
    $http({
      method: 'POST',
      url: './jsonData/machineCapacity.json.php',
      data:{machine: machine, 
      date:date,
      capacity:capacity
    }
  }).then((response)=>{
    this.getMachineCapacity = response.data;
  });
  }

$scope.schedule =()=>{

  
  $http({
    method:'POST',
    url:'./jsonData/schedule.json.php',
    data: {order_id:$scope.details.order_id,
      sku:$scope.details.sku, 
      qty:$scope.details.qty, 
      department:$scope.department, 
      duration:$scope.duration, 
      scheduleDate:$scope.scheduleDate,
      itemId: $scope.details.item_id,
      customer: $scope.details.customer}
    }).then((response)=>{
      this.results = alert(response.data);
      $('#myModal').modal('hide');
    });

};


  $scope.machines=[{
   id: 6,
    name: 'Factory',
    capacity: 1440
  },
  {
  id: 7,
  name: 'Autobox',
  capacity: 480},
  {
    id: 8,
    name: 'Loadpoint',
    capacity: 480
  }];

  $scope.showDetails = function(x){
    $scope.details = x;
    $('#myModal').modal('show');
  }

  $scope.searchSchedule=()=>{
    value = $scope.findOrder;

  $http({
    method:'POST',
    url:'./jsonData/findScheduledOrder.json.php',
    data: {order:value}
    }).then((response)=>{
      this.getOrder = response.data;
    });
}

  $scope.search=()=>{
    value = $scope.searchOrder;
  $http({
    method:'POST',
    url:'./jsonData/productionSchedule.json.php',
    data: {order:value}
    }).then((response)=>{
      this.getSchedule = response.data;
    });
}
});


myApp.filter('dateToISO', function() {
  return function(input) {
    input = new Date(input).toISOString();
    return input;
  };
});

myApp.filter('sales', function(){

});

myApp.controller('userSelect',function($scope, $http, $cookies){

  $scope.selectSales1 = function(){
$cookies.put('userCookie', $scope.selectedSalesman.sales_man);
var userCookie = $cookies.get('userCookie');
alert(userCookie);
}

$scope.selectSales2 = function(){
localStorage.setItem('user', $scope.selectedSalesman.sales_man);
var userStorage = localStorage.getItem('user');
return $scope.user;
}

$http({
  method:'GET',
  url:'./jsonData/getSalesMan.json.php'
}).then((response)=>{
  this.getSalesman = response.data;
});
});

myApp.controller('viewQuote', function($scope, $location, $http, $timeout,$compile, Upload){
   this.search = $location.search();
  qid = this.search.qid;
  cid = this.search.cid;
  $scope.orderRef = qid;

 $scope.$watch('files', function () {
  $scope.upload($scope.files);
});
 $scope.$watch('files', function () {
  if ($scope.file != null) {
    $scope.files = [$scope.file]; 
  }
});
 $scope.log = '';

 $scope.upload = function (files) {
  if (files && files.length) {
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      if (!file.$error) {
        Upload.upload({
         url: './jsonData/upload.php',
         method:'POST',
         file:file,          
         data: {'qid' :$scope.orderRef, 
          'targetPath':'../uploads/'

         }
       }).then(function (resp) {
        $timeout(function() {
          $scope.log = 'file: ' +
          resp.config.data.file.name +
          ', Response: ' + JSON.stringify(resp.data) +
          '\n' + $scope.log;
        });
      }, null, function (evt) {
        var progressPercentage = parseInt(100.0 *
          evt.loaded / evt.total);
        $scope.log = 'progress: ' + progressPercentage + 
        '% ' + evt.config.data.file.name + '\n' + 
        $scope.log;
      }).then((response)=>{
        location.reload();
      });
     }
   }
 }
}
 $http({
        method: 'POST',
        url: './jsonData/getUploads.json.php',
        data: qid
      }).then((response)=>{
        this.getUploads = response.data;
      });


$scope.requote = ()=>{
  $http({
    method: 'POST',
    url: './jsonData/requote.json.php',
    data: {quoteRef: $scope.vq.getOpenQuotes.quoteRef,
      qid: $scope.vq.getOpenQuotes.qid,
      initials: $scope.vq.getOpenQuotes.initials}
    }).then((response)=>{
      location.reload();
    })
  }

 

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
  this.add = {};
  $scope.addNotes =()=>{

    $http({
      method: 'POST',
      url:'./jsonData/addNoteToQuote.json.php',
      data: {notes:this.add,
        quoteRef: $scope.vq.getOpenQuotes.qid}
      }).then((response)=>{
        alert('Note Added');
        location.reload();
      });
    };

    $http({
      method:'POST',
      url:'/jsonData/getNotes.json.php',
      data: {ref:qid}
    }).then((response)=>{
      this.getNotes = response.data;
    });
    $scope.save = ()=>{

      $http({

        method: 'POST',
        url: './jsonData/quoteClose.json.php',
        data: {data: this.quote,
          qid: $scope.orderRef}
        }).then((response)=>{
          alert('closed!');
         location.reload();
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

     $http({
      method: 'POST',
      url: './jsonData/getOpenQuotes.json.php',
      data: {value:qid, query: 'getCustomerQuoteDetails'}
    }).then((response)=>{
      this.getOpenQuotes = response.data;
    });
  });
//CARTON CALCULATOR QUOTE APP
myApp.controller('ctnCalculator', function($scope, $http){

 //$scope.width = $scope.width;

  $scope.validateWidth = function(){
   var res = $scope.width;
   if((res)< 60 &&(res)> 1450){
    return{"background-color": "red"}
   }
   
  }

  $scope.validateHeight = function(){
   var res = $scope.height;
   if((res)< 60){
    return{"background-color": "red"}
   }
   if((res)> 1450){
    return{"background-color": "red"}
   }
  }


 $http({
  method: 'GET',
  url: '/jsonData/getAllSupplierBoardPrices.json.php'
}).then((response)=>{
  this.getSuppliers=response.data;
}); 


$scope.labourCost = 16;

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

//$scope.labourCost = 16;


$scope.calcBlankWidth = function(){
  var res = ($scope.width * $scope.styleSelect.panelW)+($scope.height*1)+($scope.fluteSelect.width) * 2;
  return res
}

$scope.blankWidth = function(){
        var res = $scope.calcBlankWidth();

      if((res) < 250){
        return{ color: "red"}
      }
    }


$scope.calcBlankLength = function(){
  var res = (($scope.length * $scope.configSelect.panelL)+($scope.width * $scope.configSelect.panelW)+($scope.fluteSelect.width * $scope.configSelect.creases)+($scope.glueFlap*1));
  return res
}
$scope.blankLength = function(){
       var res = $scope.calcBlankLength();

      if((res) < 575){
        return{ color: "red"}
      }
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
  var labour = ($scope.calcCtnLabourCost())/$scope.qty;
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
$scope.labour = 16;
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
      data: {customerId:$scope.c.getNewCustomer.id,
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
    customer =this.search.customer;
    $http({
      method: 'POST',
      url: './jsonData/updateCustomer.json.php',
      data: this.getNewCustomer
    }).then((response)=>{
     this.results = response.data;
     if((response.data) == "ERROR")
     {
      alert("There appears to be a problem, does the customer already exist?");
    }
    else{  
     alert("Customer Updated");
     window.location.replace("/customers?customer="+customer+"&id="+id);
   }
 });
  }


  $http({
    method: 'POST',
    url: './jsonData/getNewCustomer.json.php', 
    data:  value
  }).then((response)=>{
    this.getNewCustomer = response.data;
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

app.directive('href', function() {
  return {
    compile: function(element) {
      element.attr('target', '_blank');
    }
  };
});

myApp.controller('quotes', function($scope, $http, $cookies, $window){

  $scope.getPo = function(){
    po = $scope.po;
    $http({
  method: 'POST',
  url: './jsonData/getPo.json.php',
  data: {po: po}
});
  }

  $scope.getTotal = function(){
    var total = 0;
    for (var i = 0; i < $scope.q.getReports.length; i++){
      var tot = $scope.q.getReports[i];
      total += (tot.amount * 1)
    }
    if(isNaN(total)){
      return null;
    }
    return total;
  }
  $scope.getTotalQuotes = function(){
    for (var i = 0; i < $scope.q.getReports.length; i++){
    }
    return i;
  }


  $scope.report = ()=>{
status = $scope.selectStatus.name;
salesMan = $scope.selectSalesman.salesId;
datefrom = new Date($scope.dateFrom);
dateto = $scope.dateTo;
$http({
  method: 'POST',
  url: './jsonData/getReport.json.php',
  data: {sales: salesMan, dateFrom: datefrom, dateTo: dateto, status: status }
}).then((response)=>{
  this.getReports = response.data;
});
}

  $scope.user =$cookies.get('userCookie');

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
    name: "%%",
    value:4
  },{
    name: "open",
    value: 1
  },
  {
    name: "lost",
    value: 2
  },
  {
   name: "won",
   value: 0
 },
 {
  name: "inactive",
  value: 3
 }];
 $scope.selectedStatus = "";

 $scope.selectSales = function(){
  sales = $scope.selectSalesman.salesId;
  $http({
    method: 'POST',
    url:'./jsonData/getSalesmanOpenQuotes.json.php',
    data: {sales:sales}
  }).then((response)=>{
    this.getSalesman = response.data;
  });
} 
$scope.getOpenQuotes = ()=>{
value = $scope.selectedStatus.name;
$http({
  method: 'POST',
  url: './jsonData/getOpenQuotes.json.php',
  data: {value: value, query: 'getOpenQuotes', }
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



myApp.controller('customerQuote', function($scope,$http, $location){

  $scope.company=[{
    name: 'Damasco',
    emailPrefix: '@damasco.co.uk',
    logo: ('./Css/images/damasco.jpg'),
    address: 'Damasco UK Ltd, Hollis Road, Grantham,NG31 7QH',
    tel: '0845 071 0754',
    email: 'sales@damasco.co.uk',
    style: "damasco",
    colour: '#6b9bfd',
    imageStyle: "dImage",
    isoStyle: "isoImage",
    iso: ('./Css/images/DamascoISO.jpg')
  },
  {
    name: 'Postpack',
    emailPrefix: '@postpack.co.uk',
    logo: "./Css/images/postpack.jpg",
    address: 'Postpack Ltd, Hollis Road,Grantham, NG31 7QH',
    tel: '0845 071 0754',
    email: 'sales@postpack.co.uk',
    style:"postpack",
    colour: '#fd6b6b',
    imageStyle: "pImage",
    isoStyle: "isoImage",
    iso: ('./Css/images/PostpackIso.jpg')
  }];

  $scope.deleteQuote = function(){
    if(confirm("Delete Quote? Quote Id:" + $scope.selectedCustomer.qid)){
      $http({
        method: 'POST',
        url:'./jsonData/deleteQuote.json.php',
        data: {quoteRef:$scope.selectedCustomer.qid}
      }).then((response)=>{
        location.reload();
      });
    }
    else{
      exit();
    }
  }

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

$scope.addRow = function(id){

 $scope.c.getCustomerQuotes.splice($scope.c.getCustomerQuotes.push({ref: $scope.x.ref, unit: 'Each'}));
}
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
        id: this.getLastId,
        unit: 'Each'            
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
      salesEmail:$scope.selectedCustomer.sales_email+$scope.selectedCompany.emailPrefix,
      sales_man:$scope.selectedCustomer.sales_man,
      customer:$scope.selectedCustomer.customer,
      deliveryCharges:$scope.deliveryCharges,
      quoteRef: $scope.selectedCustomer.quoteRef,
      style: $scope.selectedCompany.style}
    }).then((response)=>{
      this.response = alert(response.data);
      window.location.replace("/customerQuote");
    });
  };  

  $scope.printQuote = function(){
    $http({
      method:'POST',
      url: './jsonData/printQuote.json.php',
      data: {ref:$scope.selectedCustomer.quoteRef,
        comment1:$scope.comment1,
        comment2:$scope.comment2,
        comment3:$scope.comment3}
    }).then((response)=>{
      this.response = alert("printed");
     location.reload();
      
    });
  };  
  

  $scope.updateLine = function(id,ref, size, qty, unit_price,unit,description,customerId,
    salesId,quoteRef,date,qid){

   $http({
     method: 'POST',
     url: './jsonData/updatequote.json.php',
     data: { id: id,
      size:size, 
      ref:ref,
      qty:qty, 
      unit_price:unit_price, 
      unit:unit, 
      description:description,
      salesId: salesId,
      quote_ref: quoteRef,
      customerId: customerId,
      date: date,
     qid: $scope.selectedCustomer.qid,}
    }).then((response)=>{
      //this.response = alert('Updated')
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

myApp.controller('toolList', function($scope, $http){

   
this.tool={};
  $scope.updateTool = ()=>{
  	
    $http({
      method: 'POST',
      url: './jsonData/updateTool.json.php',
      data: {tool_alias:tool_alias, style: x.style}
    });
  };

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


  $http({
    method: 'GET',
    url: './jsonData/getProductionToolList.json.php'
  }).then((response)=>{
    this.list = response.data;

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

myApp.controller('editTool', function($scope, $location, $http,$timeout,$compile, Upload) {

 this.search = $location.search();
 id = this.search.id;

 $scope.upload = function (files) {
  if (files && files.length) {
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      if (!file.$error) {
        Upload.upload({
         url: './jsonData/upload.php',
         method:'POST',
         file:file,          
         data: {'qid' :$scope.orderRef, 
          'targetPath':'../uploads/'

         }
       }).then(function (resp) {
        $timeout(function() {
          $scope.log = 'file: ' +
          resp.config.data.file.name +
          ', Response: ' + JSON.stringify(resp.data) +
          '\n' + $scope.log;
        });
      }, null, function (evt) {
        var progressPercentage = parseInt(100.0 *
          evt.loaded / evt.total);
        $scope.log = 'progress: ' + progressPercentage + 
        '% ' + evt.config.data.file.name + '\n' + 
        $scope.log;
      }).then((response)=>{
        location.reload();
      });
     }
   }
 }
}

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

  $scope.updateTool = ()=>{
    $http({
      method: 'POST',
      url: './jsonData/updateTool.json.php',
      data: this.getToolById
    })
  };

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
  var run = ($scope.machine / $scope.e.getToolById.config)
  return run;
}


$scope.calcLabour = function(){
  var labour = ($scope.machine / $scope.e.getToolById.config)/100;

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
  url:'./jsonData/getGrade.json.php'
}).then((response)=>{
  this.getGrade=response.data;
});

  $scope.updatePrice = function(id,price){
    $http({
      method: 'POST',
      url: '/jsonData/updateIdPrices.json.php',
      data:{id:id,price: price}
    })
  }

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