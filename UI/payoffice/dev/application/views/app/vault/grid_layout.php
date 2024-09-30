<script src="<?php echo $this->config->item('public_url')."ang/inc/".$dir."/ang-".$route.".js";?>"></script>
<section id="view-section" style="margin-top: 0px;" ng-controller="<?php echo $controller."Controller"; ?>">
<!-- start of section-header -->
<div id="section-header" class="container ap-section-header">


<div class="sw-hdr-timestamp"> </div>

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<?php if (isset($sourcetillname )): ?>
    <?php if ($sourcetillname == 'VAULT (POS)'): ?>
    <a class="navbar-brand ap-navbar-brand ap-navbar-brand-header" href="#">TRANSFER CASH TO TILL</a>
    <?php elseif ($sourcetillname != 'VAULT (POS)'): ?>
     <a class="navbar-brand ap-navbar-brand ap-navbar-brand-header" href="#"><?php echo $title;?> FROM  <?php echo $sourcetillname ?> aa</a>
     <?php endif ?>
<?php else :?>
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header" href="#"><?php echo $title;?>  </a>
<?php endif ?>
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
<?php if (isset($sourcetill)): ?> 
 <input class="form-control ap-inp-field" type="hidden" name="hiddensourcetill" readonly  id="id-hiddensourcetill" value=<?php if (isset($sourcetill)): ?> <?php echo $sourcetill ?>  <?php endif ?> tabindex="-1">
<?php endif ?>

<?php if (isset($destinationtill)): ?> 
 <input class="form-control ap-inp-field" type="hidden" name="hiddendestinationtill" readonly  id="id-hiddendestinationtill" value=<?php if (isset($destinationtill)): ?> <?php echo $destinationtill ?>  <?php endif ?> tabindex="-1">
<?php endif ?>


<?php if (isset($oprtype)): ?> 
<?php if ($oprtype == 'TSFT4STOPOS'): ?>
<div id="section-table" class="ap-section " style="margin-right: 20px;">
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">


<span id="ap-btn-back" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;

</span>
<span id="ap-tran-cashintopos" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> TRANSFER CASH INTO VAULT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>



</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php endif ?>
<?php endif ?>

<?php if (isset($oprtype)): ?> 
<?php if ($oprtype == 'TSFPOSTOT4S'): ?>
<div id="section-table" class="ap-section " style="margin-right: 20px;">
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">


<span id="ap-btn-back" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;

</span>
<span id="ap-tran-cashfrompos" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> TRANSFER CASH FROM VAULT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>



</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php endif ?>
<?php endif ?>

<?php if (isset($oprtype)): ?> 
<?php if ($oprtype == 'TSFCASH'): ?>
<?php if (isset($list) && is_array($list) && !empty($list)): ?>    
<div id="section-table" class="ap-section " style="margin-right: 20px;">
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-btn-back" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>

<span id="ap-btn-cash-accept-all" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-acceptall" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> ACCEPT ALL </span>&nbsp;&nbsp;
<span>
<i class="fas fa-check blue"></i>
</span>
</span>

<span id="ap-btn-cash-reject-all" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-rejectall" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> REJECT ALL </span>&nbsp;&nbsp;
<span>
<i class="fas fa-times red"></i>
</span>
</span>

</div>
<div class="clearfix"></div>
</div>
</div>
</div>    
<?php endif ?>            
<?php endif ?>
<?php endif ?>




<?php if (isset($oprtype)): ?> 
<?php if ($oprtype == 'TSFTILLTOTILL'): ?>
<div id="section-table" class="ap-section " style="margin-right: 12px; margin-left: 12px; margin-top: -20px;">

<div class="col-md-12 ap-sinp-col-for-inp-1">
<select id="id-destinationtill" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true"   tabindex="2" name="destinationtill">

    <option value="" data-subtext="" >Please Select the Destination Till to Transfer Cash</option>
    <option value="1" data-subtext="">POS VAULT</option>
    <option value="3" data-subtext="">PURCHASE COUNTER 01</option>
    <option value="4" data-subtext="">PURCHASE COUNTER 02</option>
    <option value="5" data-subtext="">SALES COUNTER 01</option>
    <option value="6" data-subtext="" >SALES COUNTER 02</option>  
    <option value="7" data-subtext="" >RE-EXCHANGE COUNTER-TRANSIT</option>
    <option value="8" data-subtext="" >RE-EXCHANGE COUNTER-DEPARTURE</option>
   

</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddendestinationtill" readonly  id="id-hiddendestinationtill" tabindex="-1">
<span id="er-destinationtill" class="ap-lbl-inp-err" for="error-msg"></span>
</div>    
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;margin-top: 20px;">

<span id="ap-btn-back" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>

<span id="ap-tran-tilltotill" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> TRANSFER CASH</span>&nbsp;&nbsp;
<span>
<i class="fas fa-check"></i>
</span>
</span>
<!-- <span id="ap-tran-tilltotill" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> TRANSFER FROM TILL TO TILL</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-sav-tilltotill" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> CONFIRM TRANSFER</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span> -->

</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php endif ?>
<?php endif ?>

<?php if (isset($oprtype)): ?> 
<?php if ($oprtype == 'TSFPOSTOTILL'): ?>


<div id="section-table" class="ap-section " style="margin-right: 20px;">
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-tran-postotill" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> TRANSFER FROM POS TO TILL</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-sav-postotill" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> CONFIRM TRANSFER</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php endif ?>
<?php endif ?>

<div id="ap-msgmdlcon">

<?php if (isset($reject_modal)): ?>
<?php echo $reject_modal; ?>
<?php endif ?>

<?php if (isset($confrm_modal)): ?>
<?php echo $confrm_modal; ?>
<?php endif ?>
</div>
 

</section>
<div id="ap-modal-container"></div>

