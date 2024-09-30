<div id="ap-rejmodalcon">
<div id="ap-rejmodal" class="modal fade">
<div class="modal-dialog" style="top: 25%;">
<div class="modal-content">
<div class="app-modal-header ap-modal-header-conf">
<span class="ap-modal-header-icon-conf"><i class="fas fa-question-circle"></i></span>&nbsp;&nbsp;
<span class="ap-header-bold">Confirmation Message</span>
</div>

<div class="app-modal-body app-modal-body-message-only">

<div id="reasontxt-wrapper" style="margin-bottom:8px;">
<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for rejecting this record: <span class="app-req-star">*</span></label>
<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="-1" minlength="1" maxlength="100"></textarea>
<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

<p id="ap-modal-message" class="ap-body-message">Are you sure you want to perform this action?</p>

</div>

<div class="app-modal-footer">
<a id="id-cancelbtn" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click="">
<span>CANCEL</span>&nbsp;&nbsp;</a>
<a id="id-rejconfrmrbtn" data-chanel="<?php echo $channel; ?>" class="ap-btn ap-btn-modal">
<span id="ap-btn-loading-confrejct" style="display:none;">
<i class="fa fa-spinner fa-spin"></i>
</span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>
</div>

</div>
</div>
</div>
</div>