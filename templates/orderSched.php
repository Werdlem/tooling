<div ng-controller="productionSchedule as ps"><h1>Schedule Order Production</h1>

<h3>Order Search: <input type="" ng-model="searchOrder" ng-change="search()"></h3>
<p>"NB:for Postpack orders, please use the prefix 'p' followed by the order number and 'd' followed by the order number for damasco"</p>
<!--<button ng-click="showDetails()" class="btn btn-info btn-sml">Schedule</button>-->
<style type="text/css">
	.table{width: 50%}
</style>

<table class="table">
	<tr>
	<th>Order Id</th>
	<th>Customer Name</th>
	<th>SKU</th>
	<th>Qty</th>
    <th>Production Duration</th>
	</tr>
	<tr ng-repeat="x in ps.getSchedule">
		<td>{{x.order_id}}</td>
		<td>{{x.customer}}</td>
		<td>{{x.sku}}</td>
		<td>{{x.qty}}</td>
        <td>~ {{(((x.qty * 1 ) / (x.config * 1))/900) | number: 1}} Days</td>
    	<td><button ng-click="showDetails(x)" class="btn btn-info btn-sml">Schedule</button></td>
	</tr>
	</table>

    
    <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Schedule Production</h4>
                            </div>
                            <div class="modal-body">
                               
                                <p>Order Id: {{details.order_id}}<input type="" ng-model="details.order_id" ng-hide="details.sku"></p>
                                <p>SKU: {{details.sku}}<input type="" ng-model="details.sku" ng-hide="details.sku"></p>
                                <p>Qty: {{details.qty}}<input type="" ng-model="details.qty" ng-hide="details.sku"></p> 
                                <p>~ {{(((details.qty * 1 ) / (details.config * 1)) /2.5)}} Minutes</p>
                                <p>Schedule Date: <input type="date" ng-model="scheduleDate" ng-change="capacity()"></p>
                                <p ng-show="scheduleDate">Department: <select ng-model="department" ng-options="x.name for x in machines" ng-change="capacity()" ></select></p>
                                <p>
                                <table class="table">
                                    <tr>
                                        <th>Capacity remainig (min)</th>
                                        <th>Capacity</th>
                                    </tr>
                                    <tr ng-repeat="x in ps.getCapacity">
                                        <td>{{x.minutes}}</td>
                                        <td>{{x.capacity | number: 0}}%</td>
                                    </tr>
                                </table>
                            </p>
                             
                                <p class="alert alert-primary" role="alert" ng-model="ps.getMachineCapacity.capacity" ng-if="ps.getMachineCapacity.capacity !== null" ng-show="machine"> There are {{ps.getMachineCapacity.capacity}} minutes remaining for {{machine.name}} on {{scheduleDate | date:'dd-MM-yy'}} </p>

                                <p ng-show="scheduleDate">Duration: <input type="number" ng-model="duration"></p>

                                <p class="alert alert-info" ng-if="ps.getMachineCapacity.capacity !== null" ng-model="capacityCheck" ng-show="((ps.getMachineCapacity.capacity*1) - (duration*1))<=0" > The duration for the required job exceeds the time avaliable for the {{machine.name}}! Please amend times.</p>

                                <p class="alert alert-info" ng-if="duration > 480" ng-model="capacityCheck" ng-show="((ps.getMachineCapacity.capacity*1) - (duration*1))<=0" > The duration for the required job exceeds the time avaliable for the selected department machine! Please amend.</p>
                                </div>
                            <div class="modal-footer">
                                <button type="button" ng-model="schedule"class="btn btn-default" ng-enabled="capacityCheck" ng-click="schedule(details.order_id,details.sku, details.qty, machine, duration, scheduleDate)">Schedule</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

</div>
