var app = angular.module('tooling', []);
app.controller('toolingController', function($scope,$http) {

  $http({
      method:'GET',
      url:'./jsonData/getRecentTools.json.php'
    }).then(function(response){
      $scope.getRecentTools=response.data;
    });

     $http({
      method:'GET',
      url:'./jsonData/getToolsById.json.php'
    }).then(function(response){
      $scope.getToolsById=response.data;
    });

     $http({
      method:'GET',
      url:'./jsonData/getToolsList.json.php'
    }).then(function(response){
      $scope.getToolsList=response.data;
    });

    $http({
      method:'GET',
      url:'./jsonData/getSuppliers.json.php'
    }).then(function(response){
      $scope.getSuppliers=response.data;
    });
});