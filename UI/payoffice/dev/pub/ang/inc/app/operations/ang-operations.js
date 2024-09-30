app.controller('OperationsController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });

// Scope Variables-------------------------------------------------------------------
$scope.dayendpending = false; 
$scope.priorcheckpending = false; 

$scope.day_begin = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-day-start" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }
$scope.day_end = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm-dayend'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-day-end" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span> CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }    
$scope.pre_check = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-pre-check" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }

$scope.reports = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-reports" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }    

$scope.generate_report      =function(){

         $("#ap-btn-loading-conf").show();
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'opr/report/generate',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {

                $("#id-response-section").removeAttr('hidden');
                $("#ap-btn-generate-report").hide();
                $("#id-report-status").text('Generated');
                $("#id-report-status").addClass('ap-st-label ap-st-lb-completed');

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Day End reports generated successfully.</p> <p id="ap-modal-desc" class="ap-modal-desc">Please check the spool</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');


               
            })
            .catch(function(error) {
                throw error;
            });
}



$scope.start_pre_check      =function(){
    $scope.priorcheckpending = true;
         
         $("#ap-btn-loading-conf").show();
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'opr/start_precheck',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {
                var result = response.data;
                
                if (result.errorStatus) {
                    $("#id-response-section").removeAttr('hidden');
                    $("#ap-btn-pre-check").hide();
                    $("#id-precheck-status").text(result.errorMessage);
                    $("#id-precheck-status").addClass('ap-st-label ap-st-lb-review');
                    $("#ap-modal-content").empty();
                    $("#ap-modal-content").append($scope.get_modal_header('error'));
                    $("#ap-modal-content").append($scope.get_modal_body('error'));

                    $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Pre-Check process failed.</p> <p id="ap-modal-desc" class="ap-modal-desc">Please check the status in daily processes</p>');
                    $("#ap-modal-content").append($scope.get_modal_footer('error'));
                 
                    $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');

                  
                    
               } else {
                    $("#id-response-section").removeAttr('hidden');
                    $("#ap-btn-pre-check").hide();
                    $("#id-precheck-status").text(result.errorMessage);
                    $("#id-precheck-status").addClass('ap-st-label ap-st-lb-completed');
                    $("#ap-modal-content").empty();
                    $("#ap-modal-content").append($scope.get_modal_header('success'));
                    $("#ap-modal-content").append($scope.get_modal_body('success'));

                    $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Pre-Check process initiated successfully.</p> <p id="ap-modal-desc" class="ap-modal-desc">Please check the status in historical process view</p>');
                    $("#ap-modal-content").append($scope.get_modal_footer('success'));
                 
                    $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');

               }
                    
                    $scope.priorcheckpending = false;

                      
            })
            .catch(function(error) {
                throw error;
            });
}

$scope.start_day_begin      =function(){
        $("#ap-btn-loading-conf").show();
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'opr/start_daybegin',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {
            //  window.alert('ll');
                $("#id-response-section").removeAttr('hidden');
                $("#ap-btn-day-begin").hide();
                $("#id-precheck-status").text('Started');
                $("#id-precheck-status").addClass('ap-st-label ap-st-lb-review');

                $("#ap-modal-content").empty();
                $("#ap-modal-content").append($scope.get_modal_header('success'));
                $("#ap-modal-content").append($scope.get_modal_body('success'));

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Day-Start process initiated successfully.<p id="ap-modal-desc" class="ap-modal-desc">Please check the status in historical process view</p>');
                $("#ap-modal-content").append($scope.get_modal_footer('success'));
             
                $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');
            

            //    $scope.priorcheckpending = false; 
               
            })
            .catch(function(error) {
                throw error;
            });
} 

$scope.start_day_end      =function(){
    $scope.dayendpending =true;
        $("#ap-btn-loading-conf").show();
            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'opr/start_dayend',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {
            var result = response.data;
                
                if (result.errorStatus) {
                    $("#id-response-section").removeAttr('hidden');
                    $("#ap-btn-day-end").hide();
                    $("#id-precheck-status").text(result.errorMessage);
                    $("#id-precheck-status").addClass('ap-st-label ap-st-lb-review');
                    $("#ap-modal-content").empty();
                    $("#ap-modal-content").append($scope.get_modal_header('error'));
                    $("#ap-modal-content").append($scope.get_modal_body('error'));

                    $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Day-End process failed.</p> <p id="ap-modal-desc" class="ap-modal-desc">Please check the status in daily processes</p>');
                    $("#ap-modal-content").append($scope.get_modal_footer('error'));
                 
                    $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');

                  
                    
               } else {
                    $("#id-response-section").removeAttr('hidden');
                    $("#ap-btn-day-end").hide();
                    $("#id-precheck-status").text('Success');
                    $("#id-precheck-status").addClass('ap-st-label ap-st-lb-completed');
                    $("#ap-modal-content").empty();
                    $("#ap-modal-content").append($scope.get_modal_header('success'));
                    $("#ap-modal-content").append($scope.get_modal_body('success'));

                    $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Day-End process initiated successfully.</p> <p id="ap-modal-desc" class="ap-modal-desc">Please check the status in historical process view</p>');
                    $("#ap-modal-content").append($scope.get_modal_footer('success'));
                 
                    $("#ap-modal-footer").append('<a id="ap-modal-btn-del-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span></a>');

               }
                $scope.dayendpending =false;
                
            })
            .catch(function(error) {
                throw error;
            });
}

$(function() { 

        $(document).on("click", "#ap-modal-btn-reports" , function() {
           $scope.generate_report();
        });

        $(document).on("click", "#ap-btn-report2" , function() {
           $scope.generate_report2();
        });

         $(document).on("click", "#ap-modal-btn-pre-check" , function() {
            if(!$scope.priorcheckpending){
               $scope.start_pre_check(); 
           }
            
        });

        $(document).on("click", "#ap-modal-btn-day-start" , function() {
            $scope.start_day_begin();
        });

        $(document).on("click", "#ap-modal-btn-day-end" , function() {
            if (!$scope.dayendpending){
                $scope.start_day_end();
            }
            
        });

        $(document).on("click", "#ap-btn-refresh" , function() {
            $scope.refresh_pre_check();
        });

       //----------------------------------------------------------------------     
        $(document).on("click", "#ap-back-btn-pre-check" , function() {
        window.location.href = $scope.get_baseurl()+'dashboard';
        return false;
        });


        

});

// Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.message_not_fount         = "Not Found";

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
           // console.log('ll');
            $(".ap-btnloading-sav").hide();
            var r = response.data;
            if ($scope.isset(r)) {
              $('#ap-msgmdlcon').empty();
              $('#ap-msgmdlcon').html(r.message_skelton);

              $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
              $('#ap-msgmdl').modal('show');
            } else {
              $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
              $('#ap-toutmodal').modal('show');
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
          //   window.alert('df');
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
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to reject currency Rates?</p>'+
        '</div>';             
        } else if (type=="confirm-dayend") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<p id="ap-modal-message"> <mark>Are you sure you want to perform the DAY END process?</mark></p>'+
        '</div>';             
        } 
        else if (type=="confirm") {
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
        if (btn_action=="daybegin") {
           $scope.day_begin();
        }else if (btn_action=="precheck") {
           $scope.pre_check();
        }else if (btn_action=="dayend") {
           $scope.day_end();
        }else if (btn_action=="reports") {
           $scope.reports();
        }else {
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

// Functions---------------------------------------------------------------------------------------------------

$(document).on("click", "#ap-modal-btn-reject" , function() {
        $scope.trigger_confbtn_action('reject');
});

$(document).on("click", "#ap-modal-btn-auth" , function() {
        $scope.trigger_confbtn_action('auth');
});

$(document).on("click", "#ap-btn-day-begin" , function() {
        $scope.trigger_confbtn_action('daybegin');
});

$(document).on("click", "#ap-btn-day-end" , function() {
        $scope.trigger_confbtn_action('dayend');
});

$(document).on("click", "#ap-btn-pre-check" , function() {
        $scope.trigger_confbtn_action('precheck');
});

$(document).on("click", "#ap-btn-generate-report" , function() {
        $scope.trigger_confbtn_action('reports');
});


// Input variables---------------------------------------------------------------------------------------------------

     $('#id-c5000').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic5000    = $('#id-c5000').val();
         $('#id-a5000').val($scope.numberWithCommas(ic5000 * 5000));
        });

     $('#id-c1000').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic1000    = $('#id-c1000').val();
         $('#id-a1000').val($scope.numberWithCommas(ic1000 * 1000));
        });

     $('#id-c500').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic500    = $('#id-c500').val();
         $('#id-a500').val($scope.numberWithCommas(ic500 * 500));
        });

     $('#id-c100').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic100    = $('#id-c100').val();
         $('#id-a100').val($scope.numberWithCommas(ic100 * 100));
        });

     $('#id-c50').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic50    = $('#id-c50').val();
         $('#id-a50').val($scope.numberWithCommas(ic50 * 50));
        });

     $('#id-c20').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic20    = $('#id-c20').val();
         $('#id-a20').val($scope.numberWithCommas(ic20 * 20));
        });

     $('#id-c10').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic10    = $('#id-c10').val();
         $('#id-a10').val($scope.numberWithCommas(ic10 * 10));
        });

     $('#id-c5').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic5    = $('#id-c5').val();
         $('#id-a5').val($scope.numberWithCommas(ic5 * 5));
        });

      $('#id-c2').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic2    = $('#id-c2').val();
         $('#id-a2').val($scope.numberWithCommas(ic2 * 2));
        });

       $('#id-c1').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var ic1    = $('#id-c1').val();
         $('#id-a1').val($scope.numberWithCommas(ic1 * 1));
        });

        $('#id-cents1').on('change', function(e, clickedIndex, newValue, oldValue) { 
         var iccents1    = $('#id-cents1').val();
         $('#id-cents2').val(iccents1);
         });

// Output Variables--------------------------------------------------------------------------------------------------

        $('#id-c5000').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-c1000').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-c500').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c100').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c50').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c20').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c10').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c5').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c2').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
        
        $('#id-c1').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });

        $('#id-cents1').on('change', function(e, clickedIndex, newValue, oldValue) { 
             $('#id-totalamount').val($scope.calculate_total_rupee_amount());
        });
 
//------------------ Upload Daily Rates---------------
    $("#ap-upload-rates").on( "click", function() {
        $("#ap-upload-rates").hide();
        $("#ap-refreshbtn").hide();
        $("#ap-upload-confirm").show();
        //inputs
        $("input").prop("readonly", true);          
        $scope.validator = true;

        $('.nav-tabs > .nav-item').next('li').find('a').trigger('click', [1]);        
    });

//------------------ Upload Daily Rates Confirm---------------
    $("#ap-upload-confirm").on( "click", function() {
    
        $scope.upload_daily_rates_message('rates/save');
    }); 

 
//------------------ Upload Daily Rates---------------
    $("#ap-auth-rates").on( "click", function() {

        $scope.rates_auth();
         
    });

 //------------------ Upload Daily Rates---------------
    $("#ap-reject-rates").on( "click", function() {
         $scope.rates_reject();
            
    });   
   



    
});









































