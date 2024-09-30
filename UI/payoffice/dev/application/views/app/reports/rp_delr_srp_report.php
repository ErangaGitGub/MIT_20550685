<section id="view-section" style="margin-top: 0px; margin-bottom: 50px;">
<div id="section-header" class="container ap-section-header">

<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>

<div class="container-fluid" style="margin-bottom:5px;">
<div tabindex="-1" class="ap-btn ap-btn-tab"><a href="<?php echo $this->config->item('base_url')."reports/view?shw=true"?>" style="color: #333;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<span>BACK TO REPORTS</span></a></div>
</div>

<div class="container-fluid">
<form id="filter-form-rtgsdr" action="" method="post" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0" tabindex="-1"> 
<div class="col-md-12">

<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet"> 
<script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>
<script>
$(document).ready(function(){

$( "#id-date" ).datepicker({
dateFormat: 'yy-mm-dd',     
onSelect: function(dateText, inst) {
$("#er-date").text("");
}
});

});
</script>


<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Date: <span class="app-req-star">*</span></label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-date" class="form-control ap-inp-field" type="text" name="date" value="<?php echo $date; ?>" autocomplete="off" autocorrect="off" spellcheck="false" readonly tabindex="1">
<span id="er-date" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_date; ?></span>
</div>

</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Channel: <span class="app-req-star">*</span></label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1">
<select id="id-channel" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Channel" tabindex="2">
<option value="all" data-subtext="">All Channels</option>
<option value="rtgs" data-subtext="">RTGS</option>
</select>
<script>$('#id-channel').selectpicker('val', '<?php echo strtolower($channel); ?>');</script>
<input class="form-control ap-inp-field" type="hidden" name="channel" value="<?php echo strtolower($channel); ?>" readonly autocomplete="off" autocorrect="off" spellcheck="false" tabindex="-1">
<span id="er-channel" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_channel; ?></span>
</div>
</div>


<script>
$(document).ready(function(){

$('#id-channel').on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {    
var o = $("#id-channel option:eq("+clickedIndex+")").val(); 

$("input[name=channel]").val(o);
$("#er-channel").text('');

});

$('#id-date').on('input', function() { 
$("#er-date").text('');
}); 


});
</script>


</div>

<div class="ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right">
<input type="submit" value="CREATE REPORT" class="ap-btn ap-btn-nxt" tabindex="-1"></div><div class="clearfix"></div></div></div>

</div>
</form>

<!-- ##################################### -->
<div id="rp-container">
<hr class="ap-rp-hr-t">
<div class="container-fluid">
<div class="col-md-8 ap-pl-0 ap-pr-0"><h4 class="ap-rp-name ap-lg-mt-30"><?php echo "Report Name: ".$report_name; ?></h4></div>
<div class="col-md-4 ap-pl-0 ap-pr-0 col-md-4-right">
<h4 class="ap-rp-name"></h4>
<p class="ap-rp-meta"><?php echo "Report Created On: ".$created_on; ?></p>
<p class="ap-rp-meta"><?php echo "Report Created At: ".$created_at; ?></p>
<p class="ap-rp-meta"><?php echo "Report Created By: ".$created_by; ?></p>
</div>
<div class="clearfix"></div>
</div>
<hr class="ap-rp-hr-b">

<div class="container-fluid" style="overflow-y: scroll; height:58vh;">

<!-- options -->  

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 

<?php if (isset($options)): ?>
<?php echo $options; ?>
<?php endif ?>

<?php else: ?>
<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 0, 'asc' ]

});

});
</script>
<?php endif ?>

<?php else: ?>
<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 0, 'asc' ]

});

});
</script>
<?php endif ?>
    
<table id="rtgs-report" class="ap-data-table display" style="width:100%">
<thead>
<tr>
<th class="text-center">BANK REFERENCE</th>
<th class="text-left">CUSTOMER ACCOUNT</th>
<th class="text-center">CHANNEL</th>
<th class="text-center">ORIGINATED BRANCH</th>
<th class="text-center">INSTRUCTED CURRENCY</th>
<th class="text-right">INSTRUCTED AMOUNT</th>
<th class="text-center">TRANSMIT CURRENCY</th>
<th class="text-right">TRANSMIT AMOUNT</th>
<th class="text-center">BOOK RATE</th>
<th class="text-center">REQ. RATE</th>
<th class="text-center">SPECIAL RATE</th>
<th class="text-center">STATUS</th>
<th class="text-center">LAST UPDATED BY</th>
<th class="text-center">LAST UPDATED AT</th>
</tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export"><?php echo number_format($item->BANKREFERENCE,0,'.',''); ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->REMITTERAC; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->TRANSFERCHANNEL; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->BRANCHCODE; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->INSTRUCTEDCURRENCY; ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->INSTRUCTEDAMOUNT), 2); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->TRANSMITCURRENCY; ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->TRANSFERAMOUNT), 2); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->BOOKRATE), 7); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->REQUESTEDRATE), 7); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->SPECIALRATE), 7); ?></span>
</td>

<?php 
    
$status_code = $item->INITIAL_STATUS;

if (trim($status_code)=='IE') {
$status = 'Request In Progress';
} else if (trim($status_code)=='B1R') {
$status = 'Request Rejected';
} else if (trim($status_code)=='B1A') {
$status = 'Request In Progress';
} else if (trim($status_code)=='IM') {
$status = 'Request In Progress';
} else if (trim($status_code)=='A1R') {
$status = 'Request Rejected';
} else if (trim($status_code)=='A1A') {
$status = 'Request Completed';
} else if (trim($status_code)=='A1F') {
$status = 'Request On Hold';
} else if (trim($status_code)=='A1D') {
$status = 'Request On Hold';
} else if (trim($status_code)=='IF') {
$status = 'Request On Hold';
} else {
$status = 'Not Defined';
}

?>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $status; ?></span>
</td>

<?php 
$last_updated_by = trim($item->LAST_UPDATED_USER);
?>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $last_updated_by; ?></span>
</td>


<?php 

$date = trim($item->LAST_UPDATED_DATE);
$time = trim($item->LAST_UPDATED_TIME);

if ($date==0 || $time=="") {
$last_updated = "-";
} else {
if ($date != 0) {
$year  = substr($date, 0, 4);
$month = substr($date, 4, 2);
$day   = substr($date, 6, 2);
$formatted_date = $year.'-'.$month.'-'.$day;
$last_updated = $formatted_date." ".$time;
} else {
$last_updated = "-";
}
}

?>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $last_updated; ?></span>
</td>

</tr>   

<?php endforeach ?>
<?php endif ?>
<?php endif ?>
</tbody>
</table>

</div>
</div>

</div>
</div>
</section>