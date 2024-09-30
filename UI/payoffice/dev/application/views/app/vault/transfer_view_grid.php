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

function get_txn_label($flag) {
    if ($flag=="") {
        return 'ap-st-label ap-st-lb-review';
    } else if ($flag=="A")  {
        return 'ap-st-label ap-st-lb-completed';  
    } else if ($flag=="R")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } 
}

    function get_txn_text($flag) {
    if ($flag=="") {
    return ' PENDING ';
    } else if ($flag=="A")  {
    return 'ACCEPTED';
    } else if ($flag=="R")  {
    return 'REJECTED';
    } 
}

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    // { "width": "10%" },
    { "width": "20%" },
    { "width": "10%" },
    { "width": "20%" },
     { "width": "20%" },
     { "width": "20%" }

    ],
    "bPaginate": true,      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
   
    <thead>
    <tr>
  <!--   <th class="text-center">ACTION</th> -->
    <th class="text-center">DESTINATION TILL</th>
    <th class="text-center">CURRENCY</th>
    <th class="text-center">AMOUNT</th>
    <th class="text-center">TRANSFER TIMESTAMP</th>
    <th class="text-center">STATUS</th>
    <!-- <th class="text-center">CHECK &nbsp;&nbsp;<a id="ap-btn-check-all">ALL</a>   <a id="ap-btn-check-none">NONE</a>   </th> -->
    </tr>
    </thead>

    <tbody>
     <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?> 

    <?php 

    $url = "";
    $row_class = 'ap-rw-def';    

    ?>      
    <tr >
    
       
    <td>  
    <center>      
    <?php echo $item->TILDESC; ?>     
    </td>

    <td>
    <center>      
    <?php echo $item->TCCURID; ?> 

    </td>
    
    <td>
    <center> 
    <?php echo number_format(floatval($item->TCTRAMNT),2); ?>     
    </td>


    <td>
        <center>      
        <?php echo $item->TCCRTTIM; ?>     
    </td> 

    <td>
    <center>
    <span class="<?php echo get_txn_label($item->TCSTATUS) ?>">
    <?php echo get_txn_text($item->TCSTATUS) ?>
    </td> 
    
    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?>
    </tbody>
</table>