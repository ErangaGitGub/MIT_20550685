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

<?php 
if ($reference==0) {
$reference = "";
}
?>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Reference Number: <span class="app-req-star">*</span></label></div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-reference" class="form-control ap-inp-field numeric_only" type="text" name="reference" value="<?php echo $reference; ?>" autocomplete="off" autocorrect="off" spellcheck="false" maxlength="16" tabindex="1">
<span id="er-reference" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_reference; ?></span>
</div>
</div>
</div>

<script>
$(document).ready(function(){
$('#id-reference').on('input', function() { 
$("#er-reference").text('');
}); 
});
</script>

<div class="ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right">
<input type="submit" value="CREATE REPORT" class="ap-btn ap-btn-nxt" tabindex="-1"></div><div class="clearfix"></div></div></div>

</div>
</form>
</div>

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
    <th class="text-center">#</th>
    <th class="text-left">ACCOUNT NAME</th>
    <th class="text-center">ACCOUNT NO</th>
    <th class="text-center">COST CENTER</th>
    <th class="text-center">TXN. TYPE</th>
    <th class="text-center">CURRENCY</th>
    <th class="text-right">AMOUNT</th>
    <th class="text-center">TRANSACTION DATE</th>
    </tr>
</thead>
<tbody>

<?php $SEQUENCENO = 0; ?>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<?php 
$date = $item->TRANSACTIONDATE;
$SEQUENCENO++;
if ($date != 0) {
$year  = substr($date, 0, 4);
$month = substr($date, 4, 2);
$day   = substr($date, 6, 2);
$formatted_date = $year.'-'.$month.'-'.$day;
} else {
$formatted_date = "";
}
?>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $SEQUENCENO; ?></span>
</td>


<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->ACCOUNT_NAME; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->ACCOUNT_NO; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->COST_CENTER; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->CODE; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->CURRENCY; ?></span>
</td>


<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->AMOUNT), 2); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $formatted_date; ?></span>
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