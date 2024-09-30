
<!-- report1 - Daily Detail Report of All Transactions - Teller wise -->
<!-- report2 - Daily Statement of Foreign Currency Report -->

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

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    { "width": "80%" },
    { "width": "20%" },
   
   
    ]      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    <th class="text-center">REPORT NAME</th>
    <th class="text-center">ACTION</th> 
   
    
    </tr>
    </thead>
    <tbody>


    <tr >
    <td>
    <center>
    <a> 
    Daily Detail Report of All Transactions - Teller wise   
    </a>
    </td>       
    

    <td>
    <center>
    <a href="" id="ap-btn-report1" class="ap-btn ap-btn-nxt ap-btn-table">    
    <span>GENERATE SPOOL REPORT</span>&nbsp;
    <span id="ap-btn-loading-conf1" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
    </a>    
    <span id="id-status-report1" class="ap-st-label ap-st-lb-completed" style="text-align: center;display:none;">
    SPOOL REPORT GENERATED    
    </center>
    </td> 
    </tr>

    <tr >
    <td>
    <center>
    <a>    
    Daily Statement of Foreign Currency Report   
    </a>
    </td>       

    <td>
    <center>
    <a href="" id="ap-btn-report2" class="ap-btn ap-btn-nxt ap-btn-table">    
    <span>GENERATE SPOOL REPORT</span>&nbsp;
    <span id="ap-btn-loading-conf2" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
    </a>    
    <span id="id-status-report2" class="ap-st-label ap-st-lb-completed" style="text-align: center;display:none;">
    SPOOL REPORT GENERATED    
    </center>
    </td>
    </tr>

    </tbody>
</table>