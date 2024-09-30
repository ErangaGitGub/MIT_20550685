<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1">  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">


<legend class="scheduler-border">Balance Panel</legend>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Currency Type : </label></div> 
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<select id="id-icurrencyselector1" class="selectpicker form-control ap-inp-field" name="icurrencyselector1" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select"  tabindex="2">
<?php if (isset($currencies)): ?> 
<?php foreach ($currencies as $tcurrency): ?> 
<?php if ( $tcurrency->CURSHRT != 'LKR'): ?>
<option value="<?php echo $tcurrency->CURSHRT; ?>" data-code="<?php echo $tcurrency->CURID; ?>" data-shrt="<?php echo $tcurrency->CURSHRT; ?>"><?php echo $tcurrency->CURSHRT; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-c5000" class="form-control ap-inp-field numdec numsep" type="text" readonly="" name="cname-5000" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name" style="margin-bottom: 15px;">TOTAL RUPEE AMOUNT: </label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-totalamount" class="form-control ap-inp-field" type="text" readonly="" name="name-totalamount" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-totalamount" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->


<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name"><b>Denomination</b></label></div> 
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name"><b>Currency Amount </b></label></div> 
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name"><b>Notes/Coins Count </b> </label></div> 


<!-- ############################## -->



<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">5000 (Five Thousand) : </label></div> 
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a5000" class="form-control ap-inp-field" type="text"  name="aname-5000" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c5000" class="form-control ap-inp-field numdec numsep" type="text"  name="cname-5000" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">1000 (Thousand) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a1000" class="form-control ap-inp-field" type="text"  name="aname-1000" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c1000" class="form-control ap-inp-field numdec numsep" type="text"  name="cname-1000" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">500 (Five Hundred) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a500" class="form-control ap-inp-field" type="text"  name="aname-500" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c500" class="form-control ap-inp-field numdec numsep" type="text" name="cname-500" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">100 (Hundred) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a100" class="form-control ap-inp-field" type="text"  name="aname-100" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c100" class="form-control ap-inp-field numdec numsep" type="text" name="cname-100" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">50 (Fifty) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a50" class="form-control ap-inp-field" type="text"  name="aname-50" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c50" class="form-control ap-inp-field numdec numsep" type="text" name="cname-50" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">20 (Twenty) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a20" class="form-control ap-inp-field" type="text" name="aname-20" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c20" class="form-control ap-inp-field numdec numsep" type="text" name="cname-20" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">10 (Ten) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a10" class="form-control ap-inp-field" type="text"  name="aname-10" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c10" class="form-control ap-inp-field numdec numsep" type="text" name="cname-10" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">5 (Five) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a5" class="form-control ap-inp-field" type="text"  name="aname-5" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1"  value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c5" class="form-control ap-inp-field numdec numsep" type="text" name="cname-5" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">2 (Two) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a2" class="form-control ap-inp-field" type="text"  name="aname-2" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c2" class="form-control ap-inp-field numdec numsep" type="text" name="cname-2" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">1 (One) : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-a1" class="form-control ap-inp-field" type="text"  name="aname-1" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1"value="0" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-c1" class="form-control ap-inp-field numdec numsep" type="text" name="cname-1" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Cents : </label></div> 

<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<input id="id-cents2" class="form-control ap-inp-field" type="text"  name="aname-Cents" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="0">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-4 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<input id="id-cents1" class="form-control ap-inp-field numdec numsep" type="text" name="cname-Cents" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>


<!-- ############################## -->

</fieldset>
</div>
</div>
</form>