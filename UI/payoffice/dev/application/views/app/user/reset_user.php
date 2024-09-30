<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1" autocomplete="off">  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Reset User Password</legend>



<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">User PF Number : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">


<div class="col-md-12 ap-sinp-col-for-inp-1">
<select id="id-userpfnumber" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select PF Number"  tabindex="2"  name="userpfnumber" >
<?php if (isset($users)): ?> 
<?php foreach ($users as $tusers): ?> 
<?php if ($tusers->STATUS == 'A'): ?>
<option value="<?php echo $tusers->USERPF; ?>" ><?php echo $tusers->USERPF; ?>  
</option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddenuserpfnumber" readonly  id="iduserpfnumberhidden" tabindex="-1">

</div>

<span id="er-userpfnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Name : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-username" class="form-control ap-inp-field" type="text" name="username" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly>
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Branch : <span class="app-req-star">*</span></label></div> 
<div class="col-md-2 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-branch" class="form-control ap-inp-field" type="text" name="branch" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly>
<span id="er-branch" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<div class="col-md-6 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-branchname" class="form-control ap-inp-field" type="text" name="branchname" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly>
<span id="er-branchname" class="ap-lbl-inp-err" for="error-msg"></span>
</div>




<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-resetpassbtn" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> RESET PASSWORD </span>&nbsp;&nbsp;
<span>
<i class="fas fa-check red"></i>
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
<div id="ap-modal-container"></div>