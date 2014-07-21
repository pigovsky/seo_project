<?require_once('application/views/tinymceload.php');?>

<script language="javascript" type="text/javascript">
runTinyMCE ("trade_body");

function validateTrade(){
    if (document.edittradeform.trade.value.length<=0){
        alert('Trade title cannot be empty!')
        return;
    }
    
    document.edittradeform.submit();
}
</script>

	
<? $edit = $trade_to_edit!=FALSE; ?>

<?php echo form_open_multipart($edit?'trade/updating':'trade/inserting',array('name' => 'edittradeform'));?>

<?php echo $error;

?>

<table>
<tr>
    <td>Trade name:  <input type="text" name="trade"
    value="<? echo ($edit?$trade_to_edit->trade:''); ?>">
</td>
</tr>
<tr>
<td>Main Image (upload):<input type="file" name="img1" size="20" /></td>
</tr>
<tr>
<td>Second Image (upload):<input type="file" name="img2" size="20" /></td>
</tr>		
<tr>
<td>Third Image (upload):<input type="file" name="img3" size="20" /></td>
</tr>
<tr>
<td> Meta title:  <br>
<textarea rows="10" cols="45" name="metatitle"><?=$edit?$trade_to_edit->metatitle:'%universaltitle%'?></textarea> </td>
</tr>
<tr>
<td>Meta description: <br>
<textarea rows="10" cols="45" name="metadescription"><?=$edit?$trade_to_edit->metadescription:'%universaldescription%'?></textarea> </td>
</tr>
<tr>
<td>Meta keywords: <br>
<textarea rows="10" cols="45" name="metakeywords"><?=$edit?$trade_to_edit->metakeywords:'%universalkeywords%'?></textarea> </td>
</tr>
<tr>
<td>Trade-specific content: <br>
<textarea rows="10" cols="45" id="trade_body" name="tradecontent">
<?=$edit?$trade_to_edit->tradecontent:'%Trade%-specific content'?>
</textarea>

</td></tr>
<tr>
<td>
<?  if ($edit) :?>
<input type="hidden" name='id' value='<? echo $trade_to_edit->id; ?>' >
<input type="button"
       onclick="validateTrade();"
       value="update">
<? else : ?>
<input type="button"
       onclick="validateTrade();"
       value="insert">
<? endif;?>
<input type="reset">
</td>
</tr>
</table>
<p><? echo anchor('trade/insert', 'add new trade'); ?></p>
</form>

<?
require_once('application/views/instructions.php');
?>