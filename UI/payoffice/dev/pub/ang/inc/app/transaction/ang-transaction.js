app.controller('TxnController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });
    
    let timer;

// Get-------------------------------------------------------------------
    $scope.get_breference_number   = function () { return $('#id-brefnumber').val(); }
    $scope.get_reference_number    = function () { return $('#id-refnumber').val(); }
    $scope.get_receipt_number      = function () { return $('#id-receiptNumber').val(); }
    $scope.get_ntxn_code           = function () { return $('#id-natureoftxn').val(); }
    $scope.get_txn_type            = function () { return $('#id-txntype').val(); }
    $scope.get_uin_type            = function () { return $('#id-uintype').val(); }
    $scope.get_itrs_code           = function () { return $('#id-itrscode').val(); }
    $scope.get_currency_format     = function () { return $('#id-curformat').val(); }
    $scope.get_uin_number          = function () { return $('#id-uinnumber').val(); }
    $scope.get_exchange_rate       = function () { return $('#id-exchange-rate').val(); }
    $scope.get_exchange_rate1      = function () { return $('#id-rate1').val(); }
    $scope.get_exchange_rate2      = function () { return $('#id-rate2').val(); }
    $scope.get_exchange_rate3      = function () { return $('#id-rate3').val(); }
    $scope.get_exchange_rate4      = function () { return $('#id-rate4').val(); }
    // $scope.get_cross_rate1         = function () { return $('#id-crossrate1').val(); }
    // $scope.get_cross_rate2         = function () { return $('#id-crossrate2').val(); }
    // $scope.get_cross_rate3         = function () { return $('#id-crossrate3').val(); }
    // $scope.get_cross_rate4         = function () { return $('#id-crossrate4').val(); }
    $scope.get_currency1           = function () { return $('#id-icurrencyselector1').val(); }
    $scope.get_currency2           = function () { return $('#id-icurrencyselector2').val(); }
    $scope.get_currency3           = function () { return $('#id-icurrencyselector3').val(); }
    $scope.get_currency4           = function () { return $('#id-icurrencyselector4').val(); }
    $scope.get_lkr_amount          = function () { return $('#id-lkr-amount').val(); }
    $scope.get_commision_percentage= function () { return $('#id-com-percentage').val(); }
    $scope.get_commision           = function () { return $('#id-commision').val(); }
    $scope.get_com_amount          = function () { return $('#id-com-amount').val(); }
    $scope.get_com_rate            = function () { return $('#id-com-rate').val(); }
    $scope.get_transaction_amount1 = function () { return $('#id-tamount1').val(); }
    $scope.get_transaction_amount2 = function () { return $('#id-tamount2').val(); }
    $scope.get_transaction_amount3 = function () { return $('#id-tamount3').val(); }
    $scope.get_transaction_amount4 = function () { return $('#id-tamount4').val(); }
    $scope.get_converted_amount1   = function () { return $('#id-camount1').val(); }
    $scope.get_converted_amount2   = function () { return $('#id-camount2').val(); }
    $scope.get_converted_amount3   = function () { return $('#id-camount3').val(); }
    $scope.get_converted_amount4   = function () { return $('#id-camount4').val(); }
    $scope.get_total_lkr_amount    = function () { return $('#id-lkrtotal').val(); }
    $scope.get_customer_lkr_amount = function () { return $('#id-customertotal').val(); }
    $scope.get_received_amount     = function () { return $('#id-receivedAmount').val(); }
    $scope.get_incentive_amount1   = function () { return $('#id-iamount1').val(); }
    $scope.get_incentive_amount2   = function () { return $('#id-iamount2').val(); }
    $scope.get_incentive_amount3   = function () { return $('#id-iamount3').val(); }
    $scope.get_incentive_amount4   = function () { return $('#id-iamount4').val(); }

 
// Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.message_insufficient      = "Insufficient parameters for search";
    $scope.message_insufficient_cal  = "Insufficient parameters for calculate";
    $scope.message_not_fount         = "Receipt Number Not Found";
    $scope.account_not_fount         = "Account Number Not Found";
    $scope.message_ref_verified      = "Receipt Number Verified";
    $scope.message_duplicate         = "Curreny has been selected already";
    $scope.message_invalid           = "Invalid NIC number";
    $scope.message_uintype           = "UIN Type Required";
    $scope.message_currency_mismatch = "Account currency type is not matched with issuing currency";
    $scope.message_currency_restrict = "Account currency type cannot be LKR";
    $scope.message_currency_other    = "Account currency type should be LKR";
    $scope.message_account_dormant   = "Account is Dormant";
    $scope.message_account_deceased    = "Account is Deceased";

 

// Scope Variables-------------------------------------------------------------------
    $scope.bpara = false;
    $scope.accpara = false;
    $scope.beneaccpara = false;
    $scope.rpara = false;
    $scope.workerRem = false;
    $scope.commission = false;
    $scope.validator = false; 
    $scope.savesuccess = false; 
    $scope.savepending = false; 
    $scope.pendingcalculation = false; 
    $scope.focuscalculator = false; 
    $scope.ceiling = 0;
    // $scope.staffcommissionpara = false;
    $scope.defaultcommissionval= 2;
    $scope.forcescommissionval = 1;
    $scope.staffcommissionval = 0;

    
    // $scope.forcescommissionpara = false;


// Functions-------------------------------------------------------------------
    $scope.accountPara = function () {
        return $scope.accpara;
    }
    $scope.receiptPara = function () {
        return $scope.rpara;
    }

    $scope.bocPara = function () {
        return $scope.bpara;
    }
  
    $scope.workerremCheck = function () {
       return $scope.workerRem;
    }

    $scope.commisionPara = function () {
       return $scope.commission;
    }

    $scope.getAccountRelatedData =function () {
        $("#ap-account-search-button").trigger('click');
    } 

    $scope.getExchangeReceiptData =function () {
        $("#ap-vfrybtn-form-verifyreceipt").trigger('click');
    }
  
    $scope.triggerOKButton =function () {

        $("#id-okbtn").trigger('click');
    }
    

    $scope.clickSavePurchaseButton =function () {
        $("#ap-savbtn-purchase").trigger('click');
    }
   

// CAlculations-------------------------------------------------------------------
    
    $scope.getCustomerLKR       = function (ntxnCode) {
        if (ntxnCode == '1'){
           var custLKR = Math.floor(parseFloat($scope.get_total_lkr_amount().replace(/[,]/g, ''))); 
       } else if (ntxnCode == '2')
            var custLKR = Math.ceil(parseFloat($scope.get_total_lkr_amount().replace(/[,]/g, ''))); 
            return custLKR;
    } 
    $scope.getGLLKR       = function (ntxnCode) {
            var totalLKR = parseFloat($scope.get_total_lkr_amount().replace(/[,]/g, ''));
            var custLKR = parseFloat($scope.get_customer_lkr_amount().replace(/[,]/g, ''));
            // var commission = parseFloat($scope.get_commision().replace(/[,]/g, ''));
            // window.alert(commission);
            if (ntxnCode =='1'){
                   var glLKR   = totalLKR - custLKR; 
            }else if (ntxnCode =='2'){
                   var glLKR   = custLKR - totalLKR;
                   // var glLKR   = ceiling +  commission; 
            }
                  
            return glLKR;
    } 
    $scope.calculate_converted_amount = function (rate, amount) {
        var irate = parseFloat(rate);
        var iamount = parseFloat(amount);
        var converted_amount = iamount* irate;               
        return $scope.numberWithCommas(Number(converted_amount).toFixed(2));
    }

    $scope.get_max_value = function (rate, ceiling) {
        var irate = parseFloat(rate);
        var iceiling = parseFloat(ceiling);
        var maxValue = irate +  iceiling;               
        return $scope.numberWithCommas(Number(maxValue).toFixed(7));
    }

    $scope.get_min_value = function (rate, ceiling) {
        var irate = parseFloat(rate);
        var iceiling = parseFloat(ceiling);
        var minValue = irate -  iceiling;               
        return $scope.numberWithCommas(Number(minValue).toFixed(7));
    }

    $scope.get_rate_with_comm = function (percentage, rate) {
        var irate = parseFloat(rate);
        var ipercentage = parseFloat(percentage);
      //  window.alert(percentage);
      //  window.alert(irate);  
        var commrate = irate * (1+(ipercentage * 0.01))  ;   

        return Number(commrate).toFixed(4);
    }

    $scope.calculate_total_lkr_amount = function (amount1, amount2, amount3, amount4) {
        var iAmount1 = parseFloat(amount1);
        var iAmount2 = parseFloat(amount2);
        var iAmount3 = parseFloat(amount3);
        var iAmount4 = parseFloat(amount4);      
        var total_lkr_amount = iAmount1 + iAmount2 + iAmount3 + iAmount4;               
        return $scope.numberWithCommas(Number(total_lkr_amount).toFixed(2));
    }

    $scope.calculate_total_amount = function () {
        return $scope.numberWithCommas(Number(parseFloat($scope.get_incentive_amount1().replace(/[,]/g, '')) + parseFloat($scope.get_incentive_amount2().replace(/[,]/g, '')) + parseFloat($scope.get_incentive_amount3().replace(/[,]/g, '')) + parseFloat($scope.get_incentive_amount4().replace(/[,]/g, ''))).toFixed(2));
    } 

    $scope.calculate_buy_rate = function (middlerate, fxbuy) {
        var imiddlerate = parseFloat(middlerate);
        var ifxbuy = parseFloat(fxbuy);
        var buy_rate = imiddlerate - fxbuy;   
        return $scope.numberWithCommas(Number(buy_rate).toFixed(7));
    }

    $scope.calculate_sell_rate = function (middlerate, fxsell) {
        var imiddlerate = parseFloat(middlerate);
        var ifxsell = parseFloat(fxsell);
        var sell_rate = imiddlerate + ifxsell;           
        return $scope.numberWithCommas(Number(sell_rate).toFixed(7));
    }

   


    $scope.get_fcy_calculator = function () {
        $scope.focuscalculator = true; 
        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false});

        $('#ap-message-modal').modal('show');
        $("#ap-message-modal").on('shown.bs.modal', function(){
             $(this).find('#id-currencyselector').focus();
          
            
        });

        



    }

    

    $scope.calculate_fcy_amount = function () {

        //$scope.pendingcalculation = true;
        $('#id-com-fixed').val('');
        $('#id-com-rate').val('');

        if ($('#id-exchange-rate').val() =="" || $('#id-lkr-amount').val() ==""){
            $scope.show_error("fcyAmount", $scope.message_insufficient_cal);
        }else {
            //$scope.pendingcalculation = true;
            $scope.hide_error("fcyAmount", $scope.message_insufficient_cal);
            var txnType         = $scope.get_txn_type();
            var uinType         = $scope.get_uin_type();
            var amount          = $scope.get_lkr_amount().replace(/[,]/g, '');

        


            if ( uinType ==""){
            $scope.show_error("uintype", $scope.message_required);
            $scope.show_error("commision-percentage", $scope.message_uintype);
            } else if (uinType =='5' || uinType =='1' ){
            var passHolType     = 'L';
            } else if (uinType =='3'){
            var passHolType     = 'F';   
            }

            var formObj = {   
            txnType: txnType,
            passHolType: passHolType,
            amount: amount,
            };

            $http({

                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/calculateCommision_amount',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }) 

            .then(function(response) {              
                var result = response.data; 
              
            if (result.error_status) {
                //ERROR HANDLING 
                //$scope.pendingcalculation = false;

            } else {  


                if (result.percentage == '0'){ // fixed amount
                 
           
                    $('#id-com-fixed').val($scope.numberWithCommas(Number(result.commission).toFixed(2)));  
                    var convertedLkr = amount - result.commission;
                    var param_exchange_rate = $scope.get_exchange_rate().replace(/[,]/g, '');
                    var param_fcy_amount    = convertedLkr / param_exchange_rate; 
                    $('#id-fcy-amount').val($scope.numberWithCommas(Number(param_fcy_amount).toFixed(2))) ;    
                } else { // percentage
               
                    var param_exchange_rate = $scope.get_exchange_rate().replace(/[,]/g, '');

                    $('#id-com-rate').val($scope.get_rate_with_comm(result.percentage, param_exchange_rate));
                     
                    var param_comm_rate = $scope.get_com_rate().replace(/[,]/g, '');
                    var param_fcy_amount    = amount / param_comm_rate; 
                    $('#id-fcy-amount').val($scope.numberWithCommas(Number(param_fcy_amount).toFixed(2))) ;    
                }

                if ( $scope.pendingcalculation) {

                    var fcyamount = Math.floor(parseFloat($('#id-fcy-amount').val().replace(/[,]/g, ''))); 
                    var lkramount = $('#id-lkr-amount').val(); 
                    var currency  = $('#id-currencyselector').val(); 
                   var exchangeRate  = $('#id-exchange-rate').val(); 
                    
                    $('#id-icurrencyselector1').val(currency);
                    $('#cur1hidden').val(currency);  
                    $('#id-icurrencyselector1').selectpicker("refresh");       

                    $('#id-tamount1').val(fcyamount); 
                    $('#id-rate1').val(exchangeRate); 

                   
                  
                    $('#id-camount1').val($scope.calculate_converted_amount(exchangeRate,fcyamount));
                    $scope.calculate_commision();  
                    $('#id-receivedAmount').val(lkramount); 

                    $scope.pendingcalculation = false;

                }
                   
                                
               

            }       
            })
            .catch(function(error) {
                throw error;
            });



        }
    
    }

    $scope.calculate_refund_amount = function () {

        if ($('#id-receivedAmount').val() =="" || $('#id-customertotal').val() ==""){
           // $scope.show_error("fcyAmount", $scope.message_insufficient_cal);
        }else {
            var param_received_amount = $scope.get_received_amount().replace(/[,]/g, '');
            var param_customer_total  = $scope.get_customer_lkr_amount().replace(/[,]/g, '');                
           
            var param_refund_amount    = param_received_amount - param_customer_total;              
            $('#id-refundAmount').val($scope.numberWithCommas(Number(param_refund_amount).toFixed(2))) ;
             }
    
    }

    // $scope.continue_calculator = function () {
    //     $("#ap-modal-container").empty();

    //     $("#ap-modal-container").append($scope.get_modal());
    //     $("#ap-modal-content").append($scope.get_modal_header('continue'));
    //     $("#ap-modal-content").append($scope.get_modal_body('continue'));
    //     $("#ap-modal-content").append($scope.get_modal_footer('continue'));

    //     // append buttons
    //     $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-cancl" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
    //     $("#ap-modal-footer").append('<a id="ap-modal-btn-continue" class="ap-btn ap-btn-modal" data-dismiss="modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

    //     $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
    //     $('#ap-message-modal').modal('show');
    // }


     $scope.delete_record_approve = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-delete-approve'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-delete-approve'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-delete-approve'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-cancl" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-del-approve" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }

    $scope.delete_record_reject = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-delete-reject'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-delete-reject'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-delete-reject'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-cancl" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-del-reject" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }

     $scope.cancel_record = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-cancel'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-cancel'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-cancel'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-cancl" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }


    $scope.trigger_savebtn_action = function (btn_action) {
        
        if (btn_action=="cancel-international") {
  
            $scope.cancel_record();
        } else if (btn_action=="delete-international-approve") {
            $scope.delete_record_approve();
        } else if (btn_action=="delete-international-reject") {
            $scope.delete_record_reject();
        }

        else {
            return;
        }
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
        } else if (type=="continue") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        }
        else if (type=="confirm-reason") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm-cancel") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        
        } else if (type=="confirm-delete-approve") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm-delete-reject") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="calculate-fcy") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Currency Calculator</span>'+
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
        }else if (type=="continue") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to import this data?</p>'+
        '</div>';               
        } else if (type=="confirm-reason") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for rejecting this deal: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>';               
        } else if (type=="confirm-delete-approve") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for approve this cancellation: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to approve this cancellation?</p>'+
        '</div>'; 
        } else if (type=="confirm-delete-reject") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for rejecting this cancellation: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to reject this cancellation?</p>'+
        '</div>'; 
        } else if (type=="confirm-cancel") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for cancelling this Transaction: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to delete this Transaction?</p>'+
        '</div>'; 
        } else if (type=="calculate-fcy") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please select the Currency Type: <span class="app-req-star">*</span></label>'+
        '<select id="id-title" class="selectpicker form-control ap-inp-field" data-dropup-auto="false" data-size="5" data-live-search="true" data-show-subtext="true" title="Select Title"  tabindex="2" name="title"> '+
                                '<option value="MR">Mr</option>'+
                                '<option value="MS">Ms</option> '+
                                '<option value="Miss">Miss</option> '+
                                '<option value="Dr">Dr</option> '+
                                '<option value="Pastor">Pastor</option> '+
                                '<option value="Rev">Rev</option>'+
                                '<option value="Other">Other</option> '+                               
        '</select> '+
        '<span id="er-maturityDate" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '<div>'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">LKR Amount: </label>'+
        '<input id="id-extend-interest" class="form-control ap-inp-field numdec numdec2 numsep" type="text" name="extendedInterest"  pattern="" autocomplete="on"  spellcheck="false" style="text-transform:uppercase" tabindex="-1" enabled >'+
        '</div>'+
        '<div>'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Equivalent FCY Amount: </label>'+
        '<input id="id-term-days" class="form-control ap-inp-field numeric_only" type="text" name="termDays" minlength="8" maxlength="11"  autocomplete="on" autocorrect="on" spellcheck="false" style="text-transform:uppercase" tabindex="-1" enabled>'+
        '</div>'+
        '</div>'+
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
        } else if (type=="confirm") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="continue") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        }else if (type=="confirm-reason") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm-delete-approve") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        } else if (type=="confirm-delete-reject") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        } else if (type=="confirm-cancel") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        }else if (type=="calculate-fcy") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else {
        return '';
        } 
    }



    $scope.trigger_confbtn_action = function (btn_action) {
        if (btn_action=="cancel") {
            var reason = $("textarea[name=reasontxt]").val();
            if ($scope.isset(reason)) {
            $scope.change_transaction_state($scope.get_reference_number(), reason);
            } else {
                $scope.show_error("reasontxt", $scope.message_required);
            }
        } else if (btn_action=="delete-approve") {
            var reason = $("textarea[name=reasontxt]").val();
            if ($scope.isset(reason)) {
            $scope.approve_cancel_transaction($scope.get_reference_number(), reason);
            } else {
                $scope.show_error("reasontxt", $scope.message_required);
            }
        } else if (btn_action=="delete-reject") {
            var reason = $("textarea[name=reasontxt]").val();
            if ($scope.isset(reason)) {
            $scope.reject_cancel_transaction($scope.get_reference_number(), reason);
            } else {
                $scope.show_error("reasontxt", $scope.message_required);
            }
        } else {
            return;        }
    }


    $scope.change_transaction_state = function (txnNo,reason) {
        var formObj = {
            reference: txnNo,
            reason: reason
            
        }



        $("#ap-btn-loading-conf").show();
        
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+'transaction/state_change_request',
            data: formObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {              
           var result = response.data; 

            $("#ap-btn-loading-conf").hide();



            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Cancelled transaction has been sent for manager approval.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
                
            } else {

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
    }

$scope.approve_cancel_transaction = function (txnNo,reason) {
        var formObj = {
            reference: txnNo,
            reason: reason
            
        }

        $("#ap-btn-loading-conf").show();
        
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+'transaction/approve_cancel_transaction_request',
            data: formObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {              
           var result = response.data; 

            $("#ap-btn-loading-conf").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transaction has been cancelled successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
                
            } else {

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
    }

    $scope.reject_cancel_transaction = function (txnNo,reason) {
        var formObj = {
            reference: txnNo,
            reason: reason
            
        }

        $("#ap-btn-loading-conf").show();
        
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+'transaction/reject_cancel_transaction_request',
            data: formObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {              
           var result = response.data; 

            $("#ap-btn-loading-conf").hide();

            if (!result.error_status) {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Transaction cancellation request has been rejected successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
                
            } else {

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
    }

    $scope.trigger_redirection_action = function (action) {
        
        if (action=="cancel") {
            window.history.back();
            return false;
        } 
        else if (action=="delete") {
            window.history.back();
            return false;
        } 

        else {
            return false;
        }
    }



    $scope.calculate_lkr_amount = function () {
        $scope.hide_error("lkrtotal");
        
        if ($scope.calculate_amount_check()) {
            //-------------Currency Type 1 -------------------------------------
            if (!$scope.isset($scope.get_exchange_rate1()) || !$scope.isset($scope.get_transaction_amount1()) ) {
                $('#id-camount1').val(0.0000); 
            }
            else {
                var param_exchange_rate1         = $scope.get_exchange_rate1().replace(/[,]/g, '');
                var param_transaction_amount1    = $scope.get_transaction_amount1().replace(/[,]/g, '');                
                $('#id-camount1').val($scope.calculate_converted_amount(param_exchange_rate1, param_transaction_amount1));

               // var param_cross_rate1         = $scope.get_cross_rate1().replace(/[,]/g, '');        
               // $('#id-crossamount1').val($scope.calculate_converted_amount(param_cross_rate1, param_transaction_amount1));
            } 

            //-------------Currency Type 2 -------------------------------------
            if (!$scope.isset($scope.get_exchange_rate2()) || !$scope.isset($scope.get_transaction_amount2()) ) {
                $('#id-camount2').val(0.0000); 
            }
            else {
                var param_exchange_rate2         = $scope.get_exchange_rate2().replace(/[,]/g, '');
                var param_transaction_amount2    = $scope.get_transaction_amount2().replace(/[,]/g, '');                
                $('#id-camount2').val($scope.calculate_converted_amount(param_exchange_rate2, param_transaction_amount2));

               // var param_cross_rate2         = $scope.get_cross_rate2().replace(/[,]/g, '');        
              //  $('#id-crossamount2').val($scope.calculate_converted_amount(param_cross_rate2, param_transaction_amount2));
            }    

            //-------------Currency Type 3 -------------------------------------
            if (!$scope.isset($scope.get_exchange_rate3()) || !$scope.isset($scope.get_transaction_amount3()) ) {
                $('#id-camount3').val(0.0000); 
            }
            else {
                var param_exchange_rate3         = $scope.get_exchange_rate3().replace(/[,]/g, '');
                var param_transaction_amount3    = $scope.get_transaction_amount3().replace(/[,]/g, '');                
                $('#id-camount3').val($scope.calculate_converted_amount(param_exchange_rate3, param_transaction_amount3));

                //var param_cross_rate3         = $scope.get_cross_rate3().replace(/[,]/g, '');        
                //$('#id-crossamount3').val($scope.calculate_converted_amount(param_cross_rate3, param_transaction_amount3));
            }
            
            //-------------Currency Type 4 -------------------------------------
            if (!$scope.isset($scope.get_exchange_rate4()) || !$scope.isset($scope.get_transaction_amount4()) ) {
                $('#id-camount4').val(0.0000); 
            }
            else {    
                var param_exchange_rate4         = $scope.get_exchange_rate4().replace(/[,]/g, '');
                var param_transaction_amount4    = $scope.get_transaction_amount4().replace(/[,]/g, '');                
                $('#id-camount4').val($scope.calculate_converted_amount(param_exchange_rate4, param_transaction_amount4));

              //  var param_cross_rate4         = $scope.get_cross_rate4().replace(/[,]/g, '');        
              //  $('#id-crossamount4').val($scope.calculate_converted_amount(param_cross_rate4, param_transaction_amount4));
            }

            $scope.calculate_commision();
            
        } else {
           // $scope.show_error("lkrtotal", $scope.message_insufficient_cal);
        }

    }


$scope.calculate_commision_sp = function () { 

        var iAmount1        = parseFloat($scope.get_converted_amount1().replace(/[,]/g, ''));
        var iAmount2        = parseFloat($scope.get_converted_amount2().replace(/[,]/g, ''));
        var iAmount3        = parseFloat($scope.get_converted_amount3().replace(/[,]/g, ''));
        var iAmount4        = parseFloat($scope.get_converted_amount4().replace(/[,]/g, ''));         
        var issuing_fee     = 0;
        var commission      = 0;
        var incentive       = 0;
        var ntxnCode        = $scope.get_ntxn_code();
        var itrscode        = $scope.get_itrs_code();
        //total converted amount    
        var total_lkr_amount = iAmount1 + iAmount2 + iAmount3 + iAmount4;
      //  var total_lkr_amount = iAmount1;

        if(ntxnCode == '2') {
                var comm_percentage =  parseFloat($('#id-commision-percentage').val());
                var commission = (total_lkr_amount / 100) * comm_percentage;     
                // if (commission < 1000) {
                //     commission = 1000;
                // }

                $('#id-commision').val($scope.numberWithCommas(Number(commission).toFixed(2))); 
                $('#id-lkrtotal').val($scope.numberWithCommas(Number(commission + total_lkr_amount).toFixed(2)));
                var customertotal = $scope.getCustomerLKR(ntxnCode);
                $('#id-customertotal').val($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                $('#id-customertotaldisplay').text($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                var comgltotal = $scope.getGLLKR(ntxnCode);
                $('#id-comgltotal').val($scope.numberWithCommas(Number(comgltotal).toFixed(2)));  
                $scope.calculate_refund_amount();      

            
        }

        if(ntxnCode == '1') {
            if(itrscode == '1501') {

                $scope.calculate_work_remm_incentive(total_lkr_amount);
            } else {
                var lkrtotal = $scope.numberWithCommas(Number(total_lkr_amount).toFixed(2));
                $('#id-lkrtotal').val(lkrtotal);
                var customertotal = $scope.getCustomerLKR(ntxnCode);
                $('#id-customertotal').val($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                $('#id-customertotaldisplay').text($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                var comgltotal = $scope.getGLLKR(ntxnCode);
                $('#id-comgltotal').val($scope.numberWithCommas(Number(comgltotal).toFixed(2)));
              //  $scope.calculate_refund_amount();  
            }
        } 

       


    }


    $scope.calculate_commision = function () { 



        var iAmount1        = parseFloat($scope.get_converted_amount1().replace(/[,]/g, ''));
        var iAmount2        = parseFloat($scope.get_converted_amount2().replace(/[,]/g, ''));
        var iAmount3        = parseFloat($scope.get_converted_amount3().replace(/[,]/g, ''));
        var iAmount4        = parseFloat($scope.get_converted_amount4().replace(/[,]/g, ''));  
       
        var txnType         = $scope.get_txn_type();
        var uinType         = $scope.get_uin_type();

        if ( uinType ==""){
        $scope.show_error("uintype", $scope.message_required);
        $scope.show_error("commision-percentage", $scope.message_uintype);
        } else if (uinType =='5' || uinType =='1' ){
        var passHolType     = 'L';
        } else if (uinType =='3'){
        var passHolType     = 'F';   
        }
        
        var issuing_fee     = 0;
        var commission      = 0;
        var incentive       = 0;
        var ntxnCode        = $scope.get_ntxn_code();
        var itrscode        = $scope.get_itrs_code();
        //total converted amount    
        var total_lkr_amount = iAmount1 + iAmount2 + iAmount3 + iAmount4;
        

        if(ntxnCode == '2') {
           var formObj = {   
            txnType: txnType,
            passHolType: passHolType,
            amount: total_lkr_amount,
            };

            $http({

                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/calculateCommision_amount',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }) 

            .then(function(response) {              
                var result = response.data; 
               // window.alert(result.percentage);
            if (result.error_status) {
                //ERROR HANDLING 

            } else {  
                if (result.percentage == '0'){
                    $('#id-commision-percentage').val('');     
                } else {
                    $('#id-commision-percentage').val(result.percentage); 
                }
                   
                $('#id-commision').val($scope.numberWithCommas(Number(result.commission).toFixed(2))); 
                 var commision = parseFloat($scope.get_commision().replace(/[,]/g, ''));
                $('#id-lkrtotal').val($scope.numberWithCommas(Number(commision + total_lkr_amount).toFixed(2)));
                var customertotal = $scope.getCustomerLKR(ntxnCode);
                $('#id-customertotal').val($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                $('#id-customertotaldisplay').text($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                var comgltotal = $scope.getGLLKR(ntxnCode);
                $('#id-comgltotal').val($scope.numberWithCommas(Number(comgltotal).toFixed(2)));   
                $scope.calculate_refund_amount();       
               

            }       
            })
            .catch(function(error) {
                throw error;
            });

            
        }

        if(ntxnCode == '1') {
            if(itrscode == '1501') {

                $scope.calculate_work_remm_incentive(total_lkr_amount);
            } else {
                var lkrtotal = $scope.numberWithCommas(Number(total_lkr_amount).toFixed(2));
                $('#id-lkrtotal').val(lkrtotal);
                var customertotal = $scope.getCustomerLKR(ntxnCode);
                $('#id-customertotal').val($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                $('#id-customertotaldisplay').text($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                var comgltotal = $scope.getGLLKR(ntxnCode);
                $('#id-comgltotal').val($scope.numberWithCommas(Number(comgltotal).toFixed(2)));
               // $scope.calculate_refund_amount();  
            }
        } 

       // $scope.calculate_refund_amount();


    }

    $scope.calculate_work_remm_incentive = function (total_lkr) {
        var param_currency1 = null;
        var param_currency2 = null;
        var param_currency3 = null;
        var param_currency4 = null;
        var param_transaction_amount1 = null;
        var param_transaction_amount2 = null;
        var param_transaction_amount3 = null;
        var param_transaction_amount4 = null;

        //-------------Currency Type 1 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount1()) ||  !$scope.isset($scope.get_currency1())) {
            $('#id-iamount1').val(0.0000); 
        }
        else {
            var param_currency1              = $scope.get_currency1();
            var param_transaction_amount1    = $scope.get_transaction_amount1().replace(/[,]/g, '');                
        }

        //-------------Currency Type 2 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount2()) ||  !$scope.isset($scope.get_currency2())) {
            $('#id-iamount2').val(0.0000); 
        }
        else {
             var param_currency2              = $scope.get_currency2();
             var param_transaction_amount2    = $scope.get_transaction_amount2().replace(/[,]/g, '');                
        }

         //-------------Currency Type 3 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount3()) ||  !$scope.isset($scope.get_currency3())) {
            $('#id-iamount3').val(0.0000); 
        }
        else {
             var param_currency3              = $scope.get_currency3();
             var param_transaction_amount3    = $scope.get_transaction_amount3().replace(/[,]/g, '');                
        }

         //-------------Currency Type 4 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount4()) ||  !$scope.isset($scope.get_currency4())) {
            $('#id-iamount4').val(0.0000); 
        }
        else {
             var param_currency4              = $scope.get_currency4();
             var param_transaction_amount4    = $scope.get_transaction_amount4().replace(/[,]/g, '');                
        }
            
        return $scope.calculate_incentive_amount(param_currency1, param_currency2, param_currency3, param_currency4, param_transaction_amount1, param_transaction_amount2, param_transaction_amount3, param_transaction_amount4, total_lkr);          
    }

    $scope.calculate_incentive_amount = function (currency1, currency2, currency3, currency4, amount1, amount2, amount3, amount4, total_lkr) {
        
        iCurrency1 =  currency1;
        iCurrency2 =  currency2;
        iCurrency3 =  currency3;
        iCurrency4 =  currency4;
        iamount1 = amount1;
        iamount2 = amount2;
        iamount3 = amount3;
        iamount4 = amount4;
        var formObj = {   
            currency1: iCurrency1,
            currency2: iCurrency2,
            currency3: iCurrency3,
            currency4: iCurrency4,
            amount1: iamount1,
            amount2: iamount2,
            amount3: iamount3,
            amount4: iamount4
        };
        $("#ap-btn-loading-incentive1").show();
        $("#ap-btn-loading-incentive2").show();
        $("#ap-btn-loading-incentive3").show();
        $("#ap-btn-loading-incentive4").show();
        $("#ap-btn-loading-incentive5").show();
        $("#ap-btn-loading-incentive6").show();
        $http({

                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/calculateWorkerRemittence',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
            if (result.error_status) {
                //ERROR HANDLING 

            } else {       
                $('#id-iamount1').val($scope.numberWithCommas(Number(result.currency1).toFixed(2))); 
                $("#ap-btn-loading-incentive1").hide(); 
                $('#id-iamount2').val($scope.numberWithCommas(Number(result.currency2).toFixed(2)));  
                $("#ap-btn-loading-incentive2").hide(); 
                $('#id-iamount3').val($scope.numberWithCommas(Number(result.currency3).toFixed(2))); 
                $("#ap-btn-loading-incentive3").hide(); 
                $('#id-iamount4').val($scope.numberWithCommas(Number(result.currency4).toFixed(2))); 
                $("#ap-btn-loading-incentive4").hide(); 
                var totalincentive =  $scope.calculate_total_amount();
                $('#id-lkrtotal').val(totalincentive);
                $('#id-incgltotal').val(totalincentive);
                var incentive =  parseFloat($('#id-lkrtotal').val().replace(/[,]/g, ''));
                var tot_lkr = parseFloat(total_lkr);
                $('#id-lkrtotal').val($scope.numberWithCommas(Number(incentive + tot_lkr).toFixed(2)));
                var customertotal = $scope.getCustomerLKR('1');
                $('#id-customertotal').val($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                $('#id-customertotaldisplay').text($scope.numberWithCommas(Number(customertotal).toFixed(2)));
                var comgltotal = $scope.getGLLKR('1');
                $('#id-comgltotal').val($scope.numberWithCommas(Number(comgltotal).toFixed(2)));
             //   $scope.calculate_refund_amount();  

            }       
            })
            .catch(function(error) {
                throw error;
            });    
    }



// Scope Functions-------------------------------------------------------------------
   $scope.load_itrsCodesListforAcc = function (itrsCodeslist) {   
        $('#id-itrscode').empty();
        for (var i = 0; i < itrsCodeslist.length; i++) {
            var itrscode = itrsCodeslist[i];
            var option = '<option value="'+itrscode.CODE+'"> '+itrscode.CODE+' - '+itrscode.NAME+' </option> ';
            $('#id-itrscode').append(option);
        }
        $('#id-itrscode').selectpicker("refresh");
    }

    $scope.load_itrsCodesListforInt = function (id) {     
        $(id).empty();
        for (var i = 0; i < $scope.itrsCodeslist.length; i++) {
            var itrscode = $scope.itrsCodeslist[i];
            var option = '<option value="'+itrscode.CODE+'"> '+itrscode.CODE+' - '+itrscode.NAME+' </option> ';
            $(id).append(option);
        }
        $(id).selectpicker();
    }

    $scope.load_sectorCodesList = function (id) {   
   // window.alert('dg');  
        $(id).empty();
        for (var i = 0; i < $scope.sectorCodeslist.length; i++) {
            var sectorcode = $scope.sectorCodeslist[i];
            if (i==0){
                 var option = '<option value="'+sectorcode.code+'" selected> '+sectorcode.name+'</option> ';
            }else {
                var option = '<option value="'+sectorcode.code+'"> '+sectorcode.name+'</option> ';
            }
            
            $(id).append(option);
        }
        $(id).selectpicker();
    }

 

   $scope.multiple_currency_check = function (cur) {
        var cur1 = $('#cur1hidden').val();  
        var cur2 = $('#cur2hidden').val();  
        var cur3 = $('#cur3hidden').val();  
        var cur4 = $('#cur4hidden').val(); 
        if (cur == cur1 || cur == cur2 || cur == cur3 || cur == cur4) {
            return true;
        } else {
            return false;
        }
    }

    $scope.calculate_amount_check = function () {
        var cur1 = $('#cur1hidden').val();  
        var cur2 = $('#cur2hidden').val();  
        var cur3 = $('#cur3hidden').val();  
        var cur4 = $('#cur4hidden').val(); 
        var amt1 = $('#id-tamount1').val();
        var amt2 = $('#id-tamount2').val();
        var amt3 = $('#id-tamount3').val();
        var amt4 = $('#id-tamount4').val();
        var curFmt = $('#curFmthidden').val();
        if (curFmt == '') {
            return false;
        } else if (cur1 == '' && cur2 == '' && cur3 == '' && cur4 == '') {
            return false;
        } else if (amt1 == '' && amt2 == '' && amt3 == '' && amt4 == '') {
            return false;
        } else {
            return true;
        }
    }

    $scope.accountSearch = function () {
   
        $("#ap-btn-loading-bref-vrfy").show();
        $scope.hide_error("accountnumber");
        $scope.accpara = false;
        if ( $('#id-accountnumber').val() =="") {
            $scope.show_error("accountnumber", $scope.message_required);
            $scope.accpara = false;
        } else {
            var iAccNumber  = $('#id-accountnumber').val(); 
            var txnType         = $scope.get_txn_type();             
                
            var formObj = {
                accnumber: iAccNumber
            }
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getAccountData',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
                $("#ap-btn-loading-bref-vrfy").hide();
                if (!result.error_status) { 
                    $scope.accpara = true;  
                    $('#id-accholdername').val(result.customerName); 
                    $('#id-currtype').val(result.currency); 
                    $('#id-accbalance').val($scope.numberWithCommas(Number(result.balance).toFixed(2))); 
                    $('#id-account-status').val(result.status);                      

                    if (result.currency.trim()== 'LKR' && txnType.trim()=='PFC') {
                        $scope.show_error("accountnumber", $scope.message_currency_restrict);

                    } else if (result.currency.trim() != 'LKR' && txnType.trim()=='FCI') {
                        $scope.show_error("accountnumber", $scope.message_currency_other);

                    }  

                    if (result.status.trim() == '5') {
                        $scope.show_error("accountnumber", $scope.message_account_dormant);
                    }  
                    if (result.status.trim() == '8') {
                        $scope.show_error("accountnumber", $scope.message_account_deceased);
                    }     
                
                } else{

                    $scope.show_error("accountnumber", $scope.account_not_fount);
                    $scope.accpara = false;
                }
            })
            .catch(function(error) {
                throw error;
            });
        }     
    }

    $scope.load_txn_sector_codes = function (uin) {
            var formObj = {   
                uintype: uin
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getTransactionSectorCodes',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data;                      
                $scope.sectorCodeslist = result;       
                $scope.load_sectorCodesList("#id-sectorcode");
                $("#id-sectorcode").selectpicker('refresh');                  
            })
            .catch(function(error) {
                throw error;
            }); 
           
    }



     $scope.validate_uin_number = function () {


            var uinnumber = $('#id-uinnumber').val();
            var uintype    = $('#id-uintype').val();
            
            if  (uintype=='1'){ 
                if (uinnumber.length==10 ) { 
                 const lastLetter = uinnumber[uinnumber.length-1];
                 const numbers    = uinnumber.slice(0,uinnumber.length-1);
                
                    if((lastLetter=='V' || lastLetter=='v' || lastLetter=='X' ||lastLetter=='x') && !isNaN(numbers)) {
                           $scope.hide_error("uinnumber");
                    } else {
                          $scope.show_error("uinnumber", $scope.message_invalid); 
                    }  
                
                } else if (uinnumber.length==12) {
                    if(!isNaN(uinnumber)){
                        $scope.hide_error("uinnumber");   
                 } else {
                    $scope.show_error("uinnumber", $scope.message_invalid);
                 }   
             } else {
                    $scope.show_error("uinnumber", $scope.message_invalid);
             }
            }       
    }

    
   


    $(function() { 

        

        $(document).on("click", "#ap-cancelbtn" , function() {
           // window.alert('dsd');
           $scope.trigger_savebtn_action('cancel-international');
        });



        $(document).on("click", "#ap-dltbtnapprove" , function() {
           $scope.trigger_savebtn_action('delete-international-approve');
        });

        $(document).on("click", "#ap-dltbtnreject" , function() {
           $scope.trigger_savebtn_action('delete-international-reject');
        });

      

        $(document).on("click", "#ap-btn-continue" , function() {
            
            $scope.pendingcalculation = true;
            $scope.focuscalculator = false;
            $scope.calculate_fcy_amount();
            //$scope.trigger_confbtn_action('continue');
           
        });

        $(document).on("click", "#ap-modal-btn-ver-clear" , function() {

           $('#id-currencyselector').val(""); 
           $('#id-currencyselector').selectpicker('refresh');
           $('#id-exchange-rate').val("");  
           $('#id-lkr-amount').val(""); 
           $('#id-com-fixed').val(""); 
           $('#id-com-rate').val(""); 
           $('#id-fcy-amount').val(""); 
          
           $scope.hide_error("fcyAmount");

            
        });

        $(document).on("click", "#ap-clrbtn-customer" , function() {

        if ($scope.validator != true) {
           $('#id-scan').val("");
           $('#id-uintype').val(""); 
           $('#id-uintype').selectpicker('refresh');
           $('#id-uinnumber').val("");  
           $('#id-title').val(""); 
           $('#id-title').selectpicker('refresh'); 
           $('#id-fname').val(""); 
           $('#id-airticket').val(""); 
           $('#id-accountnumber').val(""); 
           $('#id-accholdername').val(""); 
           $('#id-accbalance').val("");
           $('#id-currtype').val("");
           document.getElementById("id-scan").focus(); 

        }
            
            
        });

        $(document).on("click", "#ap-clrbtn-payment" , function() {
            
        if ($scope.validator!= true) {
           $('#id-icurrencyselector1').val("");
           $('#id-icurrencyselector1').selectpicker('refresh');
           $('#id-icurrencyselector2').val("");
           $('#id-icurrencyselector2').selectpicker('refresh');
           $('#id-icurrencyselector3').val("");
           $('#id-icurrencyselector3').selectpicker('refresh');
           $('#id-icurrencyselector4').val("");
           $('#id-icurrencyselector4').selectpicker('refresh');
           $('#id-tamount1').val("");
           $('#id-tamount2').val("");
           $('#id-tamount3').val("");
           $('#id-tamount4').val("");
           $('#id-iamount1').val("");
           $('#id-iamount2').val("");
           $('#id-iamount3').val("");
           $('#id-iamount4').val("");
           $('#id-rate1').val("");
           $('#id-rate2').val("");
           $('#id-rate3').val("");
           $('#id-rate4').val("");
           $('#id-camount1').val(0);
           $('#id-camount2').val(0);
           $('#id-camount3').val(0);
           $('#id-camount4').val(0);
           $('#id-iamount1').val("");
           $('#id-iamount2').val("");
           $('#id-iamount3').val("");
           $('#id-iamount4').val("");
           $('#id-lkrtotal').val("");
           $('#id-comgltotal').val("");
           $('#id-customertotal').val("");
           $('#id-commision-percentage').val("");
           $('#id-commision').val("");
           $('#id-incgltotal').val("");
           $('#id-receivedAmount').val("");
           $('#id-refundAmount').val("");
           $('#id-remarks').val("");
           $('#id-receiptNumber').val(""); 
           $('#id-prvcurr1').val(""); 
           $('#id-prvcurr2').val(""); 
           $('#id-prvcurr3').val(""); 
           $('#id-prvcurr4').val(""); 
           $('#id-prvamt1').val("");
           $('#id-prvamt2').val("");
           $('#id-prvamt3').val("");
           $('#id-prvamt4').val("");
           $('#id-prvtimestamp').val("");
           $('#id-prvlkrtotal').val("");

           $scope.hide_error("receiptNumber");
           $scope.hide_error("lkrtotal");
           $scope.hide_error("refundAmount");
           
           $scope.rpara = false;
           $scope.$apply();
        }   
           
        });
        
        

        


        

        $(document).on("click", "#ap-modal-btn-del-approve" , function() {
            $scope.trigger_confbtn_action('delete-approve');
        });

        $(document).on("click", "#ap-modal-btn-del-reject" , function() {
            $scope.trigger_confbtn_action('delete-reject');
        });

        $(document).on("click", "#ap-modal-btn-cancel" , function() {
            $scope.trigger_confbtn_action('cancel');
        });
       
       // $(document).on("click", "#ap-modal-btn-continue" , function() {
       //      $scope.trigger_confbtn_action('continue');
       //  });

        

        $(document).on("click", "#ap-modal-btn-del-dom" , function() {
            $scope.trigger_confbtn_action('delete-domestic');
        });

        $(document).on("click", "#ap-modal-btn-del-redirect" , function() {
            $scope.trigger_redirection_action('cancel');
        });

        $(document).on("click", "#ap-backbtn-delete-international" , function() {
            $scope.trigger_redirection_action('delete');
        });

        $(document).on("click", "#ap-backbtn-view-international" , function() {
            $scope.trigger_redirection_action('delete');
        });

        $(document).on("click", "#ap-modal-btn-del-dom-redirect" , function() {
            $scope.trigger_redirection_action('delete-domestic');
        });

        $(document).on("click", "#ap-backbtn-delete-domestic" , function() {
            $scope.trigger_redirection_action('delete-domestic');
        });

        $(document).on("click", "#ap-testbtn" , function() {
           window.alert('sfs');
        });

        $('#id-accountnumber').on("change", function () {
             $scope.getAccountRelatedData();
        });

        $('#id-receiptNumber').on("change", function () {
             $scope.getExchangeReceiptData();
        });




//------------------ OCR captcha--------------------------------------
        $('#id-scan').on("keyup", function () {

        clearTimeout(timer);

        timer = setTimeout( () => {

            var str = $('#id-scan').val();
           // var str ='Surname: NAWARATHNA|Forenames: ERANGA|Gender: Female|DoB: 03-02-91|ExpDate: 18-04-27|Document: PASSPORT|DocNumber: N7031039|IssuingState: LKA|Nationality: LKA';
           // var str = STARTSurname: KURUKULASURIYAGEForenames: MENADI SENUTHIMAGender: FemaleDate of Birth: 10-11-15Expiry Date: 04-09-28Document: PASSPORTDoc. Number: N7844636Issuing State: LKANationality: LKAEND';Surname: ________________|Forenames: MENADI SENUTHIMA|Gender: Female|DoB: 10-11-15|ExpDate: 04-09-28|Document: PASSPORT|DocNumber: N7844636|IssuingState: ___|Nationality: LKA
           // var str = 'Surname: RULLA|Forenames: THOMAS CHRISTIAN|Gender: Male|DoB: 13-01-68|ExpDate: 05-03-33|Document: TRAVEL DOCUMENT|DocNumber: C36FW41Z6|IssuingState: DY |Nationality: DY';
            var res = str.split("|");
            var country = res[8].split(":")[1].trim();
            var txnType         = $scope.get_txn_type();

            // if (txnType=='FCS' && res[8].split(":")[1].trim()!="LKA"){
            //     $scope.show_error("ocr", 'Issuing currencies against a foreign passport should be done in Re Exchange panel');
            // } else 
            if (txnType=='FCR' && res[8].split(":")[1].trim()=="LKA"){
                $scope.show_error("ocr", 'Only foreign passports allowed to use the panel');
            }
            else{
                $('#id-fname').val(res[1].split(":")[1].trim() + ' ' + res[0].split(":")[1].trim());
                $('#id-uinnumber').val(res[6].split(":")[1].trim());
                if(res[2].split(":")[1].trim()=="Female") {
                    $('#id-title').val("MS");
                    $('#id-title').selectpicker('refresh'); 
                }

                if(res[2].split(":")[1].trim()=="Male") {
                   $('#id-title').val("MR");
                   $('#id-title').selectpicker('refresh'); 
                } 
                if(res[8].split(":")[1].trim()=="LKA"){
                    $('#id-uintype').val(5);
                    $('#uinidtypehidden').val(5);
                    $('#id-uintype').selectpicker('refresh'); 
                    $scope.load_txn_sector_codes('5');
                  //  window.alert(country);
                    $('#id-majorcountry').val(country);
                    $('#id-majorcountry').selectpicker('refresh');
                    $('#id-benecountry').val(country);
                    $('#id-benecountry').selectpicker('refresh');  

                 
                    
                } else { 
                     
                    $('#id-uintype').val(3);
                    $('#uinidtypehidden').val(3);
                    $('#id-uintype').selectpicker('refresh'); 
                    $scope.load_txn_sector_codes('3');
                    
                    if (country.length == 3 ){
                       $('#id-majorcountry').val(country);
                       $('#id-majorcountry').selectpicker('refresh'); 
                       $('#id-benecountry').val(country);
                       $('#id-benecountry').selectpicker('refresh');  

                   } else {
                       // $('#id-majorcountry').selectpicker('refresh'); 
                       // $('#id-benecountry').selectpicker('refresh');

                   }
                    
               
                }


            }  

            $('#id-scan').val("");
            if (txnType=='FCP'){
               document.getElementById("id-itrscode").focus();  
           } else if (txnType=='FCS' || txnType=='FCR'){
               document.getElementById("id-majorcountry").focus(); 
           } else if (txnType=='FCI' || txnType=='PFC') {
                document.getElementById("id-accountnumber").focus(); 
           } 
            

        }, 100)

      
        
    }); 

//------------------ UIN Number--------------------------------------
    $('#id-uinnumber').on("change", function () {
        
        $scope.hide_error("uinnumber"); 
        $scope.validate_uin_number();
        
    }); 
//------------------ From date-------------------------------------
    $('#id-fromdate').on("change", function () {
        
        $scope.hide_error("fromdate"); 
      
    });
//------------------ TO date-------------------------------------
    $('#id-todate').on("change", function () {
        
        $scope.hide_error("todate"); 
      
    });      
//------------------ Txn type--------------------------------------
    $('#id-txntype').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
        
            $scope.hide_error("txntype");
            var txntype = $('#id-txntype').val();
            $('#idhiddentxntype').val(txntype);
        
    });
//------------------ Txn Status--------------------------------------
    $('#id-txnstatus').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
        
            $scope.hide_error("txnstatus");
            var txnstatus = $('#id-txnstatus').val();
            $('#idhiddentxnstatus').val(txnstatus);
        
    });
    //------------------ ITRS Code--------------------------------------
    $('#id-txntype').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
        
            $scope.hide_error("txntype");
            var itrscode = $('#id-txntype').val();
            $('#idhiddentxntype').val(itrscode);
        
    });     

//------------------ UIN Number--------------------------------------
    $('#id-lkr-amount').on("keyup", function () {
        
        $scope.calculate_fcy_amount();
        
    }); 

//------------------ ITRS Code--------------------------------------
    $('#id-title').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
        
        $scope.hide_error("title"); 
        
    });

//------------------ Customer Name--------------------------------------
    $('#id-fname').on("change", function () {  
        
        $scope.hide_error("fname"); 
        
    });         
//------------------ ITRS code value assignment 
        $('#id-itrscode').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            $scope.hide_error("itrscode");
            var itrscode = $('#id-itrscode').val();
            $('#id-itrscodehidden').val(itrscode);
            var natureoftxn = $('#id-natureoftxn').val(); 


            var iAmount1        = parseFloat($scope.get_converted_amount1().replace(/[,]/g, ''));
            var iAmount2        = parseFloat($scope.get_converted_amount2().replace(/[,]/g, ''));
            var iAmount3        = parseFloat($scope.get_converted_amount3().replace(/[,]/g, ''));
            var iAmount4        = parseFloat($scope.get_converted_amount4().replace(/[,]/g, ''));         
            var total_lkr_amount = iAmount1 + iAmount2 + iAmount3 + iAmount4; 
          
            
            if (itrscode=='1501') {
                $scope.calculate_work_remm_incentive(total_lkr_amount);   
                $scope.workerRem = true; 
                $scope.$apply();
              //  $scope.calculate_commision();
            } else {
                $scope.calculate_commision();
                $scope.workerRem = false; 
                $scope.$apply();
            }                           
        });

//------------------ Account type code value assignment
        $('#id-accounttypecode').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {
            $scope.hide_error("accounttypecode");    
            var accTypeCode = $('#id-accounttypecode').val();
            $('#id-accounttypecodehidden').val(accTypeCode);                           
        });

//------------------ Transaction Sector code value assignment
        $('#id-sectorcode').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {  
            $scope.hide_error("sectorcode");   
            var sectorCode = $('#id-sectorcode').val();
            $('#id-sectorcodehidden').val(sectorCode);                           
        });

//------------------ Major Country value assignment
        $('#id-majorcountry').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {  
            $scope.hide_error("majorcountry");     
            var countryCode = $('#id-majorcountry').val();
            $('#id-majorcountryhidden').val(countryCode);  
        });

//------------------ Bene bank code value assignment
        $('#id-benebank').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            var bankCode = $('#id-benebank').val();
            $('#id-benebankhidden').val(bankCode);  
        });

//------------------ Counterparty Country value assignment
        $('#id-benecountry').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            var beneCountryCode = $('#id-benecountry').val();
            $('#id-benecountryhidden').val(beneCountryCode);  
        });



//------------------ Load Transaction Sector Codes List for selected UIN 
        $('#id-uintype').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            //var cAmount        = parseFloat($scope.get_converted_amount1().replace(/[,]/g, '')); 
            if ($('#id-camount1').val() !="") {
               $scope.calculate_commision();
               $scope.hide_error("commision-percentage"); 

            }

            $scope.hide_error("uintype"); 
            var iUINType = $('#id-uintype').val();
            $('#uinidtypehidden').val(iUINType);
            var formObj = {   
                uintype: iUINType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getTransactionSectorCodes',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data;                      
                $scope.sectorCodeslist = result;       
                $scope.load_sectorCodesList("#id-sectorcode");
                $("#id-sectorcode").selectpicker('refresh');  
                var sectorCode = $('#id-sectorcode').val();
               $('#id-sectorcodehidden').val(sectorCode);                  
            })
            .catch(function(error) {
                throw error;
            }); 
            //$scope.calculate_lkr_amount();                 
        });



//------------------ Load exchange rate for selected currency   - Currency Calculator
        $('#id-currencyselector').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {
            var iCurrencyType   = $(this).find(':selected').data('code'); 
            var iCurrencyCode   = $(this).find(':selected').data('shrt');
            var iTxnType  = $('#id-txntype').val();
           
            $scope.hide_error("currencyselector");   
            var formObj = {   
                currency: iCurrencyType,
                shortcode: iCurrencyCode, 
                txntype: iTxnType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getExchangeRate',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
                if (result.error_status) {
                //ERROR HANDLING
            } else {
                $('#id-exchange-rate').val(result.sellRate); 

               // $scope.ceilingValue = result.ceiling;

            }       
            })
            .catch(function(error) {
                throw error;
            });                          
        });

//------------------ Load exchange rate for selected currency   - Currency 1
        $('#id-icurrencyselector1').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {
            $scope.hide_error("icurrencyselector1"); 
            var iCurrencyType   = $(this).find(':selected').data('code'); 
            var iCurrencyCode   = $(this).find(':selected').data('shrt');
            var iNatureOfTxn  = $('#id-natureoftxn').val();
            var iTxnType  = $('#id-txntype').val();

            // if ($scope.multiple_currency_check(iCurrencyCode)) {
            //    $scope.show_error("icurrencyselector", $scope.message_duplicate);
            //    $('#id-rate1').val('');
            //    $('#id-tamount1').val('');
            // } else {
            $scope.hide_error("icurrencyselector");   
            $('#cur1hidden').val(iCurrencyCode);   
            var formObj = {   
                currency: iCurrencyType,
                shortcode: iCurrencyCode, 
                txntype: iTxnType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getExchangeRate',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
            if (result.error_status) {
                //ERROR HANDLING
            } else {
                if (iNatureOfTxn == '1') {  // ceiling value applied only for buying
                    $('#id-rate1').val(result.buyRate); 
                    $('#id-rate1-default').val(result.buyRate);                   
                    $('#id-minrate1').val($scope.get_min_value(result.buyRate, result.ceiling ));
                    $('#id-maxrate1').val($scope.get_max_value(result.buyRate, result.ceiling ));
                    // $('#id-rate1').attr({ "max" : $scope.get_max_value(result.buyRate, result.ceiling ) , "min" : $scope.get_min_value(result.buyRate, result.ceiling ) }); 
                }
                else if (iNatureOfTxn == '2') {
                    $('#id-rate1').val(result.sellRate); 
                    $('#id-rate1-default').val(result.sellRate); 
                   ;
                } 
                $scope.calculate_lkr_amount();      
            }       
            })
            .catch(function(error) {
                throw error;
            });                          
        });
//---------------- Load exchange rate for selected currency   - Currency 2
        $('#id-currencyselector').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {      
            $scope.calculate_fcy_amount();                        
        });
//---------------- Load exchange rate for selected currency   - Currency 2
        $('#id-icurrencyselector2').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {      
            $scope.hide_error("icurrencyselector2"); 
            var iCurrencyType   = $(this).find(':selected').data('code');
            var iCurrencyCode   = $(this).find(':selected').data('shrt');  
            var iNatureOfTxn  = $('#id-natureoftxn').val();
            var iTxnType  = $('#id-txntype').val();

            // if ($scope.multiple_currency_check(iCurrencyCode)) {
            //    $scope.show_error("icurrencyselector", $scope.message_duplicate);
            //    $('#id-rate2').val('');
            //    $('#id-tamount2').val('');
            // } else {
            $scope.hide_error("icurrencyselector");
            $('#cur2hidden').val(iCurrencyCode);  
            var formObj = {   
                currency: iCurrencyType,
                shortcode: iCurrencyCode, 
                txntype: iTxnType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getExchangeRate',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
            if (result.error_status) {
                //ERROR HANDLING
            } else {
                if (iNatureOfTxn == '1') {  
                    $('#id-rate2').val(result.buyRate);
                    $('#id-rate2-default').val(result.buyRate);  
                    $('#id-minrate2').val($scope.get_min_value(result.buyRate, result.ceiling ));
                    $('#id-maxrate2').val($scope.get_max_value(result.buyRate, result.ceiling ));
                }
                else if (iNatureOfTxn == '2') {
                    $('#id-rate2').val(result.sellRate); 
                    $('#id-rate2-default').val(result.sellRate);  
                    // $('#id-crossrate2').val(0);
                    // $('#id-rate2').attr({ "max" : $scope.get_max_value(result.sellRate, result.ceiling ) , "min" : $scope.get_min_value(result.sellRate, result.ceiling ) });
                }  
                $scope.calculate_lkr_amount(); 
            }       
            })
            .catch(function(error) {
                throw error;
            });                          
        });

//------------------ Load exchange rate for selected currency   - Currency 3
        $('#id-icurrencyselector3').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {        
            $scope.hide_error("icurrencyselector3"); 
            var iCurrencyType   = $(this).find(':selected').data('code'); 
            var iCurrencyCode   = $(this).find(':selected').data('shrt');
            var iNatureOfTxn  = $('#id-natureoftxn').val();
            var iTxnType  = $('#id-txntype').val();

            // if ($scope.multiple_currency_check(iCurrencyCode)) {
            //    $scope.show_error("icurrencyselector", $scope.message_duplicate);
            //    $('#id-rate3').val('');
            //    $('#id-tamount3').val('');
            // } else {
            $scope.hide_error("icurrencyselector");
            $('#cur3hidden').val(iCurrencyCode);   
            var formObj = {   
                currency: iCurrencyType,
                shortcode: iCurrencyCode, 
                txntype: iTxnType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getExchangeRate',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
            if (result.error_status) {
                //ERROR HANDLING
            } else {
                if (iNatureOfTxn == '1') {  
                    $('#id-rate3').val(result.buyRate);
                    $('#id-rate3-default').val(result.buyRate);  
                    $('#id-minrate3').val($scope.get_min_value(result.buyRate, result.ceiling ));
                    $('#id-maxrate3').val($scope.get_max_value(result.buyRate, result.ceiling ));     
                }
                else if (iNatureOfTxn == '2') {
                    $('#id-rate3').val(result.sellRate); 
                    $('#id-rate3-default').val(result.sellRate);  
                    // $('#id-crossrate3').val(0);
                    // $('#id-rate3').attr({ "max" : $scope.get_max_value(result.sellRate, result.ceiling ) , "min" : $scope.get_min_value(result.sellRate, result.ceiling ) });
                }   
                $scope.calculate_lkr_amount();   
            }       
            })
            .catch(function(error) {
                throw error;
            });                        
        });

//------------------ Load exchange rate for selected currency   - Currency 4
        $('#id-icurrencyselector4').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {         
            $scope.hide_error("icurrencyselector4"); 
            var iCurrencyType   = $(this).find(':selected').data('code');  
            var iCurrencyCode   = $(this).find(':selected').data('shrt');
            var iNatureOfTxn  = $('#id-natureoftxn').val(); 
            var iTxnType  = $('#id-txntype').val();
            // if ($scope.multiple_currency_check(iCurrencyCode)) {
            //    $scope.show_error("icurrencyselector", $scope.message_duplicate);
            // } else {
            $scope.hide_error("icurrencyselector");
            $('#cur4hidden').val(iCurrencyCode); 
            var formObj = {   
                currency: iCurrencyType,
                shortcode: iCurrencyCode, 
                txntype: iTxnType
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getExchangeRate',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
            if (result.error_status) {
                //ERROR HANDLING
            } else {
                if (iNatureOfTxn == '1') {  
                    $('#id-rate4').val(result.buyRate);
                    $('#id-rate4-default').val(result.buyRate);                 
                    $('#id-minrate4').val($scope.get_min_value(result.buyRate, result.ceiling ));
                    $('#id-maxrate4').val($scope.get_max_value(result.buyRate, result.ceiling ));
                  
                }
                else if (iNatureOfTxn == '2') {
                    $('#id-rate4').val(result.sellRate); 
                    $('#id-rate4-default').val(result.sellRate);  
                    
                } 
                $scope.calculate_lkr_amount();      
            }       
            })
            .catch(function(error) {
                throw error;
            });                           
        }); 
//------------------ Transaction Amount 1--------------------------------------
 

  $(document).keypress(function(event) {
    var iTxnType  = $('#id-txntype').val();


     
    if (event.keyCode === 10) {
    
            document.getElementById("id-remarks").focus(); 
    }  

    if (iTxnType == 'FCP'){

            if (event.keyCode === 13 && $scope.validator===false && !$scope.savesuccess && !$scope.savepending ) {
               $scope.calculate_lkr_amount();
               $scope.validate_message_FCP('transaction/create/validate_FCP_txn');
        
            } else if (event.keyCode === 13 && $scope.validator ===true && !$scope.savesuccess && !$scope.savepending) {
                //document.getElementById("ap-savbtn-purchase").focus();
               // document.getElementById("ap-savbtn-purchase").click(); 
                $scope.save_message_purchase('transaction/create/save_FCP_txn');
            } else {
                if (event.key === "Enter" && $scope.savesuccess && !$scope.savepending) {
                    event.preventDefault();
                    document.getElementById("id-okbtn").click();
              
                }  
            }
                     

     } else if (iTxnType == 'FCS'){
            if (event.keyCode === 13 && $scope.focuscalculator === true ) {
               $("#ap-btn-continue").trigger('click');
            
            } else if (event.keyCode === 13 && $scope.validator===false && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
             $scope.calculate_lkr_amount();
             $scope.validate_message_FCS('transaction/create/validate_FCS_txn');

            } else if (event.keyCode === 13 && $scope.validator ===true && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                $scope.save_message_sales('transaction/create/save_FCS_txn');
            } else {
                if (event.key === "Enter" && $scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                    event.preventDefault();
                    document.getElementById("id-okbtn").click();
              
                }  
            } 

           

     } else if (iTxnType == 'FCR'){
            if (event.keyCode === 13 && $scope.focuscalculator === true) {
                $("#ap-btn-continue").trigger('click');
            } else if (event.keyCode === 13 && $scope.validator ===false && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                $scope.calculate_lkr_amount();
                $scope.validate_message_FCR('transaction/create/validate_FCR_txn');

            } else if (event.keyCode === 13 && $scope.validator ===true && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                $scope.save_message_exchange('transaction/create/save_FCR_txn');
            } else {
                if (event.key === "Enter" && $scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                    event.preventDefault();
                    document.getElementById("id-okbtn").click();
              
                }  
            }   

     } else if (iTxnType == 'FCI'){ 
            if (event.keyCode === 13 && $scope.focuscalculator === true) {
                $("#ap-btn-continue").trigger('click');
            } else if (event.keyCode === 13 && $scope.validator===false && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                $scope.calculate_lkr_amount();
                $scope.validate_message_FCI('transaction/create/validate_FCI_txn');

            } else if (event.keyCode === 13 && $scope.validator===true && !$scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                $scope.save_message_issue('transaction/create/save_FCI_txn');
            } else {
                if (event.key === "Enter" && $scope.savesuccess && !$scope.savepending && $scope.focuscalculator===false) {
                    event.preventDefault();
                    document.getElementById("id-okbtn").click();
              
                }  
            }  

     }  else if (iTxnType == 'PFC'){ 

        if (event.keyCode === 13 && $scope.validator===false && !$scope.savesuccess && !$scope.savepending) {
                
                $scope.validate_message_PFC('transaction/create/validate_PFC_txn');

            } else if (event.keyCode === 13 && $scope.validator===true && !$scope.savesuccess && !$scope.savepending) {
                $scope.save_message_withdraw('transaction/create/save_PFC_txn');
            } else {
                if (event.key === "Enter" && $scope.savesuccess && !$scope.savepending) {
                    event.preventDefault();
                    document.getElementById("id-okbtn").click();
              
                }  
            }  

     } 
            
   });

//------------------ Transaction Amount 1--------------------------------------
    $('#id-tamount1').on("change", function () {  
        
        $scope.hide_error("tamount1"); 
       
    });
//------------------ Transaction Amount 2--------------------------------------
    $('#id-tamount2').on("change", function () {  
        
        $scope.hide_error("tamount2"); 
        
    }); 
 //------------------ Transaction Amount 3--------------------------------------
    $('#id-tamount3').on("change", function () {  
        
        $scope.hide_error("tamount3"); 
        
    }); 
//------------------ Transaction Amount 4--------------------------------------
    $('#id-tamount4').on("change", function () {  
        
        $scope.hide_error("tamount4"); 
        
    }); 

//------------------ PFC Withdrawal
        $('#id-icurrency').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
           
            $scope.hide_error("icurrency");
            var currency1 = $('#id-icurrency').val().trim();
            var currency2 = $('#id-currtype').val().trim();   
            var txnType   = $scope.get_txn_type();          
            $('#id-icurrencyhidden').val(currency1);
     
            if (currency1 == 'LKR' ) {
               $scope.show_error("icurrency", $scope.message_currency_restrict);
            } else if (currency1 != currency2 ) {        
               $scope.show_error("icurrency", $scope.message_currency_mismatch);
            } else {       
            $scope.hide_error("icurrency");
            } 
        });                    
//------------------ Staff  Commision 
    $('#id-staffcheck').on("click", function() {
        $('#id-commision-percentage').val($scope.staffcommissionval);
        $scope.calculate_commision_sp();   
     });

//------------------ Special Forces Commision 
    $('#id-forcescheck').on("click", function() {
        $('#id-commision-percentage').val($scope.forcescommissionval);
        $scope.calculate_commision_sp();

     });

//===============================================================================

//------------------ Calculate FCY to LKR --------------------------------------
    $('.calculateLkr').on('change', function(e, clickedIndex, newValue, oldValue) { 
        $scope.calculate_lkr_amount();
    });
//------------------ Calculate FCY to LKR --------------------------------------
    // $('.calculateFcy').on('change', function(e, clickedIndex, newValue, oldValue) { 
    //     $scope.calculate_fcy_amount();
    // });
//------------------ Calculate FCY to LKR --------------------------------------
    $('.calculateRefund').on('change', function(e, clickedIndex, newValue, oldValue) { 
        $scope.calculate_refund_amount();
    }); 

       

//------------------ Currency Calculator---------------
    $("#ap-btn-currency-calculator").on( "click", function() {
        if ($('#uinidtypehidden').val() ==""){
            $scope.show_error("uintype", $scope.message_insufficient_cal);
         } else {
            $scope.get_fcy_calculator(); 
         }   
          
    });




//------------------ Reset Amount --------------------------------------
    $('#ap-calbtn-form-reset').on("click", function() {

       $('#id-camount1').val('');
       $('#id-camount2').val('');
       $('#id-camount3').val('');
       $('#id-camount4').val(''); 
       $('#id-lkrtotal').val(''); 
       $('#id-commision').val(''); 
       $("#id-lkrtotal, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-rate1, #id-rate2, #id-rate3, #id-rate4").prop("readonly", false);
       $("#id-icurrencyselector1, #id-icurrencyselector2, #id-icurrencyselector3, #id-icurrencyselector4").prop("disabled", false).selectpicker("refresh");            
       
    });

//------------------ Calculate Worker Remittence --------------------------------------
    $('#ap-calbtn-form-calculateincentive').on("click", function() {
        var param_currency1 = null;
        var param_currency2 = null;
        var param_currency3 = null;
        var param_currency4 = null;
        var param_transaction_amount1 = null;
        var param_transaction_amount2 = null;
        var param_transaction_amount3 = null;
        var param_transaction_amount4 = null;

        //-------------Currency Type 1 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount1()) ||  !$scope.isset($scope.get_currency1())) {
            $('#id-iamount1').val(0.0000); 
        }
        else {
            var param_currency1              = $scope.get_currency1();
            var param_transaction_amount1    = $scope.get_transaction_amount1().replace(/[,]/g, '');                
        }

        //-------------Currency Type 2 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount2()) ||  !$scope.isset($scope.get_currency2())) {
            $('#id-iamount2').val(0.0000); 
        }
        else {
             var param_currency2              = $scope.get_currency2();
             var param_transaction_amount2    = $scope.get_transaction_amount2().replace(/[,]/g, '');                
        }

         //-------------Currency Type 3 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount3()) ||  !$scope.isset($scope.get_currency3())) {
            $('#id-iamount3').val(0.0000); 
        }
        else {
             var param_currency3              = $scope.get_currency3();
             var param_transaction_amount3    = $scope.get_transaction_amount3().replace(/[,]/g, '');                
        }

         //-------------Currency Type 4 -------------------------------------
        if (!$scope.isset($scope.get_transaction_amount4()) ||  !$scope.isset($scope.get_currency4())) {
            $('#id-iamount4').val(0.0000); 
        }
        else {
             var param_currency4              = $scope.get_currency4();
             var param_transaction_amount4    = $scope.get_transaction_amount4().replace(/[,]/g, '');                
        }
            
        $scope.calculate_incentive_amount(param_currency1, param_currency2, param_currency3, param_currency4, param_transaction_amount1, param_transaction_amount2, param_transaction_amount3, param_transaction_amount4);          
    });

//------------------ Get Customer data for selected UIN --------------------------------------
   $('#ap-btn-uin-search').on("click", function() {
        $scope.hide_error("uintype");
         $scope.bpara = false;
        if ($('#id-uintype').val() =="" || $('#id-uinnumber').val() =="") {
            $scope.show_error("uintype", $scope.message_insufficient);
        } else {
            var iUinType    = $('#id-uintype').val();
            var iUinNumber  = $('#id-uinnumber').val();  
            var formObj = {
                uinType: iUinType,
                uinNumber: iUinNumber,
            }
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getCustomerData',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {  
                var result = response.data; 
                $("#ap-btn-loading-conf").hide();
                if (!result.error_status) {
                    //clear 
                    $scope.hide_error("uinnumber");
                    $scope.hide_error("fname");
                    // $scope.hide_error("custaddr1");
                    $("input[name=fname]").val('');
                     $scope.bpara = true;
                   
                    //set value
                    $('#id-fname').val(result.customerName);                   
                    $("#id-customercheck").prop("checked", true);
                    if (result.staff =='999'){
                      $("#id-staffcheck").prop("checked", true);  
                    }
                    // $('#id-nic').val(result.nic);
                    // $('#id-custaddr1').val(result.addressLine1);
                    // $('#id-custaddr2').val(result.addressLine2);
                    // $('#id-custaddr3').val(result.addressLine3); 

                } else{
                    $scope.show_error("uinnumber", $scope.message_not_fount);
                   //  $("input[name=fname]").val('');
                     // $("input[name=custaddr1]").val('');
                     // $("input[name=custaddr2]").val('');
                     // $("input[name=custaddr3]").val('');
                }
            })
            .catch(function(error) {
                throw error;
            });
        }     
    });

//------------------ Get Bene data for entered Account Number --------------------------------------
   $('#ap-btn-beneaccount-search').on("click", function() {
        $scope.hide_error("beneaccountnumber");
        $scope.hide_error("beneaccounttype");
        if ($('#id-beneaccounttype').val() =="" || $('#id-beneaccountnumber').val() =="") {
            $scope.show_error("beneaccounttype", $scope.message_insufficient);

        } else {
            var iAccType    = $('#id-beneaccounttype').val();
            var iAccNumber  = $('#id-beneaccountnumber').val();              
            var iNatureOfTxn  = $('#id-natureoftxn').val();             
            var formObj = {
                acctype: iAccType,
                accnumber: iAccNumber,
                natureoftxn : iNatureOfTxn
            }
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/getBeneAccountData',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
                $("#ap-btn-loading-conf").hide();
                if (!result.error_status) {
                          $('#id-benename').val(result.customerName);
                } else{
                    $scope.show_error("beneaccountnumber", $scope.message_not_fount);
                }
            })
            .catch(function(error) {
                throw error;
            });
        }     
    });


//------------------ Exclude/ Change Commision 
    $('#ap-btn-exclude-commision').on("click", function() {
       // $("#id-commision-percentage").prop("readonly", false);
    });

//------------------ Exclude/ Change Commision 
    $('#ap-btn-include-commision').on("click", function() {
     //  $('#id-commision-percentage').val($scope.defaultcommissionval);
       $scope.calculate_commision();
     });


//--------------------REdirect Actions----------------------
     $(document).on("click", "#ap-bckbtn" , function() {
            window.location.href = $scope.get_baseurl()+'dashboard';
            return false;
    });

//------------------ Validate user creation ---------------
    $("#ap-nxtbtn-view").on( "click", function() {

        $scope.validate_message_admin_view('transaction/admin/validate_view');
    });     

//------------------ Validate transaction ---------------
    $("#ap-nxtbtn-purchase").on( "click", function() {
        $scope.validate_message_FCP('transaction/create/validate_FCP_txn');
    });
//------------------ Validate transaction ---------------
    $("#ap-nxtbtn-sales").on( "click", function() {
        $scope.validate_message_FCS('transaction/create/validate_FCS_txn');
    });

//------------------ Validate transaction ---------------
    $("#ap-nxtbtn-exchange").on( "click", function() {
        $scope.validate_message_FCR('transaction/create/validate_FCR_txn');
    });

//------------------ Validate transaction ---------------
    $("#ap-nxtbtn-issue").on( "click", function() {
        $scope.validate_message_FCI('transaction/create/validate_FCI_txn');
    }); 
//------------------ Validate transaction ---------------
    $("#ap-nxtbtn-withdraw").on( "click", function() {
        $scope.validate_message_PFC('transaction/create/validate_PFC_txn');
    });          


//------------------ Save transaction ---------------
    $("#ap-savbtn-purchase").on( "click", function() {
      $scope.save_message_purchase('transaction/create/save_FCP_txn');
        
    });

//------------------ Save transaction ---------------
    $("#ap-savbtn-sales").on( "click", function() {
       $scope.save_message_sales('transaction/create/save_FCS_txn');
    }); 

//------------------ Save transaction ---------------
    $("#ap-savbtn-exchange").on( "click", function() {
       $scope.save_message_exchange('transaction/create/save_FCR_txn');
    });

//------------------ Save transaction ---------------
    $("#ap-savbtn-issue").on( "click", function() {
       $scope.save_message_issue('transaction/create/save_FCI_txn');
    });

//------------------ Save transaction ---------------
    $("#ap-savbtn-withdraw").on( "click", function() {
       $scope.save_message_withdraw('transaction/create/save_PFC_txn');
    });             

//------------------ Save transaction ---------------
    $("#ap-savbtn-view").on( "click", function() {
        
            var iFromdate    = $('#id-fromdate').val();
            var iTodate  = $('#id-todate').val();              
            var iTxntype  = $('#idhiddentxntype').val(); 
            var iTxnstatus  = $('#idhiddentxnstatus').val();  

            var parameters = '?fromdate='+iFromdate+'&todate='+iTodate+'&txntype='+iTxntype+'&txnstatus='+iTxnstatus;   

            window.location.href = $scope.get_baseurl()+'transaction/admin/view/report'+parameters;
            return false;


            // var formObj = {
            //     fromdate: iFromdate,
            //     todate: iTodate,
            //     txntype : iTxntype,
            //     txnstatus : iTxnstatus
            // }
            // $http({
            //     method: 'POST',
            //     url: $scope.get_baseurl()+'transaction/view_all',
            //     data: formObj,
            //     headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            // })
            // .then(function(response) {              
            //     var result = response.data; 
            //     $("#ap-btn-loading-conf").hide();
            //     if (!result.error_status) {
            //             alert('yes');
            //     } else{
            //        alert('no');
            //     }
            // })
            // .catch(function(error) {
            //     throw error;
            // });
         
    }); 

//------------------ Back button---------------
    $("#ap-backbtn-purchase").on( "click", function() {
             $scope.validator =false;
                $("#ap-backbtn-purchase").hide();
                $("#ap-savbtn-purchase").hide();
                $("#ap-nxtbtn-purchase").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("#id-remarks, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname,  #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4,  #id-benename").prop("readonly", false);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").removeClass('ap-btn-disabled');          
                $(".bootstrap-select button").removeClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", false).selectpicker("refresh");
                
    });
//------------------ Back button---------------
    $("#ap-backbtn-sales").on( "click", function() {
                $scope.validator =false;
                $("#ap-backbtn-sales").hide();
                $("#ap-savbtn-sales").hide();
                $("#ap-nxtbtn-sales").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("#id-remarks, #id-receivedAmount, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname,  #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4,  #id-benename").prop("readonly", false);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").removeClass('ap-btn-disabled');          
                $(".bootstrap-select button").removeClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", false).selectpicker("refresh");
                
    });

//------------------ Back button---------------
    $("#ap-backbtn-exchange").on( "click", function() {
                $scope.validator =false;
                $("#ap-backbtn-exchange").hide();
                $("#ap-savbtn-exchange").hide();
                $("#ap-nxtbtn-exchange").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("#id-remarks, #id-receiptNumber, #id-receivedAmount, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname,  #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4,  #id-benename").prop("readonly", false);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").removeClass('ap-btn-disabled');          
                $(".bootstrap-select button").removeClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", false).selectpicker("refresh");
                
    });

//------------------ Back button---------------
    $("#ap-backbtn-issue").on( "click", function() {
                $scope.validator =false;
                $("#ap-backbtn-issue").hide();
                $("#ap-savbtn-issue").hide();
                $("#ap-nxtbtn-issue").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("#id-remarks, #id-receiptNumber, #id-receivedAmount, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname,  #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4,  #id-benename").prop("readonly", false);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").removeClass('ap-btn-disabled');          
                $(".bootstrap-select button").removeClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", false).selectpicker("refresh");
                
    });          

//------------------ Back button---------------
    $("#ap-backbtn-withdraw").on( "click", function() {
                $scope.validator =false;
                $("#ap-backbtn-withdraw").hide();
                $("#ap-savbtn-withdraw").hide();
                $("#ap-nxtbtn-withdraw").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("#id-remarks, #id-accountnumber, #id-scan, #id-uinnumber, #id-fname,  #id-nic, #id-passport, #id-airticket,  #id-tamount1,  #id-benename").prop("readonly", false);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").removeClass('ap-btn-disabled');          
                $(".bootstrap-select button").removeClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", false).selectpicker("refresh");
                
    }); 
//------------------ veryfy Previous exchange receipt number
    $('#ap-vfrybtn-form-verifyreceipt').on("click", function() {
        
        $scope.hide_error(receiptNumber);
        if (!$scope.isset($scope.get_receipt_number())) {
            $scope.show_error("receiptNumber", $scope.message_required);
        }
        else {
            $("#ap-btn-loading-bref-vrfy").show();
            var receiptNumber       = $scope.get_receipt_number();
            var formObj = {   
                receiptNumber: receiptNumber
            };
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'transaction/create/verifyReceiptNumber',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {   
                $("#ap-btn-loading-bref-vrfy").hide();           
                var result = response.data; 
                if (!result.errorStatus && result.isValidRef) {
                    //window.alert('sd');
                    $scope.show_success("receiptNumber", $scope.message_ref_verified);
                  //  alert(result);
                    $('#id-prvcurr1').val(result.curr1); 
                    $('#id-prvcurr2').val(result.curr2); 
                    $('#id-prvcurr3').val(result.curr3); 
                    $('#id-prvcurr4').val(result.curr4);
                    $('#id-prvamt1').val(result.amount1); 
                    $('#id-prvamt2').val(result.amount2); 
                    $('#id-prvamt3').val(result.amount3); 
                    $('#id-prvamt4').val(result.amount4); 
                    $('#id-prvtimestamp').val(result.timestamp); 
                    $('#id-prvlkrtotal').val($scope.numberWithCommas(Number(result.totaltocustomer).toFixed(2))); 
                    

                    $scope.rpara = true;
                    $scope.$apply();

                   // alert($scope.receiptPara);
                } else {
                   // window.alert(result.isValidRef);
                    $scope.rpara = false;
                    //$scope.$apply();
                 $scope.show_error("receiptNumber", $scope.message_not_fount);
                }       
            })
            .catch(function(error) {
                throw error;
            }); 
        }

    });


//------------------ Validate All txn transaction impl ---------------
    $scope.validate_message_admin_view = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_txn(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }

//------------------ Validate FCP transaction impl ---------------
    $scope.validate_message_FCP = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_FCP(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }
//------------------ Validate FCP transaction ---------------
    $scope.set_validation_txn = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-fromdate").text(er['fromdate']);
                $("#er-todate").text(er['todate']);
                $("#er-txntype").text(er['txntype']);
                $("#er-txnstatus").text(er['txnstatus']);
                
             if (r.success) { 

                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-view").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-view").show();
                $("#ap-backbtn-view").show();
                //inputs
                $("#id-fromdate, #id-todate").prop("readonly", true);
                //buttons
               // $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-txntype, #id-txnstatus").prop("disabled", true).selectpicker("refresh");
                $("#requestform").clone(true).appendTo('.ap-tab-content-2');
                $scope.validator  = true;
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

//------------------ Validate FCP transaction ---------------
    $scope.set_validation_FCP = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-title").text(er['title']);
                $("#er-uintype").text(er['uintype']);
                $("#er-uinnumber").text(er['uinnumber']);
                $("#er-fname").text(er['fname']);
                $("#er-custaddr1").text(er['custaddr1']);
                $("#er-passportno").text(er['passportno']);
                $("#er-itrscode").text(er['itrscode']);
                $("#er-accounttypecode").text(er['accounttypecode']);
                $("#er-sectorcode").text(er['sectorcode']);
                $("#er-majorcountry").text(er['majorcountry']);
                $("#er-icurrencyselector1").text(er['icurrencyselector1']);
                $("#er-tamount1").text(er['tamount1']);
                $("#er-tamount2").text(er['tamount2']);
                $("#er-tamount3").text(er['tamount3']);
                $("#er-tamount4").text(er['tamount4']);
                $("#er-rate1").text(er['rate1']);
                $("#er-rate2").text(er['rate2']);
                $("#er-rate3").text(er['rate3']);
                $("#er-rate4").text(er['rate4']);
                $("#er-comgltotal").text(er['comgltotal']);
                $("#er-incgltotal").text(er['incgltotal']);


             if (r.success) { 

                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-purchase").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-purchase").show();
                $("#ap-backbtn-purchase").show();
                //inputs
                $("#id-remarks, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname, #id-custaddr1, #id-custaddr2, #id-custaddr3, #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-lkrtotal, #id-benename").prop("readonly", true);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", true).selectpicker("refresh");
                $("#requestform").clone(true).appendTo('.ap-tab-content-2');
                $scope.validator  = true;
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

//------------------ Validate FCP transaction impl ---------------
    $scope.validate_message_FCS = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_FCS(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }


//------------------ Validate FCR transaction impl ---------------
    $scope.validate_message_FCR = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_FCR(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }

//------------------ Validate FCI transaction impl ---------------
    $scope.validate_message_FCI = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_FCI(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }    

//------------------ Validate FCI transaction impl ---------------
    $scope.validate_message_PFC = function (u) {
        $(".ap-btnloading-nxt").show();   
        var dtaObj = { formArray: $("#requestform").serialize(), return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: dtaObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {              
            var r = response.data;    
            if ($scope.isset(r)) {
                $(".ap-btnloading-nxt").hide(); 
                $scope.set_validation_PFC(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }

//------------------ Validate FCS transaction ---------------
    $scope.set_validation_FCS = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-title").text(er['title']);
                $("#er-uintype").text(er['uintype']);
                $("#er-uinnumber").text(er['uinnumber']);
                $("#er-fname").text(er['fname']);
                $("#er-custaddr1").text(er['custaddr1']);
                $("#er-passportno").text(er['passportno']);
                $("#er-itrscode").text(er['itrscode']);
                $("#er-accounttypecode").text(er['accounttypecode']);
                $("#er-sectorcode").text(er['sectorcode']);
                $("#er-majorcountry").text(er['majorcountry']);
                $("#er-icurrencyselector1").text(er['icurrencyselector1']);
                $("#er-tamount1").text(er['tamount1']);
                $("#er-tamount2").text(er['tamount2']);
                $("#er-tamount3").text(er['tamount3']);
                $("#er-tamount4").text(er['tamount4']);
                $("#er-rate1").text(er['rate1']);
                $("#er-rate2").text(er['rate2']);
                $("#er-rate3").text(er['rate3']);
                $("#er-rate4").text(er['rate4']);
                $("#er-comgltotal").text(er['comgltotal']);
                $("#er-incgltotal").text(er['incgltotal']);
                $("#er-refundAmount").text(er['refundAmount']);


             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-sales").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-sales").show();
                $("#ap-backbtn-sales").show();
                //inputs
                $("#id-remarks, #id-receivedAmount, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname, #id-custaddr1, #id-custaddr2, #id-custaddr3, #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-lkrtotal, #id-benename").prop("readonly", true);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", true).selectpicker("refresh");
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
//------------------ Validate FCS transaction ---------------
    $scope.set_validation_FCR = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-title").text(er['title']);
                $("#er-uintype").text(er['uintype']);
                $("#er-uinnumber").text(er['uinnumber']);
                $("#er-receiptNumber").text(er['receiptNumber']);
                $("#er-fname").text(er['fname']);
                $("#er-custaddr1").text(er['custaddr1']);
                $("#er-passportno").text(er['passportno']);
                $("#er-itrscode").text(er['itrscode']);
                $("#er-accounttypecode").text(er['accounttypecode']);
                $("#er-sectorcode").text(er['sectorcode']);
                $("#er-majorcountry").text(er['majorcountry']);
                $("#er-icurrencyselector1").text(er['icurrencyselector1']);
                $("#er-tamount1").text(er['tamount1']);
                $("#er-tamount2").text(er['tamount2']);
                $("#er-tamount3").text(er['tamount3']);
                $("#er-tamount4").text(er['tamount4']);
                $("#er-rate1").text(er['rate1']);
                $("#er-rate2").text(er['rate2']);
                $("#er-rate3").text(er['rate3']);
                $("#er-rate4").text(er['rate4']);
                $("#er-comgltotal").text(er['comgltotal']);
                $("#er-incgltotal").text(er['incgltotal']);
                $("#er-lkrtotal").text(er['lkrtotal']);
                $("#er-refundAmount").text(er['refundAmount']);


             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-exchange").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-exchange").show();
                $("#ap-backbtn-exchange").show();
                //inputs
                $("#id-remarks, #id-receiptNumber, #id-receivedAmount, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname, #id-custaddr1, #id-custaddr2, #id-custaddr3, #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-lkrtotal, #id-benename").prop("readonly", true);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", true).selectpicker("refresh");
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
//------------------ Validate FCS transaction ---------------
    $scope.set_validation_FCI = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-title").text(er['title']);
                $("#er-uintype").text(er['uintype']);
                $("#er-uinnumber").text(er['uinnumber']);
                $("#er-accountnumber").text(er['accountnumber']);
                $("#er-fname").text(er['fname']);
                $("#er-custaddr1").text(er['custaddr1']);
                $("#er-passportno").text(er['passportno']);
                $("#er-itrscode").text(er['itrscode']);
                $("#er-accounttypecode").text(er['accounttypecode']);
                $("#er-sectorcode").text(er['sectorcode']);
                $("#er-majorcountry").text(er['majorcountry']);
                $("#er-icurrencyselector1").text(er['icurrencyselector1']);
                $("#er-icurrency").text(er['icurrency']);
                $("#er-tamount1").text(er['tamount1']);
                $("#er-tamount2").text(er['tamount2']);
                $("#er-tamount3").text(er['tamount3']);
                $("#er-tamount4").text(er['tamount4']);
                $("#er-rate1").text(er['rate1']);
                $("#er-rate2").text(er['rate2']);
                $("#er-rate3").text(er['rate3']);
                $("#er-rate4").text(er['rate4']);
                $("#er-comgltotal").text(er['comgltotal']);
                $("#er-incgltotal").text(er['incgltotal']);


             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-issue").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-issue").show();
                $("#ap-backbtn-issue").show();
                //inputs
                $("#id-remarks, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname, #id-custaddr1, #id-custaddr2, #id-custaddr3, #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-lkrtotal, #id-benename").prop("readonly", true);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", true).selectpicker("refresh");
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

//------------------ Validate FCS transaction ---------------
    $scope.set_validation_PFC = function (r) {

        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-title").text(er['title']);
                $("#er-uintype").text(er['uintype']);
                $("#er-uinnumber").text(er['uinnumber']);
                $("#er-accountnumber").text(er['accountnumber']);
                $("#er-fname").text(er['fname']);
                $("#er-custaddr1").text(er['custaddr1']);
                // $("#er-passportno").text(er['passportno']);
                $("#er-itrscode").text(er['itrscode']);
                $("#er-accounttypecode").text(er['accounttypecode']);
                $("#er-sectorcode").text(er['sectorcode']);
                $("#er-majorcountry").text(er['majorcountry']);
                $("#er-icurrencyselector1").text(er['icurrencyselector1']);
                $("#er-tamount1").text(er['tamount1']);
                // $("#er-tamount2").text(er['tamount2']);
                $("#er-tamount3").text(er['tamount3']);
                $("#er-tamount4").text(er['tamount4']);
                $("#er-rate1").text(er['rate1']);
                $("#er-rate2").text(er['rate2']);
                $("#er-rate3").text(er['rate3']);
                $("#er-rate4").text(er['rate4']);
                $("#er-comgltotal").text(er['comgltotal']);
                $("#er-incgltotal").text(er['incgltotal']);
                $("#er-icurrency").text(er['icurrency']);


             if (r.success) {
                
         
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn-withdraw").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-withdraw").show();
                $("#ap-backbtn-withdraw").show();
                //inputs
                $("#id-remarks, #id-accountnumber, #id-brefnumber, #id-scan, #id-uinnumber, #id-fname, #id-custaddr1, #id-custaddr2, #id-custaddr3, #id-nic, #id-passport, #id-airticket, #id-rate1, #id-rate2, #id-rate3, #id-rate4, #id-tamount1, #id-tamount2, #id-tamount3, #id-tamount4, #id-camount1, #id-camount2, #id-camount3, #id-camount4, #id-lkrtotal, #id-benename").prop("readonly", true);
                //buttons
                $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                $(".bootstrap-select button").addClass("disabled");
                //selects
                $("#id-uintype, #id-itrscode").prop("disabled", true).selectpicker("refresh");
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
//------------------ Save transaction impl---------------
$scope.save_message_purchase = function (u) {
       $scope.savepending =true;
       $("#ap-savbtn-purchase").hide();

       
       // $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {  
       // window.alert('jdf');  
            $(".ap-btnloading-sav").hide();
            var r = response.data;
                if ($scope.isset(r)) {
        $('#ap-msgmdlcon').empty();
        $('#ap-msgmdlcon').html(r.message_skelton);

        $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
        $('#ap-msgmdl').modal('show');
        $scope.savesuccess =true;
        $scope.savepending =false;
        } else {

        $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        $('#ap-toutmodal').modal('show');
        } 

        })
        .catch(function(error) { 
            throw error;
        });
}


//------------------ Save transaction impl---------------
$scope.save_message_sales = function (u) {
    $scope.savepending =true;
    $("#ap-savbtn-sales").hide();
        // $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {  
       // window.alert('jdf');  
            $(".ap-btnloading-sav").hide();
            var r = response.data;
                if ($scope.isset(r)) {
        $('#ap-msgmdlcon').empty();
        $('#ap-msgmdlcon').html(r.message_skelton);

        $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
        $('#ap-msgmdl').modal('show');
        $scope.savesuccess =true;
        $scope.savepending =false;
        } else {
        $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        $('#ap-toutmodal').modal('show');
        } 

        })
        .catch(function(error) { 
            throw error;
        });
}

//------------------ Save transaction impl---------------
$scope.save_message_exchange = function (u) {
    $scope.savepending =true;
    $("#ap-savbtn-exchange").hide();
        // $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {  
       // window.alert('jdf');  
            $(".ap-btnloading-sav").hide();
            var r = response.data;
                if ($scope.isset(r)) {
        $('#ap-msgmdlcon').empty();
        $('#ap-msgmdlcon').html(r.message_skelton);

        $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
        $('#ap-msgmdl').modal('show');
        $scope.savesuccess =true;
        $scope.savepending =false;
        } else {
        $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        $('#ap-toutmodal').modal('show');
        } 

        })
        .catch(function(error) { 
            throw error;
        });
}

//------------------ Save transaction impl---------------
$scope.save_message_issue = function (u) {
    $scope.savepending =true;
    $("#ap-savbtn-issue").hide();
        // $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {  
       // window.alert('jdf');  
            $(".ap-btnloading-sav").hide();
            var r = response.data;
                if ($scope.isset(r)) {
        $('#ap-msgmdlcon').empty();
        $('#ap-msgmdlcon').html(r.message_skelton);

        $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
        $('#ap-msgmdl').modal('show');
        $scope.savesuccess =true;
        $scope.savepending =false;
        } else {
        $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        $('#ap-toutmodal').modal('show');
        } 

        })
        .catch(function(error) { 
            throw error;
        });
}


//------------------ Save transaction impl---------------
$scope.save_message_withdraw= function (u) {
    $scope.savepending =true;
    $("#ap-savbtn-withdraw").hide();
        // $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {  
       // window.alert('jdf');  
            $(".ap-btnloading-sav").hide();
            var r = response.data;
                if ($scope.isset(r)) {
        $('#ap-msgmdlcon').empty();
        $('#ap-msgmdlcon').html(r.message_skelton);

        $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
        $('#ap-msgmdl').modal('show');
        $scope.savesuccess =true;
        $scope.savepending =false;
        } else {
        $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
        $('#ap-toutmodal').modal('show');
        } 

        })
        .catch(function(error) { 
            throw error;
        });
}





    });
});









































