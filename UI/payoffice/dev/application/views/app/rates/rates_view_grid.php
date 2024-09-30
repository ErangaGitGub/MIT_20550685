<?php 

$date = date('Y-m-d H:i:s');
$user = $this->session->userdata('fullname');



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

function get_usd_middle_rate($cur, $rate)
{
    if ($cur == 'USD') {        
        return number_format(floatval ($rate), 2);
    } else {
        return '0';
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
    "dom": 'Bfrtip',
    buttons: [

    {
    extend: 'excelHtml5',
    text: 'Export to Excel',
    title: 'Bank of Ceylon Pay Office - BIA Katunayake',
    messageTop: 'Daily Statement of Foreign Currency at  : <?php echo $date; ?>',
    messageBottom: '/br  /br /brGenerated By : <?php echo $user; ?>',
    // filename: 'PYP00701',
    // author: 'IT207416',
    // keywords: 'AAA',
    exportOptions: {
        orthogonal: 'sort',
        },
    
    },

    {
    extend: 'pdfHtml5',
    text: 'Export to PDF',
    orientation: 'portrait',
    pageSize: 'LEGAL',
    footer: true,
    header: true,
    title: 'Bank of Ceylon Pay Office - BIA Katunayake',
    messageTop: 'Daily Statement of Foreign Currency at : <?php echo $date; ?>',
    messageBottom: 'Generated By :  <?php echo $user; ?>',
     exportOptions: {
        columns: [0,1,2,3,4],
        },

    // filename: '2020-09-10',
    // author: 'by IT207416',
    // keywords: 'AAA',
    }


    ],



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

    $url = $item->curid;
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="">
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

    </tbody>
   <?php if (isset($item->status)): ?>
    <div class="ap-sinp-elm" style ="margin-top: -15px;" >  
   

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
    <span class="<?php echo get_status_label($item->status) ?>">
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
    
</table>


