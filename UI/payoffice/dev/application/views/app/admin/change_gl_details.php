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
    } else if ($flag=="PFC")  {
        return 'ap-st-label ap-st-lb-cancelled'; 
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
    } else if ($flag=="PFC")  {
    return 'WITHDRAWAL';
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
    
    <th class="text-center">TRANSACTION TYPE</th>   
    <th class="text-center">GL DEBIT A/C</th>
    <th class="text-center">GL CREDIT A/C</th> 
    <th class="text-center">GL INTERMEDIARY A/C</th>       
    <th class="text-center">GL COMMISSION A/C</th> 
    <th class="text-center">GL INCENTIVE A/C</th> 
     
    
    
    </tr>
    </thead>
    
    <tbody>


    <?php if (isset($gl) && is_array($gl) && !empty($gl)): ?>
    <?php if (!isset($gl[0]->errorStatus) || $gl[0]->errorStatus!=1): ?>   
    <?php foreach ($gl as $item): ?>

    

    <?php 

  
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 
     
     <td>
    <center>
   
        <span class="<?php echo get_transaction_label($item->GLTXNTYP) ?>" style="display: block;">
        <?php echo get_transaction_type($item->GLTXNTYP) ?>
        <input id="gltxntyp" type="hidden"   name="gltxntyp"  value="<?php echo $item->GLTXNTYP; ?>"> 

           
 
    </td>

    <td>
    <center> 
     


      <input id="debit" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->GLTXNTYP; ?>-debit"   autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php echo number_format(floatval($item->GLDEBACT)); ?>"> 

   <!--     <input id="threshold" class="form-control ap-inp-field numdec " type="text" name="
<?php echo $item->GLTXNTYP; ?>-<?php echo trim($item->GLTXNTYP);?>-threshold" 
 autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="
<?php echo number_format(floatval($item->GLTXNTYP)); ?>">  -->

    </td>

    <td>
    <center>



      <input id="credit" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->GLTXNTYP; ?>-credit"   autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php echo number_format(floatval($item->GLCRDACT)); ?>"> 
 

    </td>
       

    <td>
    <center>

    

       <input id="intermediary" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->GLTXNTYP; ?>-intermediary"   autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php echo number_format(floatval($item->GLINTMAC)); ?>"> 
     </td>



    <td>
    <center>


       <input id="commission" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->GLTXNTYP; ?>-commission"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php echo number_format(floatval($item->GLCOMACT)); ?>"> 


    </td>
    
    
    <td>
    <center>

       <!-- <input id="incentive" class="form-control ap-inp-field numdec " type="text" name="incentive"  autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="   <?php echo number_format(floatval($item->GLINCACT),2); ?>">  -->
         <input id="incentive" class="form-control ap-inp-field numdec " type="text" name="<?php echo $item->GLTXNTYP; ?>-incentive"   autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="   <?php echo number_format(floatval($item->GLINCACT)); ?>">  

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



<span id="ap-admin-changegl" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> SAVE GL DETAILS </span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>



</div>

