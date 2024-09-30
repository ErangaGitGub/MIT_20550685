<section id="view-section" style="margin-top: 0px;">
<!-- start of section-header -->
<div id="section-header" class="container ap-section-header">


<div class="sw-hdr-timestamp"></div>

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header" style="height:auto;">
<div class="navbar-header">  
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header" href="" style="line-height: 18px;padding: 15px 15px;">
<?php if (isset($heading)) { ?>
<span><?php echo $heading;?></span>
<?php } ?>  
</a>
    
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>
    <div class="ap-btn-group">     
    <?php if (isset($show_filter) && $show_filter): ?>
    <a data-toggle="" class="ap-btn ap-btn-new ap-btn-widget">    
    <i uib-tooltip="" uib-tooltip-append-to-body="" is-dynamic="true" icon="browse" class="xui-icon xui-icon-browse  stroked "> 
    <!--?xml version='1.0' encoding='utf-8'?-->
    <!--?xml version='1.0' encoding='utf-8'?-->
    <svg version="1.1" id="Layer_1" xmlns="" xmlns:xlink="" x="0px" y="0px" viewBox="0 0 20 20" width="20" height="20" style="enable-background:new 0 0 20 20;" xml:space="preserve">
    <style type="text/css">
        .st-browse0{fill:#FFFFFF;stroke:#767676;stroke-miterlimit:10;}
        .st-browse1{fill:none;stroke:#767676;stroke-miterlimit:10;}
        .st-browse2{fill:#767676;}
        .st-browse3{fill:none;stroke:#297994;stroke-width:2;stroke-miterlimit:10;}
        .st-browse4{fill:#FFFFFF;}
        .st-browse5{fill:#FFFFFF;stroke:#297994;stroke-miterlimit:10;}
    </style>
    <rect x="0.5" y="1.5" class="st-browse0" width="18" height="14"></rect>
    <path class="st-browse1" d="M15.5,4.5h-12v9h12V4.5z M4,18.5h10 M8,9.5h6 M5,9.5h2 M8,11.5h6 M5,11.5h2 M8,7.5h6 M5,7.5h2"></path>
    <rect x="7" y="16" class="st-browse2" width="4" height="2"></rect>
    <line class="st-browse3" x1="16" y1="5" x2="3" y2="5"></line>
    <polygon class="st-browse4" points="20,12 13,3 11,3 11,17.9 14.3,16.4 15.9,19.8 19.5,18.2 18,14.8 20,14 "></polygon>
    <path class="st-browse5" d="M12.5,15.4V5l6,7.8L12.5,15.4z"></path>
    <path class="st-browse3" d="M15.5,14.1l2.2,4.9"></path>
    </svg>
    </i>    
    <span class="ap-btn-widget-content"><span>REPORT FILTERS</span></span>
    </a>     
    <?php endif ?>
    </div>
</li>
</ul>
</div>


</header>
</div>
<!-- end of section-header -->
<!-- start of section-table -->
<div id="section-table" class="ap-section-tblcomponent container">

<script>
$(document).ready(function() {   
$('#ap-data-table').DataTable({
"paging":   false,
"info":     false,
"ordering": false,
"scrollX": true,
});
});
</script>

<table id="ap-data-table" class="ap-data-table display" style="width:100%">
<thead>
<tr>
<th class="text-left">REPORT NAME</th>
<th class="text-center">REPORT TYPE</th>
<th class="text-center">ACTIONS</th>
</tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     

<?php foreach ($list as $item): ?>    

<tr class="">  

<td>
<span style="color: #337ab7;"><?php echo $item->REPORT_NAME; ?></span>
</td>

<td>
<center>
<span class="ap-ch-lb ap-st-lb-actionbtn"><?php echo $item->REPORT_CHANNEL; ?></span>
</center>
</td>

<?php 
$URL = $this->config->item('base_url')."reports/view/".$item->REPORT_PATH."?shw=true";
?>

<td>
<center>
<a href="<?php echo $URL; ?>" class="ap-btn ap-btn-nxt ap-btn-table">    
<span>VIEW REPORT</span>&nbsp;
<span class="ap-btn-table-icon-ok"></span>
</a>

</center>
</td>     

</tr>   

<?php endforeach ?>

<?php endif ?>
</tbody>
</table>

</div>
<!-- end of section-table -->
</section>
