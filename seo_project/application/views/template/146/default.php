<html>

<style>
    a:link    { color:black; text-decoration:none; }
    a:visited { color:black; text-decoration:none; }
    a:hover   { color:gray; text-decoration:none; }
    a:active  { color:black; text-decoration:none; }

    table {border-width: 1; border-color: black}

    td {font-size: 12}
    input {font-size: 12}
    select {font-size: 12}
    option {font-size: 12}

    a.admin:link    { color:yellow; text-decoration:none; }
    a.admin:visited { color:yellow; text-decoration:none; }
    a.admin:hover   { color:lightyellow; text-decoration:none; }
    a.admin:active  { color:yellow; text-decoration:none; }
</style>

<? $admin_panel_pictures_dir = base_url().'img/'; ?>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title><?=$pagetitle?></title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF">

    

<table border="0" width="100%" cellspacing="0" cellpadding="0" background="<?=$admin_panel_pictures_dir?>topbkg.gif">
  <tr>
    <td width="50%">
	<a href="http://totalrenovationgroup.com/index.php"><img src="<?=$siteurl?>images/logo-trg.gif" alt="Total Renovation Group" width="300" height="150" border="0" /></a>
	</td>
    <td width="50%">
      <p align="right"><img border="0" src="<?=$admin_panel_pictures_dir?>topright.gif" width="327" height="150"></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="<?=$admin_panel_pictures_dir?>blackline.gif">
  <tr><? //B8C0F0 ?>
    <td width="100%"><font color="#FFFFFF" face="Arial" size="2"><b>&nbsp;&nbsp;
               
<? if ($isadmin) : ?>
    <?=anchor('subdomain/all','subdomains',array('class'=>'admin'))?>&nbsp;&nbsp; |&nbsp;&nbsp;
    <?=anchor('trade/edit_trades','trades',array('class'=>'admin'))?>&nbsp;&nbsp; |&nbsp;&nbsp;
    <?=anchor('subdomain/change_universals','settings',array('class'=>'admin'))?>&nbsp;&nbsp; |&nbsp;&nbsp;
<? endif;?>
<? if ($login==FALSE) : ?>
    <?=anchor('admin/login','login to admin panel',array('class'=>'admin'))?>&nbsp;&nbsp; |&nbsp;&nbsp;
<? else : ?>
    <?=anchor('admin/logout','logout from '.$login,array('class'=>'admin'))?>&nbsp;&nbsp; |&nbsp;&nbsp;
<? endif;?>

      
  </b></font></td>
  </tr>
</table>
<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="2">&nbsp;</font></b><font face="Arial" size="2" color="#000000">

    <table>
        <tr>
            <td width="20%">
                <? if ($searching_form) : ?>
                <?php echo form_open('subdomain/all/0/1');?>
                <p align="left">
                    
                <table>
                <tr><td>City</td><td><input type='text' name='city' value="<? if($last_search!=FALSE) echo $last_search['city']; ?>"></td></tr>
                <tr><td>State:</td><td><input type='text' name='state' value="<? if($last_search!=FALSE) echo $last_search['state']; ?>"></td></tr>
                <tr><td><input name="take_trade" type="checkbox"
                       <? if ($last_search!=FALSE&&
                             $last_search['take_trade']==1):?>
                            checked
                       <? endif;?>
                       value="1">Trade</td>
                <td><select name="trade_id">
                    <? foreach ($trades as $id=> $trade) :?>
                    <option value="<? echo $id; ?>"
                            <? if ($last_search!=FALSE&&
                                    $last_search['trade_id']==$id):?>
                                selected
                            <? endif; ?>  >
                        <? echo $trade; ?>
                    </option>
                    <? endforeach;?>
                </select>
                    </td></tr>
                <tr><td>Subdomain</td><td><input type='text' name='subdomain' value="<?=$last_search!=FALSE?$last_search['subdomain']:''?>"></td></tr>
                <tr><td colspan="2" align="center">
                    <input type='submit' value='search subdomain'><br>
                    </td></tr>
                </table>
                    </p>
                </form>
                <? endif;?>
            </td>
            <td width="80%">
                <? if ($page!=FALSE): ?>
                    <? include $page;?>
                <? else : ?>
                    <?=$content?>
                <?endif;?>
            </td>
        </tr>
    </table>
        
    </font></p>

<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20" align="center"><font face="Arial" color="#000000" size="1">(C)
COPYRIGHT 2012 ALL RIGHTS RESERVED - TOTAL RENOVATION GROUP </font></p>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="<?=$admin_panel_pictures_dir?>botline.gif">
  <tr>
    <td width="100%"><img border="0" src="<?=$admin_panel_pictures_dir?>botline.gif" width="41" height="12"></td>
  </tr>
</table>
<div style="text-align:center;font-family:Arial,Helvetica,Sans-Serif;font-size:11px;color:#777;">Website by Chiaweb.com </div>

</body>

</html>
