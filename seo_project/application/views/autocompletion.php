<?   
require_once 'jspath.php';
?>


<!-- Dependencies -->
<script src="<?=$yui ?>yahoo-dom-event/yahoo-dom-event.js"></script>
<script src="<?=$yui ?>datasource/datasource-min.js"></script>

<!-- OPTIONAL: Get (required only if using ScriptNodeDataSource) -->
<script src="<?=$yui ?>get/get-min.js"></script>

<!-- OPTIONAL: Connection (required only if using XHRDataSource) -->
<script src="<?=$yui ?>connection/connection-min.js"></script>

<!-- OPTIONAL: Animation (required only if enabling animation) -->
<script src="<?=$yui ?>animation/animation-min.js"></script>

<!-- OPTIONAL: JSON (enables JSON validation) -->
<script src="<?=$yui ?>json/json-min.js"></script>

<!-- Source file -->
<script src="<?=$yui ?>autocomplete/autocomplete-min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$yui ?>autocomplete/assets/skins/sam/autocomplete.css" />

<script language="javascript" type="text/javascript">
function Autocomplete(what,id){
	var field = what+id;
	var container = what+"Container"+id;
	var oDS = new YAHOO.util.XHRDataSource('<?=site_url()?>'+"/lookup/index/"+what.toLowerCase());
	oDS.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
	oDS.responseSchema = {
		recordDelim: "\n",
		fieldDelim: "\t"
	};
	oDS.maxCacheEntries = 100;
	var oAC = new YAHOO.widget.AutoComplete(field, container, oDS);

	return {
		oDS: oDS,
		oAC: oAC
	};
}
</script>
