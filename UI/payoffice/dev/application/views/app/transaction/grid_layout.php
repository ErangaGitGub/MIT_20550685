<script src="<?php echo $this->config->item('public_url')."ang/inc/".$dir."/ang-".$route.".js";?>"></script>
<section id="view-section" style="margin-top: 0px;" ng-controller="<?php echo $controller."Controller"; ?>">
<!-- start of section-header -->
<div id="section-header" class="container ap-section-header">



<div class="sw-hdr-timestamp"> </div>

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header" href="#"><?php echo $title;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>
    <div class="ap-btn-group" style="padding: 6px 0px;"> 
    <?php if (isset($datepicker) && $datepicker): ?>
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet">  
    <script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>
    <script>
    $(document).ready(function(){
    $( "#datepicker" ).datepicker({
    dateFormat: 'yy-mm-dd',
    beforeShow: function(input, inst) {
        var widget = $(inst).datepicker('widget');
        widget.css('margin-left', ($(input).outerWidth() - widget.outerWidth()) + 22);
    }, 
    onSelect: function(dateText, inst) {
        var date = dateText;
        window.location.href = $("input[name=app-baseurl]").val()+'requests/funds?typ=al&shw=true'+'&dat='+date;
    }
    });
    });
    </script>
    <input type="text" id="datepicker" value="<?php echo $current_date; ?>" style="padding: 1px 6px;">
    <?php else: ?>
    <span class="ap-btn-widget-content" style="top: 4px; left: 4px; font-size: 13px;"><?php echo "TRANSACTION DATE: ".$current_date; ?></span>
    <?php endif ?>    

    <a class="ap-btn ap-btn-new ap-btn-widget" style="margin-top:2px; padding: 6px 6px 6px 0px;">
    <span style="position: relative;top: -3px;"></span>
    </a>        
    </div>
</li>
</ul>

</div>

</div>

</header>
</div>

<div id="section-table" class="ap-section-tblcomponent container">

<?php echo $table_view; ?>

</div>

<div id="ap-msgmdlcon">
<?php if (isset($reject_modal)): ?>
<?php echo $reject_modal; ?>
<?php endif ?>

<?php if (isset($confrm_modal)): ?>
<?php echo $confrm_modal; ?>
<?php endif ?>
</div>


</section>