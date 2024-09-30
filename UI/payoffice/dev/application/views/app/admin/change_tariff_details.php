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
    if ($flag=="A") {
        return 'ap-st-label ap-st-lb-completed';
    } else if ($flag=="D")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } 
}

    function get_status_text($flag) {
    if ($flag=="A") {
    return 'ACTIVE';
    } else if ($flag=="D")  {
    return 'DELETED';
    } 
}

 function get_transaction_label($flag) {
    if ($flag=="FCI") {
        return 'ap-st-label ap-st-lb-rejected';
    } else if ($flag=="FCP")  {
        return 'ap-st-label ap-st-lb-completed';  
         } else if ($flag=="FCR")  {
        return 'ap-st-label ap-st-lb-insufficient';  
     } else if ($flag=="FCS")  {
        return 'ap-st-label ap-st-lb-inprogress'; 
    }
}

function get_transaction_type($flag) {
    if ($flag=="FCI") {
    return 'ISSUING';
    } else if ($flag=="FCP")  {
    return 'PURCHASE'; 
    } else if ($flag=="FCR")  {
    return 'RE-EXCHANGE'; 
    } else if ($flag=="FCS")  {
    return 'SALES';
    } 
}
function get_passport_type($flag) {
    if ($flag=="F") {
    return 'FOREIGN';
    } else if ($flag=="L")  {
    return 'LOCAL'; 
    } else {
    return 'N/A'; 
    }
}


?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    { "width": "12%" },
    { "width": "20%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "10%" }, 
    ],
    "bPaginate": false, 
    "bFilter": false,            
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    
    <th class="text-center">TRANSACTION TYPE</th>   
    <th class="text-center">PASSPORT HOLDER TYPE</th>
    <th class="text-center">THRESHOLD VALUE</th> 
    <th class="text-center">COMMISION PERCENTAGE</th>       
    <th class="text-center">COMMISION VALUE</th> 
    <th class="text-center">RECORD STATUS</th> 
     
    
    
    </tr>
    </thead>
    
    <tbody>

    <?php if (isset($tariff) && is_array($tariff) && !empty($tariff)): ?>
    <?php if (!isset($tariff[0]->errorStatus) || $tariff[0]->errorStatus!=1): ?>   
    <?php foreach ($tariff as $item): ?>
    

    <?php 

  
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 
     
     <td>
    <center>
   
        <span class="<?php echo get_transaction_label($item->TFTXNTYP) ?>" style="display: block;">
        <?php echo get_transaction_type($item->TFTXNTYP) ?>
        

           
 
    </td>

    <td>
    <center> 
      <?php echo get_passport_type(trim($item->TFPASTYP))?>
      

    </td>

    <td>
    <center>



      <input id="threshold" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->TFTXNTYP; ?>-<?php echo trim($item->TFPASTYP);?>-threshold"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php echo number_format(floatval($item->TFMAXVAL)); ?>"> 
 

    </td>
       

    <td>
    <center>

       <input id="percentage" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->TFTXNTYP; ?>-<?php echo trim($item->TFPASTYP);?>-percentage"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="    <?php echo $item->TFCOMPER; ?>"> 
     </td>



    <td>
    <center>

       <input id="commission" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->TFTXNTYP; ?>-<?php echo trim($item->TFPASTYP);?>-commission"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="   <?php echo number_format(floatval($item->TFCOMVAL),2); ?>"> 

    </td>
    
    <td>
        <center>
             <span class="<?php echo get_status_label($item->TFSTATUS) ?>">
             <?php echo get_status_text($item->TFSTATUS) ?>
    </td>
  

  

<!--  -->

    </tr>




    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    </tbody>
</table>

<div id="section-table" class="ap-section " style="margin-right: 20px;">
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 1px;">



<span id="ap-admin-changetariff" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> SAVE TARIFF DETAILS </span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>



</div>

