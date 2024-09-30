app.controller('VaultController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });


 
// Scope Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.message_invalid           = "Invalid";
    $scope.message_duplicate         = "Source Till and Destination Till Cannot be Same";

// Scope Variables-------------------------------------------------------------------
    $scope.validateflag = false;
    $scope.tillTransferPending = false; 
    $scope.vaultTransferInPending = false; 
    $scope.vaultTransferOutPending = false; 
    $scope.cashTransferPending = false; 
   

// Scope Functions-------------------------------------------------------------------
   


    $scope.duplicate_till_check = function () {
     
        var till1 = $('#id-hiddensourcetill').val();  
        var till2 = $('#id-hiddendestinationtill').val();  
      
        if (till1 == till2) {
             return true;
        } else {
             
            return false;
        }
    }

    $scope.check_balance = function (amount,balance) {
       // window.alert('here');  
        var ibalance = parseFloat(balance);
        var iamount = parseFloat(amount);

        if (iamount < ibalance) {
             return true;
        } else {             
            return false;
        }
    }

   
    $scope.vault_transfer_in_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-transfer'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-transfer'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-transfer'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-vault-transfer-in" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

     $scope.vault_transfer_out_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-reason'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-reason'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-reason'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-vault-transfer-out" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

    $scope.till_transfer_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-till-transfer'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-till-transfer'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-till-transfer'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-till-transfer" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

    $scope.vault_transfer_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-vault-transfer'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-vault-transfer'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-vault-transfer'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-till-transfer" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

    $scope.cash_transfer_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-cash-transfer'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-cash-transfer'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-cash-transfer'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cash-transfer" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

   $scope.get_modal = function () {
        return '<div id="ap-message-modal" class="modal fade">'+
        '<div class="modal-dialog" style="top: 30%;">'+
        '<div id="ap-modal-content" class="modal-content">'+   
        '</div>'+
        '</div>'+
        '</div>';
    }

    $scope.get_modal_header = function (type) {
        if (type=="success") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-succ">'+
        '<span class="ap-modal-header-icon-succ"><i class="far fa-check-circle"></i></span>&nbsp;'+
        '<span>Success</span>'+
        '</div>';
        } else if (type=="error") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-erro">'+
        '<span class="ap-modal-header-icon-erro"><i class="far fa-check-circle"></i></span>&nbsp;'+
        '<span>Error</span>'+
        '</div>';
        } else if (type=="confirm") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm-reason") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm-transfer") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm-cash-transfer") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        }  else if (type=="confirm-till-transfer") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>'; 
        }  else if (type=="confirm-vault-transfer") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>'; 
        } else {
        return '';
        } 
    }

    $scope.get_modal_body = function (type) {
        if (type=="success") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        } else if (type=="error") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        } else if (type=="confirm") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>';               
        } else if (type=="confirm-transfer") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>';               
        } else if (type=="confirm-reason") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Transfer Remarks: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your remarks here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to perform this transfer?</p>'+
        '</div>'; 
        } else if (type=="confirm-delete") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for deleting this Transaction: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to delete this Transaction?</p>'+
        '</div>'; 
        } else if (type=="confirm-till-transfer") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>';               
        } else if (type=="confirm-vault-transfer") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message"> <mark>Have you obtained required reports before transferring cash to the vault ? </mark></p>'+
        '</div>';             
        } else if (type=="confirm-cash-transfer") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>';               
        } else {
        return '';
        } 
    }

    $scope.get_modal_footer = function (type) {
        if (type=="success") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="error") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';                 
        } else if (type=="confirm-transfer") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm-reason") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm-till-transfer") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm-vault-transfer") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm-cash-transfer") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        } else if (type=="confirm-delete") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else {
        return '';
        } 
    }

    $scope.trigger_confbtn_action = function (btn_action) {
        if (btn_action=="vault-in-transfer") {
            $scope.save_vault_transfer_in_message('vault/transfer/saveToPOS');
        } else if (btn_action=="vault-out-transfer") {
            $scope.save_vault_transfer_out_message('vault/transfer/saveToT4S');
        } else if (btn_action=="till-transfer") {
            $scope.save_till_transfer_message('vault/transfer/saveToTill');
        } else if (btn_action=="cash-transfer") {
            $scope.save_cash_transfer_message('vault/transfer/cashToTill');
        }  else {
            return;
        }
    } 

    $scope.trigger_redirection_action = function (action) {
        
        if (action=="transfer") {
            window.location.href = $scope.get_baseurl()+'dashboard';
            return false;
        } 
        else if (action=="delete-domestic") {
            window.location.href = $scope.get_baseurl()+'transaction/report/domestic/cancel?txntype=INT"';
            return false;
        } 

        else {
            return false;
        }
    }
    
//Functions------------------------------------------------------------------------------
   
   
//----------accept cash-------------------------------------------------------------------
    $(function() { 

        $scope.acceptCash= function (srctill,desttill, currency, amount, user, timestamp) {

          $(".ap-btnloading-accept").show();
          
            var iFromTill = srctill;
            var iToTill   = desttill;
            var iCurrency = currency;
            var iAmount   = amount;
            var iUser     = user;
            var iTimeStamp= timestamp;
            var iAction   = 'A';
            

            var formObj = {   
                fromTill: iFromTill,
                toTill: iToTill,
                currency: iCurrency,
                amount: iAmount,
                user: iUser,
                timestamp: iTimeStamp,
                action: iAction,
                return_json: true           
            };

            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'vault/transfer/cashToTill',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {    
                var r = response.data; 
         

            if (!r.error_status) {
               
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Accepted Cash Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-btn-ok" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            } else {
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message"> ' + r.error_message+ ' </p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            }  

            })
            .catch(function(error) {
                throw error;
            }); 

        }
    });
//----------reject cash-------------------------------------------------------------------
    $(function() { 

        $scope.rejectCash= function (srctill,desttill, currency, amount, user, timestamp) {

          $(".ap-btnloading-reject").show();
          
            var iFromTill = srctill;
            var iToTill   = desttill;
            var iCurrency = currency;
            var iAmount   = amount;
            var iUser     = user;
            var iTimeStamp= timestamp;
            var iAction   = 'R';
            

            var formObj = {   
                fromTill: iFromTill,
                toTill: iToTill,
                currency: iCurrency,
                amount: iAmount,
                user: iUser,
                timestamp: iTimeStamp,
                action: iAction,
                return_json: true           
            };

            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'vault/transfer/cashToTill',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {    
                var r = response.data; 
              //  window.alert(r);
                

            if (!r.error_status) {
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Rejected Cash Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-btn-ok" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            } else {
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Error.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            } 

            })
            .catch(function(error) {
                throw error;
            });
            } 

        });

 
        

//------------------ Source Till change
        $('#id-sourcetill').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            $scope.hide_error("sourcetill");
            var sourceTill = $('#id-sourcetill').val();            
            $('#id-hiddensourcetill').val(sourceTill);

            if ($scope.duplicate_till_check()) {           
               $scope.show_error("sourcetill", $scope.message_duplicate);
            } else {         
            $scope.hide_error("sourcetill");
            } 
        });

//------------------ Destination Till Change
        $('#id-destinationtill').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
           window.alert('ds');
           $scope.hide_error("destinationtill");
           var destinationtill = $("input[name=destinationtill]").val();
           $('#id-hiddendestinationtill').val(destinationTill); 
           
           // if ($scope.duplicate_till_check()) {           
           //     $scope.show_error("destinationtill", $scope.message_duplicate);
           //  } else {         
           //  $scope.hide_error("destinationtill");
           //  }
        });

//-------------------------------------------------------------
$(document).on("click", "#ap-bckbtn" , function() {
        window.location.href = $scope.get_baseurl()+'dashboard';
        return false;
});
//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-vault-transfer-in" , function() {
    $("#ap-btn-loading-conf").show();
    // $("#ap-tran-cashintopos").hide();
    // $("#ap-btn-back").hide(); 
    if (!$scope.vaultTransferInPending){
        $scope.vaultTransferInPending = true;
        $scope.trigger_confbtn_action('vault-in-transfer');
    }   
    
});

//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-vault-transfer-out" , function() {
    $("#ap-btn-loading-conf").show();
   // $("#ap-tran-cashfrompos").hide();
    //$("#ap-btn-back").hide();
    if (!$scope.vaultTransferOutPending){
        $scope.vaultTransferOutPending = true;
        $scope.trigger_confbtn_action('vault-out-transfer');
    }    
    
});
//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-till-transfer" , function() {
    
    $("#ap-btn-loading-conf").show();
    $("#ap-tran-tilltotill").hide();  
    if (!$scope.tillTransferPending){
        $scope.tillTransferPending = true;
        $scope.trigger_confbtn_action('till-transfer');
    }
    
});
//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-cash-transfer" , function() {
    if (!$scope.cashTransferPending){
        $scope.cashTransferPending = true;
          $scope.trigger_confbtn_action('cash-transfer');
    }
    
      
});
//-------------------------------------------------------------  
$(document).on("click", "#ap-modal-btn-del-redirect" , function() {
            $scope.trigger_redirection_action('transfer');
});

//-------------------------------------------------------------  
$(document).on("click", "#ap-btn-back" , function() {
            window.location.href = $scope.get_baseurl()+'dashboard';
});

//------------------------------------------------------------- 
$(document).on("click", "#ap-btn-ok" , function() {
    location.reload();
});



//-------------------------------------------------------------
    $("#ap-btn-check-all").on( "click", function() {
         $('input:checkbox').not(this).prop('checked', this.checked);
        
    }); 
//-------------------------------------------------------------
    $("#ap-btn-check-none").on( "click", function() {
         
        $('input:checkbox').removeAttr('checked');
    });         
//-------------------------------------------------------------
    $("#ap-tran-t4stopos").on( "click", function() {
      
        $("#ap-tran-t4stopos").hide();
        $("#ap-refreshbtn").hide();
        $("#ap-sav-t4stopos").show();
        //inputs
        $("input").prop("readonly", true);          
        $scope.validator = true;

        $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);   
        
    });

//-------------------------------------------------------------
    $("#ap-tran-postot4s").on( "click", function() {
       
        $("#ap-tran-postot4s").hide();
        $("#ap-refreshbtn").hide();
        $("#ap-sav-postot4s").show();
        //inputs
        $("input").prop("readonly", true);          
        $scope.validator = true;

        $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);        
    });



//------------------ Transfer cash in to POS ---------------
    $("#ap-tran-cashintopos").on( "click", function() {
         $scope.vault_transfer_in_message();    
    });

//------------------ Transfer cash out from POS ---------------
    $("#ap-tran-cashfrompos").on( "click", function() {
         $scope.vault_transfer_out_message();    
    });

//------------------ Accept cash to Till from other sources ---------------
    $("#ap-btn-cash-accept-all").on( "click", function() {
        //alert('sf');
        $(".ap-btnloading-acceptall").show();
            var iAction = 'A';
             
            var formObj = {   
                action: iAction,  
                return_json: true           
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'vault/transfer/acceptRejectAll',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {    
                
                $(".ap-btnloading-acceptall").hide();
                var r = response.data;
                console.log(r);
                if (!r.error_status) {
               
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Accepted Cash Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-btn-ok" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            } else {
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message"> ' + r.error_message+ ' </p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            }    
            })
            .catch(function(error) {
                throw error;
            });
        });  

//------------------ Reject cash to Till from other sources ---------------
    $("#ap-btn-cash-reject-all").on( "click", function() {
        //alert('sf');
        $(".ap-btnloading-rejectall").show();
            var iAction = 'R';
             
            var formObj = {   
                action: iAction,  
                return_json: true           
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'vault/transfer/acceptRejectAll',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {    
                
                $(".ap-btnloading-rejectall").hide();
                var r = response.data;
                console.log(r);
                if (!r.error_status) {
               
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Rejected Cash Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-btn-ok" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            } else {
                $("#ap-modal-container").empty();
                $("#ap-modal-container").append($scope.get_modal());
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message"> ' + r.error_message+ ' </p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
                $('#ap-message-modal').modal('show');
            }    
            })
            .catch(function(error) {
                throw error;
            });
            });




//------------------ Transfer cash in to POS ---------------
    $("#ap-tran-tilltotill").on( "click", function() {
        
        var destinationtill = $('#id-destinationtill').val(); 
        $('#id-hiddendestinationtill').val(destinationtill);
        var sourcetill = $('#id-hiddensourcetill').val(); 
            
            if (!$scope.isset(destinationtill)) {
                $scope.show_error("destinationtill", $scope.message_required);
                
            } else {

                if ($scope.duplicate_till_check()) {           
                   $scope.show_error("destinationtill", $scope.message_duplicate);
                } else if (destinationtill == '1'){
                   $scope.hide_error("destinationtill");
                   $scope.vault_transfer_message();

                } else {         
                   $scope.hide_error("destinationtill");
                   $scope.till_transfer_message(); 
                }             
                
            }
        // $scope.till_transfer_message();    
    }); 

// //------------------ Save ACC transaction ---------------
//     $("#ap-nxt-tilltransfer").on( "click", function() {
//         $scope.validate_transfer_message('vault/transfer/validate_tilltotill');
//     });

// //------------------ Save ACC transaction ---------------
//     $("#ap-tilltransferviewbtn").on( "click", function() {
//         var iSourceTill = $('#id-hiddensourcetill').val();
//         var iDestinationTill = $('#id-hiddendestinationtill').val();

        
//          window.location.href = $scope.get_baseurl()+'vault/transfer/tilltotill?source='+iSourceTill+'&destination='+iDestinationTill+'';
//     }) 
 

 //------------------ Load Transfer view ---------------

    $('#ap-sav-tilltotill').on("click", function() {  
            $(".ap-btnloading-sav").show();
            var iSourceTill = $('#id-hiddensourcetill').val();
            var iDestinationTill = $('#id-hiddendestinationtill').val();
            var params = $('tbody').find('input').serialize();
            var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
             
            var formObj = {   
                sourcetill: iSourceTill,
                destinationtill: iDestinationTill,
                formArray: params,   
                return_json: true           
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'vault/transfer/saveToTill',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {    
               // console.log('ll');
                $(".ap-btnloading-sav").hide();
                var r = response.data;
                 if (!result.error_status) {
                    alert('Y');

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transferred Cash Into Vault Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {
                alert('Y');

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            } 

            })
            .catch(function(error) {
                throw error;
            });                           
        });  



    //------------------ Validate till transfer message ---------------
    $scope.validate_transfer_message = function (u) {
         var amount = $('#AED').val();
         var balance = 100;
         
         
         if ($scope.check_balance(amount,balance)) { 
            //$scope.show_error("AED", $scope.message_required);
         } else{
            $scope.show_error("AED", $scope.message_required);
         }
        // $(".ap-btnloading-nxt").show();   
        // var params = $('tbody').find('input').serialize();
        // var json_array = { formArray: params, action: "create", return_json: true };
        // $http({
        //     method: 'POST',
        //     url: $scope.get_baseurl()+u,
        //     data: json_array,
        //     headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        // }).then(function(response) {              
        //     var r = response.data;    
        //     if ($scope.isset(r)) {
        //         $(".ap-btnloading-nxt").hide(); 
        //         $scope.set_validation_transfer(r);  
        //     } else {
        //         $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        //         $('#ap-toutmodal').modal('show');
        //     } 
        // })
        // .catch(function(error) {
        //     throw error;
        // });
    }


    //------------------ set_validation_till_transfer ---------------
    $scope.set_validation_transfer = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
               // $("#er-sourcetill").text(er['sourcetill']);
              //  $("#er-destinationtill").text(er['destinationtill']);               
               

             if (r.success) {   

                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxt-tilltransfer").hide();
                $("#ap-refreshbtn").hide();
                $("#ap-tilltransferviewbtn").show();
               
                //selects
               // $("#id-sourcetill, #id-destinationtill").prop("disabled", true).selectpicker("refresh");
                $("#requestform").clone(true).appendTo('.ap-tab-content-2');
                $scope.validator = true;
                $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);
            }
        } else {
            $scope.validator = false;
            $("#ap-btnloading-nxt").hide();
            $('#ap-msgmdlcon').empty();
            $('#ap-msgmdlcon').html(r.message_skelton);
            $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
            $('#ap-msgmdl').modal('show');
        }
    }


//------------------ Save Vault transfer_message impl---------------
$scope.save_vault_transfer_in_message = function (u) {

        $(".ap-btnloading-sav").show();

        var params = $('tbody').find('input').serialize();

    //    console.log(params);
        var json_array = { formArray: params, action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
        var result = response.data; 

            $(".ap-btnloading-sav").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transferred Cash Into Vault Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            }

            $scope.vaultTransferInPending = false;

        })
        .catch(function(error) { 
            throw error;
        });
    }

//------------------ Save Vault transfer_message impl---------------
$scope.save_vault_transfer_out_message = function (u) {

        $(".ap-btnloading-sav").show();

        var params = $('tbody').find('input').serialize();
        var iRemarks = $('#id-reasontxt').val();

    //    console.log(params);
        var json_array = { 
            remarks: iRemarks,
            formArray: params, 
            action: "create", 
            return_json: true 
        };
        
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
        var result = response.data; 

            $(".ap-btnloading-sav").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transferred Cash From Vault Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            }
            $scope.vaultTransferOutPending = false;

        })
        .catch(function(error) { 
            throw error;
        });
    }    
//------------------ Save Vault transfer_message impl---------------
$scope.save_till_transfer_message = function (u) {

      //  $(".ap-btnloading-sav").show();
        var iSourceTill = $('#id-hiddensourcetill').val();
        var iDestinationTill = $('#id-hiddendestinationtill').val();
        var params = $('tbody').find('input').serialize();

        var formObj = {   
                sourcetill: iSourceTill,
                destinationtill: iDestinationTill,
                formArray: params,   
                return_json: true           
            };
      
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: formObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
        var result = response.data; 

            $(".ap-btn-loading-conf").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transfers will be sent for Teller Acceptance </p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {
                $("#ap-tran-tilltotill").show();
                
                
 
                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            }
            $scope.tillTransferPending = false;

        })
        .catch(function(error) { 
            throw error;
        });
    }

    //------------------ Save Vault transfer_message impl---------------
$scope.save_cash_transfer_message = function (u) {


        $(".ap-btnloading-sav").show();

        console.log($('tbody').find('checkbox').serialize());
        var dtaObj = { formArray: $("#ap-data-table-cash").serialize(), return_json: true };
        // window.alert(params);            
        // var formObj = {   
        //        formArray: params,   
        //         return_json: true           
        //     };
      
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
        var result = response.data; 

            $(".ap-btnloading-sav").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Cash Transfers accepted Successfully </p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            }

            $scope.cashTransferPending = false;

        })
        .catch(function(error) { 
            throw error;
        });
    }




});










































