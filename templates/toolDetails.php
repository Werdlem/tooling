<?php
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
<p><input placeholder="Tool Ref" type="text" name="tool_ref" size="15" value="<?php echo $result['tool_ref']?>" /></p>
<p><input placeholder="ESC Ref" type="text" name="esc_ref" size="15" value="<?php echo $result['esc_ref']?>" /></p>
<p><input placeholder="Location" type="text" name="location" size="5" value="<?php echo $result['location']?>"  /></p>
<p>
<input placeholder="Config" type="text" name="config" size="5" value="<?php echo $result['config']?>"  />
<input placeholder="Style" type="text" name="style" size="5" value="<?php echo $result['style']?>"  />
<input placeholder="Flute" type="text" name="flute" size="5" value="<?php echo $result['flute']?>"  />
</p>
<p>
<input placeholder="Length" type="text" name="length" size="5" value="<?php echo $result['length']?>" />
<input placeholder="Width" type="text" name="width" size="5" value="<?php echo $result['width']?>" />
<input placeholder="Height" type="text" name="height" size="5" value="<?php echo $result['height']?>" />
</p>
<p>
<input placeholder="KTOK Width" type="text" name="ktok_width" size="10" value="<?php echo $result['ktok_width']?>" />
<input placeholder="KTOK Length" type="text" name="ktok_length" size="10" value="<?php echo $result['ktok_length']?>" />
</p>
<p>
<input type="hidden" type="text" name="date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
<?php }?>
<p>
<button type="submit" id="update" name="submit" value="update">Submit</button>
</p>
</div>
