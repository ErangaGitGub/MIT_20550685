<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1">  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">


<!-- To get Nature of TXN code -->
<!-- ############################## -->	
<input class="form-control ap-inp-field" id="id-natureoftxn" type="hidden" name="natureOfTxnCode"  value=<?php if (isset($natureTxnCode)): ?> <?php echo $natureTxnCode ?> <?php endif ?>  >

<input class="form-control ap-inp-field" id="id-usertill" type="hidden" name="usertill"  
value=<?php if (isset($userTill)): ?> <?php echo $userTill ?> <?php endif ?>>
<!-- ############################## -->

<?php if (isset($txntype)): ?>
<input class="form-control ap-inp-field" id="id-txntype" type="hidden" name="txntype"  value= <?php echo $txntype ?> >
<?php endif ?>

<!-- ############################## -->
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-top: 20px;"><b>Customer Details</b></label>
<hr>
</div>
<!-- ############################## -->
<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl ">
<label class="ap-st-label-captcha" for="input-name">
SWIPE THE PASSPORT: 
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-4">
<input id="id-scan" class="form-control ap-inp-field" type="text" name="ocr" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="" tabindex="3" >
<span id="er-ocr" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-4">
<label class="ap-lbl-inp-txt" for="input-name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-barcode"></i></span><span><i class="fas fa-barcode"></i></span><span><i class="fas fa-barcode"></i></span>&nbsp;&nbsp;OCR CAPTCHA&nbsp;&nbsp;<span><i class="fas fa-barcode"></i></span><span><i class="fas fa-barcode"></i></span><span><i class="fas fa-barcode"></i></span></label>
</div>
</div>
</div>
</div>
<!-- ############################## -->

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Unique Identification Number: <span class="app-req-star">*</span></label></div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<select id="id-uintype" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select UIN Type"  tabindex="2" name="uintype">


	<option value="1" data-subtext="" >NIC No</option>
	<option value="2" data-subtext="">Business Reg No</option>
	<option value="3" data-subtext="">Foreign Passport No</option>
	<option value="4" data-subtext="">Obtain from CBSL</option>
	<option value="5" data-subtext="" selected="">SL Passport Number</option>	


</select>
<input class="form-control ap-inp-field" type="hidden" name="uinidtype" readonly  id="uinidtypehidden" tabindex="-1">
<span id="er-uintype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" >
<input id="id-uinnumber" class="form-control ap-inp-field validateuin" type="text" name="uinnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="4" >
<span id="er-uinnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
<!-- ############################## -->





<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">NIC Number: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1" >
<input id="id-uinnumber" class="form-control ap-inp-field validateuin" type="text" name="uinnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="4" >
<span id="er-uinnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="">
<a id="ap-btn-uin-search" class="ap-btn ap-cal-btn  ap-btn-uin-search" tabindex="-1"  title="Get Customer Data" ng-click="uinSearch" style="width: 100%; height: 100%;">
<span><i class="fas fa-search"></i></span>
&nbsp;GET DATA RELATED TO NIC&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>
<div id="id-comselector" class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%; height: 100%;" >

<div class="clearfix"></div>
</div>
</div>
</div>


<div class="col-md-4 ap-sinp-col-for-inp-1" style="">
<a id="ap-btn-exclude-commision" name="exludecommision" class="ap-btn ap-cal-btn" tabindex="-1"    class="ap-btn ap-btn-opt " style="width: 100%; height: 100%;">
<span><i class="fas fa-edit"></i></span>
&nbsp;EXCLUDE/CHANGE COMMISION&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>


<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Title: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-title" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Title"  tabindex="2" name="title">
								<option value="MR">MR</option>
								<option value="MS">MS</option>
								<option value="Miss">MISS</option>
								<option value="Dr">DR</option>
								<option value="Pastor">PASTOR</option>
								<option value="Rev">REV</option>
								<option value="Other">OTHER</option>								
</select>
<span id="er-title" class="ap-lbl-inp-err" for="error-msg"></span>



</div>
</div>
</div>
</div>
<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Customer Name: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-fname" class="form-control ap-inp-field" type="text" name="fname" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="34" tabindex="5" >
<span id="er-fname" class="ap-lbl-inp-err" for="error-msg"></span>
<div ng-show= "bocPara()" >
<span class="pull-right" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 200px;">BOC CUSTOMER </span>
<input id="id-customercheck" class="ap-inp-checkbox pull-left" type="checkbox" tabindex="-1">
<input class="ap-inp-checkbox pull-left" type="hidden" name="customercheck" readonly tabindex="-1">
<span class="pull-left" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 25px;">BOC STAFF </span>
<input id="id-staffcheck" class="ap-inp-checkbox pull-left" type="checkbox" tabindex="-1">
<input class="ap-inp-checkbox pull-left" type="hidden" name="staffcheck" readonly tabindex="-1">
</div>

<div ng-show= "bocPara()" >
<input id="id-custaddr1" class="form-control ap-inp-field" type="text" name="custaddr1"  minlength="1" maxlength="33" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true" value="BIA Terminal" tabindex="6">
<span id="er-custaddr1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name"> Customer Address:<span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-custaddr1" class="form-control ap-inp-field" type="text" name="custaddr1"  minlength="1" maxlength="33" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true" value="BIA Terminal" tabindex="6">
<span id="er-custaddr1" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<?php if (isset($natureTxnCode)): ?> 
<?php if ($natureTxnCode == 2 || $natureTxnCode == 3): ?>
<div class="ap-sinp-elm" >
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Air Ticket Number:</label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-airticket" class="form-control ap-inp-field" type="text" name="airticketno" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="10">
</div>
</div>
</div>
<?php endif ?>
<?php endif ?>

<!-- Start Of Category Details  -->
<!-- ############################## -->
<div class="row form-group app-form-group" style="margin-top: 20px; margin-bottom: 3px;">
<label class="app-input-label pull-left" style="margin-bottom:0px;">
<b>Category Details </b>
</label>
<label class="clearfix"></label>
<hr style="margin-top: 1px;">
</div>
<!-- ############################## -->



<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
ITRS Code: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" >
<select id="id-itrscode" class="selectpicker form-control ap-inp-field" name="itrscode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select ITRS Code"  tabindex="11"  >

<?php if (isset($itrscodes)): ?> 
<?php foreach ($itrscodes as $titrscode): ?> 
<?php if ( $titrscode->CODE == '1214' || $titrscode->CODE == '2214' ): ?>
<option value="<?php echo $titrscode->CODE; ?>" data-code="<?php echo $titrscode->NAME; ?>" selected><?php echo $titrscode->CODE; ?>  - <?php echo $titrscode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $titrscode->CODE; ?>" data-code="<?php echo $titrscode->NAME; ?>"><?php echo $titrscode->CODE; ?>  - <?php echo $titrscode->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>

</select>
<input class="form-control ap-inp-field" type="hidden" name="itrscodehidden" readonly  id="id-itrscodehidden" tabindex="-1">
<span id="er-itrscode" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->



<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Account Type Code: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-accounttypecode" class="selectpicker form-control ap-inp-field" name="accounttypecode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Account Type Code"  tabindex="12">

<?php if (isset($accounttypecodes)): ?> 
<?php foreach ($accounttypecodes as $tccounttypecode): ?> 
<?php if ( $tccounttypecode->CODE == '0'  ): ?>
<option value="<?php echo $tccounttypecode->CODE; ?>" data-code="<?php echo $tccounttypecode->NAME; ?>" selected> <?php echo $tccounttypecode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $tccounttypecode->CODE; ?>" data-code="<?php echo $tccounttypecode->NAME; ?>"><?php echo $tccounttypecode->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-accounttypecode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="accTypeCode" readonly  id="accTypeCodeHidden" tabindex="-1">
</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Transaction Sector Code: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-sectorcode" class="selectpicker form-control ap-inp-field" name="sectorcode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Transaction Sector Code"  tabindex="13">
<?php if (isset($sectorcodes)): ?> 
<?php foreach ($sectorcodes as $tsectorcode): ?> 

<option value="<?php echo $tsectorcode->CODE; ?>" data-code="<?php echo $tsectorcode->NAME; ?>" selected><?php echo $tsectorcode->NAME; ?></option>
	

<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-sectorcode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="sectorcodehidden" readonly  id="id-sectorcodehidden" tabindex="-1">
</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Major Period of Stay: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-majorcountry" class="selectpicker form-control ap-inp-field" name="majorcountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code"  tabindex="14">
<?php if (isset($countries)): ?> 
<?php foreach ($countries as $tcountry): ?> 
<?php if ( $tcountry->CODE == 'LKA'): ?>
<option value="<?php echo $tcountry->CODE; ?>" data-code="<?php echo $tcountry->NAME; ?>" selected><?php echo $tcountry->CODE; ?> - <?php echo $tcountry->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $tcountry->CODE; ?>" data-code="<?php echo $tcountry->NAME; ?>"><?php echo $tcountry->CODE; ?> - <?php echo $tcountry->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-majorcountry" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="countrycode" readonly  id="countrycodehidden" tabindex="-1">
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- ############################## -->
<!-- End Of Category Details  -->

</div>
<!-- ############################## -->
<!-- End Of Customer Details  -->


<!-- Start  Of second column Details  -->
<!-- ############################## -->
<div class="col-lg-5 " style="margin-left: 20px;">


<!-- ############################## -->
<!-- Start Of Payment Details  -->


<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-top: 20px;"><b>Payment Details</b></label>
<hr>
</div>


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Currency:  <span class="app-req-star">*</span></label>
</div> 


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector1" class="selectpicker form-control ap-inp-field" name="icurrencyselector1" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="15">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency1" readonly  id="cur1hidden" tabindex="-1">
<span id="er-icurrencyselector1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector2" class="selectpicker form-control ap-inp-field" name="icurrencyselector2" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="16">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency2" readonly  id="cur2hidden" tabindex="-1">
<span id="er-icurrencyselector2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector3" class="selectpicker form-control ap-inp-field" name="icurrencyselector3" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="17">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency3" readonly  id="cur3hidden" tabindex="-1">
<span id="er-icurrencyselector3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector4" class="selectpicker form-control ap-inp-field" name="icurrencyselector4" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="18">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency4" readonly  id="cur4hidden" tabindex="-1">
<span id="er-icurrencyselector4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<span id="er-icurrencyselector"  class="ap-lbl-inp-err" style="margin-left: 33.5%" for="error-msg"></span>
</div>

</div>

</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Amount: 
<span class="app-req-star">*</span>
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount1" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="19">
<span id="er-tamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount2" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="20">
<span id="er-tamount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount3" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="21">
<span id="er-tamount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount4" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount4" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="22">
<span id="er-tamount4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Exchange Rate: 
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate1" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="rate1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-rate1" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate1" readonly  id="id-crossrate1" tabindex="-1">
<input class="form-control ap-inp-field" type="hidden" name="crossamount1" readonly  id="id-crossamount1" tabindex="-1">
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate2" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="rate2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-rate2" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate2" readonly  id="id-crossrate2" tabindex="-1">
<input class="form-control ap-inp-field" type="hidden" name="crossamount2" readonly  id="id-crossamount2" tabindex="-1">
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate3" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="rate3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-rate" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate3" readonly  id="id-crossrate3" tabindex="-1">
<input class="form-control ap-inp-field" type="hidden" name="crossamount3" readonly  id="id-crossamount3" tabindex="-1">
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate4" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="rate4" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-rate4" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate4" readonly  id="id-crossrate4" tabindex="-1">
<input class="form-control ap-inp-field" type="hidden" name="crossamount4" readonly  id="id-crossamount4" tabindex="-1">
</div>

</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Converted LCY Amount: 
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount1" class="form-control ap-inp-field numdec numsep" type="text" name="camount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-camount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount2" class="form-control ap-inp-field numdec  numsep" type="text" name="camount2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-camount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount3" class="form-control ap-inp-field numdec  numsep" type="text" name="camount3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-camount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount4" class="form-control ap-inp-field numdec  numsep" type="text" name="camount4" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-camount4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!-- ############################## -->



<?php if (isset($natureTxnCode)): ?> 
<?php if ($natureTxnCode == '2' || $natureTxnCode == '3'): ?> 
<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Commision %:</label>
</div> 
<div class="col-md-2 ap-sinp-col-for-inp-1">
<input id="id-commision-percentage"  value="2" class="form-control ap-inp-field calculateLkr" type="number" step="any" name="commision-percentage" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1">
<span id="er-commision-percentage" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1">
<input id="id-commision" class="form-control ap-inp-field" type="text" name="commision" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1" readonly="">
<span id="er-commision" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="">
<a id="ap-btn-uin-search" class="ap-btn ap-cal-btn  ap-btn-uin-search" tabindex="-1"  title="Get Customer Data" ng-click="uinSearch" style="width: 100%; height: 100%;">
<span><i class="fas fa-search"></i></span>
&nbsp;EXCLUDE/CHANGE COMMISION&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>

</div>
</div>
</div>


<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sins-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Exclude / Change Commision For:</label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<select id="id-uintype" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Category"  tabindex="2" name="uintype">


	<option value="1" data-subtext="" >BOC Customer</option>
	<option value="2" data-subtext="">BOC Staff</option>
	<option value="3" data-subtext="">Other</option>
	


</select>
<input class="form-control ap-inp-field" type="hidden" name="uinidtype" readonly  id="uinidtypehidden" tabindex="-1">
<span id="er-uintype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-3 ap-sinp-col-for-inp-2" style="width: 28%;">
<input id="id-accountnumber" class="form-control ap-inp-field numdec" type="text" name="accountnumber" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="6" >
<span id="er-accountnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-1 ap-sinp-col-for-inp-2" style="width: 5%; height: 100%;">
<a id="ap-btn-account-search"  class="ap-btn ap-cal-btn" style="margin-top: -2px;margin-left: 0px;height: 23px;width: 100%; padding: 4px 0px;" tabindex="-1" title="Get Customer Data" ng-click="accountSearch()">
<span><i class="fas fa-search"></i></span>
</a>
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper" >
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name"> </label></div>
<div>
<span class="pull-left" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 200px;">BOC CUSTOMER </span>
<input id="id-customercheck" class="ap-inp-checkbox pull-left" type="checkbox" tabindex="-1">
<input class="ap-inp-checkbox pull-left" type="hidden" name="customercheck" readonly tabindex="-1">
<span class="pull-left" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 25px;">BOC STAFF </span>
<input id="id-staffcheck" class="ap-inp-checkbox pull-left" type="checkbox" tabindex="-1">
<input class="ap-inp-checkbox pull-left" type="hidden" name="staffcheck" readonly tabindex="-1">
<span class="pull-left" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 25px;">OTHER</span>
<input id="id-othercheck" class="ap-inp-checkbox pull-left" type="checkbox" tabindex="-1">
<input class="ap-inp-checkbox pull-left" type="hidden" name="staffcheck" readonly tabindex="-1">
</div>
</div>
</div>


<div class="ap-sinp-elm">
<div class="row form-group ap-sins-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Exclude / Change Commision Reason :</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" >
<input id="id-uinnumber" class="form-control ap-inp-field validateuin" type="text" name="uinnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="4" >
<span id="er-uinnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>

</div>
</div>
</div>












<?php endif ?>
<?php endif ?>

<!-- ############################## -->
<?php if (isset($natureTxnCode)): ?> 
<?php if ($natureTxnCode == '1'): ?> 



<!-- ############################## -->
<div class="ap-sinp-elm" >
<div class="row form-group ap-sinp-wrapper" ng-show= "workerremCheck()">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Incentive Amount: &nbsp;&nbsp; 
<span id="ap-btn-loading-incentive1" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount1" class="form-control ap-inp-field numdec numsep" type="text" name="iamount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-iamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount2" class="form-control ap-inp-field numdec numsep" type="text" name="iamount2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-iamount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount3" class="form-control ap-inp-field numdec numsep" type="text" name="iamount3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-iamount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount4" class="form-control ap-inp-field numdec numsep" type="text" name="iamount4" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="-1">
<span id="er-iamount4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm" >
<div class="row form-group ap-sinp-wrapper" ng-show= "workerremCheck()">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total Incentive: &nbsp;&nbsp; <span id="ap-btn-loading-incentive2" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-totalwithincentive" class="form-control ap-inp-field" type="text" name="totalwithincentive" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1">
<span id="er-totalwithincentive" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
<?php endif ?>
<?php endif ?>

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total Amount in LKR: &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lkrtotal" class="form-control ap-inp-field" type="text" name="lkrtotal" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1">
<span id="er-lkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">NET AMOUNT LKR: &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lkrtotal" class="form-control ap-inp-field" type="text" name="lkrtotal" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1">
<span id="er-lkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- End Of Payment Details  -->
<!-- ############################## -->


<!-- Start Of Benificiary Details  -->
<!-- ############################## -->
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-top: 20px;"><b>Counter Party / Beneficiary Details</b></label>
<hr>
</div>
<!-- ############################## -->

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">CounterParty Name:<span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<?php if (isset($natureTxnCode)): ?> 
<?php if ($natureTxnCode == 1 || $natureTxnCode == 2): ?>
<input id="id-benename" class="form-control ap-inp-field" type="text" name="benename" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1" readonly="true" value="SELF">
<?php else: ?>
<input id="id-benename" class="form-control ap-inp-field" type="text" name="benename" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1">
<?php endif; ?>
<?php endif; ?>
<span id="er-benename" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
	

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
CounterParty Country: <span class="app-req-star">*</span></label>
</div>
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-benecountry" class="selectpicker form-control ap-inp-field" name="benecountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code"  tabindex="23" >
<?php if (isset($countries)): ?> 
<?php foreach ($countries as $tcountry): ?> 

<option value="<?php echo $tcountry->CODE; ?>" data-code="<?php echo $tcountry->NAME; ?>"><?php echo $tcountry->ID; ?> -<?php echo $tcountry->CODE; ?> - <?php echo $tcountry->NAME; ?></option>

<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-benecountry" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="benecountryhid" readonly  id="benecountryhidden" tabindex="-1" value="LKA">
</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Beneficiary / Remitter Bank:<span class="app-req-star">*</span> </label>
</div>
<div class="col-md-8 ap-sinp-col-for-inp-1">
<?php if (isset($natureTxnCode)): ?> 
<?php if ($natureTxnCode == 1 || $natureTxnCode == 2 || $natureTxnCode == 3): ?>
<input id="id-benebank" class="form-control ap-inp-field" type="text" name="benebank" autocomplete="off" autocorrect="off" spellcheck="false"   tabindex="-1" readonly="true" value="7010 - Bank of Ceylon">
<?php else: ?>
<select id="id-benebank" class="selectpicker form-control ap-inp-field" name="benebank" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Bank Code"  tabindex="-1">
<?php if (isset($bankcodes)): ?> 
<?php foreach ($bankcodes as $tbankcode): ?> 
<option value="<?php echo $tbankcode->CODE; ?>" data-code="<?php echo $tbankcode->CODE; ?>" data-shrt="<?php echo $tbankcode->NAME; ?>"><?php echo $tbankcode->CODE; ?> - <?php echo $tbankcode->NAME; ?></option>
<?php endforeach ?>
<?php endif ?>
<?php endif ?>
<?php endif ?>
</select>
<span id="er-benebank" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- End Of Beneficiary Details  -->



<!-- <div class="row ap-btn-ctrl-wrapper">
</div> -->
<!-- ############################## -->


<!-- ############################## -->
<!-- <div class="form-group pull-right">
<a id="ap-savbtn-form-create" class="ap-btn ap-btn-nxt">
<span>SUBMIT</span>	
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span><i class="fas fa-chevron-right"></i></span>
</a>	
</div> -->
<!-- ############################## -->


<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right">

<span id="ap-nxtbtn" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> NEXT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-savbtn" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> SAVE</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


</div>
<div class="clearfix"></div>
</div>
</div>




</div>
</div>
</form>

