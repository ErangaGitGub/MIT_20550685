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
    { "width": "15%" },
    { "width": "20%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
   
   
    ]      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    <th class="text-center">USER PF NUMBER</th>
    <th class="text-center">USER NAME</th> 
    <th class="text-center">ENROLLED USER</th>       
    <th class="text-center">ENROLLED DATE</th>     
    <th class="text-center">STATUS</th>
    
    </tr>
    </thead>
    <tbody>

    <?php if (isset($user) && is_array($user) && !empty($user)): ?>
    <?php if (!isset($user[0]->errorStatus) || $user[0]->errorStatus!=1): ?>   
    <?php foreach ($user as $item): ?>

    <?php 

    $url = "";
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

            <td>
    <center>
    <a href="<?php echo $url?>">
    <?php echo $item->USERPF; ?>
    </a>
    </td>

    <td>
    <center>
    <?php echo $item->USERNAME; ?>
    </td>
       

    <td>
    <center>
    <?php echo $item->ENROLLEDUSER; ?>
    </td>



    <td>
    <center>
    <?php echo $item->ENROLLEDDATE; ?>
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