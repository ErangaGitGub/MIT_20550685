<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1"> 
<?php $now = new DateTime(); ?> 
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<legend class="scheduler-border">View Transactions</legend>



<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">From Date: <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-fromdate" class="form-control ap-inp-field" type="Date" name="fromdate" minlength="8" maxlength="11"   autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase" tabindex="-1">
<span id="er-fromdate" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">To Date: <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" >
<input id="id-todate" class="form-control ap-inp-field" type="Date" name="todate" minlength="8" maxlength="11"   autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase" tabindex="-1">
<span id="er-todate" class="ap-lbl-inp-err" for="error-msg"></span>
</div>



<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Transaction Type : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<select id="id-txntype" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Transaction Type"  tabindex="2"  name="txntype" >
    <option value="ALL" data-subtext="" selected="">All</option>
	<option value="FCP" data-subtext="">FCP - Foreign Currency Purchase</option>
	<option value="FCS" data-subtext="">FCS - Foreign Currency Sales</option>
	<option value="FCR" data-subtext="">FCR - Foreign Currency Re-Exchange</option>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddentxntype" readonly  id="idhiddentxntype" tabindex="-1" value ="ALL">
<span id="er-txntype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Transaction Status : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<select id="id-txnstatus" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Transaction Status"  tabindex="2"  name="txnstatus" >
    <option value="ALL" data-subtext="" selected="">All</option>
    <option value="X" data-subtext="">Pending Cancel</option>
	<option value="C" data-subtext="">Cancelled</option>
	<option value="" data-subtext="">Successful</option>
	
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddentxnstatus" readonly  id="idhiddentxnstatus" tabindex="-1" value ="ALL">
<span id="er-txnstatus" class="ap-lbl-inp-err" for="error-msg"></span>
</div>






<!-- ############################## -->




<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-nxtbtn-view" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> NEXT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-savbtn-view" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> VIEW TRANSACTIONS</span>&nbsp;&nbsp;
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