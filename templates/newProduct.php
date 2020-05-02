<div ng-controller="specSheet as np">
<form ng-submit="np.submit()" style="width: 60%; border: 1px solid #d4d4d4; padding: 10px; border-radius: 5px; box-shadow: 10px 10px 10px #d4d4d4; margin: auto">
<div id="details" style="width: 95%">	
	<h2 style="text-align: center">New Product Specification Sheet</h2>
	<p>Customer Name: <input type="text" placeholder="Customer Name" ng-model="np.pro.customerName" style="width: 70%"></p>
	<p>Product/Tool Ref: <input placeholder="Product/Tool Ref" type="text" ng-model="np.pro.tool_ref" autofocus="autofocus" style="width: 70%" /></p>
	<p>Alias: <input placeholder="Alias" type="text" ng-model="np.pro.tool_alias" autofocus="autofocus" style="width:50%" /></p>
	<p>Description: <input type="text" placeholder="" ng-model="np.pro.description" style="width: 60%"></p>
<div style="border: 2px dashed #a2a2a2; padding:5px; background-color:#d4d4d4; border-radius: 5px">
	
	<h4>Tool / Product Details</h4>
		<p><strong>Internals </strong></p>
	L: <input placeholder="Length" type="number" ng-model="np.pro.length"  autofocus="autofocus" />
W: <input placeholder="Width" type="number" ng-model="np.pro.width" size="5" autofocus="autofocus" />
H: <input placeholder="Height" type="number" ng-model="np.pro.height" size="5" autofocus="autofocus"/>
<br/>
<p><strong> Knife To Knife</strong></p>
Deckle: <input placeholder="deckle" type="number" ng-model="np.pro.deckle" size="10" autofocus="autofocus" />
Chop: <input placeholder="chop" type="number" ng-model="np.pro.chop" size="10" autofocus="autofocus" />

<p><strong>Configuration</strong>
<input placeholder="up" type="number" ng-model="np.pro.config" style="width: 30px" autofocus="autofocus" />
<strong>Style</strong>
<input placeholder="Style" type="number" ng-model="np.pro.style" size="5" autofocus="autofocus" /> <strong>Flute: <input placeholder="Flute" type="text" ng-model="np.pro.flute" size="5" autofocus="autofocus"  /></strong></p>

<p><strong>Material Details</strong></p>
<input placeholder="Material" type="text" ng-model="np.pro.material" autofocus="autofocus" /></p>

</div>
<br/>
<h2>Further Product Specifics</h2>
<textarea id="furtherComments" ng-model="np.pro.furtherComments" rows="5" style="width: 60%"></textarea>

<h3>Uploads:</h3>

 Drop File:
    <div ngf-drop ngf-select ng-model="files" class="drop-box" 
        ngf-drag-over-class="'dragover'" ngf-multiple="true" ngf-allow-dir="true"
        accept="image/*,application/pdf" 
        ngf-pattern="'image/*,application/pdf'">Drop pdfs or images here or click to upload</div>
    <div ngf-no-file-drop>File Drag/Drop is not supported for this browser</div>
    <ul>
        <li ng-repeat="f in files" style="font:smaller">{{f.name}} {{f.$error}} {{f.$errorParam}}</li>

     </ul>
</div>

<button type="submit" id="submit" value="Submit" class="btn btn-primary">Submit</button>
</form>
    