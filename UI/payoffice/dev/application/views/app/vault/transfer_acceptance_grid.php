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
    { "width": "10%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
   
    

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
    <th class="text-center">TRANSFER TIME</th>
    <th class="text-center">ACCEPT</th>
    <th class="text-center">REJECT</th>
    <!-- <th class="text-center">ACCEPT&nbsp;&nbsp;&nbsp;&nbsp; <a>ALL</a>&nbsp;&nbsp; <a>NONE</a></th>
    <th class="text-center">REJECT&nbsp;&nbsp;&nbsp;&nbsp; <a>ALL</a>&nbsp;&nbsp; <a>NONE</a></th> -->
   
    
    <!-- <th class="text-center">CHECK &nbsp;&nbsp;<a id="ap-btn-check-all">ALL</a>   <a id="ap-btn-check-none">NONE</a>   </th> -->
    </tr>
    </thead>

    <tbody>
     <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>       
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
        <?php echo $item->TCCRTUSR; ?> 
    </td>

    <td>
        <center>      
        <?php echo $item->TCCRTTIM; ?>     
    </td> 

    <td>   
    <center>
       <input type="checkbox" id="id-acceptcheck" name="acceptcheck" value="" class="ap-inp-checkbox" ng-click="acceptCash(
        '<?php echo $item->TCSRCTIL; ?>',
        '<?php echo $item->TCDESTIL; ?>',
        '<?php echo $item->TCCURID; ?>',
        '<?php echo $item->TCTRAMNT; ?>',
        '<?php echo $item->TCCRTUSR; ?>',        
        '<?php echo $item->TCCRTTIM; ?>'
        )"> 
        <!-- <span id="ap-btn-cash-accept" class="ap-btn ap-btn-nxt" data-event="create"  ng-click="acceptCash(
        '<?php //echo $item->TCSRCTIL; ?>',
        '<?php //echo $item->TCDESTIL; ?>',
        '<?php //echo $item->TCCURID; ?>',
        '<?php //echo $item->TCTRAMNT; ?>',
        '<?php //echo $item->TCCRTUSR; ?>',        
        '<?php //echo $item->TCCRTTIM; ?>'
        )">
        <span class="ap-btnloading-accept" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
        <span> ACCEPT</span>&nbsp;&nbsp;
        <span>
        <i class="fas fa-check blue"></i>
        </span>
        </span> -->
    </center>
    </td>

    <td>   
    <center>
        <input type="checkbox" id="id-rejectcheck" name="rejectcheck" value="" class="ap-inp-checkbox" ng-click="rejectCash(
        '<?php echo $item->TCSRCTIL; ?>',
        '<?php echo $item->TCDESTIL; ?>',
        '<?php echo $item->TCCURID; ?>',
        '<?php echo $item->TCTRAMNT; ?>',
        '<?php echo $item->TCCRTUSR; ?>',        
        '<?php echo $item->TCCRTTIM; ?>'
        )"> 

        <!-- <span id="ap-btn-cash-reject" class="ap-btn ap-btn-nxt" data-event="create" ng-click="rejectCash(
        '<?php //echo $item->TCSRCTIL; ?>',
        '<?php //echo $item->TCDESTIL; ?>',
        '<?php //echo $item->TCCURID; ?>',
        '<?php //echo $item->TCTRAMNT; ?>',
        '<?php //echo $item->TCCRTUSR; ?>',        
        '<?php //echo $item->TCCRTTIM; ?>'
        )"> -->
        <!-- <span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
        <span> REJECT</span>&nbsp;&nbsp;
        <span>
        <i class="fas fa-times red"></i>
        </span>
        </span> -->
    </center>
    </td>

    



    
    
    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?>
    </tbody>
</table>