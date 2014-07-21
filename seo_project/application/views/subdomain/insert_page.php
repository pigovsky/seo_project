<? require_once('application/views/autocompletion.php');
    require_once('application/views/tinymceload.php');
?>


<!-- Dependencies -->
<script src="<?=$yui ?>yahoo-dom-event/yahoo-dom-event.js"></script>
<script src="<?=$yui ?>connection/connection-min.js"></script>


<script language="javascript" type="text/javascript">
runTinyMCE ("subdomain_body");

function getAllInputs(){
    return document.getElementsByTagName('input');
}

function setAllSubtrades(my){
    var arrInput = getAllInputs();
    for (var i=0,j=0 ; j<my.length && i<arrInput.length; i++){
        if (arrInput[i].name=='subtrade[]')
            arrInput[i].value=my[j++];
    }
}

function getAllSubtrades(){
    var arrInput = getAllInputs();
    var my=[];
    for (var i=0,j=0 ; i<arrInput.length; i++){
        if (arrInput[i].name=='subtrade[]')
            my[j++]=arrInput[i].value;
    }
    return my;
}

function getSubtradesElement(){
    return document.getElementById('subtrades');
}

function deleteSubtrade(index){
    var my = getAllSubtrades();
    if (my.length<=1)
        return;
    
    ste = getSubtradesElement();
    ste.innerHTML="";
    
    for(var i=0, j=0; i<my.length; i++)
        if (i!=index)
            ste.innerHTML
                +=subtradeEntry(j++,my[i]);
}

function subtradeEntry(index, value){
    var x=
        '<input name="subtrade[]" type="text" '+
        'value="'+ value + '"> '+
        '<input type="button" onclick="deleteSubtrade('+
        index + ')" value="delete"><br>';
    return x;
}

function addSubtrade(){
    var my = getAllSubtrades();
    
    getSubtradesElement().
        innerHTML += subtradeEntry(my.length,'');
    setAllSubtrades(my);
}


function validateSubdomain(edit){
    var city = document.subdomainform.city.value;

    if (city.length<=0){
        alert('city cannot be empty!');
        return false;
    }

    this.success =function(o){
        //alert(o.responseText);
        if (o.responseText !== undefined &&
            o.responseText.indexOf("OK")>=0){
                document.subdomainform.submit();
        }
        else
            alert(o.responseText);        
    };

    this.failure=function(o){
        alert(o.responseText);        
    };

    var trade_id = document.subdomainform.trade_id.value;    
    		
    var sUrl =
        "<?=site_url()?>/lookup/validate"+
        (edit?'/'+document.subdomainform.id.value:'')+
        '?trade_id='+trade_id+
        '&city='+city;
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, this);
}

</script>

<? $edit = is_object($sd); ?>

<?php echo form_open_multipart($edit?'subdomain/updating':'subdomain/inserting',array('name' => 'subdomainform'));?>

<?php echo $error;?>

<table>
    <tr>
            <td>City</td>
            <td><input type="text"
                        value="<? if ($edit) echo $sd->city; ?>"
                        name="city"
                        onchange="domain_name_generator()"
                        id='CityForm'>
                <div id='CityContainerForm'></div>
            </td>
    </tr>
    <tr>
            <td>State</td>
            <td><input type="text"
                        value="<?  if ($edit) echo $sd->state; ?>"
                        name="state"
                        onchange="domain_name_generator()"
                        id="StateForm">
                 <div id='StateContainerForm'></div>
            </td>
    </tr>
    <tr>
            <td>Trade</td>
            <td><select name="trade_id">
                 <? foreach($trades as $trade_id=> $trade): ?>
                    <option
                        <?  if ($edit && $trade_id==$sd->trade_id): ?>
                            selected
                        <? endif;?>
                            value="<? echo $trade_id ?>">
                        <? echo $trade; ?>
                    </option>
                 <? endforeach;?>
                </select>
            </td>
    </tr>
    <tr>
            <td>Sub-Trades </td><td>
                <div id="subtrades">
                    <?  if (!$edit) : ?>
                        <input id="subtrade" name="subtrade[]" type="text">
                        <input type="button"
                                   value="delete"
                                   onclick="deleteSubtrade(0)"><br>
                    <? else : ?>
                        <? $j=0;
                            foreach ($sd->subtrade as $s) : ?>
                            <input id="subtrade"
                                   name="subtrade[]"
                                   type="text"
                                   value="<?=$s?>">
                            <input type="button"
                                   value="delete"
                                   onclick="deleteSubtrade(<?=$j++?>)">
                            <br>
                        <? endforeach;?>
                    <? endif;?>
                </div>
                <input type="button" onclick="addSubtrade()" value="add subtrade">
            </td>
    </tr>
    <tr>
        <td colspan="2">
            Subdomain content. Use <font color="red">%templatecontent%</font> for general content
            for any subdomain or trade, use <font color="red">%tradecontent%</font> for
            trade-specific content, then you can add the
            subdomain-specific content:<br>
        <textarea rows="10" cols="45" id="subdomain_body" name="subdomaincontent">
            <?=$edit?$sd->subdomaincontent:
                '%templatecontent% %tradecontent%' ?>
            </textarea>
        </td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <?  if ($edit) :?>
                    <input type="hidden" name='id' value='<? echo $sd->id; ?>' >
                    <input type="button"
                           value="update"
                           onclick="validateSubdomain(true)">
                    <? echo anchor('subdomain/insert', 'insert new subdomain'); ?>
            <? else : ?>
                    <input type="button"
                           value="insert"
                           onclick="validateSubdomain(false)">
            <? endif;?>
                    <input type="reset">
            </td>
    </tr>
</table>

</form>

<?
require_once('application/views/instructions.php');
?>


<script type="text/javascript">
Autocomplete('City', 'Form');
Autocomplete('State', 'Form');
</script>

