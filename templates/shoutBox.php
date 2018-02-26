<h2>Comments</h2>

<input type="text" name="shoutBox" size="50"> 

<button type="submit" value="shoutBox" id="shoutBox" name="submit">Submit Text</button>

<?php

$shout = $toolDal->getShouts($id);

foreach ($shout as $result){
	echo '<p>'.$result['comments'].' - '.date('d/m/Y',strtotime($result['date'])).'</p>';
}