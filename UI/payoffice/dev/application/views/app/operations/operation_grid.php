
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

function get_deal_status_name($status)
{
    if (trim($status)=='F') {
        return 'Failed';
    } else if (trim($status)=='S') {
        return 'Success';
    } else {
        return 'Not Defined';
    }
}

function get_init_status_label($status)
{
    if (trim($status)=='F') {
        return 'ap-st-label ap-st-lb-rejected';
    } else if (trim($status)=='S') {
        return 'ap-st-label ap-st-lb-completed';
    } else {
        return 'ap-st-label';
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
    { "width": "20%" },
    { "width": "10%" },
    { "width": "20%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" }
   
   
    ]      
    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
            <th class="text-center" style="width: 10%;">DATE</th>
            <th class="text-center" style="width: 20%;">OPERATION NAME</th>
            <th class="text-center" style="width: 10%;">STATUS</th>
            <th class="text-center" style="width: 30%;">ERROR DESCRIPTION</th>
            <th class="text-center" style="width: 10%;">STARTED TIME</th>
            <th class="text-center" style="width: 10%;">FINISHED TIME</th>
            <th class="text-center" style="width: 10%;">EXECUTED USER</th>
   
    
    </tr>
    </thead>
    <tbody>
    <?php if (isset($list) && !$list[0]->errorStatus): ?>
    <?php foreach ($list as $item): ?>    
    <?php 
    
    $date =  get_formatted_date($item->date);
    $status = get_deal_status_name($item->status);
    $processName = $item->processName;
    $error = $item->error;
    $user = $item->user;
    $start = $item->started;
    $end = $item->ended;

    $statusLabel = get_init_status_label($item->status); 
   
    ?> 
    
        <tr class="ap-rw-def">  
            <td>
                <center>
                    <span class="ap-tabledata-name ap-tabledata-datetime"><?php echo $date ; ?></span>
                </center>
            </td>
            <td>                
                <span class="ap-tabledata-name" ><?php echo $processName; ?></span>
            </td>
            <td>
                <center>
                    <span class="<?php echo $statusLabel ?>"><?php echo $status; ?></span>
                </center>
            </td>
            <td>
                <center>
                    <span class="ap-tabledata-name ap-tabledata-datetime text-left" ><?php echo $error ; ?></span>
                </center>
            </td> 

            <td>
                <center>
                    <span class="ap-tabledata-name ap-tabledata-datetime"><?php echo $start ; ?></span>
                </center>
            </td>           
            
            <td>
                <center>
                    <span class="ap-tabledata-name ap-tabledata-datetime"><?php echo $end ; ?></span>
                </center>
            </td> 
           
            <td>
                <center>
                    <span class="ap-tabledata-name "><?php echo $user ; ?></span>
                </center>
            </td>
        </tr>
    <?php endforeach ?>
    <?php endif ?> 
    </tbody>
</table>