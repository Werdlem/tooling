<div ng-controller="NonConformance as ncr"><h1>Closed Ncr's</h1>

	<input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />



<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<table class="table" style="width: 50%">
	<tr>	
	<th>Order No</th>
	<th>Date Closed</th>
	</tr>
	<tr ng-repeat="x in ncr.getClosedNcrs">
		<td ng-model="x.sku"><a href="/closedNcrDetails?orderId={{x.po}}">{{x.po}}</td>
		<td ng-model="x.date_closed">{{x.date_closed}}</td>	
	</tr>
	</table>

	</div>
