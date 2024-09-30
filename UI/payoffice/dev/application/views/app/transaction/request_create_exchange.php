<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " 
>  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6" style="margin-left: 0px; padding-left: 0px;">


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
<label class="app-input-label" style="margin-top: 10px;"><b>Customer Details</b></label>
<span  id="ap-clrbtn-customer" class="ap-btn ap-btn-nxt pull-right" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none; "><i class="fa fa-spinner fa-spin"></i></span>
<span> CLEAR CUSTOMER DETAILS</span>&nbsp;&nbsp;
<span>
<i class="fas fa-times"></i>
</span>
</span>
<hr>
</div>
<!-- ############################## -->
<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">OCR Captcha: </label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-4">
<input id="id-scan" class="form-control ap-inp-field" type="text" name="ocr" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="" tabindex="1" autofocus>
<span id="er-ocr" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%; height: 100%;">
<span class="ap-st-label ap-st-lb-initiated" style="display: block; text-align: center;">
	<span><i class="fas fa-passport"></i></span>
SWIPE THE PASSPORT
</div>

</div>

</div>
<span id="er-ocr" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Unique Identification Number: <span class="app-req-star">*</span></label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-4" >
<select id="id-uintype" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select UIN Type"  tabindex="2" name="uintype">


	<option value="1" data-subtext="" >NIC NO</option>
	<option value="2" data-subtext="">BUSINESS REG NO</option>
	<option value="3" data-subtext="" selected="">FOREIGN PASSPORT NO</option>
	<option value="4" data-subtext="">OBTAIN FROM CBSL</option>
	<option value="5" data-subtext="">SL PASSPORT NO</option>


</select>
<input class="form-control ap-inp-field" type="hidden" name="uinidtype" readonly  id="uinidtypehidden" 
value="3">
<span id="er-uintype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%;">
<input id="id-uinnumber" class="form-control ap-inp-field validateuin" type="text" name="uinnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="3" >
<span id="er-uinnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
<!-- ############################## -->





<!-- ############################## -->
<!-- <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">NIC Number: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1" >
<input id="id-nicnumber" class="form-control ap-inp-field validateuin" type="text" name="nicnumber" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase" tabindex="4" >
<span id="er-nicnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="">
<a id="ap-btn-uin-search" class="ap-btn ap-cal-btn  ap-btn-uin-search" 
  title="Get Customer Data" ng-click="uinSearch" style="width: 100%; height: 100%;">
<span><i class="fas fa-search"></i></span>
&nbsp;GET DATA RELATED TO NIC&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>
<div id="id-comselector" class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%; height: 100%;" >

<div class="clearfix"></div>
</div>
</div>
</div> -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Title: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-title" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Title"  tabindex="4" name="title">
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

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Customer Name: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-fname" class="form-control ap-inp-field" type="text" name="fname" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="200" tabindex="5" style="text-transform: uppercase;">
<span id="er-fname" class="ap-lbl-inp-err" for="error-msg"></span>



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
<label class="ap-lbl-inp-txt" for="input-name"> Customer Address:<span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-custaddr1" class="form-control ap-inp-field" type="text" name="custaddr1"  minlength="1" maxlength="33" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true" value="BIA TERMINAL" >
<span id="er-custaddr1" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
</div>
<!-- ############################## -->


<!-- ############################## -->

<div class="ap-sinp-elm" >
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Air Ticket Number:</label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-airticket" class="form-control ap-inp-field" type="text" name="airticketno" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="6">
</div>
</div>
</div>


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
<select id="id-itrscode" class="selectpicker form-control ap-inp-field" name="itrscode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select ITRS Code"   >

<?php if (isset($itrscodes)): ?> 
<?php foreach ($itrscodes as $titrscode): ?> 
<?php if ( $titrscode->code == '1214' || $titrscode->code == '2214' ): ?>
<option value="<?php echo $titrscode->code; ?>" data-code="<?php echo $titrscode->name; ?>" selected><?php echo $titrscode->code; ?>  - <?php echo $titrscode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $titrscode->code; ?>" data-code="<?php echo $titrscode->name; ?>"><?php echo $titrscode->code; ?>  - <?php echo $titrscode->name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>

</select>
<input class="form-control ap-inp-field" type="hidden" name="itrscodehidden" readonly  id="id-itrscodehidden"  value="2214">
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
<select id="id-accounttypecode" class="selectpicker form-control ap-inp-field" name="accounttypecode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Account Type Code"  >

<?php if (isset($accounttypecodes)): ?> 
<?php foreach ($accounttypecodes as $tccounttypecode): ?> 
<?php if ( $tccounttypecode->code == '0'  ): ?>
<option value="<?php echo $tccounttypecode->code; ?>" data-code="<?php echo $tccounttypecode->name; ?>" selected> <?php echo $tccounttypecode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $tccounttypecode->code; ?>" data-code="<?php echo $tccounttypecode->name; ?>"><?php echo $tccounttypecode->name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-accounttypecode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="accounttypecodehidden" readonly  id="id-accounttypecodehidden" 
 value="0">
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
<select id="id-sectorcode" class="selectpicker form-control ap-inp-field" name="sectorcode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Transaction Sector Code"  >
<?php if (isset($sectorcodes)): ?> 
<?php foreach ($sectorcodes as $tsectorcode): ?> 
<?php if ( $tsectorcode->code == '18'  ): ?>
<option value="<?php echo $tsectorcode->code; ?>" data-code="<?php echo $tsectorcode->name; ?>" selected><?php echo $tsectorcode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $tsectorcode->code; ?>" data-code="<?php echo $tsectorcode->name; ?>"><?php echo $tsectorcode->name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-sectorcode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="sectorcodehidden" readonly  id="id-sectorcodehidden" 
>
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
<select id="id-majorcountry" class="selectpicker form-control ap-inp-field" name="majorcountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code" tabindex="7" 
>
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
<input class="form-control ap-inp-field" type="hidden" name="majorcountryhidden" readonly  id="id-majorcountryhidden" 
 value="LKA">
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- ############################## -->
<!-- End Of Category Details  -->
<!-- Start Of Benificiary Details  -->
<!-- ############################## -->
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-top: 20px;"><b>Counter Party / Beneficiary Details</b></label>
<hr>
</div>
<!-- ############################## -->

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">CounterParty Name:<span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">

<input id="id-benename" class="form-control ap-inp-field" type="text" name="benename" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true" 
  value="SELF">

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
<select id="id-benecountry" class="selectpicker form-control ap-inp-field" name="benecountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code"   >



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
<span id="er-benecountry" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="benecountryhidden" readonly  id="id-benecountryhidden" 
 value="LKA">
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

<select id="id-benebank" class="selectpicker form-control ap-inp-field" name="benebank" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Bank Code"  
>
<?php if (isset($bankcodes)): ?> 
<?php foreach ($bankcodes as $tbankcode): ?> 
<?php if ( $tbankcode->code == '7010'): ?>
<option value="<?php echo $tbankcode->code; ?>" data-code="<?php echo $tbankcode->code; ?>" data-shrt="<?php echo $tbankcode->name; ?>" selected><?php echo $tbankcode->code; ?> - <?php echo $tbankcode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $tbankcode->code; ?>" data-code="<?php echo $tbankcode->code; ?>" data-shrt="<?php echo $tbankcode->name; ?>" ><?php echo $tbankcode->code; ?> - <?php echo $tbankcode->name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>


</select>
<span id="er-benebank" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="benebankhidden" readonly  id="id-benebankhidden" 
 value="7010">
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- End Of Beneficiary Details  -->

</div>
<!-- ############################## -->
<!-- End Of Customer Details  -->


<!-- Start  Of second column Details  -->
<!-- ############################## -->
<div class="col-lg-6 " style="margin-left: 0px; padding-left: 50px;">


<!-- ############################## -->
<!-- Start Of Payment Details  -->

<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-top: 10px;"><b>Payment Details</b></label>
<span  id="ap-clrbtn-payment" class="ap-btn ap-btn-nxt pull-right" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none; "><i class="fa fa-spinner fa-spin"></i></span>
<span> CLEAR PAYMENT DETAILS</span>&nbsp;&nbsp;
<span>
<i class="fas fa-times"></i>
</span>
</span>
<hr>
</div>

<div class="ap-sinp-elm" >
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl ">
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<a id="ap-btn-currency-calculator"  name="currencycalculator"  class="ap-btn ap-cal-btn "  class="ap-btn ap-btn-opt " style="width: 100%; height: 100%;" tabindex="8" target="#ap-message-modal" href=""><span><i class="fas fa-calculator"></i></span>
&nbsp;CURRENCY CALCULATOR&nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></a>
<!-- <a  id="ap-btn-currency-calculator" name="currencycalculator" class="ap-btn ap-cal-btn"  class="ap-btn ap-btn-opt " style="width: 100%; height: 100%;" >

</a> -->
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Exchange Receipt Number: </label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-4" >
<input id="id-receiptNumber" class="form-control ap-inp-field" type="text" name="receiptNumber" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9" >
<span id="er-receiptNumber" class="ap-lbl-inp-err" for="error-msg"></span>
<span id="er-prvlkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%; height: 100%;">
<a id="ap-vfrybtn-form-verifyreceipt" class="ap-btn ap-cal-btn  ap-btn-verify-bref" 
 title="Exchange Receipt Verefication" style="width: 100%; height: 100%;">
<span><i class="fas fa-check"></i></span>
&nbsp;VERIFY &nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>

</div>
</div>


<!-- ############################## -->


<!-- ############################## -->


<div class="ap-sinp-elm" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper" ng-show="receiptPara()">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Previous Exchange Currency: </label></div>
<div class="col-md-2 ap-sinp-col-for-inp-1">
<input id="id-prvcurr1" class="form-control ap-inp-field" type="text" name="prvcurr1" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvcurr1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvcurr2" class="form-control ap-inp-field" type="text" name="prvcurr2" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvcurr2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvcurr3" class="form-control ap-inp-field" type="text" name="prvcurr3" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvcurr3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvcurr4" class="form-control ap-inp-field" type="text" name="prvcurr4" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvcurr4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>

<div class="ap-sinp-elm" style="margin-top: 2px;" ng-show="receiptPara()">
<div class="row form-group ap-sins-wrapper" >
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Previous Exchange Amount: </label></div>
<div class="col-md-2 ap-sinp-col-for-inp-1">
<input id="id-prvamt1" class="form-control ap-inp-field" type="text" name="prvamt1" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvamt1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvamt2" class="form-control ap-inp-field" type="text" name="prvamt2" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvamt2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvamt3" class="form-control ap-inp-field" type="text" name="prvamt3" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvamt3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-1" >
<input id="id-prvamt4" class="form-control ap-inp-field" type="text" name="prvamt4" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvamt4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>

<div class="ap-sinp-elm" ng-show= "receiptPara()" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper"   >
<div>	
<div class="col-md-4 ap-sinp-col-for-lbl" >
<label class="ap-lbl-inp-txt" for="input-name">Previous Exchange Date:</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-prvtimestamp" class="form-control ap-inp-field" type="text" name="prvtimestamp" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvtimestamp" class="ap-lbl-inp-err" for="error-msg"></span>
</div> 
</div>
</div>
</div>

<div class="ap-sinp-elm" ng-show= "receiptPara()" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper"   >
<div>	
<div class="col-md-4 ap-sinp-col-for-lbl" >
<label class="ap-lbl-inp-txt" for="input-name">Previous LKR Total to Customer:</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-prvlkrtotal" class="form-control ap-inp-field" type="text" name="prvlkrtotal" autocomplete="off" autocorrect="off" spellcheck="false"  
 readonly="">
<span id="er-prvlkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div> 
</div>
</div>
</div>

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Currency:  <span class="app-req-star">*</span></label>
</div> 


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector1" class="selectpicker form-control ap-inp-field" name="icurrencyselector1" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="10">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency1" readonly  id="cur1hidden" 
>
<span id="er-icurrencyselector1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector2" class="selectpicker form-control ap-inp-field" name="icurrencyselector2" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select" disabled="" >
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency2" readonly  id="cur2hidden" 
>
<span id="er-icurrencyselector2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector3" class="selectpicker form-control ap-inp-field" name="icurrencyselector3" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select" disabled="" >
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency3" readonly  id="cur3hidden" 
>
<span id="er-icurrencyselector3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector4" class="selectpicker form-control ap-inp-field" name="icurrencyselector4" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select" disabled="" >
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency4" readonly  id="cur4hidden" 
>
<span id="er-icurrencyselector4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<span id="er-icurrencyselector"  class="ap-lbl-inp-err" style="margin-left: 33.5%" for="error-msg"></span>
</div>

</div>

</div>
<!-- ############################## -->


<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
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
<input id="id-tamount1" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="11">
<span id="er-tamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount2" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount2" autocomplete="off" autocorrect="off" spellcheck="false" readonly="" >
<span id="er-tamount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount3" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount3" autocomplete="off" autocorrect="off" spellcheck="false" readonly="" >
<span id="er-tamount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount4" class="form-control ap-inp-field numdec numsep calculateLkr" type="text" name="tamount4" autocomplete="off" autocorrect="off" spellcheck="false" readonly="" >
<span id="er-tamount4" class="ap-lbl-inp-err" for="error-msg"></span>
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
<label class="ap-lbl-inp-txt" for="input-name">Exchange Rate: 
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate1" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate1" autocomplete="off" autocorrect="off" readonly="true" spellcheck="false"  
>
<span id="er-rate1" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate1" readonly  id="id-crossrate1" 
>
<input class="form-control ap-inp-field" type="hidden" name="crossamount1" readonly  id="id-crossamount1" 
>
<input class="form-control ap-inp-field" type="hidden" name="rate1-default" readonly  id="id-rate1-default" >
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate2" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate2" autocomplete="off" autocorrect="off" readonly="" spellcheck="false"  
>
<span id="er-rate2" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate2" readonly  id="id-crossrate2" 
>
<input class="form-control ap-inp-field" type="hidden" name="crossamount2" readonly  id="id-crossamount2" 
>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate3" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate3" autocomplete="off" autocorrect="off" readonly="" spellcheck="false"  
>
<span id="er-rate" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate3" readonly  id="id-crossrate3" 
>
<input class="form-control ap-inp-field" type="hidden" name="crossamount3" readonly  id="id-crossamount3" 
>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate4" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate4" autocomplete="off" autocorrect="off" readonly="" spellcheck="false"  
>
<span id="er-rate4" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="crossrate4" readonly  id="id-crossrate4" 
>
<input class="form-control ap-inp-field" type="hidden" name="crossamount4" readonly  id="id-crossamount4" 
>
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
<label class="ap-lbl-inp-txt" for="input-name">Converted Amount: 
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount1" class="form-control ap-inp-field numdec numsep" type="text" name="camount1" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true" value="0">
<span id="er-camount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount2" class="form-control ap-inp-field numdec  numsep" type="text" name="camount2" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true" value="0">
<span id="er-camount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount3" class="form-control ap-inp-field numdec  numsep" type="text" name="camount3" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true" value="0">
<span id="er-camount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount4" class="form-control ap-inp-field numdec  numsep" type="text" name="camount4" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true" value="0">
<span id="er-camount4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!-- ############################## -->
<!-- <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Converted Amount Total (LKR): &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lcytotal" class="form-control ap-inp-field" type="text" name="lcytotal" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-lcytotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div> -->



<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">commission Fee:</label>
</div> 
<div class="col-md-2 ap-sinp-col-for-inp-1">
<input id="id-commision-percentage"   class="form-control ap-inp-field calculateLkr" type="number" step="any" name="commision-percentage" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-commision-percentage" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-6 ap-sinp-col-for-inp-1">
<input id="id-commision" class="form-control ap-inp-field" type="text" name="commision" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-commision" class="ap-lbl-inp-err" for="error-msg"></span>
</div>






</div>
</div>
</div>



<!-- ############################## -->




<div class="ap-sinp-elm" style="margin-top: 2px;" ng-show="commision">
<div class="row form-group ap-sins-wrapper" >
<div class="col-md-4 ap-sinp-col-for-lbl">
</div>
<div class="col-md-8 ap-sinp-col-for-lbl">

<div class="col-md-6 ap-sinp-col-for-lbl">
<input type="radio" id="id-staffcheck" name="staffORforcescheck" value="staff" class="ap-inp-radio" style="margin-top: 5px;">
<label class="ap-lbl-inp-txt" for="input-name" >BOC STAFF</label>
</div>	
<div class="col-md-6 ap-sinp-col-for-lbl">
<input type="radio" id="id-forcescheck" name="staffORforcescheck" value="forces" class="ap-inp-radio"> 
<label class="ap-lbl-inp-txt" for="input-name">SPECIAL FORCES</label>
</div>
</div>
</div>
</div>


<div class="ap-sinp-elm" ng-show= "commision" >
<div class="row form-group ap-sins-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">PF Number / NIC Number</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" >
<input id="id-commreason" class="form-control ap-inp-field" type="text" name="commreason" minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase"  >
<span id="er-commreason" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>





<!-- ############################## -->


<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total LKR Amount: &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lkrtotal" class="form-control ap-inp-field" type="text" name="lkrtotal" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-lkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>


 <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Ceiling/Floor commission : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-comgltotal" class="form-control ap-inp-field" type="text" name="comgltotal" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-comgltotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-rejected" style="display: block; text-align: center;">
COMMISSION A/C CREDIT
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total Receivable Amount : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-customertotal" class="form-control ap-inp-field" type="text" name="customertotal" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-customertotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-completed" style="display: block; text-align: center;">
TILL CASH IN
</div>
</div>
</div>
</div>


 <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Received Amount : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-receivedAmount" class="form-control ap-inp-field numdec numsep calculateRefund" type="text" name="receivedAmount" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="12"  
 >
<span id="er-receivedAmount" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>

 <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Refund Amount : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-refundAmount" class="form-control ap-inp-field" type="text" name="refundAmount" autocomplete="off" autocorrect="off" spellcheck="false"   
 readonly="">
<span id="er-refundAmount" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>



<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Remarks  : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id ="id-remarks" name="remarks" class="form-control ap-inp-field" tabindex="13"></textarea>
<span id="er-remarks" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- End Of Payment Details  -->
<!-- ############################## -->
<!-- <div class="alert alert-success row " style="margin-top: 2%;">
<div class="col-md-8 ap-sinp-col-for-inp-1">
<label class="ap-lbl-inp-txt" for="input-name">TOTAL RECEIVABLE AMOUNT :&nbsp;&nbsp;<span><i class="fas-fa-hand-holding-dollar"></i></span></label>
<label  id="id-customertotaldisplay" class="ap-lbl-inp-txt" for="input-name" style="font-weight:bold;"></label>
</div>
</div> -->

<!-- ############################## -->


<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right">

<span id="ap-nxtbtn-exchange" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> PROCEED TRANSACTION </span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

<span id="ap-backbtn-exchange" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>

<span id="ap-savbtn-exchange" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> SAVE TRANSACTION</span>&nbsp;&nbsp;
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
<div id="ap-modal-container">
 	<div id="ap-message-modal" class="modal fade">
    <div class="modal-dialog" style="top: 13%; right:24%;">
    <div id="ap-modal-content" class="modal-content">
        
        <div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">
        <span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;
        <span> Currency Calculator</span>
        </div>

        <div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">
        <div id="reasontxt-wrapper" style="margin-bottom:8px;">
        <label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Select Currency Type: <span class="app-req-star">*</span></label>
        <select id="id-currencyselector" class="selectpicker form-control ap-inp-field calculateFcy" name="currencyselector" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Currency Type"  >
		<?php if (isset($currencies)): ?> 
		<?php foreach ($currencies as $tcurrency): ?> 
		<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
		<?php endforeach ?>
		<?php endif ?>
		</select>
        <span id="er-currencyselector" class="ap-lbl-inp-err" for="error-msg"></span>
        
        
        <div>
        <label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Exchange Rate: </label>
        <input id="id-exchange-rate" class="form-control ap-inp-field numdec numdec2 " type="text" name="exchangeRate" readonly="true"  autocomplete="on"  spellcheck="false" style="text-transform:uppercase"  enabled >
        </div>
        
        <div>
        <label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">LKR Amount: </label>
        <input id="id-lkr-amount" class="form-control ap-inp-field numdec numsep  calculateFcy" type="text" name="lkrAmount" minlength="8" maxlength="11"  autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase"  enabled>
        </div>

        
        <div>
        <label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Fixed commission /Exchange Rate with commission : </label>
        <div class="col-md-12 ap-sinp-col-for-inp-1">
        <div class="col-md-6 ap-sinp-col-for-inp-1">
        	<input id="id-com-fixed" class="form-control ap-inp-field numeric_only" type="number" step="any" name="comFixed" minlength="8" maxlength="11" autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase"  readonly="true" enabled>
        </div>
        <div class="col-md-6 ap-sinp-col-for-inp-1">
        	<input id="id-com-rate" class="form-control ap-inp-field numeric_only" type="number" step="any" name="comRate" minlength="8" maxlength="11" autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase"   readonly="">
        </div>
        
       </div>
        </div>

        <div>
        <label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Equivalent FCY Amount: </label>
        <input id="id-fcy-amount" class="form-control ap-inp-field numdec numsep" type="text" name="fcyAmount" minlength="8" maxlength="11"  autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase"  readonly="true">
        <span id="er-fcyAmount" class="ap-lbl-inp-err" for="error-msg"></span>
        </div>

        </div>
        <!-- <p id="ap-modal-message">Copy FCY Amount?</p> -->
        </div> 

        <div id="ap-modal-footer" class="app-modal-footer">
        	<a id="ap-btn-continue" class="ap-btn ap-btn-modal" data-dismiss="modal" tabindex="-1"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONTINUE</span>&nbsp;<span><i class="fas fa-check"></i></span></a>

        	<a id="ap-modal-btn-ver-clear" class="ap-btn ap-btn-modal"  ng-click=""><span>CLEAR</span>&nbsp;&nbsp;<span><i class="fas fa-undo"></i></span></a> 

        	<a id="ap-modal-btn-ver-cancl" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CLOSE</span>&nbsp;
        		<span><i class="fas fa-times"></i></span></a>
    	
        </div>  
    </div>
    </div>
    </div>

 </div>

