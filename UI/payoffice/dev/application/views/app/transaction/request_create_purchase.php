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
<div class="col-md-4 ap-sinp-col-for-inp-4">
<input id="id-scan" class="form-control ap-inp-field" type="text" name="ocr" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="" tabindex="1" autofocus >
<span id="er-ocr" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%; height: 100%;">
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
<div class="col-md-4 ap-sinp-col-for-inp-4" >
<select id="id-uintype" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select UIN Type" tabindex="2" name="uintype">

    
	<option value="1" data-subtext="" >NIC NO</option>
	<option value="2" data-subtext="">BUSINESS REG NO</option>
	<option value="3" data-subtext="">FOREIGN PASSPORT NO</option>
	<option value="4" data-subtext="">OBTAIN FROM CBSL</option>
	<option value="5" data-subtext="">SL PASSPORT NO</option>


</select>
<input class="form-control ap-inp-field" type="hidden" name="uinidtype" readonly  id="uinidtypehidden"  >
<span id="er-uintype" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-4" style="width: 36%;">
<input id="id-uinnumber" class="form-control ap-inp-field validateuin" type="text" name="uinnumber"   minlength="8" maxlength="13" autocomplete="off" autocorrect="off" spellcheck="false" style="text-transform:uppercase"  tabindex="3">
<span id="er-uinnumber" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
<!-- ############################## -->







<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">
Title: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-title" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Title" tabindex="4"  name="title">
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
<input id="id-fname" class="form-control ap-inp-field" type="text" name="fname" autocomplete="off" autocorrect="off" spellcheck="false" minlength="1" maxlength="200" tabindex="5" style="text-transform: uppercase;" >
<span id="er-fname" class="ap-lbl-inp-err" for="error-msg"></span>
<div ng-show= "bocPara()" >
<span class="pull-right" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 200px;">BOC CUSTOMER </span>
<input id="id-customercheck" class="ap-inp-checkbox pull-left" type="checkbox" >
<input class="ap-inp-checkbox pull-left" type="hidden" name="customercheck" readonly >
<span class="pull-left" style="font-size: 11px;margin-top: 4px;margin-right: 8px;margin-left: 25px;">BOC STAFF </span>
<input id="id-staffcheck" class="ap-inp-checkbox pull-left" type="checkbox" >
<input class="ap-inp-checkbox pull-left" type="hidden" name="staffcheck" readonly >
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
<input id="id-custaddr1" class="form-control ap-inp-field" type="text" name="custaddr1"  minlength="1" maxlength="33" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true" value="BIA TERMINAL" >
<span id="er-custaddr1" class="ap-lbl-inp-err" for="error-msg"></span>

</div>
</div>
</div>
</div>
<!-- ############################## -->

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
<select id="id-itrscode" class="selectpicker form-control ap-inp-field" name="itrscode" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select ITRS Code"   tabindex="6">

<?php if (isset($itrscodes)): ?> 
<?php foreach ($itrscodes as $titrscode): ?> 
<?php if ( $titrscode->code == '1214'): ?>
<option value="<?php echo $titrscode->code; ?>" data-code="<?php echo $titrscode->code; ?>" selected><?php echo $titrscode->code; ?>  - <?php echo $titrscode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $titrscode->code; ?>" data-code="<?php echo $titrscode->name; ?>"><?php echo $titrscode->code; ?>  - <?php echo $titrscode->name; ?></option>
<?php endif ?>

<?php endforeach ?>
<?php endif ?>

</select>

<input class="form-control ap-inp-field" type="hidden" name="itrscodehidden" readonly  id="id-itrscodehidden"  value="1214">
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
<option value="<?php echo $tccounttypecode->CODE; ?>" data-code="<?php echo $tccounttypecode->name; ?>"><?php echo $tccounttypecode->name; ?></option>
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
<?php if ( $tsectorcode->code == '18'  ): ?>
<option value="<?php echo $tsectorcode->code; ?>" data-code="<?php echo $tsectorcode->name; ?>" selected><?php echo $tsectorcode->name; ?></option>
<?php else : ?>
<option value="<?php echo $tsectorcode->code; ?>" data-code="<?php echo $tsectorcode->name; ?>" ><?php echo $tsectorcode->name; ?></option>
<?php endif ?>	

<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-sectorcode" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="sectorcodehidden" readonly  id="id-sectorcodehidden"  value="18">
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

<input id="id-benename" class="form-control ap-inp-field" type="text" name="benename" autocomplete="off" autocorrect="off" spellcheck="false"  readonly="true"   value="SELF">

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
<?php if ( $tbankcode->code == '7010'): ?>
<option value="<?php echo $tbankcode->code; ?>" data-code="<?php echo $tbankcode->code; ?>" data-shrt="<?php echo $tbankcode->name; ?>" selected><?php echo $tbankcode->name; ?> - <?php echo $tbankcode->name; ?></option>
<?php else : ?>	
<option value="<?php echo $tbankcode->code; ?>" data-code="<?php echo $tbankcode->code; ?>" data-shrt="<?php echo $tbankcode->name; ?>" ><?php echo $tbankcode->code; ?> - <?php echo $tbankcode->name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>


</select>
<input class="form-control ap-inp-field" type="hidden" name="benebankhidden" readonly  id="id-benebankhidden"  value="7010">
<span id="er-benebank" class="ap-lbl-inp-err" for="error-msg"></span>
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
<div class="col-lg-6 " style="margin-left: 0px; padding-left: 45px;">


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
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Currency:  <span class="app-req-star">*</span></label>
</div> 


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector1" class="selectpicker form-control ap-inp-field" name="icurrencyselector1" data-dropup-auto="false" data-size="5"  autocomplete="on" autocorrect="on"  data-live-search="true" data-show-subtext="true" title="Select"  tabindex="7">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>"  data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency1" readonly  id="cur1hidden" >
<span id="er-icurrencyselector1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector2" class="selectpicker form-control ap-inp-field" name="icurrencyselector2" data-dropup-auto="false" data-size="8" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="10">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency2" readonly  id="cur2hidden" >
<span id="er-icurrencyselector2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector3" class="selectpicker form-control ap-inp-field" name="icurrencyselector3" data-dropup-auto="false" data-size="10" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="13">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency3" readonly  id="cur3hidden" >
<span id="er-icurrencyselector3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<div class="col-md-2 ap-sinp-col-for-inp-1">
<select id="id-icurrencyselector4" class="selectpicker form-control ap-inp-field" name="icurrencyselector4" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="16">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="currency4" readonly  id="cur4hidden" >
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
<input id="id-tamount1" class="form-control ap-inp-field  numsep calculateLkr" type="text" name="tamount1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="8" >
<span id="er-tamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount2" class="form-control ap-inp-field  numsep calculateLkr" type="text" name="tamount2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="11">
<span id="er-tamount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount3" class="form-control ap-inp-field  numsep calculateLkr" type="text" name="tamount3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="14">
<span id="er-tamount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-tamount4" class="form-control ap-inp-field  numsep calculateLkr" type="text" name="tamount4" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="17">
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
	<span class="app-req-star">*</span>
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate1" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate1" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9"  >
<span id="er-rate1" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="minrate1" readonly  id="id-minrate1" value="0">
<input class="form-control ap-inp-field" type="hidden" name="maxrate1" readonly  id="id-maxrate1" value="9999">
<input class="form-control ap-inp-field" type="hidden" name="rate1-default" readonly  id="id-rate1-default" >
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate2" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate2" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="12" >
<span id="er-rate2" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="minrate2" readonly  id="id-minrate2" >
<input class="form-control ap-inp-field" type="hidden" name="maxrate2" readonly  id="id-maxrate2" >
<input class="form-control ap-inp-field" type="hidden" name="rate2-default" readonly  id="id-rate2-default" >
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate3" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate3" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="15">
<span id="er-rate" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="minrate3" readonly  id="id-minrate3" >
<input class="form-control ap-inp-field" type="hidden" name="maxrate3" readonly  id="id-maxrate3" >
<input class="form-control ap-inp-field" type="hidden" name="rate3-default" readonly  id="id-rate3-default" >
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-rate4" class="form-control ap-inp-field numdec  calculateLkr" type="text" name="rate4" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="18" >
<span id="er-rate4" class="ap-lbl-inp-err" for="error-msg"></span>
<input class="form-control ap-inp-field" type="hidden" name="minrate4" readonly  id="id-minrate4" >
<input class="form-control ap-inp-field" type="hidden" name="maxrate4" readonly  id="id-maxrate4" >
<input class="form-control ap-inp-field" type="hidden" name="rate4-default" readonly  id="id-rate4-default" >
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
<label class="ap-lbl-inp-txt" for="input-name">Converted Amount: 
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount1" class="form-control ap-inp-field numdec numsep" type="text" name="camount1" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="" value="0">
<span id="er-camount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount2" class="form-control ap-inp-field numdec  numsep" type="text" name="camount2" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="" value="0">
<span id="er-camount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount3" class="form-control ap-inp-field numdec  numsep" type="text" name="camount3" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="" value="0">
<span id="er-camount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-camount4" class="form-control ap-inp-field numdec  numsep" type="text" name="camount4" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="" value="0">
<span id="er-camount4" class="ap-lbl-inp-err" for="error-msg"></span>
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
<label class="ap-lbl-inp-txt" for="input-name">Incentive Amount: &nbsp;&nbsp; 
<span id="ap-btn-loading-incentive1" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
</label>
<span class="pull-right">
<i id="ap-dp-arow" class="fas fa-caret-down ap-icon" style="cursor: pointer; display:none; margin-top: 6px;"></i>
</span>
</div> 

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount1" class="form-control ap-inp-field numdec numsep" type="text" name="iamount1" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-iamount1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount2" class="form-control ap-inp-field numdec numsep" type="text" name="iamount2" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-iamount2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount3" class="form-control ap-inp-field numdec numsep" type="text" name="iamount3" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-iamount3" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-2 ap-sinp-col-for-inp-2">
<input id="id-iamount4" class="form-control ap-inp-field numdec numsep" type="text" name="iamount4" autocomplete="off" autocorrect="off" spellcheck="false"   readonly="">
<span id="er-iamount4" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>



<!-- ############################## -->
<!-- <div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Converted LCY TOTAL: &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lcytotal" class="form-control ap-inp-field" type="text" name="lcytotal" autocomplete="off" autocorrect="off" spellcheck="false"    readonly="">
<span id="er-lcytotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div> -->
<!-- ############################## -->



<!-- ############################## -->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper" >
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total LKR Amount: &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-lkrtotal" class="form-control ap-inp-field" type="text" name="lkrtotal" autocomplete="off" autocorrect="off" spellcheck="false"    readonly="">
<span id="er-lkrtotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm ">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Amount to Commision A/C: <span id="ap-btn-loading-incentive4" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-comgltotal" class="form-control ap-inp-field" type="text" name="comgltotal" autocomplete="off" autocorrect="off" spellcheck="false"    readonly="">
<span id="er-comgltotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-completed" style="display: block; text-align: center;">
COMMISSION A/C CREDIT
</div>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Net Amount to Customer: &nbsp;&nbsp; <span id="ap-btn-loading-incentive4" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-customertotal" class="form-control ap-inp-field" type="text" name="customertotal" autocomplete="off" autocorrect="off" spellcheck="false"    readonly="">
<span id="er-customertotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-rejected" style="display: block; text-align: center;">
 TILL CASH OUT
</div>
</div>
</div>





<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper" ng-show= "workerremCheck()">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Total Incentive Amount: &nbsp;&nbsp; <span id="ap-btn-loading-incentive4" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-incgltotal" class="form-control ap-inp-field" type="text" name="incgltotal" autocomplete="off" autocorrect="off" spellcheck="false"    readonly="">
<span id="er-incgltotal" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1">
<span class="ap-st-label ap-st-lb-review" style="display: block; text-align: center;">
INCENTIVE A/C DEBIT</span>


</div>
</div>
</div>
</div>

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper"">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Remarks  : &nbsp;&nbsp; <span id="ap-btn-loading-incentive3" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-remarks" class="form-control ap-inp-field" name="remarks" tabindex="19" ></textarea>
<span id="er-remarks" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
</div>
</div>
</div>
<!-- ############################## -->
<!-- End Of Payment Details  -->
<!-- ############################## -->


<!-- Start Of Transaction Summary -->
<!-- ############################## -->

<!-- <div class="row form-group app-form-group app-form-group-first ">
<label class="app-input-label" style="margin-top: 20px;"><b>Transaction Summary</b></label>
<hr>
</div> -->

<!-- <div class="alert alert-danger row " style="margin-top: 2%;">
<div class="col-md-8 ap-sinp-col-for-inp-1">
<label class="ap-lbl-inp-txt" for="input-name">NET AMOUNT TO CUSTOMER :&nbsp;&nbsp;<span><i class="fas-fa-hand-holding-dollar"></i></span></label>
<label  id="id-customertotaldisplay" class="ap-lbl-inp-txt" for="input-name" style="font-weight:bold;"></label>
</div>
</div> -->


<!-- ############################## -->
<!-- End Of Transaction Summary  -->



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


<div class="row ap-btn-ctrl-wrapper" >
<div class="ap-btn-pannel" >
<div class="form-group pull-left"></div>
<div class="form-group pull-right">


<!-- <span id="ap-backbtn" class="ap-btn ap-btn-back back" data-event="create" >
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> BACK</span>&nbsp;&nbsp;

</span> -->
						
<span  id="ap-nxtbtn-purchase" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none; "><i class="fa fa-spinner fa-spin"></i></span>
<span> PROCEED TRANSACTION</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

<span id="ap-backbtn-purchase" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-back" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span>
<i class="fas fa-chevron-left"></i>
</span>
<span> BACK</span>&nbsp;&nbsp;
</span>

<span id="ap-savbtn-purchase" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
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




