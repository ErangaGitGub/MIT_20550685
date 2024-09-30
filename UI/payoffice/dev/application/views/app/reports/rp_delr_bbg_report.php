<style type="text/css">

 input[type="checkbox"]:checked:before {
    content: "\2714";
    background: linear-gradient(to bottom, #e6e6e6 0px, #fff 100%) repeat scroll 0 0 rgba(0, 0, 0, 0); 
    border-color: #3d9000;
    color: #3d9000;
    font-size: 11px;
    font-weight: bold;
    line-height: 35px;
    text-align: center;
    position: relative;
    top: -11px;
    right: -2px;
    background: transparent;
}

</style>

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

<div class="container-fluid" style="overflow-y: scroll; height:69vh;">

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
<th class="text-center"></th>
<th class="text-center">INSTRUMENT</th>
<th class="text-center">CURRENCY</th>
<th class="text-center">SIDE</th>
<th class="text-center">START TENOR</th>
<th class="text-center">VALUE DATE</th>
<th class="text-center">FAR TENOR</th>
<th class="text-right">AMOUNT</th>
<th class="text-left">ACCOUNT</th>
<th class="text-center">COUNTER PARTIES</th>
<th class="text-center">MARKET TYPE</th>
<th class="text-center">DIRECTION</th>
<th class="text-center">TYPE</th>        
<th class="text-left">SPECIAL INSTRUCTIONS</th>
</tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?> 
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export">
<input id="<?php echo $item->reference; ?>" type="checkbox" name="<?php echo "bbg-cbox-".$item->reference; ?>" disabled>
</span>
</td> 

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->Instrument; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->Currency; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->Side; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->StartTenor; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->ValueDate; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->FarTenor; ?></span>
</td>

<td class="text-right">
<span class="ap-tabledata-export"><?php echo number_format(floatval ($item->Amount), 2); ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->Account ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->Counterparties; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->MarketType; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->Direction; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->Type; ?></span>
</td>

<td class="text-left">
<span class="ap-tabledata-export"><?php echo $item->SpecialInstruction; ?></span>
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