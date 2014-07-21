<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="<?=$metadescription?>"/>
<meta name="keywords" content="<?=$metakeywords?>"/>
<meta name="title" content="<?=$metatitle?>"/>
<meta name="zipcode" content="64015,64014,64064,64063,64086,64034,64081,64133,64030,64081,64082,64029,64030,64101,64102,64105,64108,64109,64110,64111,64112,64113,64114,64115,64116,64117,64118,64119,64120,64123,64124,64125,64126,64127,64128,64129,64130,64050,64052,64053,64054,64055,64056,64057,64058, 66062, 66061, 66214, 66213, 66205, 66204"/><!---fixed--->
<meta name="city" content="<?=$city?>"/>
<meta name="state" content="<?=$state?>"/>


<title><?=$pagetitle?></title>
<link href="<?=$siteurl?>css-universal.css" rel="stylesheet" type="text/css" />

<link href="<?=$siteurl?>css-trg.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/<?=$trade?>.css" rel="stylesheet" type="text/css" /><!--Based on the "trade"---each trade will be using its own css file the template for that trade-->


<link rel="shortcut icon" type="<?=$siteurl?>image/ico" href="<?=$siteurl?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=$siteurl?>jqueryslidemenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="<?=$siteurl?>jqueryslidemenu.js"></script>

</head>

<body >
<div align="center">

   <table class="headerBG" cellpadding="0" cellspacing="0">
   <tr>
   <td valign="top" align="center">
   <?php
        require "../ssi-logo-topheader.php";
    ?>

<table class="main" cellpadding="0" cellspacing="0">
  <tr>
    <td class="leftslogan" valign="top" width="75" rowspan="2">
	</td>
	<td valign="top" rowspan="2" width="200" bgcolor="#000000" align="center">
  <img src="<?=$img1?>" alt="<?=$trade?>" width="200" height="715" border="0" /><!----Image alt tag should should based on "trade" - if Trade is Windows---then image alt="windows" First image from the subdomain creation form----------->

<br />

<?php
    require "../ssi-left-box.php";
?>
	<br />
</td>
<td class="rightpanelnavi" valign="top" align="left" height="280">
<?php
    require "../ssi-navi.php";
?>


 <div id="graphicPanel"></div>





</td></tr>
	<tr>
<td class="rightpanelcontent" valign="top">
<table width="100%" border="0" cellspacing="8" cellpadding="8">
  <tr>
    <td valign="top" align="left">
<div id="contentwrapper">
<div id="contentcolumnsite">

<div id="content">
    <?=$subdomaincontent?>
</div>
</div>
<div id="rightcolumnsite">

</div>
</div>

	</td>
  </tr>
</table>


</td></tr>
</table>
</td>
</tr>
</table>


<?php
require "../ssi-bottom-address.php";
?>

<?php
require "../ssi-footer.php";
?>



</div>
</body>
</html>