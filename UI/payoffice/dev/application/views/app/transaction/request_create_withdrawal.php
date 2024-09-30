<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " >  
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
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-scan" class="form-control ap-inp-field" type="text" name="ocr" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="" tabindex="1" autofocus>
<span id="er-ocr" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-initiated" style="display: block; text-align: center;">
	<span><i class="fas fa-passport"></i></span>
SWIPE THE PASSPORT
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


	<option value="1" data-subtext="" >NIC NO</option>
	<option value="2" data-subtext="">BUSINESS REG NO</option>
	<option value="3" data-subtext="">FOREIGN PASSPORT NO</option>
	<option value="4" data-subtext="">OBTAIN FROM CBSL</option>
	<option value="5" data-subtext="" selected="">SL PASSPORT NO</option>


</select>
<input class="form-control ap-inp-field" type="hidden" name="uinidtype" readonly  id="uinidtypehidden"  value="5">
<span id="er-uintype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
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
<a id="ap-btn-uin-search" class="ap-btn ap-cal-btn  ap-btn-uin-search"   title="Get Customer Data" ng-click="uinSearch" style="width: 100%; height: 100%;">
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
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
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
<?php if ( $titrscode->CODE == '1214' || $titrscode->CODE == '2214' ): ?>
<option value="<?php echo $titrscode->CODE; ?>" data-code="<?php echo $titrscode->NAME; ?>" selected><?php echo $titrscode->CODE; ?>  - <?php echo $titrscode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $titrscode->CODE; ?>" data-code="<?php echo $titrscode->NAME; ?>"><?php echo $titrscode->CODE; ?>  - <?php echo $titrscode->NAME; ?></option>
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
<?php if ( $tccounttypecode->CODE == '0'  ): ?>
<option value="<?php echo $tccounttypecode->CODE; ?>" data-code="<?php echo $tccounttypecode->NAME; ?>" selected> <?php echo $tccounttypecode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $tccounttypecode->CODE; ?>" data-code="<?php echo $tccounttypecode->NAME; ?>"><?php echo $tccounttypecode->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-accounttypecode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="accounttypecodehidden" readonly  id="id-accounttypecodehidden"  value="0">
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
<?php if ( $tsectorcode->CODE == '18'  ): ?>
<option value="<?php echo $tsectorcode->CODE; ?>" data-code="<?php echo $tsectorcode->NAME; ?>" selected><?php echo $tsectorcode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $tsectorcode->CODE; ?>" data-code="<?php echo $tsectorcode->NAME; ?>"><?php echo $tsectorcode->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-sectorcode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="sectorcodehidden" readonly  id="id-sectorcodehidden" >
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
<select id="id-majorcountry" class="selectpicker form-control ap-inp-field" name="majorcountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code"  >
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
<input class="form-control ap-inp-field" type="hidden" name="majorcountryhidden" readonly  id="id-majorcountryhidden"  value="LKA">
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
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">CounterParty Name:<span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">

<input id="id-benename" class="form-control ap-inp-field" type="text" name="benename" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true"  value="SELF">

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
<select id="id-benecountry" class="selectpicker form-control ap-inp-field" name="benecountry" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Country Code"  >



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
<input class="form-control ap-inp-field" type="hidden" name="benecountryhidden" readonly  id="id-benecountryhidden"  value="LKA">
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

<select id="id-benebank" class="selectpicker form-control ap-inp-field" name="benebank" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Bank Code"  >
<?php if (isset($bankcodes)): ?> 
<?php foreach ($bankcodes as $tbankcode): ?> 
<?php if ( $tbankcode->CODE == '7010'): ?>
<option value="<?php echo $tbankcode->CODE; ?>" data-code="<?php echo $tbankcode->CODE; ?>" data-shrt="<?php echo $tbankcode->NAME; ?>" selected><?php echo $tbankcode->CODE; ?> - <?php echo $tbankcode->NAME; ?></option>
<?php else : ?>	
<option value="<?php echo $tbankcode->CODE; ?>" data-code="<?php echo $tbankcode->CODE; ?>" data-shrt="<?php echo $tbankcode->NAME; ?>" ><?php echo $tbankcode->CODE; ?> - <?php echo $tbankcode->NAME; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>


</select>
<span id="er-benebank" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="benebankhidden" readonly  id="id-benebankhidden"  value="7010">
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

<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Account Number: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-accountnumber" class="form-control ap-inp-field" type="text" name="accountnumber" minlength="5" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="7" ng-click="accountSearch()">
<span id="er-accountnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-inp-1">
<a id="ap-account-search-button" class="ap-btn ap-cal-btn  ap-btn-verify-bref   title="Exchange Receipt Verefication" style="width: 100%; height: 100%;"  ng-click="accountSearch()">
<span><i class="fas fa-search"></i></span>
&nbsp;GET ACCOUNT RELATED DATA &nbsp;
<span id="ap-btn-loading-bref-vrfy" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</a>
</div>

</div>
</div>


<div class="ap-sinp-elm" ng-show= "accountPara()" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper"   >
<div>	
<div class="col-md-4 ap-sinp-col-for-lbl" >
<label class="ap-lbl-inp-txt" for="input-name">Account Holder Name:</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-accholdername" class="form-control ap-inp-field" type="text" name="accholdername" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-accholdername" class="ap-lbl-inp-err" for="error-msg"></span>
</div> 
</div>
</div>
</div>

<div class="ap-sinp-elm" ng-show= "accountPara()" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper"   >
<div>	
<div class="col-md-4 ap-sinp-col-for-lbl" >
<label class="ap-lbl-inp-txt" for="input-name">Account Curreny Type:</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-currtype" class="form-control ap-inp-field" type="text" name="currtype" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="true">
<span id="er-currtype" class="ap-lbl-inp-err" for="error-msg"></span>
</div> 
</div>
</div>
</div>

<div class="ap-sinp-elm" ng-show= "accountPara()" style="margin-top: 2px;">
<div class="row form-group ap-sins-wrapper"   >
<div>	
<div class="col-md-4 ap-sinp-col-for-lbl" >
<label class="ap-lbl-inp-txt" for="input-name">Account Current Balance:</label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-accbalance" class="form-control ap-inp-field" type="text" name="accbalance" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-accbalance" class="ap-lbl-inp-err" for="error-msg"></span>
</div> 
</div>
</div>
</div>
<input class="form-control ap-inp-field" type="hidden" name="account-status" readonly  id="id-account-status">
<!-- ############################## -->



<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Currency: 
<span class="app-req-star">*</span>
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-icurrency" class="selectpicker form-control ap-inp-field" name="icurrency" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select currency"  tabindex="8">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 

<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>

<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="icurrencyhidden" readonly  id="id-icurrencyhidden" >
<span id="er-icurrency" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


</div>
</div>
</div>

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

<div class="col-md-8 ap-sinp-col-for-inp-2">
<input id="id-tamount1" class="form-control ap-inp-field numdec numsep" type="text" name="tamount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="9">
<span id="er-tamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


</div>
</div>
</div>
<!-- ############################## -->












<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Remarks  : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id ="id-remarks" name="remarks" class="form-control ap-inp-field" tabindex="10"></textarea>
<span id="er-comgltotal" class="ap-lbl-inp-err" for="error-msg"></span>
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

<span id="ap-nxtbtn-withdraw" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> PROCEED TRANSACTION </span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

<span id="ap-backbtn-withdraw" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>



<span id="ap-savbtn-withdraw" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
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
