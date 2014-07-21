<p> List of trades</p>
<table border='1' width="100%">

<? foreach ($trades as $id=> $trade): ?>
<tr>
    <td>
    <? echo anchor('trade/edit/'. $id, $trade); ?>
    </td>

    <? if ($isadmin) : ?>
    <td>
    <input type="button" value="edit" onclick="
        location.href='<? echo site_url('trade/edit/'. $id); ?>' ">
    <input type="button" value="delete" onclick="
        if (confirm('Are you sure to remove the <? echo $trade?> trade'))
        location.href='<? echo site_url('trade/remove/'. $id); ?>'
    ">
    </td>
    <? endif; ?>
</tr>
<? endforeach; ?>

</table>
<? if ($isadmin) : ?>
<p align="center"><input width="100%" type="button" value='insert new trade'
onclick="location.href='<? echo site_url('trade/insert'); ?>'; ">
</p>
<? endif;?>
