<div ng-controller="viewQuote as vq">	
	<h1 style="text-align: center;">Quote Ref: {{vq.getOpenQuotes.quoteRef}}</h1>
	<p>Customer Name: {{vq.getOpenQuotes.customer}}</p>
	<p>Company Name: {{vq.getOpenQuotes.business}}</p>
	<p>Email: {{vq.getOpenQuotes.Cemail}}</p>
	<p>Contact No: {{vq.getOpenQuotes.contact_no}}</p>
	<input hidden type="" ng-model="vq.getOpenQuotes.quoteRef">
	<p><strong>Quote Status: {{vq.getOpenQuotes.result}}</strong></p> 
	<p><strong>Details: {{vq.getOpenQuotes.details}}</strong></p>
	

<table class="table">
	<tr>
		<th>Quote Ref: {{vq.getOpenQuotes.quoteRef}}</th>
	</tr>
	<tr>
		<th>Product Ref</th>
		<th>Description</th>
    <th>Size</th>
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
    <td>
      {{x.size}}
    </td>
		<td>{{x.qty}}
		</td>
		<td>
			{{x.unit_price}}
		</td>
	</tr>
</table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Close Quote
</button>

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#notesModal">Add Note</button>
<button type="button" class="btn btn-success" ng-click="requote()">Requote</button>
<h2>Notes</h2>
<table class="table">
	<tr>
		<th>Comments</th>
		<th>Date</th>
	</tr>	
	<tr ng-repeat="x in vq.getNotes">

	<td>{{x.notes}}</td>
	<td>{{x.date}}</td>
</tr>
</table>

<!-- Modal -->
<!--CLOSE THE QUOTE - WON/LOST-->
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
      	<p>Select option for quote Ref: {{vq.getOpenQuotes.quoteRef}}</p>
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
<!--ADD NOTES TO QUOTE MODAL-->
<div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="addnotes" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closeNotes">Close</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<h2>Add notes to quote no: {{vq.getOpenQuotes.quoteRef}}</h2>
      	<p><input hidden type="" ng-model="vq.getOpenQuotes.Qid"></p>
      	<p><textarea ng-model="vq.add.notes" rows="5" cols="50"></p></textarea>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addNotes()">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>