app.controller('UsrController', function ($scope, $http, $window, $timeout, $controller) {

$controller('BaseController', { $scope: $scope });

// Messages-------------------------------------------------------------------
    $scope.message_required          = "Required";
    $scope.get_pf_number    = function () { return $('#iduserpfnumberhidden').val(); }

//------------------ Currency format value assignment----------------------------
        $('#id-userpfnumber').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {    
            var iPFNumber = $('#id-userpfnumber').val();
             $scope.hide_error("userpfnumber");   
            $('#iduserpfnumberhidden').val(iPFNumber);
            var formObj = {   
                pfNumber: iPFNumber
            };

            $http({
                method: 'POST',
                url: $scope.get_baseurl()+'user/data/getBranchUserDetails',
                data: formObj,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {              
                var result = response.data;
                
                if (!result.errorStatus) {
                    $('#id-username').val(result.data.username); 
                    $('#id-branch').val(result.data.branchcode);
                    $('#id-branchname').val(result.data.branchname);  
                }
                                
            })
            .catch(function(error) {
                throw error;
            }); 
        });
       
//------------------ Transaction Sector code value assignment
        $('#id-userlevel').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {  
          
            $scope.hide_error("userlevel");   
            var userLevel = $('#id-userlevel').val();
            $('#idhiddenuserLevel').val(userLevel);  



            if (userLevel=="3") {
                $('#id-till').val('1'); 
                $('#idhiddenuserTill').val('1');
                $('#id-till').prop("disabled", true).selectpicker("refresh");
                $("#id-effectiveDate").prop("readonly", false);
            } else if (userLevel=="1" || userLevel=="2") { 
                $('#id-till').prop("disabled", false).selectpicker("refresh");
  


                
            } else {
                $("#id-effectiveDate").prop("readonly", false);
            }                        
        });
//------------------ Transaction Sector code value assignment
        $('#id-till').on('changed.bs.select', function(e, clickedIndex, newValue, oldValue) {  
            $scope.hide_error("till");   
            var userTill = $('#id-till').val();
            $('#idhiddenuserTill').val(userTill);                           
        });

 //------------------ Validate user creation ---------------
    $("#ap-nxtbtn").on( "click", function() {

        $scope.validate_message('user/create/validate');
    });

    //------------------ Validate user assignment ---------------
    $("#ap-nxtbtnassign").on( "click", function() {

        $scope.validate_assign_message('user/assign/validate');
    });   

     //------------------ Validate user assignment ---------------
    $("#ap-delnxtbtn").on( "click", function() {

        $scope.validate_delete_message('user/delete/validate');
    });

 //------------------ Save transaction ---------------
    $("#ap-savbtn").on( "click", function() {
        $scope.save_message('user/create/save');
    });  

    //------------------ Save transaction ---------------
    $("#ap-savbtnassign").on( "click", function() {
        $scope.save_assign_message('user/assign/save');

    });   
 //------------------ Save transaction ---------------
    $("#ap-delsavbtn").on( "click", function() {
        $scope.save_delete_message('user/delete/save');

    });

     //------------------ Save transaction ---------------
    $("#ap-assigndelsavbtn").on( "click", function() {
       
        $scope.save_delete_message('user/deleteAssign/save');

    }); 

    // $(document).on("click", "#ap-delete-user" , function() {
    //   // window.alert('kd');
    //     $scope.delete_user();
    // });

    //-------------------------------------------------------------    
    $(document).on("click", "#ap-modal-btn-delete" , function() {
        $scope.trigger_confbtn_action('delete-user');
    }); 

        //-------------------------------------------------------------    
    $(document).on("click", "#ap-resetpassbtn" , function() {

        $scope.trigger_savebtn_action('reset-user');
    }); 

    $(document).on("click", "#ap-changepassbtn" , function() {

        $scope.trigger_savebtn_action('change-password');
    }); 

    $(document).on("click", "#ap-modal-btn-reset" , function() {
        $scope.trigger_confbtn_action('reset-user');
    });

    $(document).on("click", "#ap-modal-btn-changepw" , function() {
        $scope.trigger_confbtn_action('change-password');
    });

    $(document).on("click", "#ap-modal-btn-reset-cancel" , function() {
        location.reload();
    });

    $(document).on("click", "#ap-modal-btn-changepw-cancel" , function() {
        location.reload();
    });

    

    

    $(document).on("click", "#ap-modal-btn-reset-redirect" , function() {
        location.reload();
    });



//------------------ Save button action---------------
    $scope.trigger_savebtn_action = function (btn_action) {
        
        if (btn_action=="reset-user") {
            var username = $('#id-username').val();

            if (username!="") {
                $scope.reset_user();
            } else {
               alert("Please select user..."); 
            }

        } else if (btn_action=="change-password") {
            var passwordnew = $('#id-passwordnew').val();
            var passwordconf = $('#id-passwordconf').val();
            
            if (passwordnew=="") {
                alert("Please Enter New Password..."); 
            } else if (passwordconf=="") {
                alert("Please Enter Confirm Password..."); 
            } else if(passwordnew!=passwordconf) {
                alert("New Password and Confirm Password must be same..."); 
            } else {
                $scope.change_password();
            }

        } else {
            alert("Invalid Option...");
        }
    }



//------------------ Save Vault transfer_message impl---------------
 $scope.reset_user = function () {
    $("#ap-modal-container").empty();

    $("#ap-modal-container").append($scope.get_modal());
    $("#ap-modal-content").append($scope.get_modal_header('confirm'));
    $("#ap-modal-content").append($scope.get_modal_body('confirm'));
    $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

    // append buttons
    $("#ap-modal-footer").append('<a id="ap-modal-btn-reset-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
    $("#ap-modal-footer").append('<a id="ap-modal-btn-reset" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

    $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
    $('#ap-message-modal').modal('show');
}     

$scope.change_password = function () {
        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('confirm'));
        $("#ap-modal-content").append($scope.get_modal_body('confirm'));
        $("#ap-modal-content").append($scope.get_modal_footer('confirm'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-changepw-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-changepw" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');
    }

//-----------------------------------------------------------
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
        } else if (type=="delete") {
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

    $scope.get_modal_body = function (type,userpf) {
        if (type=="success") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        } else if (type=="error") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only"></div>';               
        }else if (type=="delete") {
        return '<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">'+
        '<div id="reasontxt-wrapper" style="margin-bottom:8px;">'+
        '<label id="ap-lbl-reasontxt" class="ap-lbl-inp-txt" for="input-name">Please state the reason for deleting user '+userpf +'data: <span class="app-req-star">*</span></label>'+
        '<textarea id="id-reasontxt" class="form-control ap-inp-field" name="reasontxt" cols="30" rows="8" placeholder="Type your reason here..." tabindex="1"></textarea>'+
        '<span id="er-reasontxt" class="ap-lbl-inp-err" for="error-msg"></span>'+
        '</div>'+
        '<p id="ap-modal-message">Are you sure you want to delete user data?</p>'+
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
        }else if (type=="delete") {
        return '<div id="ap-modal-footer" class="app-modal-footer"></div>';               
        } else if (type=="confirm") {
         return '<div id="ap-modal-footer" class="app-modal-footer"></div>'; 
        } 
        else {
        return '';
        } 
    }   

//---------------------------------------------------------
    $scope.delete_user = function (userpf) {

        $("#ap-modal-container").empty();

        $("#ap-modal-container").append($scope.get_modal());
        $("#ap-modal-content").append($scope.get_modal_header('delete'));
        $("#ap-modal-content").append($scope.get_modal_body('delete',userpf));
        $("#ap-modal-content").append($scope.get_modal_footer('delete'));

        // append buttons
        $("#ap-modal-footer").append('<a id="ap-modal-btn-cancel" class="ap-btn ap-btn-modal" data-dismiss="modal" ng-click=""><span>CANCEL</span>&nbsp;&nbsp;</a>');
        $("#ap-modal-footer").append('<a id="ap-modal-btn-delete" class="ap-btn ap-btn-modal"><span id="ap-btn-loading-conf" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;<span>CONFIRM</span>&nbsp;&nbsp;</a>');

        $('#ap-message-modal').modal({backdrop: 'static', keyboard: false})  
        $('#ap-message-modal').modal('show');

    }
//---------------------------------------------------------
$scope.trigger_confbtn_action = function (btn_action) {

        if (btn_action=="delete-user") {

            var reason = $("textarea[name=reasontxt]").val();
          //  var userpf = $("textarea[name=reasontxt]").val();
            var userpf = $("iduserpfnumberhidden").val();

            if ($scope.isset(reason)) {
                $scope.delete_user_message('user/delete_user'); 
            } else {
               // window.alert('dfsd');
                $scope.show_error("reasontxt", $scope.message_required);
            }
        } else if (btn_action=="reset-user") {
            $scope.reset_user_confirm($scope.get_pf_number());
        } else if (btn_action=="change-password") {
            $scope.change_password_confirm();
        } else {
            return;
        }
    } 

$scope.reset_user_confirm = function (pfnumber) {

    var formObj = {
        pfnumber: pfnumber
        
    }

    $("#ap-btn-loading-conf").show();
    
    $http({
        method: 'POST',
        url: $scope.get_baseurl()+'user/reset_user_request',
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

            $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">User password has been reset successfully.</p>');
            $("#ap-modal-content").append($scope.get_modal_footer('success'));
            $("#ap-modal-footer").append('<a id="ap-modal-btn-reset-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            
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

$scope.change_password_confirm = function () {

    var passwordnew = $('#id-passwordnew').val();


    var formObj = {
        passwordnew: passwordnew
    }

    $("#ap-btn-loading-conf").show();
    
    $http({
        method: 'POST',
        url: $scope.get_baseurl()+'user/change_password_request',
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

            $("#ap-modal-body").append('<p id="ap-modal-message" class="ap-modal-message">User password has been change successfully.</p>');
            $("#ap-modal-content").append($scope.get_modal_footer('success'));
            $("#ap-modal-footer").append('<a id="ap-modal-btn-reset-redirect" class="ap-btn ap-btn-ok" data-dismiss="modal"><span>OK</span>&nbsp;&nbsp;</a>');
            
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
//-----------------------------------------------------------------
$scope.delete_user_message = function (u) {
        
        $(".ap-btnloading-sav").show();
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
//------------------ Validate user creation ---------------
    $scope.validate_message = function (u) {
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
                $scope.set_validation(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }

    //------------------ Validate user assignment ---------------
    $scope.validate_assign_message = function (u) {
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
               
                $scope.set_assign_validation(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }
  //------------------ Validate user deletion ---------------
    $scope.validate_delete_message = function (u) {
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
               
                $scope.set_delete_validation(r);  
            } else {
                $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
                $('#ap-toutmodal').modal('show');
            } 
        })
        .catch(function(error) {
            throw error;
        });
    }


    //------------------ Set validation for user creation ---------------
    $scope.set_validation = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-userpfnumber").text(er['userpfnumber']);
                $("#er-userpassword").text(er['userpassword']);
                
                $("#er-username").text(er['username']);
                $("#er-branch").text(er['branch']);
                
             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtn").hide();
                $("#ap-refreshbtn").hide();
                $("#ap-savbtn").show();
                //inputs
                // $("#id-username").prop("readonly", true);
                //buttons
                // $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                // $(".bootstrap-select button").addClass("disabled");
                // //selects
                //$("#id-userpfnumber").prop("disabled", true).selectpicker("refresh");
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

     //------------------ Set validation for user assignment ---------------
    $scope.set_assign_validation = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-userpfnumber").text(er['userpfnumber']);
                $("#er-username").text(er['username']);
                 $("#er-userlevel").text(er['userlevel']);
                $("#er-till").text(er['till']);

             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-nxtbtnassign").hide();
                $("#ap-refreshbtn").hide();
                $("#ap-savbtnassign").show();
                //inputs
                $("#id-username, #id-effectiveDate").prop("readonly", true);
                //buttons
                // $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                // $(".bootstrap-select button").addClass("disabled");
                // //selects
                $("#id-userpfnumber, #id-userlevel, #id-till").prop("disabled", true).selectpicker("refresh");
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
    //------------------ Set validation for user deletion ---------------
    $scope.set_delete_validation = function (r) {
        if (!r.unexpected) {
            var er = r.field_errors;
                $("#er-userpfnumber").text(er['userpfnumber']);
                $("#er-username").text(er['username']);
             

             if (r.success) {   
                $("#ap-bckbtn").hide();
                $("#ap-prvbtn").show();
                $("#ap-delnxtbtn").hide();
                $("#ap-refreshbtn").hide();
                $("#ap-delsavbtn").show();
                //inputs
                $("#id-username").prop("readonly", true);
                //buttons
                // $(".ap-btn-verify-bref, .ap-btn-uin-search, .ap-btn-cal-amount").addClass('ap-btn-disabled');          
                // $(".bootstrap-select button").addClass("disabled");
                // //selects
                $("#id-userpfnumber").prop("disabled", true).selectpicker("refresh");
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

  

   //------------------ Save user---------------
   $scope.save_message = function (u) {
        $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
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
//------------------ Save assigned user---------------
   $scope.save_assign_message = function (u) {
        $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
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
//------------------ Save assigned user---------------
   $scope.save_delete_message = function (u) {
        $(".ap-btnloading-sav").show();
        var json_array = { formArray: $("#requestform").serialize(), action: "create", return_json: true };
        $http({
            method: 'POST',
            url: $scope.get_baseurl()+u,
            data: json_array,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {    
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

   
});









































