<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1"> 
<?php $now = new DateTime(); ?> 
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Remove User Assignement</legend>


<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">User PF Number : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-userpfnumber" class="form-control ap-inp-field" type="text" name="userpfnumber" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly="" value="<?php echo $userPF; ?>">
<span id="er-userpfnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Name : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<input id="id-username" class="form-control ap-inp-field" type="text" name="username" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly="" value="<?php echo $userName; ?>">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->


<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Level : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-userlevel" class="form-control ap-inp-field" type="text" name="userlevel" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly="" value="<?php echo $userLevel; ?>">
<span id="er-userlevel" class="ap-lbl-inp-err" for="error-msg"></span>
</div>




<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Department/Till  : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-usertill" class="form-control ap-inp-field" type="text" name="usertill" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly="" value="<?php echo $userTill; ?>">
<span id="er-usertill" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->

<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">Effective Date : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-effdate" class="form-control ap-inp-field" type="text" name="effdate" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" readonly="" value="<?php echo $effDate; ?>">
<span id="er-effdate" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->




<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-assigndelsavbtn" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> CONFIRM REMOVE </span>&nbsp;&nbsp;
<span>
<i class="fas fa-times red"></i>
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