app.controller('AdminController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });


 
// Scope Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.message_invalid           = "Invalid";


 
// Scope Functions-------------------------------------------------------------------

   
    $scope.admin_changetariff_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-admin-changetariff" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }

      $scope.admin_changegl_message = function () {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        // $("#ap-modal-footer").append('<a id="ap-modal-btn-test" class="ap-btn ap-btn-modal" d ><span>TEST</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-admin-changegl" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

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
        } else {
        return '';
        } 
    }

     $scope.trigger_confbtn_action = function (btn_action) {
        if (btn_action=="admin-changetariff") {
            $scope.save_admin_tariff_details_message('admin/tariff/save');
        } 
        else if (btn_action=="admin-changegl") {
            $scope.save_admin_gl_details_message('admin/gl/save');
        }
        else {
            return;
        }
    } 

    
    //------------------ save_admin_tariff_details_message---------------
    $scope.save_admin_tariff_details_message = function (u) {

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

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Saved Tariff Details Successfully.</p>');
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
     //------------------ save_admin_gl_details_message---------------
    $scope.save_admin_gl_details_message = function (u) {

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

                $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">Saved Gl Details Successfully.</p>');
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





//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-admin-changetariff" , function() {
    $("#ap-btn-loading-conf").show();
   // $("#ap-btn-back").hide(); 
    $scope.trigger_confbtn_action('admin-changetariff');  
});
//-------------------------------------------------------------    
$(document).on("click", "#ap-modal-btn-admin-changegl" , function() {
    $("#ap-btn-loading-conf").show();
   // $("#ap-btn-back").hide(); 
    $scope.trigger_confbtn_action('admin-changegl');  
});

//------------------ Transfer cash in to POS ---------------
    $("#ap-admin-changetariff").on( "click", function() {
         $scope.admin_changetariff_message();    
    });
//------------------ Transfer cash in to POS ---------------
    $("#ap-admin-changegl").on( "click", function() {
     
         $scope.admin_changegl_message();    
    });




   


});










































