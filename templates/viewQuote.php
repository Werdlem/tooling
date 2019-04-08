<div ng-controller="viewQuote as vq">	
	<h1 style="text-align: center;">{{orderRef}}</h1>
	<p>Customer Name: {{vq.getOpenQuotes.customer}}</p>
	<p>Company Name: {{vq.getOpenQuotes.business}}</p>
	<p>Email: {{vq.getOpenQuotes.Cemail}}</p>
	<p>Contact No: {{vq.getOpenQuotes.contact_no}}</p>
	<input hidden type="" ng-model="orderRef">
	<p><strong>Quote Status: {{vq.getOpenQuotes.result}}</strong></p> 
	<p><strong>Details: {{vq.getOpenQuotes.details}}</strong></p>
	

<table class="table">
	<tr>
		<th>Quote Ref: {{orderRef}}</th>
	</tr>
	<tr>
		<th>Product Ref</th>
		<th>Drscription</th>
		<th>Qty</th>
		<th>Amount</th>
	</tr>
	<tr ng-repeat="x in vq.getQuoteById">
		<td>
			{{x.ref}}
		</td>
		<td>
			{{x.description}}
		</td>
		<td>{{x.qty}}
		</td>
		<td>
			{{x.unit_price}}
		</td>
	</tr>
</table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Close
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Close Quote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p>Select option for quote Ref: {{orderRef}}</p>
      	<p> Won: <input type="checkbox" name="status" ng-hide="vq.quote.lost" value="won" ng-model="vq.quote.won"></p>
      	<p> Lost: <input type="checkbox" name="status" ng-hide="vq.quote.won" value="lost" ng-model="vq.quote.lost"></p>

        <p><select ng-model="vq.quote.reasonSelect" ng-show="vq.quote.lost" ng-options="x.reason for x in lost"></select></p>
        <p><span ng-show="vq.quote.won">Order Total: <input ng-model="vq.quote.amount"></span></p>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="save()">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>