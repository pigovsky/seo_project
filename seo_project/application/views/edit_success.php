<h3>The <?=$what?> "<?=$upload_data[$what]?>" was
    successfully
        <?=$isadded?'add':'updat'?>ed!
</h3>

<p><?php echo anchor($what.'/show/'.$id, 'show this '. $what); ?></p>
<p><?php echo anchor($what.'/edit/'.$id, 'edit this '. $what. ' again'); ?></p>
<p><?php echo anchor($what.'/insert', 'insert one more '.$what); ?></p>