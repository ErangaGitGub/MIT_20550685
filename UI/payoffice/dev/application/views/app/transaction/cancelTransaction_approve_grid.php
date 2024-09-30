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
        return 'ap-st-label ap-st-lb-review';  
    } else if ($flag=="FCR")  {
        return 'ap-st-label ap-st-lb-rejected';  
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

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    { "width": "10%" },
    { "width": "10%" },
    { "width": "15%" },
    { "width": "5%" },
    { "width": "10%" },
    { "width": "10%" },
    { "width": "10%" },
    { "width": "10%" },    
    { "width": "10%" },
    { "width": "10%" },
   
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
     <th class="text-center">COMISSION</th> 
    
    </tr>
    </thead>
    <tbody>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>
    <?php if ($item->STATUS != 'C'): ?>
    <?php 
    
    $url = $this->config->item('base_url')."transaction/delete/internationTxn?txnNo=".$item->REFNO;
    // $url = ('base_url')."transaction/view/internationTxn?txnNo=".$item->REFNO;
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="<?php echo $url?>">
    <?php echo $item->REFNO; ?>
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
  


<!--  -->

    </tr>
    <?php endif ?>
    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    </tbody>
</table>