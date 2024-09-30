app.controller('RatesController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });

// Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.message_not_fount         = "Not Found";
    $scope.message_usd_rate_required = "USD Middle rate is required";

// Get Functions----------------------------------------------------------------------------------------------------

   $scope.get_a5000_amount   = function () { return $('#id-a5000').val(); }
   $scope.get_a1000_amount   = function () { return $('#id-a1000').val(); }
   $scope.get_a500_amount    = function () { return $('#id-a500').val(); }
   $scope.get_a100_amount    = function () { return $('#id-a100').val(); }
   $scope.get_a50_amount     = function () { return $('#id-a50').val(); }
   $scope.get_a20_amount     = function () { return $('#id-a20').val(); }
   $scope.get_a10_amount     = function () { return $('#id-a10').val(); }
   $scope.get_a5_amount      = function () { return $('#id-a5').val(); }
   $scope.get_a2_amount      = function () { return $('#id-a2').val(); }
   $scope.get_a1_amount      = function () { return $('#id-a1').val(); }
   $scope.get_cents2_amount  = function () { return $('#id-cents2').val(); }

//--------------------------------------------------------------------
 

 
// Calculate Total Rupee amount in Balancing Panel-------------------------------------------------------------------
    $scope.calculate_total_rupee_amount = function () {
         
          var ia5000    = parseFloat($scope.get_a5000_amount().replace(/[,]/g, ''));
          var ia1000    = parseFloat($scope.get_a1000_amount().replace(/[,]/g, ''));
          var ia500     = parseFloat($scope.get_a500_amount().replace(/[,]/g, ''));
          var ia100     = parseFloat($scope.get_a100_amount().replace(/[,]/g, ''));
          var ia50      = parseFloat($scope.get_a50_amount().replace(/[,]/g, ''));
          var ia20      = parseFloat($scope.get_a20_amount().replace(/[,]/g, ''));
          var ia10      = parseFloat($scope.get_a10_amount().replace(/[,]/g, ''));
          var ia5       = parseFloat($scope.get_a5_amount().replace(/[,]/g, ''));
          var ia2       = parseFloat($scope.get_a2_amount().replace(/[,]/g, ''));
          var ia1       = parseFloat($scope.get_a1_amount().replace(/[,]/g, ''));
          var iacents   = parseFloat($scope.get_cents2_amount().replace(/[,]/g, ''));
        
                  
         var total_rupee_amount =  ia5000 + ia1000 + ia500 +ia100 + ia50 + ia20 + ia10 + ia5 + ia2 + ia1 + iacents ;        
                
         return $scope.numberWithCommas(Number(total_rupee_amount).toFixed(2));
    }



//------------------ Upload Daily Rates Response message---------------
$scope.upload_daily_rates_message = function (u) {
        
        $(".ap-btnloading-sav").show();
      
        var reason = $("textarea[name=reasontxt]").val();
        var iMiddleRate = 0;
        var params = $('tbody').find('input').serialize();
      
        var json_array = { 
            middlerate: iMiddleRate,
            reason: reason,
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

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Uploaded Currency Rates Successfully.</p>');
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

        })
        .catch(function(error) { 
            throw error;
        });
}

//------------------ Upload Daily Rates Response message---------------
$scope.authorize_daily_rates_message = function (u) {
        
        $(".ap-btnloading-sav").show();
      
        
        var params = $('tbody').find('input').serialize();

        console.log(params);
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

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Authorized Currency Rates Successfully.</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
                
                
            } else {

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('error'));
                $("#ap-modal-content").append($scope.get_modal_body('error'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">'+result.error_message+'</p>');
                
                $("#ap-modal-content").append($scope.get_modal_footer('error'));

                $("#ap-modal-footer").append('<a id="ap-modal-btn-ver-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
              //  wndow.alert('yhfy');
            }

        })
        .catch(function(error) { 
            throw error;
        });
}

//------------------ Upload Daily Rates Response message---------------
$scope.reject_daily_rates_message = function (u) {
        
        $(".ap-btnloading-sav").show();
      
        
       // var params = $('tbody').find('textarea').serialize();
        var reason = $("textarea[name=reasontxt]").val();
      
        var json_array = { textArray: reason, action: "create", return_json: true };
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

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Rejected Currency Rates Successfully.</p>');
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

        })
        .catch(function(error) { 
            throw error;
        });
}

//--Message Body-------------------------------------------------------------- 
    $scope.rates_save = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-upload'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-upload'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-upload'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-upload" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }
//--Message Body-------------------------------------------------------------- 
    $scope.rates_auth = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-auth" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }
    $scope.rates_reject = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm-reject'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-reject'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm-reject'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-reject" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

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
        } else if (type=="confirm-reject") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>'; 
    } else if (type=="confirm-upload") {
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';
        } else if (type=="confirm"){
        return '<div id="ap-modal-header" class="app-modal-header ap-modal-header-conf">'+
        '<span class="ap-modal-header-icon-conf"><i class="far fa-question-circle"></i></span>&nbsp;'+
        '<span>Confirmation Message</span>'+
        '</div>';    
        }
        else {
        return '';
        } 
    }

    $scope.get_modal_body = function (type) {
        if (type=="success") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        } else if (type=="error") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        }else if (type=="confirm-reject") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for rejecting currency rates: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" maxlength="50" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to reject currency Rates?</p>'+
        '</div>';             
        }else if (type=="confirm-upload") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Remarks for currency rates upload: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" maxlength="50" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to upload currency Rates?</p>'+
        '</div>'; 
        } else if (type=="confirm") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message">Are you sure you want to perform this action?</p>'+
        '</div>'; 
        }
         else {
            return '';
        }
    }

    $scope.get_modal_footer = function (type) {
        if (type=="success") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="error") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';                 
        }else if (type=="confirm-reject") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        }else if (type=="confirm-upload") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';
       } else if (type=="confirm") {
         return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        } 
        else {
        return '';
        } 
    }   

//--Button functions-------------------------------------------------------------- 

    $scope.trigger_savebtn_action = function (btn_action) {
        if (btn_action=="create") {
            var formObj = {
            formArray: $("#deal-create-form").serialize(),
            };

            $scope.save(formObj);
        }

        else if (btn_action=="modify") {
            var formObj = {
            formArray: $("#deal-create-form").serialize(),
            };

            $scope.modify(formObj);
        }

        else if (btn_action=="rates-reject") {

            $scope.rates_reject();
        }

        else {
            return;
        }
    }

    $scope.trigger_confbtn_action = function (btn_action) {
        if (btn_action=="reject") {
            var reason = $("textarea[name=reasontxt]").val();
            if ($scope.isset(reason)) {
                $scope.reject_daily_rates_message('rates/save_reject'); 
            } else {
                $scope.show_error("reasontxt", $scope.message_required);
            }
        } else if (btn_action=="upload") {
            $scope.upload_daily_rates_message('rates/save'); 
           
        } else if (btn_action=="auth") {

            $scope.authorize_daily_rates_message('rates/save_auth'); 
        }

        else {
            return;
        }
    } 

//-------------------------------------------------------------------------------------------
$scope.accountSearch = function () {
        $scope.hide_error("accountnumber");
       if ($('#id-accountnumber').val() =="") {
            $scope.show_error("accountnumber", $scope.message_required);
        } else {
            var iAccNumber  = $('#id-accountnumber').val();              
                     
            var formObj = {
                accnumber: iAccNumber
            }
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'rates/getAccountData',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data; 
                $("#ap-btn-loading-conf").hide();
                if (!result.error_status) { 
                    $('#id-customername').val(result.customerName);                            
                } else{

                    $scope.show_error("accountnumber", $scope.message_not_fount);
                    $scope.accpara = false;
                }
            })
            .catch(function(error) {
                throw error;
            });
        }     
    }       
//------------------ Validate CHQ deposit transaction impl ---------------
    $scope.validate_message_CHQ = function (u) {
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
                $scope.set_validation_CHQ(r);  
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
    $scope.set_validation_CHQ = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-accountnumber").text(er['accountnumber']);
                $("#er-customername").text(er['customername']);
                $("#er-bankcode").text(er['bankcode']);
                $("#er-branchcode").text(er['branchcode']);
                $("#er-effdate").text(er['effdate']);
                $("#er-amount").text(er['amount']);
                
             if (r.success) { 

              
                $("#ap-nxtbtn-cheque").hide();

                $("#ap-refreshbtn").hide();
                $("#ap-savbtn-cheque").show();
                $("#ap-backbtn-cheque").show();
                //inputs
                $("#id-accountnumber, #id-customername, #id-bankcode, #id-branchcode, #id-effdate, #id-amount").prop("readonly", true);
                //buttons         
            
                //selects
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
//------------------ Save transaction impl---------------
$scope.save_message_CHQ = function (u) {
       $scope.savepending =true;
       $("#ap-savbtn-cheque").hide();

       
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
//--------------------------------------------------------
$('#id-accountnumber').on("change", function () {
        $scope.hide_error("accountnumber");   
        $scope.accountSearch();   
}); 

//--------------------------------------------------------
$('#id-customername').on("change", function () {
        $scope.hide_error("customername");   
}); 

//--------------------------------------------------------
$('#id-bankcode').on("change", function () {
        $scope.hide_error("bankcode");   
}); 

//--------------------------------------------------------
$('#id-branchcode').on("change", function () {
        $scope.hide_error("branchcode");   
});

//--------------------------------------------------------
$('#id-effdate').on("change", function () {
        $scope.hide_error("effdate");   
}); 

//--------------------------------------------------------
$('#id-amount').on("change", function () {
        $scope.hide_error("amount");   
});  
//--------------------Redirect Actions----------------------
$(document).on("click", "#ap-modal-btn-del-redirect" , function() {
     window.location.href = $scope.get_baseurl()+'dashboard';
     return false;
});

//--------------------Redirect Actions----------------------
$(document).on("click", "ap-viewbtn-cheque" , function() {
     window.location.href = $scope.get_baseurl()+'dashboard';
     //return false;
});
// Functions---------------------------------------------------------------------------------------------------

$(document).on("click", "#ap-modal-btn-reject" , function() {
        $scope.trigger_confbtn_action('reject');
});

$(document).on("click", "#ap-modal-btn-upload" , function() {
        $scope.trigger_confbtn_action('upload');
});

$(document).on("click", "#ap-modal-btn-auth" , function() {
        $scope.trigger_confbtn_action('auth');
});

$(document).on("click", "#ap-nxtbtn-cheque" , function() {
        $scope.validate_message_CHQ('rates/validate_CHQ_deposit');
});

$(document).on("click", "#ap-savbtn-cheque" , function() {
        $scope.save_message_CHQ('rates/save_CHQ_deposit');
});

// Input variables---------------------------------------------------------------------------------------------------

     $('#id-a5000').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia5000    = $('#id-a5000').val();
         $('#id-c5000').val($scope.numberWithCommas(ia5000 / 5000));
        });

     $('#id-a1000').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia1000    = $('#id-a1000').val();
         $('#id-c1000').val($scope.numberWithCommas(ia1000 * 1000));
        });

     $('#id-a500').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia500    = $('#id-a500').val();
         $('#id-c500').val($scope.numberWithCommas(ia500 * 500));
        });

     $('#id-a100').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia100    = $('#id-a100').val();
         $('#id-c100').val($scope.numberWithCommas(ia100 * 100));
        });

     $('#id-a50').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia50    = $('#id-a50').val();
         $('#id-c50').val($scope.numberWithCommas(ia50 * 50));
        });

     $('#id-a20').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia20    = $('#id-a20').val();
         $('#id-c20').val($scope.numberWithCommas(ia20 * 20));
        });

     $('#id-a10').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia10    = $('#id-a10').val();
         $('#id-c10').val($scope.numberWithCommas(ia10 * 10));
        });

     $('#id-a5').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia5    = $('#id-a5').val();
         $('#id-a5').val($scope.numberWithCommas(ia5 * 5));
        });

      $('#id-a2').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia2    = $('#id-a2').val();
         $('#id-c2').val($scope.numberWithCommas(ia2 * 2));
        });

       $('#id-a1').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ia1    = $('#id-a1').val();
         $('#id-a1').val($scope.numberWithCommas(ia1 * 1));
        });

        $('#id-cents2').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var iccents2    = $('#id-cents2').val();
         $('#id-cents1').val(iccents2);
         });

// Output Variables--------------------------------------------------------------------------------------------------

        $('#id-a5000').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-a1000').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-a500').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a100').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a50').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a20').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a10').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a5').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a2').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-a1').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-cents2').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
 
//------------------ Upload Daily Rates---------------
    $("#ap-upload-rates").on( "click", function() {
       $scope.hide_error("middlerate");
       $scope.hide_error("errorbutton");
       var middlerate = $('#id-middlerate').val(); 
       // if (!$scope.isset(middlerate)) {
       //      $scope.show_error("middlerate", $scope.message_required);
       //      $scope.show_error("errorbutton", $scope.message_usd_rate_required);                

       //  } else {    
            $("#ap-upload-rates").hide();
            $("#ap-refreshbtn").hide();
            $("#ap-backbtn-uploadrates").show();
            $("#ap-upload-confirm").show();
            //inputs
            $("input").prop("readonly", true);          
            $scope.validator = true;

            $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);
        // }    



    });

//------------------ Back button Upload Daily Rates---------------
    $("#ap-backbtn-uploadrates").on( "click", function() {
                $("#ap-backbtn-uploadrates").hide();
                $("#ap-upload-confirm").hide();
                $("#ap-upload-rates").show();
                $("#ap-refreshbtn").hide();
                //inputs
                $("input").prop("readonly", false); 
                $scope.validator = false;

                // $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);
    }); 
//------------------ Back button Upload Daily Rates---------------
    $("#ap-backbtn-cheque").on( "click", function() {
                $("#ap-backbtn-cheque").hide();
                $("#ap-savbtn-cheque").hide();
                $("#ap-nxtbtn-cheque").show();
             //   $("#ap-refreshbtn").hide();
                //inputs
                $("input").prop("readonly", false); 
              //  $scope.validator = false;

                // $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);
    }); 
 

 
//------------------ Upload Daily Rates---------------
    $("#ap-auth-rates").on( "click", function() {

        $scope.rates_auth();
         
    });
//------------------ Upload Daily Rates---------------
    $("#ap-upload-confirm").on( "click", function() {

        $scope.rates_save();
         
    });
 //------------------ Upload Daily Rates---------------
    $("#ap-reject-rates").on( "click", function() {
         $scope.rates_reject();
            
    });  

   



    
});









































