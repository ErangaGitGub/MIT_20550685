<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*------------------------------------------------------------
AUTH
-------------------------------------------------------------*/
$route['auth'] 						= 'core/Auth';
$route['auth/login'] 				= 'core/Auth/login';
$route['auth/logout'] 				= 'core/Auth/logout';

/*------------------------------------------------------------
DASHBOARD ROUTES
-------------------------------------------------------------*/
$route['dashboard']					= 'app/Dashboard';

$route['admin-dashboard']			= 'sys/Dashboard';

/*------------------------------------------------------------
-------------------APPLICATION ROUTES-------------------------
-------------------------------------------------------------*/

/*------------------------------------------------------------
ADMIN MODULE ROUTES
-------------------------------------------------------------*/
$route['admin/change/tariff']	    = 'app/Admin/changeTariffData';
$route['admin/tariff/save']		    = 'app/Admin/saveTariffData';
$route['admin/change/gl']	    = 'app/Admin/changeGlData';
$route['admin/gl/save']		    = 'app/Admin/saveGlData';


/*------------------------------------------------------------
TRANSACTION CREATION ROUTES
-------------------------------------------------------------*/
$route['transaction/create/purchase/new']				 = 'app/Transaction/create_purchase';
$route['transaction/create/sales/new']				     = 'app/Transaction/create_sales';
$route['transaction/create/exchange/new']			     = 'app/Transaction/create_exchange';
$route['transaction/create/payment/new']			     = 'app/Transaction/create_payment';
$route['transaction/create/pfcawithdraw/new']		     = 'app/Transaction/create_pfcawithdraw';
$route['transaction/create/getCustomerData']			 = 'app/Transaction/getCustomerData';
$route['transaction/create/calculateWorkerRemittence']	 = 'app/Transaction/calculateWorkerRemittence';
$route['transaction/create/calculateCommision_amount']	 = 'app/Transaction/calculateCommisionAmount';
$route['transaction/view']			                     = 'app/Transaction/view_transaction';
$route['transaction/view_all']			                 = 'app/Transaction/view_all_transaction';
$route['transaction/cancel']			                 = 'app/Transaction/cancel_transaction';
$route['transaction/approvecancel']			             = 'app/Transaction/approve_cancel_transactions';
$route['transaction/create/getTransactionSectorCodes']	 = 'app/Transaction/getTransactionSectorCodes';
$route['transaction/create/getExchangeRate']	         = 'app/Transaction/getExchangeRate';
$route['transaction/create/validate_FCP_txn']	         = 'app/Transaction/validate_FCP_txn';
$route['transaction/create/validate_FCS_txn']	         = 'app/Transaction/validate_FCS_txn';
$route['transaction/create/validate_FCR_txn']	         = 'app/Transaction/validate_FCR_txn';
$route['transaction/create/validate_FCI_txn']	         = 'app/Transaction/validate_FCI_txn';
$route['transaction/create/validate_PFC_txn']	         = 'app/Transaction/validate_PFC_txn';
$route['transaction/admin/validate_view']	             = 'app/Transaction/validate_txn_view';
$route['transaction/create/save_FCP_txn']	             = 'app/Transaction/save_FCP_txn';
$route['transaction/create/save_FCS_txn']	             = 'app/Transaction/save_FCS_txn';
$route['transaction/create/save_FCR_txn']	             = 'app/Transaction/save_FCR_txn';
$route['transaction/create/save_FCI_txn']	             = 'app/Transaction/save_FCI_txn';
$route['transaction/create/save_PFC_txn']	             = 'app/Transaction/save_PFC_txn';
$route['transaction/convertpdf']	                     = 'app/Transaction/convertToPDF';
$route['transaction/view/internationTxn']			   	 = 'app/Transaction/view_international_txn';
$route['transaction/view/exceptionTxn']			    	 = 'app/Transaction/view_exception_txn';
$route['transaction/print/internationTxn']			   	 = 'app/Transaction/print_international_txn';
$route['transaction/print/exceptionTxn']			   	 = 'app/Transaction/print_exception_txn';
$route['transaction/delete/internationTxn']			   	 = 'app/Transaction/delete_international_txn';
$route['transaction/cancel/internationTxn']			   	 = 'app/Transaction/cancel_international_txn';
$route['transaction/create/verifyReceiptNumber']		 = 'app/Transaction/verifyReceiptNumber';
$route['transaction/state_change_request']		         = 'app/Transaction/state_change_request';
$route['transaction/approve_cancel_transaction_request'] = 'app/Transaction/approve_cancel_transaction_request';
$route['transaction/reject_cancel_transaction_request']	 = 'app/Transaction/reject_cancel_transaction_request';
$route['transaction/create/getAccountData']				 = 'app/Transaction/get_accountData';
$route['transaction/admin/view']	                     = 'app/Transaction/admin_view';
$route['transaction/admin/view/report']	                 = 'app/Transaction/admin_view_report';


/*------------------------------------------------------------
USER MANAGEMENT ROUTES
-------------------------------------------------------------*/
$route['user/create/new']							 	 = 'app/User/create_new_user';
// $route['user/remove']						     	 	 = 'app/User/remove_user';
$route['user/assign/new']						   	 	 = 'app/User/assign_user';
$route['user/view']				    	   	        	 = 'app/User/view_user';
$route['user/data/getBranchUserDetails']		       	 = 'app/User/getBranchUserDetails';
$route['user/data/getSystemDate']		             	 = 'app/User/getSystemDate';
$route['user/create/validate']					         = 'app/User/validate';
$route['user/create/save']						         = 'app/User/save';
$route['user/assign/validate']						     = 'app/User/validate_assign';
$route['user/assign/save']					     	     = 'app/User/save_assign';
$route['user/delete/validate']					  	     = 'app/User/validate_delete';
$route['user/delete/save']					  	         = 'app/User/delete';
$route['user/deleteAssign/save']				         = 'app/User/delete_assign';
$route['user/remove_user']  					         = 'app/User/remove_user';
$route['user/remove_assignment']  					     = 'app/User/remove_assignment';
$route['user/reset/password']  					         = 'app/User/reset_user';
$route['user/reset_user_request']  					     = 'app/User/reset_user_request';
$route['user/change/password']  					     = 'app/User/change_password';
$route['user/change_password_request']  			     = 'app/User/change_password_request';

/*------------------------------------------------------------
VAULT MANAGEMENT ROUTES
-------------------------------------------------------------*/
$route['vault/transfer/t4stopos']						 = 'app/Vault/transfer_T4StoPOS';
$route['vault/transfer/postot4s']						 = 'app/Vault/transfer_POStoT4S';
$route['vault/transfer/postotill']					     = 'app/Vault/transfer_POStoTILL';
$route['vault/transfer/tilltopos']					     = 'app/Vault/transfer_TILLTOPOS';
$route['vault/transfer/tilltotill']						 = 'app/Vault/transfer_TilltoTill';

$route['vault/transfer/validate']					     = 'app/Vault/validate';
$route['vault/transfer/saveToPOS']					     = 'app/Vault/saveToPOS';
$route['vault/transfer/saveToT4S']					     = 'app/Vault/saveToT4S';
$route['vault/transfer/saveToTill']	                     = 'app/Vault/saveToTill';
$route['vault/transfer/cashToTill']	                     = 'app/Vault/cashToTill';
$route['vault/transfer/validate_tilltotill']		     = 'app/Vault/validate_tilltotill';
$route['vault/transfer/load_transfer_view']		         = 'app/Vault/load_transfer_view';
$route['vault/transfer/load_view']		                 = 'app/Vault/load_view';
$route['vault/transfer/getCurrencyListwithBalances']	 = 'app/Vault/getCurrencyListwithBalances';
$route['vault/transfer/acceptTransfers']	             = 'app/Vault/accept_transfers';
$route['vault/transfer/acceptRejectAll']	             = 'app/Vault/accept_reject_all_transfers';
$route['vault/transfer/viewTransfers']	                 = 'app/Vault/view_transfers';
$route['vault/view/tillbalance']	                     = 'app/Vault/view_tillbalance';

/*------------------------------------------------------------
CURRENCY RATES ROUTES
-------------------------------------------------------------*/
$route['rates/upload']					            	 = 'app/Rates/upload_rates';
$route['rates/save']					            	 = 'app/Rates/save_rates';
$route['rates/auth']					            	 = 'app/Rates/authorize_rates';
$route['rates/save_auth']					           	 = 'app/Rates/save_authorized_rates';
$route['rates/save_reject']					           	 = 'app/Rates/save_rejected_rates';
$route['rates/view']					            	 = 'app/Rates/view_rates';
$route['rates/before/print']					         = 'app/Rates/before_print_view';
$route['rates/after/print']					             = 'app/Rates/after_print_view';
$route['rates/getAccountData']					         = 'app/Rates/get_accountData';
$route['rates/validate_CHQ_deposit']					 = 'app/Rates/validate_CHQ_deposit';
$route['rates/save_CHQ_deposit']				     	 = 'app/Rates/save_CHQ_deposit';
$route['rates/view_cheques']					         = 'app/Rates/view_cheque_details';

/*------------------------------------------------------------
 DATA CENTER OPERATION ROUTES
-------------------------------------------------------------*/
$route['opr/preCheckView']		        	             = 'app/Operations/preCheckView';
$route['opr/dayBeginView']				                 = 'app/Operations/dayBeginView';
$route['opr/dayEndView']				                 = 'app/Operations/dayEndView';
$route['opr/list']					   		    	     = 'app/Operations/listOperations';
$route['opr/reports']					   		    	 = 'app/Operations/reports';
$route['opr/exceptions']					   		   	 = 'app/Operations/listExceptions';
$route['opr/start_precheck']				             = 'app/Operations/startPreCheck';
$route['opr/start_daybegin']				             = 'app/Operations/startDayBegin';
$route['opr/start_dayend']				                 = 'app/Operations/startDayEnd';
$route['opr/report/generate']				             = 'app/Operations/generateReport';
$route['opr/dayend/report']				                 = 'app/Operations/generateDayEndReport';

/*------------------------------------------------------------
OTHER ROUTES
-------------------------------------------------------------*/
$route['rates/balance_panel']					       	 = 'app/Rates/balance_panel';
$route['rates/cheque_panel']					       	 = 'app/Rates/cheque_panel';


