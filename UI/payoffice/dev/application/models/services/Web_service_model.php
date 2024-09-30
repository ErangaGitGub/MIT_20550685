<?php
/**
* Class:  Web_service_model 
* Author: Eranga
* Date:   17/01/2023
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/apis/'.'Web_api_model.php');

class Web_service_model extends Web_api_model
{
	public function __construct() {
        parent::__construct();
    }


    /*******************************************************************************
     * 
     * ADMIN MODULE
     * 
    *******************************************************************************/

    
    /*******************************************************************************
     * Check user from api service
     *
     * @return json response
    *******************************************************************************/
    public function check_user($credintials) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/auth/login/", $credintials)
        ); 
    }

    /*******************************************************************************
     * Get user data from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_user($data=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/auth/getuser/", $data)
        ); 
    }
    /*******************************************************************************
     * Get tariff details from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_tariff_data() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/admin/getTariffData/")
        ); 
    }

    /*******************************************************************************
     * Save tariff details from api service
     *
     * @return json response
    *******************************************************************************/
    public function save_tariff_data($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/admin/saveTariffData/", $transferArray)
        );
    }

    /*******************************************************************************
     * Get gl details from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_gl_data() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/admin/getGlData/")
        ); 
    }

    /*******************************************************************************
     * Save tariff details from api service
     *
     * @return json response
    *******************************************************************************/
    public function save_gl_data($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/admin/saveGlData/", $transferArray)
        );
    }  

 
    /*******************************************************************************
     * Get user data from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_user_data($credintials) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/user/getUserData/", $credintials)
        ); 
    }
    /*******************************************************************************
     * Get branch user list  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_branchUserList() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getBranchUserList/")
        ); 
    }

    /*******************************************************************************
     * Get branch user details  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_BranchUserDetails($pfArray) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getBranchUserData/", $pfArray)
        ); 
    }


    /*******************************************************************************
     * Get branch user details  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_systemDate() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getSystemDate/")
        ); 
    }

        /*******************************************************************************
     * Get effective date  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_effectiveDate() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getEffectiveDate/")
        ); 
    }

    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_user($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/insertUserData/", $dataArray)
        );
    }
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_assigned_user($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/assignUserData/", $dataArray)
        );
    }
     /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function delete_user($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/removeUserData/", $dataArray)
        );
    }
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function delete_user_assignment($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/removeUserAssignData/", $dataArray)
        );
    }

   /*******************************************************************************
     * 
     *
     * @return json response
    *******************************************************************************/
    public function reset_user_password_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/resetUserPassword/", $dataArray)
        );
    }

    /*******************************************************************************
     * 
     *
     * @return json response
    *******************************************************************************/
    public function change_user_password_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/changeUserPassword/", $dataArray)
        );
    }

    /*******************************************************************************
     * Get system user list  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_system_users() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getSystemUsers/")
        ); 
    }
  /*******************************************************************************
     * Get system user assignmemt list  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_user_assignments() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getDailyAssignments/")
        ); 
    }


    
    /*******************************************************************************
     * Get branch user details  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_UserLevels() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getUserLevels/")
        ); 
    }

    /*******************************************************************************
     * Get branch user details  from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_Tills() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/usr/getTills/")
        ); 
    }

   /*******************************************************************************
     * save transaction request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_transaction_request($dataArray=[]) {
        
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/insertData/", $dataArray)
        );
        
    }

    /*******************************************************************************
     * save transaction request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_cheque_deposit_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/currency/insertChequeData/", $dataArray)
        );
    }

    /*******************************************************************************
     * Get currency codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_currencyList() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getCurrencyList/")
        );
    }


    /*******************************************************************************
     * Get itrs codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_itrsCodesList($itrsinternationalArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getITRSCodesData/", $itrsinternationalArray)
        );    
    }

    /*******************************************************************************
     * Get customer data based on selected UIN from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_customerData($uinArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getCustomerData/", $uinArray)
        );
    }

    /*******************************************************************************
     * Get account type codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_accountTypeCodesList() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getAccountTypeCodesData/")
        );
    }

     /*******************************************************************************
     * Get  transaction sector codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_sectorCodesList($sectorArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getTransactionSectorCodesData/", $sectorArray)
        );
    }
      /*******************************************************************************
     * Get country codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_countryList() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getCountryData/")
        );
    }

     /*******************************************************************************
     * Get exchange rate(middle rate) from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_exchangeRate($exchangeRateArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getExchangeRate/", $exchangeRateArray)
        );
    }

   /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_transfer_T4STOPOS($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/insertToPOS/", $transferArray)
        );
    } 
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_transfer_POSTOT4S($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/insertToT4S/", $transferArray)
        );
    } 
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_transfer_POSTOTILL($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/tillToTill/", $transferArray)
        );
    }  
 /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_cash_transfer_request($transferArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/acceptCashToTill/", $transferArray)
        );
    }  

    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function accept_reject_all_transfers($actionArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/acceptRejectAllTransfers/", $actionArray)
        );
    }  
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_till_balances($tillArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getTillBalances/", $tillArray)
        );
    }

     /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_PreviousDayOpeningBalance($tillArray=[]) {
        
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getPreviousDayOpeningBalance/", $tillArray)
        );
    }
     /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_currencyListWithBalances($tillArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getCurrencyListWithBalance/", $tillArray)
        );
    } 
     /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_tillBalances($tillArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getTillBalance/", $tillArray)
        );
    } 
     /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_pending_transfer_list($tillArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getPendingTransfers/", $tillArray)
        );
    }  
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_cash_transfer_list($tillArray=[]) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/vault/getCashTransfers/", $tillArray)
        );
    }
    
    /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function get_international_transactions($brefArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getTransactions/", $brefArray)
        );
    }

      /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function get_all_transactions($brefArray) {  

        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getFilteredTransaction/", $brefArray)
        );
    }

    /*******************************************************************************
     * Get pending cancellation transactions
     *
     * @return json response
    *******************************************************************************/
    public function get_pending_cancellation_list() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getPendingCancellationList/")
        );
    }

    /*******************************************************************************
     * Get transaction exceptions
     *
     * @return json response
    *******************************************************************************/
    public function get_transaction_exceptions($brefArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getTransactionExceptions/", $brefArray)
        );
    } 

     /*******************************************************************************
     * Get transaction exceptions
     *
     * @return json response
    *******************************************************************************/
    public function get_daily_summary_data() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/getDailySummaryData/")
        );
    }

     /*******************************************************************************
     * Save Currency Rates
     *
     * @return json response
    *******************************************************************************/
    public function save_currency_rates($curArray) {  
       
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/currency/insertCurrency/", $curArray)
        );
    } 
     /*******************************************************************************
     * Authorized Currency Rates
     *
     * @return json response
    *******************************************************************************/
    public function auth_currency_rates($curArray) {  
            
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/currency/authorizeRejectCurrency/", $curArray)
        );
    }

     /*******************************************************************************
     * Save Currency Rates
     *
     * @return json response
    *******************************************************************************/
    public function get_rates_data($ratesArray) {  
            
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/currency/getRatesData/", $ratesArray)
        );
    }

    /*******************************************************************************
     * Save Currency Rates
     *
     * @return json response
    *******************************************************************************/
    public function get_cheque_data() {  
            
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/currency/getChequeData/")
        );
    }
    
   /*******************************************************************************
     * Get bank codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_bankCodesList() {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getBankCodesData/")
        );    
    }

    /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_workerRemittanceData($incentiveArray) {   
   
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getRemmitanceData/", $incentiveArray)
        );
    }

      /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_commissionData($commisionArray) {   
   
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/CalculateCommission/", $commisionArray)
        );
    }

    /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function load_international_transaction($brefArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getTransactionData/", $brefArray)
        );
    }

     /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_accountData($accountArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getAccountData/", $accountArray)
        );
    }
    
    /*******************************************************************************
     * DAY END OPERATIONS API CALLS
    *******************************************************************************/    
    /*******************************************************************************
     * load Historical Pre-check requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function eod_HistoricalOpr() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/getOperationHistory/")
        );
    }
       /*******************************************************************************
     * Check Process run status
     *
     * @return json response
    *******************************************************************************/
    public function eod_CheckRunStatus($dataArray) {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/checkRunStatus",$dataArray)
        );
    } 

     /*******************************************************************************
     * Check Pre-Check Process run status
     *
     * @return json response
    *******************************************************************************/
    public function eod_CheckPreCheckRunStatus() {
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/checkPreCheckRunStatus")
        );
    }   

   

     /*******************************************************************************
     * Start PreCheck Operation from api service
     *
     * @return json response
    *******************************************************************************/
    public function eod_StartPreCheckOperations($dataArray) {   
   
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/startPreCheckOperation/", $dataArray)
        );
    }

    /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function eod_StartDayEndOperations($dataArray) {   
   
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/startDayEndOperation/", $dataArray)
        );
    }

    /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function eod_GenerateReports($dataArray) {   
   
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/eodbod/generateReports/", $dataArray)
        );
    }

    /*******************************************************************************
     * Get Receipt Number
     *
     * @return json response
    *******************************************************************************/
    public function get_exchange_receipt_number($receiptArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/getExchangeReceiptNumber/", $receiptArray)
        );
    }

    /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function change_tansaction_state($brefArray) {
     
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/changeTransactionState/", $brefArray)
        );
    }

     /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function approve_cancel_transaction_request($brefArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/approveCancelTransaction/", $brefArray)
        );
    }

    /*******************************************************************************
     * Get transactions
     *
     * @return json response
    *******************************************************************************/
    public function reject_cancel_transaction_request($brefArray) {    
        return json_decode (
            $this->connect_to_service("/PayOfficeService/webresources/txn/rejectCancelTransaction/", $brefArray)
        );
    }



    

    /*******************************************************************************
     * Get itrs codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_AllitrsCodesList() {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/txn/getAllITRSCodesData/")
        );    
    }
   
   
 

    /*******************************************************************************
     * Get customer data based on account from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_ITRSaccountData($itrsaccountArray) {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/txn/getITRSCodesforAccounts/", $accountArray)
        );
    }

   

    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_request_user($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/txn/insertData/", $dataArray)
        );
    } 

    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_request_acc($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/txn/insertDataAcc/", $dataArray)
        );
    } 

    /*******************************************************************************
     * Get B reference Number
     *
     * @return json response
    *******************************************************************************/
    public function get_brefNumber($brefArray) {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/txn/getBRefNumber/", $brefArray)
        );
    }


    

   











































    /*******************************************************************************
     * Get currency codes from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_currenceyList() {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getCurrncyData/")
        );
    }
    /*******************************************************************************
     * Get available channel list from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_channelList() {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getChannelData/")
        );
    }
    /*******************************************************************************
     * Get global bic list from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_globalbic_list() {    
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getBICData/")
        );
    }
    /*******************************************************************************
     * load local bic list using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_localbic_list($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getSLBICData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * Get available nostro list from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_nostro_list() {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getNostroData/")
        );
    } 
    /*******************************************************************************
     * Get details of charges from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_docList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getDetailsofCharges/", $dataArray)
        );
    }   
    /*******************************************************************************
     * Get package list from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_packageList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getPackageDetails/", $dataArray)
        );
    }  
    /*******************************************************************************
     * Get purposecode list from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_purposecodeList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getPurposeCodes/", $dataArray)
        );
    }       
    /*******************************************************************************
     * Get account data from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_account($dataArray=[]) { 
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getAccountData/", $dataArray)
        );
    }
    /*******************************************************************************
     * Get account cost center data from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_ccenter($dataArray=[]) { 
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/validate/validateCC/", $dataArray)
        );
    }
    /*******************************************************************************
     * Get GL account data from api service
     *
     * @return json response
    *******************************************************************************/
    public function get_glaccount($dataArray=[]) { 
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getGLData/", $dataArray)
        );
    }
    /*******************************************************************************
     * Get transmit amount after currency conversion using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transmit_amount($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getTransferAmount/", $dataArray)
        );
    }
    /*******************************************************************************
     * Get remitter account data from api service
     *
     * @return json response
    *******************************************************************************/
    public function search_remi_accounts($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getRemitterAccount/", $dataArray)
        );
    }
    /*******************************************************************************
     * Get existing record matching to bene acc and rem acc from api service
     *
     * @return json response
    *******************************************************************************/
    public function search_bene_accounts($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getMatchingRecords/", $dataArray)
        );
    }
    /*******************************************************************************
     * search account is linked with the cif using api service
     *
     * @return json response
    *******************************************************************************/
    public function search_cif_link($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/validate/validateCIF/", $dataArray)
        );
    }
    /*******************************************************************************
     * search customer by cif using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_userbycif($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getCIFData/", $dataArray)
        );
    }
    /*******************************************************************************
     * get transfer amounts using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transferamounts($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getAmounts/", $dataArray)
        );
    }        
    /*******************************************************************************
     * save customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_customer_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/insertBasicData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * update customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function update_customer_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/modifyBasicData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * verify customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function verify_customer_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeBasicData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * authorize customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function authorize_customer_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeBasicData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * hold cuurent account payment using api service
     *
     * @return json response
    *******************************************************************************/
    public function hold_payment_on_currentac($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/fourceFullyDebit/", $dataArray)
        );
    } 
    /*******************************************************************************
     * authorize customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function authorize_customer_request_forcefully($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/fourceFullyDebit/", $dataArray)
        );
    } 
    /*******************************************************************************
     * reject customer fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function reject_customer_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeBasicData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * cancel customer payment using api service
     *
     * @return json response
    *******************************************************************************/
    public function cancel_customer_payment($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/cancelRecord/", $dataArray)
        );
    } 
    /*******************************************************************************
     * save additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/insertAditionalData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * update additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function update_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/modifyAditionalData/", $dataArray)
        );
    }
    /*******************************************************************************
     * verify additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function verify_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeAdditionalData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * authorize additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function authorize_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeAdditionalData/", $dataArray)
        );
    }
    /*******************************************************************************
     * reject additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function reject_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeAdditionalData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * cancel additional data of a fund transfer request using api service
     *
     * @return json response
    *******************************************************************************/
    public function cancel_stp_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/authorizeAdditionalData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load data to Customer Requests table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_customerRequestList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAllBasicData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load data to Transfer Auth Requests table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transferauthList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAllBasicData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * load data to Transfer Edit Requests table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transfereditList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAllModificationData/", $dataArray)
        );
    }   
    /*******************************************************************************
     * load data to Transfer Debit Requests table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transferdebitList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAllBasicData/", $dataArray)
        );
    }
    /*******************************************************************************
     * load all requests related to logged in user br and cluster to inquiry table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transferRequestList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAllData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * load all requests related to passing serch filters, to inquiry table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_transferRequestListByFilters($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/searchData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * load all pending payment requests related to logged in user br and cluster to 
     * re debit using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_pendingPaymentsList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/pendingDebits/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load all declined payment requests related to logged in user br and cluster to 
     * resend it to swft sever
     *
     * @return json response
    *******************************************************************************/
    public function get_declinedPaymentsList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/pendingMessage/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load all cancelled payment requests related to logged in user br and cluster to 
     * process using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_cancelledPaymentsList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/listCancellation/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load all reports related to logged in user cluster to 
     * process using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_reportList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/reportTypes/", $dataArray)
        );
    }  
    /*******************************************************************************
     * load request data to table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_request_dta($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadBasicData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load message data to table using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_message_dta($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/loadAdditionalData/", $dataArray)
        );
    }  
    /*******************************************************************************
     * perform IBAN validation on bene a/c using api service
     *
     * @return json response
    *******************************************************************************/
    public function do_validation_for_iban($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/validate/validateIBAN/", $dataArray)
        );
    }    
    /*******************************************************************************
     * load pending fund allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_pending_fund_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load accepted fund allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_accepted_fund_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load all fund allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_all_fund_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * accept fund allocation for payment using api service
     *
     * @return json response
    *******************************************************************************/
    public function accept_fund_allocation($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/reserveFunds/", $dataArray)
        );
    }
    /*******************************************************************************
     * reject fund allocation for payment using api service
     *
     * @return json response
    *******************************************************************************/
    public function reject_fund_allocation($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/reserveFunds/", $dataArray)
        );
    }
    /*******************************************************************************
     * load pending rate allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_pending_rate_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load accepted rate allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_accepted_rate_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * load all rate allocation requests using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_all_rate_allocationList($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * save rate allocation for payment using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_rate_allocation($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/specialRate/", $dataArray)
        );
    } 
    /*******************************************************************************
     * get send to reciver codes using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_sndrtorevivercodes($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getF72Codes/", $dataArray)
        );
    }
    /*******************************************************************************
     * get branch cutoff times for relavant channel using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_branch_cutoffs($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/get/getCutOffTimes/", $dataArray)
        );
    } 
    /*******************************************************************************
     * get rtgs daily report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_rtgs_daily_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/rtgsDailyReport/", $dataArray)
        );
    } 
    /*******************************************************************************
     * get rtgs inquiry report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_rtgs_inquiry_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/rtgsInquiryReport/", $dataArray)
        );
    }
    /*******************************************************************************
     * get rtgs GL entries inquiry report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_rtgs_gl_inquiry_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/rtgsGLInquiryReport/", $dataArray)
        );
    }
    /*******************************************************************************
     * get rtgs AC entries inquiry report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_rtgs_ac_inquiry_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/rtgsGLEntriesReport/", $dataArray)
        );
    }
    /*******************************************************************************
     * get rtgs Over One Million report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_rtgs_over_one_mil_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/rtgsOverOneMilReport/", $dataArray)
        );
    }
    /*******************************************************************************
     * get bbg report for dealer report using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_dealer_bbg_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/bbgReport/", $dataArray)
        );
    } 
    /*******************************************************************************
     * update bbg report after excel download using api service
     *
     * @return json response
    *******************************************************************************/
    public function update_dealer_bbg_report_to_excel($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/report/updateBBG/", $dataArray)
        );
    }   
    /*******************************************************************************
     * get srp report for dealer using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_srp_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/rateNotUsed/", $dataArray)
        );
    } 
    /*******************************************************************************
     * get funds inquiry report for dealer using api service
     *
     * @return json response
    *******************************************************************************/
    public function get_fund_inquiry_report($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/dealer/getDealerReportData/", $dataArray)
        );
    } 
    /*******************************************************************************
     * send customer email using api service
     *
     * @return json response
    *******************************************************************************/
    public function send_customer_email($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/mail/generateMail/", $dataArray)
        );
    } 

    /*******************************************************************************
     * save request template using api service
     *
     * @return json response
    *******************************************************************************/
    public function save_request_template($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/data/insertBeneData/", $dataArray)
        );
    } 

    /*******************************************************************************
     * load request template using api service
     *
     * @return json response
    *******************************************************************************/
    // public function get_request_template($dataArray=[]) {
    //     return json_decode (
    //         // $this->connect_to_service("/FundTransferService/webresources/mail/generateMail/", $dataArray)
    //     );
    // }

     /*******************************************************************************
     * save message template using api service
     *
     * @return json response
    *******************************************************************************/
    // public function save_message_template($dataArray=[]) {
    //     return json_decode (
    //         $this->connect_to_service("/FundTransferService/webresources/mail/generateMail/", $dataArray)
    //     );
    // }

    /*******************************************************************************
     * resend message authorization request using api service
     *
     * @return json response
    *******************************************************************************/
    public function reauth_message_request($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/msg/resendMessage/", $dataArray)
        );
    } 

    public function save_rates($dataArray=[]) {
        return json_decode (
            $this->connect_to_service("/FundTransferService/webresources/msg/resendMessage/", $dataArray)
        );
    } 
    
}