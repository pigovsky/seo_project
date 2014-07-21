<? $begin = true;
if($last_search!=FALSE) :?>
    Subdomains
    <? foreach ($last_search as $key => $val) :?>        
        <? if (strcmp($key,'trade_id')!=0 &&
                strcmp($key,'take_trade')!=0 &&
                strlen($val)>0):?>
            <?=$begin?'for which':', '?>
            <?=$key?> is like "<?=$val?>"
            <?$begin = false;?>
        <?endif;?>
    <? endforeach;?>
    <? if ($last_search['take_trade']) :?>
        <?=$begin?'for which':', '?>
            trade is <?=array_key_exists($last_search['trade_id'], $trades)?$trades[$last_search['trade_id']]:'removed'?>
    <? endif; ?>

<? endif; ?>
<table border='1' width="100%">
<tr>
<? foreach ($table_cols as $key): ?>
<td>
<? echo $key; ?>
</td>
<? endforeach; ?>
</tr>
<? foreach ($subdomains as $sd) : 
$sd = get_object_vars($sd); ?>
<tr>
<? foreach ($table_cols as $key): ?>
<td>
<? if (strlen($sd[$key])>0)
echo anchor('welcome/show/'. $sd['id'], $sd[$key],
            array('class'=> 'subdomain')); ?>
</td>
<? endforeach; ?>
<? if ($isadmin) : ?>
<td>
<input type="button" value="edit" onclick="location.href='<? echo site_url('subdomain/edit/'. $sd['id']); ?>' ">
<input type="button" value="delete" onclick="
if (confirm('Are you sure to remove the <? echo $sd['subdomain']?> subdomain'))
location.href='<? echo site_url('subdomain/remove/'. $sd['id']); ?>'	
">
</td>
<? endif; ?>
</tr>
<? endforeach; ?>

</table>
        <p align="center"> <? echo $this->pagination->create_links(); ?></p>


<? if ($isadmin) : ?>
    <p align="center">
        <input width="100%" type="button" value='insert new subdomain'
        onclick="location.href='<? echo site_url('subdomain/insert'); ?>'; ">
    </p>
    <p align="center">Import subdomains from a csv</p>
    <?php echo form_open_multipart('subdomain/csv');?>
    <p align="center"><input type="file" name="csvfile" size="20" />
    <input type="submit" value="parse"/></p>
    </form>
    
<? endif;?>





