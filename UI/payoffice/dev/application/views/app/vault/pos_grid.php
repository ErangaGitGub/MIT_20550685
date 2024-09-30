<?php 
function encrypt_ubrn($reference, $key1, $key2)
{
    $refferenceArr = str_split($reference);
    $enctxt = '';

    for ($i=0; $i < count($refferenceArr) ; $i++) {    
    if ($refferenceArr[$i]=='0') {
    $key=$key1;
    $keyArray = str_split($key);
    $randomIndex = array_rand($keyArray);
    $enctxt = $enctxt.$keyArray[$randomIndex];
    } else {
    $key=$key2;
    $keyArray = str_split($key);
    $enctxt = $enctxt.$keyArray[$refferenceArr[$i]];
    }
    }

    return strrev($enctxt);
}

function get_formatted_date($date)
{
    if ($date != 0) {
    $year  = substr($date, 0, 4);
    $month = substr($date, 4, 2);
    $day   = substr($date, 6, 2);
    return $year.'-'.$month.'-'.$day;
    } else {
    return $date;
    }
}



function get_status_label($flag) {  
 return 'ap-st-label ap-st-lb-completed';
   
}

    function get_status_text($flag) {
    if ($flag=="A") {
    return 'ACTIVE';
    } else if ($flag=="D")  {
    return 'DELETED';
    } 
}

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    { "width": "20%" },
    { "width": "30%" },
    { "width": "25%" },
    { "width": "25%" },
   
    ],
    "bPaginate": false, 
    "bFilter": false,      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    
    <th class="text-center">CURRENCY SHORT CODE</th>  
    <th class="text-center">CURRENCY NAME</th>
    <th class="text-center">AVAILABLE AMOUNT</th>       
    <th class="text-center">TRANSFER AMOUNT</th>
    
    </tr>
    </thead>
    <tbody>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>

    <?php 

    $url = $item->CURID;
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="<?php echo $url?>">
    <?php echo $item->CURSHRT; ?>
    </a>
    </td>

    <td>
    <center>

   <?php echo $item->CURDESC; ?>
    </td>

    <td>
    <center>

   <?php echo $item->CURBAL; ?>
    </td>

    <td>
    <input id="<?php echo $item->CURID; ?>" class="form-control ap-inp-field" type="text" name="<?php echo $item->CURSHRT; ?>" value="<?php echo $item->CURBAL; ?>"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
    </td>
   

  


<!--  -->

    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    </tbody>
</table>