<?
    require_once 'application/views/tinymceload.php';
?>
<script language="javascript" type="text/javascript">
	runTinyMCE("u_templatecontent");
</script>

<? echo form_open('subdomain/changing_universals'); ?>
<p> Values, which are common for every subdomain: </p>
<table>
<? foreach ($universal as $key => $value) : ?>
	<tr>
		<td><? echo $key; ?>:</td>
		<td> 
		<? if (strlen($value)>30) : ?>
			<textarea rows="10" cols="45" id="u_<? echo $key; ?>" name="<? echo $key; ?>" ><? echo $value; ?></textarea>
		<? else : ?>
			<input type="text" name="<? echo $key; ?>" value="<? echo $value; ?>">
		<? endif; ?> 
		</td>
	</tr>
<? endforeach; ?>
</table>
<p> <input type="submit" value="update"> </p>
</form>

<?
require_once('application/views/instructions.php');
?>
