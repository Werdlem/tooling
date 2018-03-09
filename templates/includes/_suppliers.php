<?php 
if (empty($_GET['id']))
{
	echo 'Please select a supplier';
}
else {
echo '

<table class="table">
	<thead>
		<tr class="heading">
			<th>Grade</th>
			<th>Flute</th>
			<th>Price Band</th>
			<th>Price</th>
		</tr>
	</thead>';
	
	
	$id = $_GET['id'];
	$supplier = $_GET['supplier'];

	echo '<h2>'.$supplier.'</h2>';
	?>
	<label>Filter Grade: </label><select ng-model="grade" style="width: 7em">
         <option>125K125T</option>
        </select><br>
        <label>Filter Flute: </label><select ng-model="flute" style="width: 7em">
         <option>B</option>
        </select><br>
        <?php 

	$fetch = $toolDal->getSupplierDetails($id);
	foreach ($fetch as $result) {
		echo 
		'<tr><td>'. $result['grade'].'</td>
		<td>'. $result['flute'].'</td>
		<td>'. $result['price_band'].'</td>
		<td>'. $result['price'].'</td></tr>';

	}
}
	 ?>
	


