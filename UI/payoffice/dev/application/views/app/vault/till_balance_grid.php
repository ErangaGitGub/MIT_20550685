<?php 


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
    { "width": "60%" },
    { "width": "20%" },
   
    
    ],
    "bPaginate": false,      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
   
    <thead>
    <tr>
    <th class="text-center">CURRENCY SHORT CODE</th>
    <th class="text-center">CURRENCY DESCRIPTION</th>
    <th class="text-center">CURRENT BALANCE</th>
   
    </tr>
    </thead>

    <tbody>
    
    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>
    <tr > 
       
    <td>
    <center>    
    <a href=""> 
    <?php echo $item->TPCURID; ?> 
     </a>
    </td>

    <td>
    <center>
     <?php echo $item->CURDESC; ?>    
    </td>
    
    <td>
        <center>
    <?php echo number_format(floatval($item->TPCURBAL),2); ?>
    </td>

   
    </tr>
    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?>
    
    </tbody>
</table>