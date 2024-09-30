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

function get_cross_curr_label($flag) {
    if ($flag=='Y') {
    return 'ap-st-label ap-st-lb-completed';
    } else {
    return 'ap-st-label ap-st-lb-onhold';
    }
}

function get_cross_curr_text($flag) {
    if ($flag=='Y') {
    return 'LKR INVOLVED';
    } else {
    return 'CROSS CURRENCY';
    }
}

function get_status_label($flag) {
    if ($flag==" ") {
        return 'ap-st-label ap-st-lb-completed';
    } else if ($flag=="C")  {
        return 'ap-st-label ap-st-lb-rejected';  
    } else {
        return 'ap-st-label ap-st-lb-onhold';
    }
}

    function get_status_text($flag) {
    if ($flag==" ") {
    return 'PENDING';
    } else if ($flag=="C")  {
    return 'CANCELLED';
    } else {
    return 'EXTRACTED';
    }
}

?>

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,     
    "columns": [
    { "width": "5%" },
    { "width": "5%" },
    { "width": "5%" },
  
    ]      
    });
});
</script>
<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
            <th class="text-center">CURRENCY</th>
    <th class="text-center">AMOUNT</th>
    <th></th>
    </tr>
    </thead>
    <tbody>
    <td>
        </td>
        <td>
            <div class="col-md-15 ap-sinp-col-for-lbl">
          <input type="text" class="form-control">
        </td>
        <td>
            <div class="text-center">
          <button class="btn btn-outline-transfer transfer_row">Transfer</button>      
        </td>
  </div>
    </tbody>
  </table>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>

    <?php 

    $url = $this->config->item('base_url')."transaction/delete/domesticTxn?txnNo=".$item->REFNO;
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
    <?php echo $item->REFNO12; ?>
    </td>



    <td>
    <center>
    <?php echo $item->NATTXNCODE; ?>
    </td>

    <td>
    <center>
    <?php echo $item->ITRSCODE; ?>
    </td>

    <td>
    <center>
    <?php echo $item->ACCNUMBER; ?>
    </td>

    <td>
    <?php echo $item->NAME; ?>
    </td>

    <td>
        <center>
             <span class="<?php echo get_cross_curr_label($item->CROSSCONVERSIONFLAG) ?>">
    <?php echo get_cross_curr_text($item->CROSSCONVERSIONFLAG) ?>
    </td>

    <td>
        <center>
             <span class="<?php echo get_status_label($item->STATUS) ?>">
    <?php echo get_status_text($item->STATUS) ?>
    </td>
  


<!--  -->

    </tr>

    <?php endforeach ?> 
    <?php endif ?>
    <?php endif ?> 
    </tbody>
</table>