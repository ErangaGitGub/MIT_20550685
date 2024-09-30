<form id="requestform" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form ap-padding-0 " tabindex="-1" ng-hide= "tillTransferView()">  
<div class="col-md-12 wid-no-padding">
<div class="col-md-6 wid-no-padding">
<fieldset class="scheduler-border">

<legend class="scheduler-border"> <?php echo $title; ?></legend>

<!-- ############################## -->



<div class="col-md-4 ap-sinp-col-for-lbl" ><label class="ap-lbl-inp-txt" for="input-name">Source Till : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-sourcetill" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Source Till" required="required"  tabindex="2"  name="sourcetill">
<?php if (isset($tills)): ?> 
<?php foreach ($tills as $till): ?> 
<?php if ($till->TILLID != $sourcetill ): ?> 	
<option value="<?php echo $till->TILLID; ?>" data-code="<?php echo $till->TILLID; ?>" data-shrt="<?php echo $till->TILLDESC; ?>"><?php echo $till->TILLDESC; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>

  
<input class="form-control ap-inp-field" type="hidden" value="<?php echo $sourcetill; ?>" name="hiddensourcetill" readonly  id="id-hiddensourcetill" tabindex="-1">

<span id="er-sourcetill" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<!-- ############################## -->
<div class="col-md-4 ap-sinp-col-for-lbl" style="margin-top: 15px;margin-bottom: 15px;"><label class="ap-lbl-inp-txt" for="input-name">Destination Till : <span class="app-req-star">*</span></label></div> 
<div class="col-md-8 ap-sinp-col-for-inp-1" style="margin-top: 15px;margin-bottom: 15px;">
<select id="id-destinationtill" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Destination Till"  tabindex="2"  name="destinationtill">
<?php if (isset($tills)): ?> 
<?php foreach ($tills as $till): ?> 
<?php if ($till->TILLID != $sourcetill ): ?> 	
<option value="<?php echo $till->TILLID; ?>" data-code="<?php echo $till->TILLID; ?>" data-shrt="<?php echo $till->TILLDESC; ?>"><?php echo $till->TILLDESC; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
</select>
<input class="form-control ap-inp-field" type="hidden" name="hiddendestinationtill" readonly  id="id-hiddendestinationtill" tabindex="-1">
<span id="er-destinationtill" class="ap-lbl-inp-err" for="error-msg"></span>
</div>
<!-- ############################## -->



<div id="section-table" class="ap-section " >
<div class="row ap-btn-ctrl-wrapper">
<div class="ap-btn-pannel">

<div class="form-group pull-right" style="margin-right: 15px;">

<span id="ap-nxt-tilltransfer" class="ap-btn ap-btn-nxt" data-event="create" >
<span class="ap-btnloading-nxt" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> NEXT</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>

<span id="ap-tilltransferviewbtn" class="ap-btn ap-btn-nxt" style="display:none;" data-event="create" >
<span class="ap-btnloading-sav" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
<span> VIEW</span>&nbsp;&nbsp;
<span>
<i class="fas fa-chevron-right"></i>
</span>
</span>


</div>
<div class="clearfix"></div>
</div>
</div>
</div>




</fieldset>
</div>
</div>
</form>

