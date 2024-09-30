
<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1"> 
<?php $now = new DateTime(); ?> 
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Cheque Deposit Details</legend>


<div class="row ap-btn-ctrl-wrapper" style="margin-top: -20px;">
<div class="ap-btn-pannel">
<div class="form-group pull-right" style="margin-right: 15px;">
<a  href="<?php echo $this->config->item('base_url');?>rates/view_cheques"  class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>VIEW CHEQUE DEPOSIT DETAILS</span>&nbsp;&nbsp;
<span>
<i class="fas fa-book green"></i>
</span>
</a>

</div>
<div class="clearfix"></div>
</div>
</div>


<div class="ap-sinp-elm">
<div class="col-md-3 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Account Number: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1" >
<input id="id-accountnumber" class="form-control ap-inp-field numdec" type="text" name="accountnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="1" autofocus  >
<span id="er-accountnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
<div class="col-md-5 ap-sinp-col-for-inp-1" style="">
<a id="ap-btn-uin-search" class="ap-btn ap-cal-btn  ap-btn-uin-search" tabindex="-1"  title="Get Customer Data"  ng-click="accountSearch()" style="width: 100%; height: 100%;">
<span><i class="fas fa-search blue"></i></span>
&nbsp;GET DATA RELATED TO ACCOUNT&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>
<div class="clearfix"></div>
</div>


<div class="ap-sinp-elm">
<div class="col-md-3 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Customer Name: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-9 ap-sinp-col-for-inp-1"style="margin-top: 15px;" >
<input id="id-customername" class="form-control ap-inp-field " type="text" name="customername" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="2" >
<span id="er-customername" class="ap-lbl-inp-err" for="error-msg"></span>

</div>

<div class="clearfix"></div>
</div>



<div class="ap-sinp-elm">
<div class="col-md-3 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Debiting Bank Code: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-9 ap-sinp-col-for-inp-1"style="margin-top: 15px;" >
<input id="id-bankcode" class="form-control ap-inp-field numdec " type="text" name="bankcode" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="3" >
<span id="er-bankcode" class="ap-lbl-inp-err" for="error-msg"></span>

</div>

<div class="clearfix"></div>
</div>



<div class="ap-sinp-elm">
<div class="col-md-3 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Branch Code: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-9 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-branchcode" class="form-control ap-inp-field numdec" type="text" name="branchcode" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="4" >
<span id="er-branchcode" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
<div class="clearfix"></div>
</div>







<div class="ap-sinp-elm">
<div class="col-md-3 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Amount: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-9 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-amount" class="form-control ap-inp-field numdec numsep " type="text" name="amount" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="5" >
<span id="er-amount" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
<div class="clearfix"></div>
</div>




<!-- ################################################################-->

<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">


<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-nxtbtn-cheque" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>SAVE CHEQUE DEPOSIT DETAILS</span>&nbsp;&nbsp;
<span>
<i class="fas fa-check green"></i>
</span>
</span>

<span id="ap-backbtn-cheque" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>


<span id="ap-savbtn-cheque" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>SAVE</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

</div>
<div class="clearfix"></div>
</div>
</div>




</fieldset>
</div>
</div>
</form>