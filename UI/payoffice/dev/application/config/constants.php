<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/*
|--------------------------------------------------------------------------
| Application Messages
|--------------------------------------------------------------------------
|
*/
defined('SC_TXN_SAVED_SUCCESSFULLY')   			OR define('SC_TXN_SAVED_SUCCESSFULLY', 'Transaction has been saved successfully.'); 
defined('SC_DTA_SAVED_SUCCESSFULLY')   			OR define('SC_DTA_SAVED_SUCCESSFULLY', 'Data has been saved successfully.'); 
defined('SC_USR_SAVED_SUCCESSFULLY')   			OR define('SC_USR_SAVED_SUCCESSFULLY', 'User has been saved successfully.'); 
defined('SC_USR_ASSIGN_SUCCESSFULLY')   		OR define('SC_USR_ASSIGN_SUCCESSFULLY', 'User has been assigned successfully.'); 
defined('SC_USR_DELETE_SUCCESSFULLY')   		OR define('SC_USR_DELETE_SUCCESSFULLY', 'User has been deleted successfully.');
defined('SC_USR_DELETE_ASSIGN_SUCCESSFULLY')   		OR define('SC_USR_DELETE_ASSIGN_SUCCESSFULLY', 'User assignment has been deleted successfully.');  
defined('ER_MSG_NO_REF_FOUND')   			   OR define('ER_MSG_NO_REF_FOUND', 'Valid Reference Not Found'); 

defined('TSF_T4S_TO_POS_SUCCESSFULLY')   	   OR define('TSF_T4S_TO_POS_SUCCESSFULLY', 'Transferred Cash Into Vault Successfully'); 
defined('TSF_POS_TO_T4S_SUCCESSFULLY')   	   OR define('TSF_POS_TO_T4S_SUCCESSFULLY', 'Transferred from POS to T4S successfully'); 
defined('SAVE_RATES_SUCCESSFULLY')   	       OR define('SAVE_RATES_SUCCESSFULLY', 'Saved Currency Rates Successfully'); 
defined('AUTH_RATES_SUCCESSFULLY')   	       OR define('AUTH_RATES_SUCCESSFULLY', 'Authorized Currency Rates Successfully'); 
defined('REJECT_RATES_SUCCESSFULLY')   	       OR define('REJECT_RATES_SUCCESSFULLY', 'Rejected Currency Rates Successfully'); 






defined('ER_MSG_USER_BLOCKED')        		 	 		OR define('ER_MSG_USER_BLOCKED', 'This user account has been blocked.'); 
defined('ER_MSG_USER_DISABLED')        		 	 		OR define('ER_MSG_USER_DISABLED', 'This user account has been disabled.'); 
defined('ER_MSG_REQUIRED_FIELD')        		 		OR define('ER_MSG_REQUIRED_FIELD', 'Required.'); 
defined('ER_MSG_REQUIRED_FIELD_USERNAME')        		OR define('ER_MSG_REQUIRED_FIELD_USERNAME', 'Username is required.'); 
defined('ER_MSG_REQUIRED_FIELD_PASSWORD')        		OR define('ER_MSG_REQUIRED_FIELD_PASSWORD', 'Password is required.'); 
defined('ER_MSG_INVALID_USERNAME_OR_PASSWORD')   		OR define('ER_MSG_INVALID_USERNAME_OR_PASSWORD', 'Invalid username or password.'); 
defined('ER_MSG_AUTH_FAILED_IN_FIELD')   				OR define('ER_MSG_AUTH_FAILED_IN_FIELD', 'Field authentication is failed'); 
defined('ER_MSG_SYSTEM_CONFIG_ERROR')   				OR define('ER_MSG_SYSTEM_CONFIG_ERROR', 'Invalid configuration has been found.'); 
defined('ER_MSG_LDAP_CONNECTION_ERROR')   				OR define('ER_MSG_LDAP_CONNECTION_ERROR', 'Invalid username or password.'); 
defined('ER_MSG_WEBAPP_CONNECTION_ERROR')   			OR define('ER_MSG_WEBAPP_CONNECTION_ERROR', 'Invalid username or password.'); 
defined('ER_MSG_INTERNAL_SERVER_ERROR')   				OR define('ER_MSG_INTERNAL_SERVER_ERROR', 'The internal server encountered an unexpected error.'); 
defined('ER_MSG_FUNCTION_IS_BLOCKED')   				OR define('ER_MSG_FUNCTION_IS_BLOCKED', 'This function is blocked for your user level.'); 
defined('ER_MSG_URL_NOT_FOUND')   				        OR define('ER_MSG_URL_NOT_FOUND', 'The requested URL could not be retrieved.'); 
defined('ER_MSG_DATA_NOT_FOUND')   					   	OR define('ER_MSG_DATA_NOT_FOUND', 'The requested URL could not be retrieved.'); 
defined('ER_MSG_PAGE_NOT_FOUND')   				        OR define('ER_MSG_PAGE_NOT_FOUND', 'The page you requested was not found.'); 
defined('ER_MSG_REQ_TIMEOUT')   				        OR define('ER_MSG_REQ_TIMEOUT', 'The server is taking too long to respond.'); 
defined('ER_MSG_INSUF_BALANCE')   				        OR define('ER_MSG_INSUF_BALANCE', 'Transaction cannot be completed due to insufficient balance in customer account.'); 
defined('ER_MSG_INSUF_BALANCE_IN_COMMAC')   			OR define('ER_MSG_INSUF_BALANCE_IN_COMMAC', 'Transaction cannot be completed due to insufficient balance in commission account.'); 
defined('ER_MSG_PENDING_RATE')   				        OR define('ER_MSG_PENDING_RATE', 'Transaction cannot be completed due to pending rate allocation.'); 

defined('SC_MSG_FOR_CREATION')   				        OR define('SC_MSG_FOR_CREATION', 'has been created successfully.'); 
defined('SC_MSG_FOR_UPDATE')   				            OR define('SC_MSG_FOR_UPDATE', 'have been changed successfully.'); 
defined('SC_MSG_FOR_DELETE')   				            OR define('SC_MSG_FOR_DELETE', 'has been deleted successfully.'); 

defined('ER_MSG_FAILED_TO_SAVE')   				        OR define('ER_MSG_FAILED_TO_SAVE', 'Failed to save this data due to session validation error.'); 
defined('ER_MSG_FAILED_TO_SAVE_NO_DATA')   				OR define('ER_MSG_FAILED_TO_SAVE_NO_DATA', 'An error has occurred processing your request to the data source.'); 
defined('ER_MSG_SESSION_IS_ACTIVE')   					OR define('ER_MSG_SESSION_IS_ACTIVE', 'You are already logged in from another client. Click Reset User to terminate the previous login.'); 
defined('ER_MSG_ACCESS_FORBIDDEN')   					OR define('ER_MSG_ACCESS_FORBIDDEN', 'This function is blocked for your user level.'); 
defined('ER_MSG_INVALID_DATA_FOUND')   					OR define('ER_MSG_INVALID_DATA_FOUND', 'Invalid data or no data has been found.'); 
defined('ER_MSG_INVALID_FIELD')   					    OR define('ER_MSG_INVALID_FIELD', 'Invalid'); 
defined('ER_MSG_CIF_MISMATCH')   					    OR define('ER_MSG_CIF_MISMATCH', 'Invalid (CIF Mismatch)'); 
defined('ER_MSG_IBAN_ERROR')   					    	OR define('ER_MSG_IBAN_ERROR', 'Invalid (IBAN Error)'); 
defined('ER_MSG_INVALID_CHARS')   					   	OR define('ER_MSG_INVALID_CHARS', 'Invalid Characters'); 
defined('ER_MSG_INVALID_NUMBERS')   				   	OR define('ER_MSG_INVALID_NUMBERS', 'Invalid Numbers'); 
defined('ER_MSG_ERROR_INCENTIVE')   				   	OR define('ER_MSG_ERROR_INCENTIVE', 'An error has occurred processing incentive calculation'); 
defined('ER_MSG_INVALID_LENGTH')   					   	OR define('ER_MSG_INVALID_LENGTH', 'Invalid Length'); 
defined('ER_MSG_CANCELLED_REQUEST')   					OR define('ER_MSG_CANCELLED_REQUEST', 'This request has been cancelled.'); 
defined('ER_MSG_CANCELLATION_PROGRESS')   				OR define('ER_MSG_CANCELLATION_PROGRESS', 'This request cannot be opened while cancellation in progress.'); 

defined('SC_MSG_RATE_SAVED_SUCCSESS')   				OR define('SC_MSG_RATE_SAVED_SUCCSESS', 'Rate has been reserved successfully.'); 
defined('SC_MSG_FUND_SAVED_SUCCSESS')   				OR define('SC_MSG_FUND_SAVED_SUCCSESS', 'Funds have been reserved successfully.'); 
defined('SC_MSG_REQ_SAVED_SUCCSESS')   					OR define('SC_MSG_REQ_SAVED_SUCCSESS', 'Customer request has been created successfully.'); 
defined('SC_MSG_REQ_UPDATED_SUCCSESS')   				OR define('SC_MSG_REQ_UPDATED_SUCCSESS', 'Customer request has been updated successfully.'); 
defined('SC_MSG_REQ_REJECTED_SUCCSESS')   				OR define('SC_MSG_REQ_REJECTED_SUCCSESS', 'Customer request has been rejected successfully.'); 
defined('SC_MSG_REQ_VERIFIED_SUCCSESS')   				OR define('SC_MSG_REQ_VERIFIED_SUCCSESS', 'Customer request has been verified successfully.'); 
defined('SC_MSG_REQ_AUTHORIZED_SUCCSESS')   			OR define('SC_MSG_REQ_AUTHORIZED_SUCCSESS', 'Customer request has been authorized successfully.'); 
defined('SC_MSG_MOVED_PP_QUEUE')   			            OR define('SC_MSG_MOVED_PP_QUEUE', 'Transaction has been moved to the pending payments queue successfully.'); 
defined('SC_MSG_REQ_CANCELLATION_INITIATED')   			OR define('SC_MSG_REQ_CANCELLATION_INITIATED', 'Payment cancellation request has been initiated successfully.'); 
defined('SC_MSG_REQ_CANCELLATION_APPROVED')   			OR define('SC_MSG_REQ_CANCELLATION_APPROVED', 'Payment cancellation request has been approved successfully.'); 
defined('SC_MSG_REQ_CANCELLED')   						OR define('SC_MSG_REQ_CANCELLED', 'Payment request has been cancelled successfully.'); 
defined('SC_MSG_REQ_CANCELLED_ACCEPTED')   				OR define('SC_MSG_REQ_CANCELLED_ACCEPTED', 'Payment cancellation request has been accepted successfully.'); 



defined('SC_MSG_103_SAVED_SUCCSESS')   					OR define('SC_MSG_103_SAVED_SUCCSESS', 'MT103 message has been created successfully.'); 
defined('SC_MSG_202_SAVED_SUCCSESS')   					OR define('SC_MSG_202_SAVED_SUCCSESS', 'MT202 message has been created successfully.'); 
defined('SC_MSG_202C_SAVED_SUCCSESS')   				OR define('SC_MSG_202C_SAVED_SUCCSESS', 'MT202.COV message has been created successfully.'); 

defined('SC_MSG_103_UPDATED_SUCCSESS')   				OR define('SC_MSG_103_UPDATED_SUCCSESS', 'MT103 message has been updated successfully.'); 
defined('SC_MSG_202_UPDATED_SUCCSESS')   				OR define('SC_MSG_202_UPDATED_SUCCSESS', 'MT202 message has been updated successfully.'); 
defined('SC_MSG_202C_UPDATED_SUCCSESS')   				OR define('SC_MSG_202C_UPDATED_SUCCSESS', 'MT202.COV message has been updated successfully.'); 

defined('SC_MSG_103_VERIFIED_SUCCSESS')   				OR define('SC_MSG_103_VERIFIED_SUCCSESS', 'MT103 message has been verified successfully.'); 
defined('SC_MSG_202_VERIFIED_SUCCSESS')   				OR define('SC_MSG_202_VERIFIED_SUCCSESS', 'MT202 message has been verified successfully.'); 
defined('SC_MSG_202C_VERIFIED_SUCCSESS')   				OR define('SC_MSG_202C_VERIFIED_SUCCSESS', 'MT202.COV message has been verified successfully.'); 

defined('SC_MSG_103_AUTHORIZED_SUCCSESS')   			OR define('SC_MSG_103_AUTHORIZED_SUCCSESS', 'MT103 message has been authorized successfully.'); 
defined('SC_MSG_202_AUTHORIZED_SUCCSESS')   			OR define('SC_MSG_202_AUTHORIZED_SUCCSESS', 'MT202 message has been authorized successfully.'); 
defined('SC_MSG_202C_AUTHORIZED_SUCCSESS')   			OR define('SC_MSG_202C_AUTHORIZED_SUCCSESS', 'MT202.COV message has been authorized successfully.'); 

defined('SC_MSG_103_REJECTED_SUCCSESS')   			    OR define('SC_MSG_103_REJECTED_SUCCSESS', 'MT103 message has been rejected successfully.'); 
defined('SC_MSG_202_REJECTED_SUCCSESS')   			    OR define('SC_MSG_202_REJECTED_SUCCSESS', 'MT202 message has been rejected successfully.'); 
defined('SC_MSG_202C_REJECTED_SUCCSESS')   			    OR define('SC_MSG_202C_REJECTED_SUCCSESS', 'MT202.COV message has been rejected successfully.'); 

defined('SC_MSG_SENT_MAIL')   			    			OR define('SC_MSG_SENT_MAIL', 'Email has been sent successfully.'); 
defined('ER_MSG_SENT_MAIL')   			    			OR define('ER_MSG_SENT_MAIL', 'Message not delivered.'); 



defined('WN_MSG_CUT_OFF')   			    			OR define('WN_MSG_CUT_OFF', 'The cut off time to create this payment has passed.'); 