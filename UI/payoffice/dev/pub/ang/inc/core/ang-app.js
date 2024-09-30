var app = angular.module('app', []);

app.controller('BaseController', function ($scope, $http, $window, $timeout) {

	$scope.get_baseurl = function () {
	return $("input[name=app-baseurl]").val();
	}

	$scope.isset = function (value) {
        if (typeof value !== 'undefined') {
            if (value !== '') { return true; }
            else { return false; }
        } else {
            return false;
        }
    } 
    $scope.show_error = function (er_id, msg) {
        $("#er-"+er_id).text(msg);
    }

  
    $scope.hide_error = function (er_id) {
        $("#er-"+er_id).text('');
    }

    $scope.numberWithCommas = function (x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    } 
    $scope.isnull = function (value) {
        if (typeof value !== 'null') {
            if (value !== '') { return true; }
            else { return false; }
        } else {
            return false;
        }
    }

    $scope.show_success = function (er_id, msg) {
        $("#er-"+er_id).removeClass('ap-lbl-inp-err');
        $("#er-"+er_id).addClass('ap-lbl-inp-success');
        $("#er-"+er_id).text(msg);
    }
    

    
});
