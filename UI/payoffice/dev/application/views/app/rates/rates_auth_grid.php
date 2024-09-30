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
    if ($flag=="N") {
        return 'ap-st-label ap-st-lb-initiated';
    } else if ($flag=="A")  {
        return 'ap-st-label ap-st-lb-completed'; 
    } else if ($flag=="R")  {
        return 'ap-st-label ap-st-lb-rejected';      
    } else {
        return 'ap-st-label ap-st-lb-onhold';
    }
}

    function get_status_text($flag) {
    if ($flag=="N") {
    return 'NEW';
    } else if ($flag=="A")  {
    return 'AUTHORIZED';
    } else if ($flag=="R")  {
    return 'REJECTED';
    } else {
    return 'NOT ENTERED';
    }
}

function get_usd_middle_rate($cur, $rate)
{
    if ($cur == 'USD') {        
        return number_format(floatval ($rate), 2);
    } else {
        return '-';
    }
}

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
      { "width": "15%" },
    { "width": "15%" },
     { "width": "15%" },
      { "width": "15%" },
      { "width": "15%" },
     
      
       
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
    <th class="text-center">BUYING RATE</th>
    <th class="text-center">SELLING RATE</th>
    <th class="text-center">CEILING VALUE</th>
    <th class="text-center">CBSL INDICATIVE RATE</th>
    
        <!-- <th class="text-center">CHECK
        <a href='http://www.google.com' onclick='return check()'>ALL</a>
        <a href='http://www.google.com' onclick='return check()'>NONE</a>
    </th> -->
    
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

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="<?php echo $url?>">
    <?php echo $item->curshrt; ?>
    </a>
    </td>

     <td>
    <center>
   <?php echo number_format(floatval($item->buyrate),4); ?>
    </td>
   
    <td>
    <center>

  <?php echo number_format(floatval($item->sellrate),4); ?>
    </td>
  
    <td>
    <center>

   <?php echo number_format(floatval($item->ceiling),4); ?>
    </td>

    <td>
    <center>

  <?php echo number_format(floatval($item->indicativerate),4); ?>
    </td>

    
<!--  -->

    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 

    <?php if (isset($item->status)): ?>
    <div class="ap-sinp-elm" style ="margin-top: -15px; margin-bottom: 40px;" >
   
   

     <?php if (isset($item->remarks) && $item->remarks != ' ' && $item->status == 'N' ): ?>  

    <div class="col-md-6 ap-sinp-col-for-inp-1"  style="float: right;">
       Daily Rates Remarks : 
    <span class="<?php echo get_status_label($item->status) ?>">
    <?php echo $item->remarks;  ?>
    </div> 
    <?php endif ?> 

    <?php if (isset($item->reason) && $item->reason != ' ' && $item->status == 'R' ): ?>  

    <div class="col-md-6 ap-sinp-col-for-inp-1"  style="float: right;">
       Rejected Reason : 
    <span class="<?php echo get_status_label($item->status) ?>">
    <?php echo $item->reason;  ?>
    </div> 
    <?php endif ?> 

    <?php if (isset($item->middlerate) && $item->middlerate != '0' ): ?>  

    <div class="col-md-2 ap-sinp-col-for-inp-1"  style="float: right;">
        USD Middle Rate : 
    <span class="<?php echo get_status_label($item->STATUS) ?>">
    <?php echo get_usd_middle_rate($item->curshrt, $item->middlerate); ?>
    </div>
    <?php endif ?> 

     <div class="col-md-3 ap-sinp-col-for-inp-2"  style="float: right;">
        Daily Rates Status : 
    <span class="<?php echo get_status_label($item->status) ?>">
    <?php echo get_status_text($item->status); ?>
    </div> 

    </div>
    <?php endif ?> 
    </tbody>
  
   
</table>

<?php if (isset($item->status) &&  $item->status != 'A' ): ?>  

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-auth-rates" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> AUTHORIZE RATES</span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>

<span id="ap-reject-rates" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> REJECT RATES</span>&nbsp;&nbsp;
<span>
<i class="fas fa-times"></i>
</span>
</span>

</div>
 <?php endif ?> 