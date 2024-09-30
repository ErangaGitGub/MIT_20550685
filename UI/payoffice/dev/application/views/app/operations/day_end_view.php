
<div class="ap-section-tblcomponent container pull-left" style="width: 60%; ">
<div class="tab-pane active" id="tab-1">
<div class="col-md-24 ap-tab-pane-content-wrapper">
<div class="ap-orgin-form-container">
<div >
<form id="fx-rates-form" enctype="multipart/form-data" class="col-md-12 app-tab-pane-content-form" tabindex="-1">
 
<div class="col-md-12">



<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label"><b>Day End Process Details</b></label>        
          
<hr>
<div class="col-md-2 ap-sinp-col-for-inp-2" style="width: 25%; margin-top: 10px;">
<label class="ap-lbl-inp-txt" for="input-name">Process Name: </label>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-2" style="width: 25%; margin-top: 10px;">
<label class="ap-lbl-inp-txt" for="input-name"> DAY END</label>
</div>
</div>


<div class="row form-group app-form-group app-form-group-first">
<div class="col-md-2 ap-sinp-col-for-inp-2" style="width: 25%; margin-top: 10px;">
<label class="ap-lbl-inp-txt" for="input-name">Process Description: </label>
</div>
<div class="col-md-2 ap-sinp-col-for-inp-2" style="width: 75%;  margin-top: 10px;">
<label class="ap-lbl-inp-txt" for="input-name"> This process generates a report including currency wise totals for all the transactions to update General Ledgers </label>
</div>
</div>

<?php if (isset($status)  && $status->status == 'S'):?>

<div id="id-response-section" class="ap-sinp-elm" style="margin-top: 20px;" >      
<div class="row form-group app-form-group app-form-group-first">
<label class="ap-lbl-inp-txt" for="input-name">Process Status: </label>
<label id="id-precheck-status" class="ap-st-label ap-st-lb-completed" style="text-align: center; width: 40%;padding-left:5px;  padding-right:5px;  margin-left:90px;font color:#f44336;">Day End process executed for Today</label>
</div>
</div>

<?php else: ?>

  <?php if (isset($prestatus)  && $prestatus->status == 'S'):?>
        <div id="id-response-section" class="ap-sinp-elm" style="margin-top: 20px;" hidden>      
        <div class="row form-group app-form-group app-form-group-first">
        <label class="ap-lbl-inp-txt" for="input-name">Process Status: </label>
        <label id="id-precheck-status"  style="text-align: center; width: 100px;padding-left:5px;  padding-right:5px;  margin-left:80px;font color:#f44336;"></label>
        </div>
        </div>

   <?php else: ?>

        <div id="id-response-section" class="ap-sinp-elm" style="margin-top: 20px;" >      
        <div class="row form-group app-form-group app-form-group-first">
        <label class="ap-lbl-inp-txt" for="input-name">Process Status: </label>
        <label id="id-precheck-status" class="ap-st-label ap-st-lb-rejected" style="text-align: center; width: 50%;padding-left:5px;  padding-right:5px;  margin-left:90px;font color:#f44336;">Pre Check process not executed successfully for Today</label>
        </div>
        </div>

   <?php endif; ?>
      
<?php endif; ?>



<div class="ap-sinp-elm" style="margin-top: 20px;">
<div class="row form-group app-form-group app-form-group-first">
<hr>
<div class="ap-btn-pannel" style="margin-top: 20px;">
        
        <?php if (isset($status)  && $status->status == 'S'):?>
        <div class="form-group pull-left">
        <a id="ap-back-btn-pre-check" class="ap-btn ap-btn-opt continue pull-left " >
        <i class="fas fa-chevron-left"></i>
        <span>BACK</span>
        </a>
        </div>

        
        <?php else: ?>
        <?php if (isset($prestatus)  && $prestatus->status == 'S'):?>

        <div class="form-group pull-left">
        <a id="ap-back-btn-pre-check" class="ap-btn ap-btn-opt continue pull-left " >
        <i class="fas fa-chevron-left"></i>
        <span>BACK</span>
        </a>
        </div>

        <div class="form-group pull-right">
        <a id="ap-btn-day-end" class="ap-btn ap-btn-opt continue pull-left " >
        <span>DAY END</span>
        <i class="fas fa-check-circle"></i>
        </a>
        </div> 

        <?php else: ?>
        <div class="form-group pull-left">
        <a id="ap-back-btn-pre-check" class="ap-btn ap-btn-opt continue pull-left " >
        <i class="fas fa-chevron-left"></i>
        <span>BACK</span>
        </a>
        </div>
         
        <?php endif; ?>

        <?php endif; ?>        
        
</div>
</div>
</div>


</div>


</form>	
</div>
</div>
</div>
</div>
<div id="ap-modal-container"></div>
</div>

















