<?php
require_once './DAL/DBConn.php';
//require_once '../DAL/sheetboard_PDOConnection.php';
$toolDal = new tooling();
$id = $_GET['id'];


$search = $toolDal->getToolById($id);


 ?>


<form id="add_Tool" method="post" action="?action=action&updateTool">
<div id="tool-entry">
	<?php
	foreach ($search as $result) {

	  ?>
<input type="text" name="id" size="5" autofocus="autofocus" hidden value="<?php echo $result['id'] ?>" /></p>	  
<p>Tool Ref: <input placeholder="Tool Ref" type="text" name="tool_ref" size="20" value="<?php echo $result['tool_ref']?>" /></p>
<p>ESC Ref: <input placeholder="ESC Ref" type="text" name="esc_ref" size="15" value="<?php echo $result['esc_ref']?>" /></p>
<p>Location: <input placeholder="Location" type="text" name="location" size="5" value="<?php echo $result['location']?>"  /></p>
<p>
Config: <input placeholder="Config" type="text" name="config" size="4" value="<?php echo $result['config']?>"  />
Style: <input placeholder="Style" type="text" name="style" size="4" value="<?php echo $result['style']?>"  />
Flute: <input placeholder="Flute" type="text" name="flute" size="4" value="<?php echo $result['flute']?>"  />
</p>
<p>
Length: <input placeholder="Length" type="text" name="length" size="5" value="<?php echo $result['length']?>" />
Width: <input placeholder="Width" type="text" name="width" size="5" value="<?php echo $result['width']?>" />
Height: <input placeholder="Height" type="text" name="height" size="5" value="<?php echo $result['height']?>" />
</p>
<p>
KTOK (deckle): <input placeholder="KTOK Width" type="text" name="ktok_width" size="10" value="<?php echo $result['ktok_width']?>" />
KTOK (chop): <input placeholder="KTOK Length" type="text" name="ktok_length" size="10" value="<?php echo $result['ktok_length']?>" />
</p>
<p>
<input type="hidden" type="text" name="date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
<?php }?>
<p>
<button type="submit" id="update" name="submit" value="update">Submit</button>
</p>
</div>
