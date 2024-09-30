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

$('#id-brncode').on('input', function() { 
$("#er-brncode").text('');
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
    <th class="text-center">REFERENCE NO</th>
    <th class="text-center">BRANCH CODE</th>
    <th class="text-left">BRANCH</th>
    <th class="text-right">CASH AT BANKERS</th>
    <th class="text-right">COMMISSION A/C SPECIAL SERVICES</th>
    <th class="text-right">SWIFT CHARGES RECOVERED A/C</th>
    <th class="text-right">COMMISSION A/C MTS DTS</th>
    <th class="text-right">TOTAL</th>
    </tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->referenceNo; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->branchCode; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->branchName; ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->cash_Bank), 2); ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->comSpService), 2); ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->swiftChg), 2); ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->comMtsDts), 2); ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->total), 2); ?></span>
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