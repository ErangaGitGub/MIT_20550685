<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1"> 
<?php $now = new DateTime(); ?> 
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Assign User</legend>


<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">User PF Number : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-userpfnumber" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select PF Number"  tabindex="2"  name="userpfnumber" >
<?php if (isset($users)): ?> 
<?php foreach ($users as $tusers): ?> 
<?php if ($tusers->STATUS == 'A' && $tusers->USERPF !='IT207416'  ): ?>
<option value="<?php echo $tusers->USERPF; ?>" data-subtext="<?php echo $tusers->USERNAME; ?>"><?php echo $tusers->USERPF; ?>  
</option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddenuserpfnumber" readonly  id="iduserpfnumberhidden" tabindex="-1">
<span id="er-userpfnumber" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Name : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;">
<input id="id-username" class="form-control ap-inp-field" type="text" name="username" minlength="8" maxlength="11" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" >
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->


<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">User Level : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<select id="id-userlevel" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select User Level"  tabindex="2"  name="userlevel" >
<?php if (isset($levels)): ?> 
<?php foreach ($levels as $tlevels): ?> 
<?php if ($tlevels->LEVELID!='4'): ?> 
<option value="<?php echo $tlevels->LEVELID;?>" data-subtext="<?php echo $tlevels->LEVELDESC;?>"><?php echo $tlevels->LEVELID; ?> 
</option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddenuserLevel" readonly  id="idhiddenuserLevel" tabindex="-1">
<span id="er-userlevel" class="ap-lbl-inp-err" for="error-msg"></span>
</div>




<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Department/Till  : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<select id="id-till" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Department/Till"  tabindex="2"  name="till" >
<?php if (isset($tills)): ?> 
<?php foreach ($tills as $ttills): ?> 
<?php if ($ttills->TILLID!='0'): ?>
<option value="<?php echo $ttills->TILLID;?>" data-subtext="<?php echo $ttills->TILLDESC;?>"><?php echo $ttills->TILLID; ?> 
</option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddenuserTill" readonly  id="idhiddenuserTill" tabindex="-1">
<span id="er-till" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->
<?php $now = new DateTime(); ?>
<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">Effective Date: <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-bottom: 15px;">
<input id="id-effectiveDate" class="form-control ap-inp-field" type="Date" name="effectiveDate" minlength="8" maxlength="11"  value="<?php echo $now->format('Y-m-d') ?>" min="<?php echo $now->format('Y-m-d') ?>" autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase" tabindex="-1">
<span id="er-effectiveDate" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->


<?php if ($operationtype == 'ASSUSR'): ?>

<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-nxtbtnassign" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> NEXT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


<span id="ap-savbtnassign" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
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



</fieldset>
</div>
</div>
</form>