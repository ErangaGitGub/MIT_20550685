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

$( "#id-frmdate" ).datepicker({
dateFormat: 'yy-mm-dd',     
onSelect: function(dateText, inst) {
$("#er-frmdate").text("");
$("#er-todate").text("");
$("input[name=todate]").val(dateText);
}
});

$( "#id-todate" ).datepicker({
dateFormat: 'yy-mm-dd',
onSelect: function(dateText, inst) {
$("#er-frmdate").text("");
$("#er-todate").text("");
}
});

});
</script>


<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Date (From Date | To Date): <span class="app-req-star">*</span></label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-frmdate" class="form-control ap-inp-field" type="text" name="frmdate" value="<?php echo $frmdate; ?>" autocomplete="off" autocorrect="off" spellcheck="false" readonly tabindex="1">
<span id="er-frmdate" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_frmdate; ?></span>
</div>

<div class="col-md-4 ap-sinp-col-for-inp-2">
<input id="id-todate" class="form-control ap-inp-field" type="text" name="todate" value="<?php echo $todate; ?>" autocomplete="off" autocorrect="off" spellcheck="false" readonly tabindex="2">
<span id="er-todate" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_todate; ?></span>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Branch: <span class="app-req-star">*</span></label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1">
<?php if (isset($cluster) && $cluster==="DBU"): ?>
<select id="id-brntypeselector" class="selectpicker form-control ap-inp-field" name="brntypeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Branch Type" disabled tabindex="3">
<option value="code" data-subtext="">Branch Code</option>
</select>
<?php else: ?>
<select id="id-brntypeselector" class="selectpicker form-control ap-inp-field" name="brntypeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Branch Type" tabindex="3">
<option value="code" data-subtext="">Branch Code</option>
<option value="all" data-subtext="">All Branches</option>
</select>
<?php endif ?>
<input id="id-branchtype" class="form-control ap-inp-field" type="hidden" name="branchtype" value="" readonly autocomplete="off" autocorrect="off" spellcheck="false" tabindex="-1">
</div>

<div class="col-md-4 ap-sinp-col-for-inp-2">
<?php if ($branchtype==="code"): ?>
<div id="id-brncode-grp">
<?php else: ?>
<div id="id-brncode-grp" style="display:none;"> 
<?php endif ?>

<?php if (isset($cluster) && $cluster==="DBU"): ?>
<input id="id-brncode" class="form-control ap-inp-field numeric_only" type="text" name="brncode" placeholder="Branch Code" value="<?php echo $brncode; ?>" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" readonly>
<?php else: ?>
<input id="id-brncode" class="form-control ap-inp-field numeric_only" type="text" name="brncode" placeholder="Branch Code" value="<?php echo $brncode; ?>" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4">
<?php endif ?>

<span id="er-brncode" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_brncode; ?></span>
</div>
</div>
</div>

</div>


<script>
$(document).ready(function(){
var btype = '<?php echo $branchtype; ?>';
var bcode = '<?php echo $brncode; ?>';
$('#id-brntypeselector').val(btype).selectpicker('refresh'); 
$("input[name=branchtype]").val(btype);
$("input[name=brncode]").val(bcode);


$('#id-brntypeselector').on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {    
var o = $("#id-brntypeselector option:eq("+clickedIndex+")").val(); 
var bcode = '<?php echo $ubranch; ?>';

$("input[name=branchtype]").val(o);
$("#er-brncode").text('');


if (o==="all") {
$("input[name=brncode]").val('0');
$("#id-brncode-grp").hide();
} else {
$("input[name=brncode]").val(bcode);
$("#id-brncode-grp").show();
}

});

$('#id-frmdate').on('input', function() { 
$("#er-frmdate").text('');
}); 

$('#id-todate').on('input', function() { 
$("#er-todate").text('');
}); 

$('#id-brncode').on('input', function() { 
$("#er-brncode").text('');
}); 


});
</script>

<?php 
if ($glaccount==0) {
$glaccount = "";
}
?>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">GL Account Number: <span class="app-req-star">*</span></label></div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-glaccount" class="form-control ap-inp-field numeric_only" type="text" name="glaccount" value="<?php echo $glaccount; ?>" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1">
<span id="er-glaccount" class="ap-lbl-inp-err" for="error-msg"><?php echo $er_glaccount; ?></span>
</div>
</div>
</div>

<script>
$(document).ready(function(){
$('#id-glaccount').on('input', function() { 
$("#er-glaccount").text('');
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

<div class="container-fluid" style="overflow-y: scroll; height:52vh;">

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
"order": [ 1, 'asc' ]

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
"order": [ 1, 'asc' ]

});

});
</script>
<?php endif ?>
    
<table id="rtgs-report" class="ap-data-table display" style="width:100%">
<thead>
    <tr>
    <th class="text-center">DATE</th>
    <th class="text-center">REFERENCE NO</th>
    <th class="text-center">ORDERING BRANCH</th>
    <th class="text-left">ORDERING NAME</th>
    <th class="text-center">ORDERING A/C</th>
    <th class="text-center">BENEFICIARY BANK</th>
    <th class="text-left">BENEFICIARY NAME</th>
    <th class="text-right">AMOUNT</th>
    <th class="text-center">TXN. TYPE</th>
    </tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<?php 
$date = $item->DATE;
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
<span class="ap-tabledata-export"><?php echo $formatted_date; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo number_format($item->REFERENCE_NO,0,'.',''); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->ORDERING_BRANCH; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->ORDERING_NAME; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->ORDERING_AC; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->BENEFICIARY_BANK; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->BENEFICIARY_NAME; ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->TRANSACTION_AMOUNT), 2); ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->CODE; ?></span>
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