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
    { "width": "10%" },
    { "width": "20%" },
    { "width": "20%" },
    { "width": "20%" },
    { "width": "20%" },
    { "width": "10%" },
    ],
    "bPaginate": true,      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
   
    <thead>
    <tr>
    <th class="text-center">FROM TILL</th>
    <th class="text-center">CURRENCY</th>
    <th class="text-center">AMOUNT</th>
    <th class="text-center">TRANSFER USER</th>
    <th class="text-center">TRANSFER TIMESTAMP</th>
    <th class="text-center">CHECK</th>
    </tr>
    </thead>

    <tbody>

    <tr > 
       
    <td>  
    </td>

    <td>
    </td>
    
    <td>
    </td>

    <td>
    </td>
     <td>
    </td> 
    <td>
    </td>
   
    </tr>

    
    </tbody>
</table>