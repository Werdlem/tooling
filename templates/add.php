<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Add New Tool</h4>
      </div>
      <div class="modal-body">
       
      

<form id="add_Tool" ng-submit="a.submit()">

<p><input placeholder="Tool Ref" type="text" ng-model="a.tool.tool_ref" size="10" autofocus="autofocus" /></p>
<p><input placeholder="ESC Ref" type="text" ng-model="a.tool.esc_ref" size="5" autofocus="autofocus" /></p>
<p><input placeholder="Location" type="text" ng-model="a.tool.location" size="5" autofocus="autofocus" /></p>
<p>
<input placeholder="Config" type="text" ng-model="a.tool.config" size="5" autofocus="autofocus" />
<input placeholder="Style" type="text" ng-model="a.tool.style" size="5" autofocus="autofocus" />
<input placeholder="Flute" type="text" ng-model="a.tool.flute" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="Length" type="text" ng-model="a.tool.length" size="5" autofocus="autofocus" />
<input placeholder="Width" type="text" ng-model="a.tool.width" size="5" autofocus="autofocus" />
<input placeholder="Height" type="text" ng-model="a.tool.height" size="5" autofocus="autofocus" />
</p>
<p>
<input placeholder="KTOK Width" type="text" ng-model="a.tool.ktok_width" size="10" autofocus="autofocus" />
<input placeholder="KTOK Length" type="text" ng-model="a.tool.ktok_length" size="10" autofocus="autofocus" />
</p>
<p>
<input type="hidden" type="text" ng-model="a.tool.date" size="10" value="<?php echo date("Y-m-d") ?>" readonly autofocus="autofocus"/>
</p>
<p>
<button type="submit" id="submit" value="Submit" >Submit</button>
</p>

</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>