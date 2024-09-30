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
   
    </tr>
    </thead>
    <tbody>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>

    <?php 

    $url = '';
       $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    

    <td>
    <center>
    <a href="<?php echo $url?>">
   <?php echo $item->curshrt; ?>
    </td>



    <td>
    <input id="<?php echo $item->curid; ?>" class="form-control ap-inp-field numdec " type="text" name="B-<?php echo $item->curshrt; ?>"  value="<?php echo number_format(floatval($item->buyrate),4); ?>" minlength="8" maxlength="11" autocomplete="on" autocorrect="off" spellcheck="false" tabindex="1" >
    </td>
   
<td>
    <input id="<?php echo $item->curid; ?>" class="form-control ap-inp-field numdec " type="text" name="S-<?php echo $item->curshrt; ?>" value="<?php echo number_format(floatval($item->sellrate),4); ?>" minlength="8" maxlength="11" autocomplete="on" autocorrect="off" spellcheck="false" tabindex="1" >
    </td>
<td>
    <input id="<?php echo $item->curid; ?>" class="form-control ap-inp-field numdec " type="text" name="C-<?php echo $item->curshrt; ?>" value="<?php echo number_format(floatval($item->ceiling),4); ?>" minlength="8" maxlength="11" autocomplete="on" autocorrect="off" spellcheck="false" tabindex="1" >
    </td>  
<td>
    <input id="<?php echo $item->curid; ?>" class="form-control ap-inp-field numdec " type="text" name="I-<?php echo $item->curshrt; ?>" value="<?php echo number_format(floatval($item->indicativerate),4); ?>" minlength="8" maxlength="11" autocomplete="on" autocorrect="off" spellcheck="false" tabindex="1" >
    </td>

    

<!--  -->

    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    <?php if (isset($item->STATUS)): ?>
    <div class="ap-sinp-elm" style ="margin-top: -15px;" >
   
   

     <?php if (isset($item->REMARKS) && $item->REMARKS != ' ' && $item->STATUS == 'N' ): ?>  

    <div class="col-md-6 ap-sinp-col-for-inp-1"  style="float: right;">
       Daily Rates Remarks : 
    <span class="<?php echo get_status_label($item->STATUS) ?>">
    <?php echo $item->REMARKS;  ?>
    </div> 
    <?php endif ?> 

    <?php if (isset($item->REASON) && $item->REASON != ' ' && $item->STATUS == 'R' ): ?>  

    <div class="col-md-6 ap-sinp-col-for-inp-1"  style="float: right;">
       Rejected Reason : 
    <span class="<?php echo get_status_label($item->STATUS) ?>">
    <?php echo $item->REASON;  ?>
    </div> 
    <?php endif ?> 

    

     <div class="col-md-3 ap-sinp-col-for-inp-2"  style="float: right;">
        Daily Rates Status : 
    <span class="<?php echo get_status_label($item->STATUS) ?>">
    <?php echo get_status_text($item->STATUS); ?>
    </div> 

    </div>
    <?php endif ?> 

    <!-- <div class="ap-sinp-elm" style="margin-bottom: 40px; ">
    <div>    
    
    <div class="col-md-2 ap-sinp-col-for-inp-1"  style="width: 10%; float: left;"  >
    <sp;">
    <span><i class=" fas fa-dollar-sign"></i></span>
    USD MIDDLE RATE
    </div>
    <div class="col-md-4 ap-sinp-col-for-inp-1" style="width: 10%;float: left;">
    <input id="id-middlerate" class="form-control ap-inp-field numdec" type="text" name="middlerate" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="" tabindex="3" >
    <span id="er-middlerate" class="ap-lbl-inp-err" for="error-msg"></span>
    </div>an class="ap-st-label ap-st-lb-initiated" style="display: block; text-align: center
    </div>
    </div> -->
    </tbody>
    
</table>

