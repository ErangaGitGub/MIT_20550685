<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1">  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<?php if ($operationtype == 'CRTUSR'): ?>
<legend class="scheduler-border"> Create New User</legend>
<?php endif ?>
<?php if ($operationtype == 'RMVUSR'): ?>
<legend class="scheduler-border">Remove User</legend>
<?php endif ?>
<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">User PF Number : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-userpfnumber" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select PF Number"  tabindex="2"  name="userpfnumber" >

<?php if ($operationtype == 'RMVUSR'): ?>

<?php if (isset($users)): ?> 
<?php foreach ($users as $tusers): ?> 
<?php if ($tusers->STATUS == 'A'): ?>
<option value="<?php echo $tusers->USERPF; ?>" ><?php echo $tusers->USERPF; ?> 
</option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>


<?php else : ?> {
<?php if (isset($users)): ?> 
<?php foreach ($users as $tusers): ?> 
<option value="<?php echo $tusers->USERPF; ?>" ><?php echo $tusers->USERPF; ?> 
</option>
<?php endforeach ?>
<?php endif ?>
}

<?php endif ?>






</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddenuserpfnumber" readonly  id="iduserpfnumberhidden" tabindex="-1">
<span id="er-userpfnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Name : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<input id="id-username" class="form-control ap-inp-field" type="text" name="username" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->


<?php if ($operationtype == 'CRTUSR'): ?>

<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

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

<?php endif ?>

<?php if ($operationtype == 'RMVUSR'): ?>
<!-- ############################## -->
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">
<div class="form-group pull-left"></div>
<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-delnxtbtn" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> NEXT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-delsavbtn" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> DELETE</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>



</div>
<div class="clearfix"></div>
</div>
</div>

<?php endif ?>

</fieldset>
</div>
</div>
</form>