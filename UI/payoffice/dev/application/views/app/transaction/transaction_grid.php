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

function get_currency_data($cur)
{
    if ($cur == 0) {
        return '--';
    } else {
        return number_format(floatval ($cur), 2);
    }
}
function get_currency_code($cur)
{
    if ($cur == "0") {
        return '';
    } else {
        return $cur;
    }
}

function get_txn_label($flag) {
    if ($flag=="FCP") {
        return 'ap-st-label ap-st-lb-completed';
    } else if ($flag=="FCS")  {
        return 'ap-st-label ap-st-lb-inprogress';  
    } else if ($flag=="FCR")  {
        return 'ap-st-label ap-st-lb-insufficient';  
    } else if ($flag=="FCI")  {
        return 'ap-st-label ap-st-lb-initiated';  
    } else if ($flag=="PFC")  {
        return 'ap-st-label ap-st-lb-cancelled';  
    }
}

    function get_txn_text($flag) {
    if ($flag=="FCP") {
    return 'PURCHASE';
    } else if ($flag=="FCS")  {
    return 'SALES';
    } else if ($flag=="FCR")  {
    return 'RE-EXCHANGE';
    } else if ($flag=="FCI")  {
    return 'ISSUING';
    } else if ($flag=="PFC")  {
    return 'WITHDRAWAL';
    } 
}

function get_status_label($flag) {
    if ($flag==" ") {
        return '';
    } else if ($flag=="C")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } else if ($flag=="X")  {
        return 'ap-st-label ap-st-lb-review';  
    } else if ($flag=="N")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } else if ($flag=="R")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } 
}


    function get_status_text($flag) {
    if ($flag==" ") {
    return '';
    } else if ($flag=="C")  {
    return 'CANCELLED';
    } else if ($flag=="X")  {
    return 'PENDING CANCEL';
    } else if ($flag=="N")  {
    return 'COMMUNICATOR FAILED';
    } else if ($flag=="R")  {
    return 'CANCELLATION REJECTED';
    }
}

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,
    "ordering": false,     
    "columns": [
    { "width": "8%" },
    { "width": "8%" },
    { "width": "15%" },
    { "width": "5%" },
    { "width": "8%" },
    { "width": "8%" },
    { "width": "8%" },
    { "width": "8%" },    
    { "width": "8%" },
    { "width": "8%" },
    { "width": "10%" },
    { "width": "8%" },
   
    ],  
    "dom": 'Bfrtip',
    buttons: [

    {
    extend: 'excelHtml5',
    text: 'Export to Excel',
    title: '',
    filename: function(){
                var d = new Date();
                return 'Daily Report_' + d.toDateString();
            },
    author: '',
    keywords: '',
    exportOptions: {
        orthogonal: 'sort',
        },
    
    },

    {
    extend: 'pdfHtml5',
    text: 'Export to PDF',
    orientation: 'landscape',
    pageSize: 'LEGAL',
    footer: true,
    header: true,
    title: '',
    filename: function(){
                var d = new Date();
                return 'Daily Report_' + d.toDateString();
            },
    author: '',
    keywords: '',
    }


    ],



    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    <th class="text-center">REFERENCE </th>
    <th class="text-center">UIN NUMBER</th>       
    <th class="text-center">CUSTOMER NAME</th>
    <th class="text-center">TYPE</th> 
    <th class="text-center">CURRENCY 1</th> 
    <th class="text-center">CURRENCY 2</th> 
    <th class="text-center">CURRENCY 3</th> 
    <th class="text-center">CURRENCY 4</th>    
    <th class="text-center">INCENTIVE</th> 
    <th class="text-center">COMMISSION</th> 
    <th class="text-center">LKR TOTAL</th> 
    <th class="text-center">STATUS</th> 
    
    </tr>
    </thead>
    <tbody>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>

    <?php 
    
    $url = $this->config->item('base_url')."transaction/view/internationTxn?txnNo=".$item->REFNO;
    // $url = "";
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="<?php echo $url?>">
    <?php echo $item->REFNO; ?><span class="fa fa-print  blue"></span> 
    </a>
    </td>

    <td>
    <center>
    <?php echo $item->UINNUMBER; ?>
    </td>

    <td>
    <center>
    <?php echo $item->NAME; ?>
    </td>

    <td>
    <center>
    <span class="<?php echo get_txn_label($item->TXNTYPE) ?>" style="display: block;">
    <?php echo get_txn_text($item->TXNTYPE) ?>
    </td> 

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->AMOUNT1) ?>
    &nbsp;
    <span class="ap-tabledata-currency"><?php echo get_currency_code($item->CURR1); ?></span>
    </span>
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->AMOUNT2) ?>
    &nbsp;
    <span class="ap-tabledata-currency"><?php echo get_currency_code($item->CURR2); ?></span>
    </span>
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->AMOUNT3) ?>
    &nbsp;
    <span class="ap-tabledata-currency"><?php echo get_currency_code($item->CURR3); ?></span>
    </span>
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->AMOUNT4) ?>
    &nbsp;
    <span class="ap-tabledata-currency"><?php echo get_currency_code($item->CURR4); ?></span>
    </span>
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->INCENTIVE) ?>
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->COMMISION) ?>
    
    <span class="clearfix"></span>
    </td>

    <td>
    <span class="pull-right">
    <?php echo get_currency_data($item->LKRTOTAL) ?>
    &nbsp;
    <span class="ap-tabledata-currency"><?php echo get_currency_code('LKR'); ?></span>
    <span class="clearfix"></span>
    </td>

    <td>
    <center>
    <?php if ($item->COMMSTATUS == 'N'): ?> 
        <span class="<?php echo get_status_label($item->COMMSTATUS) ?>">
        <?php echo get_status_text($item->COMMSTATUS) ?>
    <?php elseif ($item->AUTSTATUS == 'R'): ?> 
        <span class="<?php echo get_status_label($item->AUTSTATUS) ?>">
        <?php echo get_status_text($item->AUTSTATUS) ?>
    <?php else: ?>
        <span class="<?php echo get_status_label($item->STATUS) ?>">
        <?php echo get_status_text($item->STATUS) ?>
    <?php endif ?>     

    
    </td> 

   
  


<!--  -->

    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    </tbody>
</table>