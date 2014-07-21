<?php
$online = false ; // if $online==true than load components from sites of their developers

$local_scripts = base_url(). 'jscripts/';

$tinyMCE = $online?
		'http://www.tinymce.com/js/tinymce/jscripts/tiny_mce/tiny_mce.js' :
		$local_scripts.'tiny_mce/tiny_mce.js';

$yui = 
		'http://yui.yahooapis.com/2.9.0/build/' ;
//:		$local_scripts.'yui/build/';
?>
