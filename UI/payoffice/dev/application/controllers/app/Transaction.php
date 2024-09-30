<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Transaction extends Base {

	protected $transaction;

	public function __construct(){
        parent::__construct();
        $this->load->model('app/Payment_model');
        $this->payment = new Payment_model();
    }



    /*******************************************************************************
     * Render view for admin view
     *
     * @return view
    *******************************************************************************/
    public function admin_view()
    {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            
            $data['title'] = 'Transaction Report';
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_view';
            $tabs = [];
            $data['bootstrap_select'] = true;
           

            $tabs += ['VIEW TRANSACTIONS' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/view_transactions', $data, true) ]];
            
            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for admin view
     *
     * @return view
    *******************************************************************************/
    public function admin_view_report()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        
        

        $fromdate = $this->input->get('fromdate', TRUE);
        $todate = $this->input->get('todate', TRUE);
        $txntype = $this->input->get('txntype', TRUE);
        $txnstatus = $this->input->get('txnstatus', TRUE);



        $data['title'] = 'View Transaction Details';
        $data['dir'] = 'app/transaction';
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';

         $dataArray = array (  
           'fromdate'         => $fromdate, 
           'todate'          =>  $todate, 
           'txntype'         => $txntype, 
           'txnstatus'          =>  $txnstatus          
         );

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
    

        $data['list'] = $this->payment->get_all_transactions($dataArray); 


        $data['table_view'] = $this->load->view('app/transaction/transaction_grid', $data, true); 
        $data['body'] = $this->load->view('app/transaction/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

    /*******************************************************************************
     * Render view for purchase
     *
     * @return view
    *******************************************************************************/
    public function create_purchase()
    {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            $txntype = $this->input->get('txntype', TRUE);
            $subtitle = $this->input->get('subtitle', TRUE);
            $txncode = $this->input->get('txncode', TRUE);
            $user_till = $this->session->userdata('user_till');
           
            if(isset($txnType)){
                $data['tabtitle1']    = $subtitle;
            }    
            if(isset($txncode)){
                $data['natureTxnCode']    = $txncode;
            }
            if(isset($txntype)){
                $data['txntype']    = $txntype;
            } 
            if(isset($user_till)){

                $data['userTill']    = $user_till;
            }


            $data['title']        = 'New Request';  
            $data['tabtitle1']    = 'NEW TRANSACTION';    
            $data['tabtitle2']    = 'REQUEST CONFIRMATION'; 
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_create';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 
            $data['countries']           = $this->payment->get_countryList(); 
            $data['accounttypecodes']    = $this->payment->get_accountTypeCodesList();
           
            $sectorArray   = array('uintype' => '3'); 
            $data['sectorcodes']         = $this->payment->get_sectorCodesList($sectorArray); 
            $txncodeArray   = array('txncode' => $txncode);
            $data['itrscodes']           = $this->payment->get_itrsCodesList($txncodeArray);
            $data['bankcodes']           = $this->payment->get_bankCodesList();   
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_purchase', $data, true) ]];
            } else {
                $tabs += ['NEW TRANSACTION' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_purchase', $data, true) ]];
            }
            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }


    /*******************************************************************************
     * Render view for sales
     *
     * @return view
    *******************************************************************************/
    public function create_sales()
    {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            $txntype = $this->input->get('txntype', TRUE);
            $subtitle = $this->input->get('subtitle', TRUE);
            $txncode = $this->input->get('txncode', TRUE);
             $user_till = $this->session->userdata('user_till');
           
            if(isset($txnType)){
                $data['tabtitle1']    = $subtitle;
            }    
            if(isset($txncode)){
                $data['natureTxnCode']    = $txncode;
            } 
             if(isset($txntype)){
                $data['txntype']    = $txntype;
            } 
            if(isset($user_till)){
                $data['userTill']    = $user_till;
            }

            $data['title']        = 'New Request';  
            $data['tabtitle1']    = 'NEW TRANSACTION';    
            $data['tabtitle2']    = 'REQUEST CONFIRMATION'; 
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_create';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 
            $data['countries']           = $this->payment->get_countryList(); 
            $data['accounttypecodes']    = $this->payment->get_accountTypeCodesList();
            $sectorArray   = array('uintype' => '5');
            $data['sectorcodes']         = $this->payment->get_sectorCodesList($sectorArray); 
              $txncodeArray   = array('txncode' => $txncode);
            $data['itrscodes']           = $this->payment->get_itrsCodesList($txncodeArray);
            $data['bankcodes']           = $this->payment->get_bankCodesList();   
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_sales', $data, true) ]];
            } else {
                $tabs += ['NEW TRANSACTION' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_sales', $data, true) ]];
            }
            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }


        /*******************************************************************************
     * Render view for Re-exchange
     *
     * @return view
    *******************************************************************************/
    public function create_exchange()
     {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            $txntype = $this->input->get('txntype', TRUE);
            $subtitle = $this->input->get('subtitle', TRUE);
            $txncode = $this->input->get('txncode', TRUE);
             $user_till = $this->session->userdata('user_till');


           
            if(isset($txnType)){
                $data['tabtitle1']    = $subtitle;
            }    
            if(isset($txncode)){
                $data['natureTxnCode']    = $txncode;
            } 
             if(isset($txntype)){
                $data['txntype']    = $txntype;
            } 
            if(isset($user_till)){
                $data['userTill']    = $user_till;
            }

            $data['title']        = 'New Request';  
            $data['tabtitle1']    = 'NEW TRANSACTION';    
            $data['tabtitle2']    = 'REQUEST CONFIRMATION'; 
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_create';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 
            $data['countries']           = $this->payment->get_countryList(); 
            $data['accounttypecodes']    = $this->payment->get_accountTypeCodesList();
            $sectorArray   = array('uintype' => '3');
            $data['sectorcodes']         = $this->payment->get_sectorCodesList($sectorArray); 
              $txncodeArray   = array('txncode' => $txncode);
            $data['itrscodes']           = $this->payment->get_itrsCodesList($txncodeArray);
            $data['bankcodes']           = $this->payment->get_bankCodesList();   
            $data['bootstrap_select'] = true;

            // print_r('<pre>');
            // print_r($data);
            // print_r('</pre>');die;


            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_exchange', $data, true) ]];
            } else {
                $tabs += ['NEW TRANSACTION' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_exchange', $data, true) ]];
            }


            $data['tabs'] = $tabs; 

            

           

            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 

            

            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for purchase
     *
     * @return view
    *******************************************************************************/
    public function create_payment()
    {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            $txntype = $this->input->get('txntype', TRUE);
            $subtitle = $this->input->get('subtitle', TRUE);
            $txncode = $this->input->get('txncode', TRUE);
            $user_till = $this->session->userdata('user_till');
           
            if(isset($txnType)){
                $data['tabtitle1']    = $subtitle;
            }    
            if(isset($txncode)){
                $data['natureTxnCode']    = $txncode;
            }
            if(isset($txntype)){
                $data['txntype']    = $txntype;
            } 
            if(isset($user_till)){

                $data['userTill']    = $user_till;
            }


            $data['title']        = 'New Request';  
            $data['tabtitle1']    = 'NEW TRANSACTION';    
            $data['tabtitle2']    = 'REQUEST CONFIRMATION'; 
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_create';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 
            $data['countries']           = $this->payment->get_countryList(); 
            $data['accounttypecodes']    = $this->payment->get_accountTypeCodesList();
           
            $sectorArray   = array('uintype' => '3'); 
            $data['sectorcodes']         = $this->payment->get_sectorCodesList($sectorArray); 
            $txncodeArray   = array('txncode' => $txncode);
            $data['itrscodes']           = $this->payment->get_itrsCodesList($txncodeArray);
            $data['bankcodes']           = $this->payment->get_bankCodesList();   
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_payment', $data, true) ]];
            } else {
                $tabs += ['NEW TRANSACTION' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_payment', $data, true) ]];
            }
            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for purchase
     *
     * @return view
    *******************************************************************************/
    public function create_pfcawithdraw()
    {
        // if (Auth::has_permission('request_creation')) {
        if (true) {
            $txntype = $this->input->get('txntype', TRUE);
            $subtitle = $this->input->get('subtitle', TRUE);
            $txncode = $this->input->get('txncode', TRUE);
            $user_till = $this->session->userdata('user_till');
           
            if(isset($txnType)){
                $data['tabtitle1']    = $subtitle;
            }    
            if(isset($txncode)){
                $data['natureTxnCode']    = $txncode;
            }
            if(isset($txntype)){
                $data['txntype']    = $txntype;
            } 
            if(isset($user_till)){

                $data['userTill']    = $user_till;
            }


            $data['title']        = 'New Request';  
            $data['tabtitle1']    = 'NEW TRANSACTION';    
            $data['tabtitle2']    = 'REQUEST CONFIRMATION'; 
            $data['dir'] = 'app/transaction';
            $data['route'] = 'transaction';
            $data['controller'] = 'Txn';
            $data['angular'] = true;
            $data['event'] = 'transaction_create';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 
            $data['countries']           = $this->payment->get_countryList(); 
            $data['accounttypecodes']    = $this->payment->get_accountTypeCodesList();
           
            $sectorArray   = array('uintype' => '3'); 
            $data['sectorcodes']         = $this->payment->get_sectorCodesList($sectorArray); 
            $txncodeArray   = array('txncode' => $txncode);
            $data['itrscodes']           = $this->payment->get_itrsCodesList($txncodeArray);
            $data['bankcodes']           = $this->payment->get_bankCodesList();   
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_withdrawal', $data, true) ]];
            } else {
                $tabs += ['NEW TRANSACTION' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/Transaction/request_create_withdrawal', $data, true) ]];
            }
            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }


     /*******************************************************************************
     * Render view for Transactions
     *
     * @return view
    *******************************************************************************/
        public function view_transaction()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $tillID = $this->session->userdata('user_till');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $txnType = $this->input->get('txntype', TRUE);



        $data['title'] = 'View Transaction Details';
        $data['dir'] = 'app/transaction';
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';

         $dataArray = array (  
           'txnType'         => $txnType, 
           'tillID'          =>  $tillID           
         );

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
    

        $data['list'] = $this->payment->get_international_transactions($dataArray); 


        $data['table_view'] = $this->load->view('app/transaction/transaction_grid', $data, true); 
        $data['body'] = $this->load->view('app/transaction/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }


     /*******************************************************************************
     * Render view for Transactions
     *
     * @return view
    *******************************************************************************/
        public function view_all_transaction()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $fromdate = $this->get_json_input('fromdate', TRUE); 
        $todate = $this->get_json_input('todate', TRUE);          
        $txntype = $this->get_json_input('txntype', TRUE);
        $txnstatus = $this->get_json_input('txnstatus', TRUE);




        $data['title'] = 'View All Transaction Details';
        $data['dir'] = 'app/transaction';
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';

         $dataArray = array (  
           'fromdate'         => $fromdate, 
           'todate'          =>  $todate,
           'txntype'          =>  $txntype,
           'txnstatus'          =>  $txnstatus           
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);

        $data['list'] = $this->payment->get_all_transactions($dataArray); 

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/transaction/transaction_grid', $data, true); 
        $data['body'] = $this->load->view('app/transaction/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

      /*******************************************************************************
     * Render view for Transactions
     *
     * @return view
    *******************************************************************************/
        public function cancel_transaction()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $tillID = $this->session->userdata('user_till');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $txnType = $this->input->get('txntype', TRUE);



        $data['title'] = 'Cancel Transactions';
        $data['dir'] = 'app/transaction';
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';

         $dataArray = array (  
           'txnType'         => $txnType, 
           'tillID'          =>  $tillID             
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);

        $data['list'] = $this->payment->get_international_transactions($dataArray); 

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/transaction/transaction_cancel_grid', $data, true); 
        $data['body'] = $this->load->view('app/transaction/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

         /*******************************************************************************
     * Render view for Transactions
     *
     * @return view
    *******************************************************************************/
        public function approve_cancel_transactions()
     {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $tillID = $this->session->userdata('user_till');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $txnType = $this->input->get('txntype', TRUE);



        $data['title'] = 'Approve Cancel Transactions';

        $data['dir'] = 'app/transaction';
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';

         $dataArray = array (  
           'txnType'         => $txnType, 
           'tillID'          =>  $tillID            
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);

        $data['list'] = $this->payment->get_international_transactions($dataArray); 

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/transaction/cancelTransaction_approve_grid', $data, true); 
        $data['body'] = $this->load->view('app/transaction/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

     /*******************************************************************************
     * Validate FCP Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_FCP_txn()
    {       
        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();

                    ###VALIDATION: uin type
                    if ($fields['uinidtype']==="") {
                        $error_status      = true;
                        $errors['uintype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uintype'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['uinnumber']==="") {
                        $error_status      = true;
                        $errors['uinnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uinnumber'] = "";
                    }
                

                    // ###VALIDATION:UIN TYPE
                    if ($fields['title']==="") {
                        $error_status      = true;
                        $errors['title'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['title'] = "";
                    }

                    ###VALIDATION:NAME
                    if ($fields['fname']==="") {
                        $error_status      = true;
                        $errors['fname'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('fname', $fields['fname']) ) {
                         $error_status = true;
                         $errors["fname"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['fname'] = "";
                    }


                    ###VALIDATION:NAME
                    if ($fields['custaddr1']==="") {
                        $error_status      = true;
                        $errors['custaddr1'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('custaddr1', $fields['custaddr1']) ) {
                         $error_status = true;
                         $errors["custaddr1"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['custaddr1'] = "";
                    }


                    ###VALIDATION:ITRS CODE
                    if ($fields['itrscode']==="") {
                        $error_status      = true;
                        $errors['itrscode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        if ($fields['itrscode']==="1501"){
                                if ($fields['comgltotal']==="") {
                                    $error_status      = true;
                                    $errors['comgltotal'] = ER_MSG_REQUIRED_FIELD;
                                } else {
                                    $errors['comgltotal'] = "";
                                }

                                if ($fields['incgltotal']==="") {
                                    $error_status      = true;
                                    $errors['incgltotal'] = ER_MSG_REQUIRED_FIELD;
                                } else {
                                    $errors['incgltotal'] = "";
                                }
                        } else{
                           $errors['itrscode'] = ""; 
                        }
                        
                    }



                    ###VALIDATION:ITRS CODE
                    if ($fields['accounttypecode']==="") {
                        $error_status      = true;
                        $errors['accounttypecode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accounttypecode'] = "";
                    }
                    
                    ###VALIDATION:ITRS CODE
                    if ($fields['sectorcode']==="") {
                        $error_status      = true;
                        $errors['sectorcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['sectorcode'] = "";
                    } 

                    //  ###VALIDATION:INCENTIVE AMOUNT
                    if ($fields['incgltotal']==="NaN") {
                        $error_status      = true;
                        $errors['incgltotal'] = ER_MSG_ERROR_INCENTIVE;

                    } else {

                        $errors['incgltotal'] = "";
                    } 

                    ###VALIDATION:ITRS CODE
                    if ($fields['majorcountry']==="") {
                        $error_status      = true;
                        $errors['majorcountry'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['majorcountry'] = "";
                    }

                    ###VALIDATION:CURRENCIES
                    if ($fields['currency1']==="" && $fields['currency2']==="" && $fields['currency3']==="" && $fields['currency4']==="" ) {
                        $error_status  = true;
                        $errors["icurrencyselector1"] = ER_MSG_REQUIRED_FIELD; 
                    } else {
                        $errors["icurrencyselector1"] = "";
                    }


                    if ($fields['currency1']===""){
                        //
                    } else {
                        if ($fields['tamount1']==="") {
                            $error_status      = true;
                            $errors['tamount1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount1'] = "";
                        }

                        if ($fields['rate1']==="") {
                            $error_status      = true;
                            $errors['rate1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate1'] = 'Invalid exchange rate';

                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['maxrate1']), 
                                $this->remove_commas($fields['rate1']))){
                                $error_status      = true;
                                $errors['rate1'] = 'Maximum rate value exceeds';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['rate1']), 
                                $this->remove_commas($fields['minrate1']))){
                                $error_status      = true;
                                $errors['rate1'] = 'Minimum rate value exceeds';
                            }
                             else {
                               $errors['rate1'] = "";  
                            }                           
                        }
                    }


                    if ($fields['currency2']===""){
                        //
                    } else {
                        if ($fields['tamount2']==="") {
                            $error_status      = true;
                            $errors['tamount2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount2'] = "";
                        }

                        if ($fields['rate2']==="") {
                            $error_status      = true;
                            $errors['rate2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate2'] = 'Invalid exchange rate';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['maxrate2']), 
                                $this->remove_commas($fields['rate2']))){
                                $error_status      = true;
                                $errors['rate2'] = 'Maximum rate value exceeds';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['rate2']), 
                                $this->remove_commas($fields['minrate2']))){
                                $error_status      = true;
                                $errors['rate2'] = 'Minimum rate value exceeds';
                            }
                            else {
                               $errors['rate2'] = "";  
                            }
                        }
                    }

                    if ($fields['currency3']===""){
                        //
                    } else {
                        if ($fields['tamount3']==="") {
                            $error_status      = true;
                            $errors['tamount3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount3'] = "";
                        }

                        if ($fields['rate3']==="") {
                            $error_status      = true;
                            $errors['rate3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate3'] = 'Invalid exchange rate';

                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['maxrate3']), 
                                $this->remove_commas($fields['rate3']))){
                                $error_status      = true;
                                $errors['rate3'] = 'Maximum rate value exceeds';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['rate3']), 
                                $this->remove_commas($fields['minrate3']))){
                                $error_status      = true;
                                $errors['rate3'] = 'Minimum rate value exceeds';
                            }
                            else {
                               $errors['rate3'] = "";  
                            }
                        }
                    }

                    if ($fields['currency4']===""){
                        //
                    } else {
                        if ($fields['tamount4']==="") {
                            $error_status      = true;
                            $errors['tamount4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount4'] = "";
                        }

                        if ($fields['rate4']==="") {
                            $error_status      = true;
                            $errors['rate4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate4'] = 'Invalid exchange rate';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['maxrate4']), 
                                $this->remove_commas($fields['rate4']))){
                                $error_status      = true;
                                $errors['rate4'] = 'Maximum rate value exceeds';
                            } else if ($shars->has_insufficient_balance($this->remove_commas($fields['rate4']), 
                                $this->remove_commas($fields['minrate4']))){
                                $error_status      = true;
                                $errors['rate4'] = 'Minimum rate value exceeds';
                            }
                            else {
                               $errors['rate4'] = "";  
                            }
                        }
                    }




                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }
            $this->handle_json_response($resdta, $return_json);
        }
    }

     /*******************************************************************************
     * Validate FCS Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_FCS_txn()
    {       
        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();



                    ###VALIDATION: uin type
                    if ($fields['uinidtype']==="") {
                        $error_status      = true;
                        $errors['uintype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uintype'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['uinnumber']==="") {
                        $error_status      = true;
                        $errors['uinnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uinnumber'] = "";
                    }
                

                    // ###VALIDATION:UIN TYPE
                    if ($fields['title']==="") {
                        $error_status      = true;
                        $errors['title'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['title'] = "";
                    }

                    ###VALIDATION:NAME
                    if ($fields['fname']==="") {
                        $error_status      = true;
                        $errors['fname'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('fname', $fields['fname']) ) {
                         $error_status = true;
                         $errors["fname"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['fname'] = "";
                    }


                    ###VALIDATION:NAME
                    if ($fields['custaddr1']==="") {
                        $error_status      = true;
                        $errors['custaddr1'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('custaddr1', $fields['custaddr1']) ) {
                         $error_status = true;
                         $errors["custaddr1"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['custaddr1'] = "";
                    }


                    ###VALIDATION:ITRS CODE
                    if ($fields['itrscode']==="") {
                        $error_status      = true;
                        $errors['itrscode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['itrscode'] = "";
                    }



                    ###VALIDATION:ITRS CODE
                    if ($fields['accounttypecode']==="") {
                        $error_status      = true;
                        $errors['accounttypecode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accounttypecode'] = "";
                    }
                    
                    ###VALIDATION:ITRS CODE
                    if ($fields['sectorcode']==="") {
                        $error_status      = true;
                        $errors['sectorcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['sectorcode'] = "";
                    } 


                    ###VALIDATION:ITRS CODE
                    if ($fields['majorcountry']==="") {
                        $error_status      = true;
                        $errors['majorcountry'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['majorcountry'] = "";
                    }

                    // ###VALIDATION:REFUND AMOUNT
                                  
                           
                    if ($shars->has_insufficient_balance($this->remove_commas($fields['receivedAmount']), 
                                $this->remove_commas($fields['customertotal']))){
                                $error_status      = true;
                                $errors['refundAmount'] = 'Invalid Refund Amount';
                            } else{
                               $errors['refundAmount'] = ""; 
                            }

                    ###VALIDATION:CURRENCIES
                    if ($fields['currency1']==="" && $fields['currency2']==="" && $fields['currency3']==="" && $fields['currency4']==="" ) {
                        $error_status  = true;
                        $errors["icurrencyselector1"] = ER_MSG_REQUIRED_FIELD; 
                    } else {
                        $errors["icurrencyselector1"] = "";
                    }


                    
                    if ($fields['currency1']===""){
                        //
                    } else {
                        if ($fields['tamount1']==="") {
                            $error_status      = true;
                            $errors['tamount1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount1'] = "";
                        }

                        if ($fields['rate1']==="") {
                            $error_status      = true;
                            $errors['rate1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate1'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate1'] = ""; 
                            }
                            
                        }
                    }


                    if ($fields['currency2']===""){
                        //
                    } else {
                        if ($fields['tamount2']==="") {
                            $error_status      = true;
                            $errors['tamount2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount2'] = "";
                        }

                        if ($fields['rate2']==="") {
                            $error_status      = true;
                            $errors['rate2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate2']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate2'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate2'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency3']===""){
                        //
                    } else {
                        if ($fields['tamount3']==="") {
                            $error_status      = true;
                            $errors['tamount3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount3'] = "";
                        }

                        if ($fields['rate3']==="") {
                            $error_status      = true;
                            $errors['rate3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate3']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate3'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate3'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency4']===""){
                        //
                    } else {
                        if ($fields['tamount4']==="") {
                            $error_status      = true;
                            $errors['tamount4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount4'] = "";
                        }

                        if ($fields['rate4']==="") {
                            $error_status      = true;
                            $errors['rate4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate4']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate4'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate4'] = ""; 
                            }
                        }
                    }





                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }
            $this->handle_json_response($resdta, $return_json);
        }
    } 


      /*******************************************************************************
     * Validate FCR Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_FCR_txn()
    {       
        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();

                    ###VALIDATION: uin type
                    if ($fields['uinidtype']==="") {
                        $error_status      = true;
                        $errors['uintype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uintype'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['uinnumber']==="") {
                        $error_status      = true;
                        $errors['uinnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uinnumber'] = "";
                    }
                

                    // ###VALIDATION:PREVIOUS EXCHANGE RECEIPT
                    // if ($fields['receiptNumber']==="") {
                    //     $error_status      = true;
                    //     $errors['receiptNumber'] = ER_MSG_REQUIRED_FIELD;
                    // } else {
                    //     if ($fields['prvlkrtotal']==="") {                             
                    //          $error_status      = true;
                    //          $errors['receiptNumber'] = 'Exchange Receipt Details are Required';
                    //     } else {                 
                           
                    //         if ($shars->has_insufficient_balance($this->remove_commas($fields['prvlkrtotal']), 
                    //             $this->remove_commas($fields['lkrtotal']))){
                    //             $error_status      = true;
                    //             $errors['lkrtotal'] = 'Total LKR Amount Exceeds Previously Received Amount';
                    //         } else{
                    //            $errors['receiptNumber'] = ""; 
                    //         }

                                
                    //     }
                    // }

                    // ###VALIDATION:REFUND AMOUNT
                                  
                           
                    if ($shars->has_insufficient_balance($this->remove_commas($fields['receivedAmount']), 
                                $this->remove_commas($fields['customertotal']))){
                                $error_status      = true;
                                $errors['refundAmount'] = 'Invalid Refund Amount';
                            } else{
                               $errors['refundAmount'] = ""; 
                            }

                     
                    

                    // ###VALIDATION:UIN TYPE
                    if ($fields['title']==="") {
                        $error_status      = true;
                        $errors['title'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['title'] = "";
                    }

                    ###VALIDATION:NAME
                    if ($fields['fname']==="") {
                        $error_status      = true;
                        $errors['fname'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('fname', $fields['fname']) ) {
                         $error_status = true;
                         $errors["fname"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['fname'] = "";
                    }


                    ###VALIDATION:NAME
                    if ($fields['custaddr1']==="") {
                        $error_status      = true;
                        $errors['custaddr1'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('custaddr1', $fields['custaddr1']) ) {
                         $error_status = true;
                         $errors["custaddr1"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['custaddr1'] = "";
                    }


                    ###VALIDATION:ITRS CODE
                    if ($fields['itrscode']==="") {
                        $error_status      = true;
                        $errors['itrscode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['itrscode'] = "";
                    }



                    ###VALIDATION:ITRS CODE
                    if ($fields['accounttypecode']==="") {
                        $error_status      = true;
                        $errors['accounttypecode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accounttypecode'] = "";
                    }
                    
                    ###VALIDATION:ITRS CODE
                    if ($fields['sectorcode']==="") {
                        $error_status      = true;
                        $errors['sectorcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['sectorcode'] = "";
                    } 


                    ###VALIDATION:ITRS CODE
                    if ($fields['majorcountry']==="") {
                        $error_status      = true;
                        $errors['majorcountry'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['majorcountry'] = "";
                    }

                    ###VALIDATION:CURRENCIES
                    if ($fields['currency1']==="" && $fields['currency2']==="" && $fields['currency3']==="" && $fields['currency4']==="" ) {
                        $error_status  = true;
                        $errors["icurrencyselector1"] = ER_MSG_REQUIRED_FIELD; 
                    } else {
                        $errors["icurrencyselector1"] = "";
                    }


                    
                    if ($fields['currency1']===""){
                        //
                    } else {
                        if ($fields['tamount1']==="") {
                            $error_status      = true;
                            $errors['tamount1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount1'] = "";
                        }

                        if ($fields['rate1']==="") {
                            $error_status      = true;
                            $errors['rate1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate1'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate1'] = ""; 
                            }
                        }
                    }


                    if ($fields['currency2']===""){
                        //
                    } else {
                        if ($fields['tamount2']==="") {
                            $error_status      = true;
                            $errors['tamount2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount2'] = "";
                        }

                        if ($fields['rate2']==="") {
                            $error_status      = true;
                            $errors['rate2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate2']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate2'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate2'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency3']===""){
                        //
                    } else {
                        if ($fields['tamount3']==="") {
                            $error_status      = true;
                            $errors['tamount3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount3'] = "";
                        }

                        if ($fields['rate3']==="") {
                            $error_status      = true;
                            $errors['rate3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate3']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate3'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate3'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency4']===""){
                        //
                    } else {
                        if ($fields['tamount4']==="") {
                            $error_status      = true;
                            $errors['tamount4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount4'] = "";
                        }

                        if ($fields['rate4']==="") {
                            $error_status      = true;
                            $errors['rate4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate4']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate4'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate4'] = ""; 
                            }
                        }
                    }



                    





                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }
            $this->handle_json_response($resdta, $return_json);
        }
    } 

       /*******************************************************************************
     * Validate FCR Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_FCI_txn()
    {
        

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();

                    ###VALIDATION: uin type
                    if ($fields['uinidtype']==="") {
                        $error_status      = true;
                        $errors['uintype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uintype'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['uinnumber']==="") {
                        $error_status      = true;
                        $errors['uinnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uinnumber'] = "";
                    }
                

                    // ###VALIDATION:UIN TYPE                 

                    

                    if ($fields['accountnumber']==="") {
                        
                        $error_status      = true;
                        $errors['accountnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        if ($fields['account-status']==="5"){
                           $error_status      = true;
                           $errors['accountnumber'] = 'Account is Dormant'; 
                        
                        } else if($fields['account-status']==="8"){
                           $error_status      = true;
                           $errors['accountnumber'] = 'Account is Deceased'; 
                        } else {
                                
      
                                    if ($fields['accbalance']<0){
                                    $error_status      = true;
                                        $errors['accountnumber'] = 'Account Balance is Not Sufficient';
                                    } else {
                                    
                                    if ($shars->has_insufficient_balance($this->remove_commas($fields['accbalance']), 
                                        $this->remove_commas($fields['lkrtotal'])))
                                    {
                                        $error_status      = true;
                                        $errors['accountnumber'] = 'Account Balance is Not Sufficient';
                                    } else{
                                       $errors['accountnumber'] = ""; 
                                    }

                                    }     

                                    
                            

                        }
                        
                        
                    }

                  

                    // ###VALIDATION:UIN TYPE
                    if ($fields['title']==="") {
                        $error_status      = true;
                        $errors['title'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['title'] = "";
                    }

                    ###VALIDATION:NAME
                    if ($fields['fname']==="") {
                        $error_status      = true;
                        $errors['fname'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('fname', $fields['fname']) ) {
                         $error_status = true;
                         $errors["fname"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['fname'] = "";
                    }


                    ###VALIDATION:NAME
                    if ($fields['custaddr1']==="") {
                        $error_status      = true;
                        $errors['custaddr1'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('custaddr1', $fields['custaddr1']) ) {
                         $error_status = true;
                         $errors["custaddr1"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['custaddr1'] = "";
                    }


                    ###VALIDATION:ITRS CODE
                    if ($fields['itrscode']==="") {
                        $error_status      = true;
                        $errors['itrscode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['itrscode'] = "";
                    }



                    ###VALIDATION:ITRS CODE
                    if ($fields['accounttypecode']==="") {
                        $error_status      = true;
                        $errors['accounttypecode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accounttypecode'] = "";
                    }
                    
                    ###VALIDATION:ITRS CODE
                    if ($fields['sectorcode']==="") {
                        $error_status      = true;
                        $errors['sectorcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['sectorcode'] = "";
                    } 


                    ###VALIDATION:ITRS CODE
                    if ($fields['majorcountry']==="") {
                        $error_status      = true;
                        $errors['majorcountry'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['majorcountry'] = "";
                    }

                    ###VALIDATION:CURRENCIES
                    if ($fields['currency1']==="" && $fields['currency2']==="" && $fields['currency3']==="" && $fields['currency4']==="" ) {
                        $error_status  = true;
                        $errors["icurrencyselector1"] = ER_MSG_REQUIRED_FIELD; 
                    } else {
                        $errors["icurrencyselector1"] = "";
                    }


                    
                    if ($fields['currency1']===""){
                        //
                    } else {
                        if ($fields['tamount1']==="") {
                            $error_status      = true;
                            $errors['tamount1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount1'] = "";
                        }

                        if ($fields['rate1']==="") {
                            $error_status      = true;
                            $errors['rate1'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate1']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate1'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate1'] = ""; 
                            }
                        }
                    }


                    if ($fields['currency2']===""){
                        //
                    } else {
                        if ($fields['tamount2']==="") {
                            $error_status      = true;
                            $errors['tamount2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount2'] = "";
                        }

                        if ($fields['rate2']==="") {
                            $error_status      = true;
                            $errors['rate2'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate2']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate2'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate2'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency3']===""){
                        //
                    } else {
                        if ($fields['tamount3']==="") {
                            $error_status      = true;
                            $errors['tamount3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount3'] = "";
                        }

                        if ($fields['rate3']==="") {
                            $error_status      = true;
                            $errors['rate3'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate3']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate3'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate3'] = ""; 
                            }
                        }
                    }

                    if ($fields['currency4']===""){
                        //
                    } else {
                        if ($fields['tamount4']==="") {
                            $error_status      = true;
                            $errors['tamount4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            $errors['tamount4'] = "";
                        }

                        if ($fields['rate4']==="") {
                            $error_status      = true;
                            $errors['rate4'] = ER_MSG_REQUIRED_FIELD;
                        } else {
                            if ($fields['rate4']==="0.0000000"){
                                $error_status      = true;
                                $errors['rate4'] = 'Invalid exchange rate';

                            } else{
                               $errors['rate4'] = ""; 
                            }
                        }
                    }






                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }
            $this->handle_json_response($resdta, $return_json);
        }
    }


         /*******************************************************************************
     * Validate FCR Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_txn_view()
    {
        
        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();


                    ###VALIDATION: From date
                    if ($fields['fromdate']==="") {
                        $error_status      = true;
                        $errors['fromdate'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['fromdate'] = "";
                    }

                    ###VALIDATION: To date
                    if ($fields['todate']==="") {
                        $error_status      = true;
                        $errors['todate'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['todate'] = "";
                    }


                    ###VALIDATION:txn Type
                    if ($fields['hiddentxntype']==="") {
                        $error_status      = true;
                        $errors['txntype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['txntype'] = "";
                    }

                    ###VALIDATION:txn Status
                    if ($fields['hiddentxnstatus']==="") {
                        $error_status      = true;
                        $errors['txnstatus'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['txnstatus'] = "";
                    }
                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }

            $this->handle_json_response($resdta, $return_json);
        }
    }

           /*******************************************************************************
     * Validate FCR Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_PFC_txn()
    {
        

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else { 
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //permission check
                $fields = [];  
                $error_status = false; 
                $errors = []; 
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $this->load->model('app/Specialchars_model');
                    $shars = new Specialchars_model();

                    ###VALIDATION: uin type
                    if ($fields['uinidtype']==="") {
                        $error_status      = true;
                        $errors['uintype'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uintype'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['uinnumber']==="") {
                        $error_status      = true;
                        $errors['uinnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['uinnumber'] = "";
                    }
                

                    // ###VALIDATION:UIN TYPE                 

                    

                    if ($fields['accountnumber']==="") {
                        
                        $error_status      = true;
                        $errors['accountnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {

                        if ($fields['account-status']==="5"){
                           $error_status      = true;
                           $errors['accountnumber'] = 'Account is Dormant'; 
                        } else if($fields['account-status']==="8"){
                           $error_status      = true;
                           $errors['accountnumber'] = 'Account is Deceased'; 
                        } else {
                                

                            if ($fields['accbalance']<0){
                                $error_status      = true;
                                $errors['accountnumber'] = 'Account Balance is Not Sufficient';
                            } else {

                                if ($shars->has_insufficient_balance($this->remove_commas($fields['accbalance']), 
                                    $this->remove_commas($fields['tamount1']))){
                                    $error_status      = true;
                                    $errors['accountnumber'] = 'Account Balance is Not Sufficient';
                                } else{
                                   $errors['accountnumber'] = ""; 
                                }

                            }                                 
                            

                        }
                        
                        
                    }

                  

                    // ###VALIDATION:UIN TYPE
                    if ($fields['title']==="") {
                        $error_status      = true;
                        $errors['title'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['title'] = "";
                    }

                    ###VALIDATION:NAME
                    if ($fields['fname']==="") {
                        $error_status      = true;
                        $errors['fname'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('fname', $fields['fname']) ) {
                         $error_status = true;
                         $errors["fname"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['fname'] = "";
                    }


                    ###VALIDATION:NAME
                    if ($fields['custaddr1']==="") {
                        $error_status      = true;
                        $errors['custaddr1'] = ER_MSG_REQUIRED_FIELD;
                    } else if ( $shars->has_invalid_chars('custaddr1', $fields['custaddr1']) ) {
                         $error_status = true;
                         $errors["custaddr1"] = ER_MSG_INVALID_CHARS;
                    } else {
                        $errors['custaddr1'] = "";
                    }


                    ###VALIDATION:ITRS CODE
                    if ($fields['itrscode']==="") {
                        $error_status      = true;
                        $errors['itrscode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['itrscode'] = "";
                    }



                    ###VALIDATION:ITRS CODE
                    if ($fields['accounttypecode']==="") {
                        $error_status      = true;
                        $errors['accounttypecode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accounttypecode'] = "";
                    }
                    
                    ###VALIDATION:ITRS CODE
                    if ($fields['sectorcode']==="") {
                        $error_status      = true;
                        $errors['sectorcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['sectorcode'] = "";
                    } 


                    ###VALIDATION:ITRS CODE
                    if ($fields['majorcountry']==="") {
                        $error_status      = true;
                        $errors['majorcountry'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['majorcountry'] = "";
                    }

                      ###VALIDATION:TRANSACTION AMOUNT

                    if ($fields['tamount1']==="") {
                            $error_status      = true;
                            $errors['tamount1'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                            $errors['tamount1'] = "";
                    }

                       ###VALIDATION:CURRENCY

                    if ($fields['icurrency']==="") {
                            $error_status      = true;
                            $errors['icurrency'] = ER_MSG_REQUIRED_FIELD;
                    } else {

                        if ($fields['icurrency']!==$fields['currtype']) {
                                $error_status      = true;
                                $errors['icurrency'] = 'Account currency type is not matched with issuing currency';
                        }else if ($fields['currtype']  == 'LKR') {
                                $error_status      = true;
                                $errors['icurrency'] = 'Account currency type cannot be LKR';
                        } else {
                                 $errors['icurrency'] = "";
                        }

                             
                    }

                   
                    
                    $resdta->unexpected = false;

                    if ($error_status) {
                        $resdta->success = false;
                    } else {
                        $resdta->success = true;
                    }

                    $resdta->field_errors = $errors;

                } else {
                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                                "message"     => ER_MSG_INVALID_DATA_FOUND,
                                "description" => '',
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                //"chanel"=> strtolower($this->channelcode),
                                "event" => "",
                                ]],
                                ]);   
                }

            } else {
                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                            "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                            "description" => '',
                            "buttons"     => 
                            [[
                            "id"    => "id-okbtn",
                            "loader"=> "",
                            "icon"  => "",
                            "url"   => $this->config->item('base_url')."requests?usr=1&req=mn&shw=true",
                            "name"  => "OK",
                            "class" => "ap-btn ap-btn-modal",
                           // "chanel"=> strtolower($this->channelcode),
                            "event" => "",
                            ]],
                            ]);   
            }
            $this->handle_json_response($resdta, $return_json);
        }
    }   
      /*******************************************************************************
     * Save Request Data
     *
     * @return 
    *******************************************************************************/
    public function save_FCP_txn()
    {


        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else {
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //  if (Auth::has_permission('message_creation')) {
                $fields = []; 
                $data_string = $this->get_json_input('formArray');
                $action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);

                    $dataArray = $this->get_dataArray_FCP($fields);
                   
                    $data = $this->payment->save_transaction_request($dataArray);
                    if (!$data->errorStatus) {

                    # saved successfully
                        $message = SC_TXN_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Transaction Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."transaction/print/internationTxn?txnNo=".$data->bankReference,
                                // "url" => "javascript:window.print()",
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                "event" => "",
                                ]
                                ],
                                ]);
                    } else {            
                    # error found in saving data

                        $log_status = 'F';
                        $log_description = $data->errorMessage;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->errorMessage,
                        "description" => '',
                        "buttons"     => 
                        [[
                        "id"    => "id-okbtn",
                        "loader"=> "",
                        "icon"  => "",
                        "url"   => $this->config->item('base_url')."dashboard",
                        "name"  => "OK",
                        "class" => "ap-btn ap-btn-modal",
                        "event" => "",
                        ]],
                        ]);    
                    }

                } else {

                    $log_status = 'F';
                    $log_description = ER_MSG_INVALID_DATA_FOUND;

                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                    "message"     => ER_MSG_INVALID_DATA_FOUND,
                    "description" => '',
                    "buttons"     => 
                    [[
                    "id"    => "id-okbtn",
                    "loader"=> "",
                    "icon"  => "",
                    "url"   => $this->config->item('base_url')."dashboard",
                    "name"  => "OK",
                    "class" => "ap-btn ap-btn-modal",
                    "event" => "",
                    ]],
                    ]);   
                }

            } else {

                $log_status = 'F';
                $log_description = ER_MSG_FUNCTION_IS_BLOCKED;

                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                "description" => '',
                "buttons"     => 
                [[
                "id"    => "id-okbtn",
                "loader"=> "",
                "icon"  => "",
                "url"   => $this->config->item('base_url')."dashboard",
                "name"  => "OK",
                "class" => "ap-btn ap-btn-modal",
                "event" => "",
                ]],
                ]);   
            }

        $this->handle_json_response($resdta, $return_json); 

        }
    }
    

       /*******************************************************************************
     * Save Request Data
     *
     * @return 
    *******************************************************************************/
    public function save_FCS_txn()
    {

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else {
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //  if (Auth::has_permission('message_creation')) {
                $fields = []; 
                $data_string = $this->get_json_input('formArray');
                $action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $dataArray = $this->get_dataArray_FCS($fields);

                    $data = $this->payment->save_transaction_request($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                      //  print_r('success'); die();
                        $message = SC_TXN_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Transaction Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."transaction/print/internationTxn?txnNo=".$data->bankReference,
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                "event" => "",
                                ]
                                ],
                                ]);
                    } else {            
                    # error found in saving data

                        $log_status = 'F';
                        $log_description = $data->errorMessage;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->errorMessage,
                        "description" => '',
                        "buttons"     => 
                        [[
                        "id"    => "id-okbtn",
                        "loader"=> "",
                        "icon"  => "",
                        "url"   => $this->config->item('base_url')."dashboard",
                        "name"  => "OK",
                        "class" => "ap-btn ap-btn-modal",
                        "event" => "",
                        ]],
                        ]);    
                    }

                } else {

                    $log_status = 'F';
                    $log_description = ER_MSG_INVALID_DATA_FOUND;

                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                    "message"     => ER_MSG_INVALID_DATA_FOUND,
                    "description" => '',
                    "buttons"     => 
                    [[
                    "id"    => "id-okbtn",
                    "loader"=> "",
                    "icon"  => "",
                    "url"   => $this->config->item('base_url')."dashboard",
                    "name"  => "OK",
                    "class" => "ap-btn ap-btn-modal",
                    "event" => "",
                    ]],
                    ]);   
                }

            } else {

                $log_status = 'F';
                $log_description = ER_MSG_FUNCTION_IS_BLOCKED;

                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                "description" => '',
                "buttons"     => 
                [[
                "id"    => "id-okbtn",
                "loader"=> "",
                "icon"  => "",
                "url"   => $this->config->item('base_url')."dashboard",
                "name"  => "OK",
                "class" => "ap-btn ap-btn-modal",
                "event" => "",
                ]],
                ]);   
            }

        $this->handle_json_response($resdta, $return_json); 

        }
    }



        /*******************************************************************************
     * Save Request Data
     *
     * @return 
    *******************************************************************************/
    public function save_FCR_txn()
    {

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else {
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //  if (Auth::has_permission('message_creation')) {
                $fields = []; 
                $data_string = $this->get_json_input('formArray');
                $action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $dataArray = $this->get_dataArray_FCR($fields);

                    $data = $this->payment->save_transaction_request($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                      //  print_r('success'); die();
                        $message = SC_TXN_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Transaction Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."transaction/print/internationTxn?txnNo=".$data->bankReference,
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                "event" => "",
                                ]
                                ],
                                ]);
                    } else {            
                    # error found in saving data

                        $log_status = 'F';
                        $log_description = $data->errorMessage;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->errorMessage,
                        "description" => '',
                        "buttons"     => 
                        [[
                        "id"    => "id-okbtn",
                        "loader"=> "",
                        "icon"  => "",
                        "url"   => $this->config->item('base_url')."dashboard",
                        "name"  => "OK",
                        "class" => "ap-btn ap-btn-modal",
                        "event" => "",
                        ]],
                        ]);    
                    }

                } else {

                    $log_status = 'F';
                    $log_description = ER_MSG_INVALID_DATA_FOUND;

                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                    "message"     => ER_MSG_INVALID_DATA_FOUND,
                    "description" => '',
                    "buttons"     => 
                    [[
                    "id"    => "id-okbtn",
                    "loader"=> "",
                    "icon"  => "",
                    "url"   => $this->config->item('base_url')."dashboard",
                    "name"  => "OK",
                    "class" => "ap-btn ap-btn-modal",
                    "event" => "",
                    ]],
                    ]);   
                }

            } else {

                $log_status = 'F';
                $log_description = ER_MSG_FUNCTION_IS_BLOCKED;

                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                "description" => '',
                "buttons"     => 
                [[
                "id"    => "id-okbtn",
                "loader"=> "",
                "icon"  => "",
                "url"   => $this->config->item('base_url')."dashboard",
                "name"  => "OK",
                "class" => "ap-btn ap-btn-modal",
                "event" => "",
                ]],
                ]);   
            }

        $this->handle_json_response($resdta, $return_json); 

        }
    }

       /*******************************************************************************
     * Save Request Data
     *
     * @return 
    *******************************************************************************/
    public function save_FCI_txn()
    {

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else {
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //  if (Auth::has_permission('message_creation')) {
                $fields = []; 
                $data_string = $this->get_json_input('formArray');
                $action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $dataArray = $this->get_dataArray_FCI($fields);

                    $data = $this->payment->save_transaction_request($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                      //  print_r('success'); die();
                        $message = SC_TXN_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Transaction Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."transaction/print/internationTxn?txnNo=".$data->bankReference,
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                "event" => "",
                                ]
                                ],
                                ]);
                    } else {            
                    # error found in saving data

                        $log_status = 'F';
                        $log_description = $data->errorMessage;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->errorMessage,
                        "description" => '',
                        "buttons"     => 
                        [[
                        "id"    => "id-okbtn",
                        "loader"=> "",
                        "icon"  => "",
                        "url"   => $this->config->item('base_url')."dashboard",
                        "name"  => "OK",
                        "class" => "ap-btn ap-btn-modal",
                        "event" => "",
                        ]],
                        ]);    
                    }

                } else {

                    $log_status = 'F';
                    $log_description = ER_MSG_INVALID_DATA_FOUND;

                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                    "message"     => ER_MSG_INVALID_DATA_FOUND,
                    "description" => '',
                    "buttons"     => 
                    [[
                    "id"    => "id-okbtn",
                    "loader"=> "",
                    "icon"  => "",
                    "url"   => $this->config->item('base_url')."dashboard",
                    "name"  => "OK",
                    "class" => "ap-btn ap-btn-modal",
                    "event" => "",
                    ]],
                    ]);   
                }

            } else {

                $log_status = 'F';
                $log_description = ER_MSG_FUNCTION_IS_BLOCKED;

                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                "description" => '',
                "buttons"     => 
                [[
                "id"    => "id-okbtn",
                "loader"=> "",
                "icon"  => "",
                "url"   => $this->config->item('base_url')."dashboard",
                "name"  => "OK",
                "class" => "ap-btn ap-btn-modal",
                "event" => "",
                ]],
                ]);   
            }

        $this->handle_json_response($resdta, $return_json); 

        }
    }

           /*******************************************************************************
     * Save Request Data
     *
     * @return 
    *******************************************************************************/
    public function save_PFC_txn()
    {

        if ($this->is_get()) {        
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        } else {
            $resdta = new stdClass();
            $return_json = true;      
            if (true) { //  if (Auth::has_permission('message_creation')) {
                $fields = []; 
                $data_string = $this->get_json_input('formArray');
                $action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);
                    $dataArray = $this->get_dataArray_PFC($fields);

                    $data = $this->payment->save_transaction_request($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                      //  print_r('success'); die();
                        $message = SC_TXN_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Transaction Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."transaction/print/internationTxn?txnNo=".$data->bankReference,
                                "name"  => "OK",
                                "class" => "ap-btn ap-btn-modal",
                                "event" => "",
                                ]
                                ],
                                ]);
                    } else {            
                    # error found in saving data

                        $log_status = 'F';
                        $log_description = $data->errorMessage;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->errorMessage,
                        "description" => '',
                        "buttons"     => 
                        [[
                        "id"    => "id-okbtn",
                        "loader"=> "",
                        "icon"  => "",
                        "url"   => $this->config->item('base_url')."dashboard",
                        "name"  => "OK",
                        "class" => "ap-btn ap-btn-modal",
                        "event" => "",
                        ]],
                        ]);    
                    }

                } else {

                    $log_status = 'F';
                    $log_description = ER_MSG_INVALID_DATA_FOUND;

                    $resdta->unexpected = true;
                    $resdta->message_skelton = $this->get_error_message([
                    "message"     => ER_MSG_INVALID_DATA_FOUND,
                    "description" => '',
                    "buttons"     => 
                    [[
                    "id"    => "id-okbtn",
                    "loader"=> "",
                    "icon"  => "",
                    "url"   => $this->config->item('base_url')."dashboard",
                    "name"  => "OK",
                    "class" => "ap-btn ap-btn-modal",
                    "event" => "",
                    ]],
                    ]);   
                }

            } else {

                $log_status = 'F';
                $log_description = ER_MSG_FUNCTION_IS_BLOCKED;

                $resdta->unexpected = true;
                $resdta->message_skelton = $this->get_error_message([
                "message"     => ER_MSG_FUNCTION_IS_BLOCKED,
                "description" => '',
                "buttons"     => 
                [[
                "id"    => "id-okbtn",
                "loader"=> "",
                "icon"  => "",
                "url"   => $this->config->item('base_url')."dashboard",
                "name"  => "OK",
                "class" => "ap-btn ap-btn-modal",
                "event" => "",
                ]],
                ]);   
            }

        $this->handle_json_response($resdta, $return_json); 

        }
    }



    /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function print_international_txn()
    {
        if (true) {       

        $txnNo = $this->input->get('txnNo', TRUE);
        $duplicate = $this->input->get('duplicate', TRUE);

        if(isset($duplicate)){
                $data['dupflag']    = $duplicate;
            }    
        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/transaction/print', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
        
        

   
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }
    /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function print_exception_txn()
    {
        if (true) {       

        $txnNo = $this->input->get('txnNo', TRUE);
          
        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/transaction/print_exception', $data, true);
        $data['title'] = 'View Exception Transaction | '.$txnNo;    
        

   
        $data['route'] = 'transaction';
        $data['controller'] = 'Txn';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

        /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function delete_international_txn()
    {
        if (true) {  
                $data['route'] = 'transaction';
                $data['controller'] = 'Txn';
                $data['dir'] = 'app/transaction';
                $data['angular'] = true;
                    

        $txnNo = $this->input->get('txnNo', TRUE);

        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        
        $data['body'] = $this->load->view('app/transaction/delete_transaction', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
   
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

         /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function cancel_international_txn()
    {
        if (true) {  
                $data['route'] = 'transaction';
                $data['controller'] = 'Txn';
                $data['dir'] = 'app/transaction';
                $data['angular'] = true;
                    

        $txnNo = $this->input->get('txnNo', TRUE);

        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/transaction/cancel_transaction', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
   
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

          /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function view_international_txn()
    {
        if (true) { 
                $data['route'] = 'transaction';
                $data['controller'] = 'Txn';
                $data['dir'] = 'app/transaction';
                $data['angular'] = true;      

        $txnNo = $this->input->get('txnNo', TRUE);
        
          
        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/transaction/view_print', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
        
        
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }
          /*******************************************************************************
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function view_exception_txn()
    {
        if (true) { 
                $data['route'] = 'transaction';
                $data['controller'] = 'Txn';
                $data['dir'] = 'app/transaction';
                $data['angular'] = true;      

        $txnNo = $this->input->get('txnNo', TRUE);
        
          
        $dataArray = array ('txnRef' => $txnNo);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/transaction/view_exception', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
        
        
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

    /*******************************************************************************
     * Verify Receipt number
     *
     * @return 
    *******************************************************************************/
    public function verifyReceiptNumber()
    {
        $receiptNumber          = $this->get_json_input('receiptNumber');
        $receiptArray   = array('receiptNumber' => $receiptNumber); 
        $receiptNumber = $this->payment->get_exchange_receipt_number($receiptArray);
       // print_r($receiptNumber); die
        echo json_encode($receiptNumber); 
    
    }

    /*******************************************************************************
     * Get Account Data
     *
     * @return 
    *******************************************************************************/
    public function get_accountData()
    {
        
        $accountnumber         = $this->get_json_input('accnumber');        
        $accountArray   = array('accountnumber' => $accountnumber);
        $accountData= $this->payment->get_accountData($accountArray);
    
        echo json_encode($accountData); 
    }

    /*******************************************************************************
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function state_change_request()
    {
        // if (Auth::has_permission('request_verification')) {
        if (true) {
        //give access only to role==B
        $reference  = $this->get_json_input('reference');
        $hostname   = $this->get_computer_name();
        $ip         = $this->get_current_user_ip();
        $userId     = $this->session->userdata('username');
       
        if ($this->get_json_input('reason')){
            $reason = $this->get_json_input('reason');
        } else {
            $reason = null;
        }
        
        $resdta = new stdClass();

        if (isset($reference)) {

        $dataArray = array(
            'txnRef'        => $reference,
            'user'          => $userId,
            'reason'        => $reason,
            'ip'            => $ip,
            'hostname'      => $hostname
        );


        $data = $this->payment->change_tansaction_state($dataArray);
        

        $resdta->error_status = $data->errorStatus;
        $resdta->error_message = $data->errorMessage;

        if (!$data->errorStatus) {
        //success
        }
                
        } else {
        $resdta->error_status = true;
        $resdta->error_message = "Invalid Request: Reference number cannot be found.";
        }       

        echo json_encode($resdta); 

        } else {
        $this->show_error('permission', '403');   
        }
    }   

     /*******************************************************************************
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function approve_cancel_transaction_request()
    {
        // if (Auth::has_permission('request_verification')) {
        if (true) {
        //give access only to role==B
        $reference  = $this->get_json_input('reference');
        $hostname   = $this->get_computer_name();
        $ip         = $this->get_current_user_ip();
        $userId     = $this->session->userdata('username');
       
        if ($this->get_json_input('reason')){
            $reason = $this->get_json_input('reason');
        } else {
            $reason = null;
        }
        
        $resdta = new stdClass();

        if (isset($reference)) {

        $dataArray = array(
            'txnRef'        => $reference,
            'user'          => $userId,
            'reason'        => $reason,
            'ip'            => $ip,
            'hostname'      => $hostname
        );


        $data = $this->payment->approve_cancel_transaction_request($dataArray);
        

        $resdta->error_status = $data->errorStatus;
        $resdta->error_message = $data->errorMessage;

        if (!$data->errorStatus) {
        //success
        }
                
        } else {
        $resdta->error_status = true;
        $resdta->error_message = "Invalid Request: Reference number cannot be found.";
        }       

        echo json_encode($resdta); 

        } else {
        $this->show_error('permission', '403');   
        }
    }

       /*******************************************************************************
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function reject_cancel_transaction_request()
    {
        // if (Auth::has_permission('request_verification')) {
        if (true) {
        //give access only to role==B
        $reference  = $this->get_json_input('reference');
        $hostname   = $this->get_computer_name();
        $ip         = $this->get_current_user_ip();
        $userId     = $this->session->userdata('username');
       
        if ($this->get_json_input('reason')){
            $reason = $this->get_json_input('reason');
        } else {
            $reason = null;
        }
        
        $resdta = new stdClass();

        if (isset($reference)) {

        $dataArray = array(
            'txnRef'        => $reference,
            'user'          => $userId,
            'reason'        => $reason,
            'ip'            => $ip,
            'hostname'      => $hostname
        );


        $data = $this->payment->reject_cancel_transaction_request($dataArray);
        

        $resdta->error_status = $data->errorStatus;
        $resdta->error_message = $data->errorMessage;

        if (!$data->errorStatus) {
        //success
        }
                
        } else {
        $resdta->error_status = true;
        $resdta->error_message = "Invalid Request: Reference number cannot be found.";
        }       

        echo json_encode($resdta); 

        } else {
        $this->show_error('permission', '403');   
        }
    }
    /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_FCP($fields=[])
    {

        $dataArray_FCP = [];
       // print_r('ddd'); die();  
        $dataArray_FCP = array(
       'uincode'              => $fields['uinidtype'],
        'referrence'           => $this->create_reference(),
        'txntype'              => $fields['txntype'],
        'uinnumber'            => $fields['uinnumber'],
        'title'                => $fields['title'],
        'fname'                => $fields['fname'],
        'custaddr1'            => $fields['custaddr1'],
        'userTill'             => $fields['usertill'],
        'natureOfTxnCode'      => $fields['natureOfTxnCode'],
        'commisionAmount'      => $this->get_commision($fields),
        'commisionpercentage'  => $this->get_commision_percentage($fields),
        'itrscode'             => $fields['itrscodehidden'],
        'accounttypecode'      => $fields['accounttypecodehidden'],
        'sectorcode'           => $fields['sectorcode'],
        'majorcountry'         => $fields['majorcountryhidden'],
        'icurrencyselector1'   => $fields['currency1'],
        'icurrencyselector2'   => $fields['currency2'],
        'icurrencyselector3'   => $fields['currency3'],
        'icurrencyselector4'   => $fields['currency4'],
        'rate1'                => $this->get_rate($fields['rate1']),
        'rate2'                => $this->get_rate($fields['rate2']),
        'rate3'                => $this->get_rate($fields['rate3']),
        'rate4'                => $this->get_rate($fields['rate4']),
        'defaultRate1'         => $this->get_rate($fields['rate1-default']),
        'defaultRate2'         => $this->get_rate($fields['rate2-default']),
        'defaultRate3'         => $this->get_rate($fields['rate3-default']),
        'defaultRate4'         => $this->get_rate($fields['rate4-default']),
        // 'usdCrossRate1'        => $this->get_rate($fields['crossrate1']),
        // 'usdCrossRate2'        => $this->get_rate($fields['crossrate2']),
        // 'usdCrossRate3'        => $this->get_rate($fields['crossrate3']),
        // 'usdCrossRate4'        => $this->get_rate($fields['crossrate4']),
        'tamount1'             => $this->get_amount($fields['tamount1']),     
        'tamount2'             => $this->get_amount($fields['tamount2']),     
        'tamount3'             => $this->get_amount($fields['tamount3']),    
        'tamount4'             => $this->get_amount($fields['tamount4']),    
        'camount1'             => $this->get_amount($fields['camount1']),
        'camount2'             => $this->get_amount($fields['camount2']),
        'camount3'             => $this->get_amount($fields['camount3']),
        'camount4'             => $this->get_amount($fields['camount4']),
        // 'usdEqvAmount1'        => $this->get_amount($fields['crossamount1']),
        // 'usdEqvAmount2'        => $this->get_amount($fields['crossamount2']),
        // 'usdEqvAmount3'        => $this->get_amount($fields['crossamount3']),
        // 'usdEqvAmount4'        => $this->get_amount($fields['crossamount4']),
        'iamount1'             => $this->get_amount($fields['iamount1']),
        'iamount2'             => $this->get_amount($fields['iamount2']),
        'iamount3'             => $this->get_amount($fields['iamount3']),
        'iamount4'             => $this->get_amount($fields['iamount4']),
        'lkrtotal'             => $this->get_amount($fields['lkrtotal']),
        'inctotal'             => $this->get_amount($fields['incgltotal']),
        'ceilingFloorComm'     => $this->get_amount($fields['comgltotal']),
        'custotal'             => $this->get_amount($fields['customertotal']),
        'remarks'              => $fields['remarks'],
        'benename'             => $fields['benename'],
        'benecountry'          => $fields['benecountryhidden'],
        'benebank'             => $fields['benebankhidden'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );
        // print_r($dataArray_FCP); die();
        return $dataArray_FCP;
    } 
   
    /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_FCS($fields=[])
    {
        $dataArray_FCS = [];
      
        $dataArray_FCS = array(
        'uincode'              => $fields['uinidtype'],
        'referrence'           => $this->create_reference(),
        'txntype'              => $fields['txntype'],
        'uinnumber'            => $fields['uinnumber'],
        'title'                => $fields['title'],
        'fname'                => $fields['fname'],
        'custaddr1'            => $fields['custaddr1'],
        'userTill'             => $fields['usertill'],
        'natureOfTxnCode'      => $fields['natureOfTxnCode'],
        'commisionAmount'      => $this->get_commision($fields),
        'commisionpercentage'  => $this->get_commision_percentage($fields),
        'itrscode'             => $fields['itrscodehidden'],
        'accounttypecode'      => $fields['accounttypecodehidden'],
        'sectorcode'           => $fields['sectorcode'],
        'majorcountry'         => $fields['majorcountryhidden'],
        'icurrencyselector1'   => $fields['currency1'],
        'airTicketNo'          => $fields['airticketno'],
        // 'icurrencyselector3'   => $fields['currency3'],
        // 'icurrencyselector4'   => $fields['currency4'],
        'rate1'                => $this->get_rate($fields['rate1']),
        'defaultRate1'         => $this->get_rate($fields['rate1-default']),

        // 'rate2'                => $this->get_rate($fields['rate2']),
        // 'rate3'                => $this->get_rate($fields['rate3']),
        // 'rate4'                => $this->get_rate($fields['rate4']),
        // 'usdCrossRate1'        => $this->get_rate($fields['crossrate1']),
        // 'usdCrossRate2'        => $this->get_rate($fields['crossrate2']),
        // 'usdCrossRate3'        => $this->get_rate($fields['crossrate3']),
        // 'usdCrossRate4'        => $this->get_rate($fields['crossrate4']),
        'tamount1'             => $this->get_amount($fields['tamount1']),     
        // 'tamount2'             => $this->get_amount($fields['tamount2']),     
        // 'tamount3'             => $this->get_amount($fields['tamount3']),    
        // 'tamount4'             => $this->get_amount($fields['tamount4']),    
        'camount1'             => $this->get_amount($fields['camount1']),
        // 'camount2'             => $this->get_amount($fields['camount2']),
        // 'camount3'             => $this->get_amount($fields['camount3']),
        // 'camount4'             => $this->get_amount($fields['camount4']),
        // 'usdEqvAmount1'        => $this->get_amount($fields['crossamount1']),
        // 'usdEqvAmount2'        => $this->get_amount($fields['crossamount2']),
        // 'usdEqvAmount3'        => $this->get_amount($fields['crossamount3']),
        // 'usdEqvAmount4'        => $this->get_amount($fields['crossamount4']),
        // 'iamount1'             => $this->get_amount($fields['iamount1']),
        // 'iamount2'             => $this->get_amount($fields['iamount2']),
        // 'iamount3'             => $this->get_amount($fields['iamount3']),
        // 'iamount4'             => $this->get_amount($fields['iamount4']),
        'lkrtotal'             => $this->get_amount($fields['lkrtotal']),
        'airticketno'          => $this->get_amount($fields['airticketno']),
        'ceilingFloorComm'     => $this->get_amount($fields['comgltotal']),
        'custotal'             => $this->get_amount($fields['customertotal']),
        'receivedAmount'       => $this->get_amount($fields['receivedAmount']),
        'refundAmount'         => $fields['refundAmount'],
        'remarks'              => $fields['remarks'],
        'benename'             => $fields['benename'],
        'benecountry'          => $fields['benecountryhidden'],
        'benebank'             => $fields['benebankhidden'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );
            
        return $dataArray_FCS;
    }

     /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_FCR($fields=[])
    {
        $dataArray_FCR = [];
      
        $dataArray_FCR = array(
        'uincode'              => $fields['uinidtype'],
        'referrence'           => $this->create_reference(),
        'txntype'              => $fields['txntype'],
        'uinnumber'            => $fields['uinnumber'],
        'title'                => $fields['title'],
        'fname'                => $fields['fname'],
        'custaddr1'            => $fields['custaddr1'],
        'userTill'             => $fields['usertill'],
        'natureOfTxnCode'      => $fields['natureOfTxnCode'],
        'commisionAmount'      => $this->get_commision($fields),
        'commisionpercentage'  => $this->get_commision_percentage($fields),
        'itrscode'             => $fields['itrscodehidden'],
        'accounttypecode'      => $fields['accounttypecodehidden'],
        'sectorcode'           => $fields['sectorcode'],
        'majorcountry'         => $fields['majorcountryhidden'],
        'icurrencyselector1'   => $fields['currency1'],
        'airTicketNo'          => $fields['airticketno'],
        // 'icurrencyselector2'   => $fields['currency2'],
        // 'icurrencyselector3'   => $fields['currency3'],
        // 'icurrencyselector4'   => $fields['currency4'],
        'rate1'                => $this->get_rate($fields['rate1']),
        'defaultRate1'         => $this->get_rate($fields['rate1-default']),
        // 'rate2'                => $this->get_rate($fields['rate2']),
        // 'rate3'                => $this->get_rate($fields['rate3']),
        // 'rate4'                => $this->get_rate($fields['rate4']),
        // 'usdCrossRate1'        => $this->get_rate($fields['crossrate1']),
        // 'usdCrossRate2'        => $this->get_rate($fields['crossrate2']),
        // 'usdCrossRate3'        => $this->get_rate($fields['crossrate3']),
        // 'usdCrossRate4'        => $this->get_rate($fields['crossrate4']),
        'tamount1'             => $this->get_amount($fields['tamount1']),     
        // 'tamount2'             => $this->get_amount($fields['tamount2']),     
        // 'tamount3'             => $this->get_amount($fields['tamount3']),    
        // 'tamount4'             => $this->get_amount($fields['tamount4']),    
        'camount1'             => $this->get_amount($fields['camount1']),
        // 'camount2'             => $this->get_amount($fields['camount2']),
        // 'camount3'             => $this->get_amount($fields['camount3']),
        // 'camount4'             => $this->get_amount($fields['camount4']),
        // // 'usdEqvAmount1'        => $this->get_amount($fields['crossamount1']),
        // 'usdEqvAmount2'        => $this->get_amount($fields['crossamount2']),
        // 'usdEqvAmount3'        => $this->get_amount($fields['crossamount3']),
        // 'usdEqvAmount4'        => $this->get_amount($fields['crossamount4']),
        // 'iamount1'             => $this->get_amount($fields['iamount1']),
        // 'iamount2'             => $this->get_amount($fields['iamount2']),
        // 'iamount3'             => $this->get_amount($fields['iamount3']),
        // 'iamount4'             => $this->get_amount($fields['iamount4']),
        'lkrtotal'             => $this->get_amount($fields['lkrtotal']),
        // 'inctotal'             => $this->get_amount($fields['incgltotal']),
        'ceilingFloorComm'     => $this->get_amount($fields['comgltotal']),
        'custotal'             => $this->get_amount($fields['customertotal']),
        'receivedAmount'       => $this->get_amount($fields['receivedAmount']),
        'refundAmount'         => $fields['refundAmount'],
        'remarks'              => $fields['remarks'],
        'previousReceiptNo'    => $fields['receiptNumber'],
        'benename'             => $fields['benename'],
        'benecountry'          => $fields['benecountryhidden'],
        'benebank'             => $fields['benebankhidden'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );

            
        return $dataArray_FCR;
    } 

     /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_FCI($fields=[])
    {
        $dataArray_FCI = [];
      
        $dataArray_FCI = array(
        'uincode'              => $fields['uinidtype'],
        'referrence'           => $this->create_reference(),
        'txntype'              => $fields['txntype'],
        'uinnumber'            => $fields['uinnumber'],
        'title'                => $fields['title'],
        'fname'                => $fields['fname'],
        'accountnumber'        => $fields['accountnumber'],
        'custaddr1'            => $fields['custaddr1'],
        'userTill'             => $fields['usertill'],
        'natureOfTxnCode'      => $fields['natureOfTxnCode'],
        'commisionAmount'      => $this->get_commision($fields),
        'commisionpercentage'  => $this->get_commision_percentage($fields),
        'itrscode'             => $fields['itrscodehidden'],
        'accounttypecode'      => $fields['accounttypecodehidden'],
        'sectorcode'           => $fields['sectorcode'],
        'majorcountry'         => $fields['majorcountryhidden'],
        'icurrencyselector1'   => $fields['currency1'],
        'airTicketNo'          => $fields['airticketno'],
        // 'icurrencyselector2'   => $fields['currency2'],
        // 'icurrencyselector3'   => $fields['currency3'],
        // 'icurrencyselector4'   => $fields['currency4'],
        'rate1'                => $this->get_rate($fields['rate1']),
        'defaultRate1'         => $this->get_rate($fields['rate1-default']),
        // 'rate2'                => $this->get_rate($fields['rate2']),
        // 'rate3'                => $this->get_rate($fields['rate3']),
        // 'rate4'                => $this->get_rate($fields['rate4']),
        // 'usdCrossRate1'        => $this->get_rate($fields['crossrate1']),
        // 'usdCrossRate2'        => $this->get_rate($fields['crossrate2']),
        // 'usdCrossRate3'        => $this->get_rate($fields['crossrate3']),
        // 'usdCrossRate4'        => $this->get_rate($fields['crossrate4']),
        'tamount1'             => $this->get_amount($fields['tamount1']),     
        // 'tamount2'             => $this->get_amount($fields['tamount2']),     
        // 'tamount3'             => $this->get_amount($fields['tamount3']),    
        // 'tamount4'             => $this->get_amount($fields['tamount4']),    
        'camount1'             => $this->get_amount($fields['camount1']),
        // 'camount2'             => $this->get_amount($fields['camount2']),
        // 'camount3'             => $this->get_amount($fields['camount3']),
        // 'camount4'             => $this->get_amount($fields['camount4']),
        // 'usdEqvAmount1'        => $this->get_amount($fields['crossamount1']),
        // 'usdEqvAmount2'        => $this->get_amount($fields['crossamount2']),
        // 'usdEqvAmount3'        => $this->get_amount($fields['crossamount3']),
        // 'usdEqvAmount4'        => $this->get_amount($fields['crossamount4']),
        // 'iamount1'             => $this->get_amount($fields['iamount1']),
        // 'iamount2'             => $this->get_amount($fields['iamount2']),
        // 'iamount3'             => $this->get_amount($fields['iamount3']),
        // 'iamount4'             => $this->get_amount($fields['iamount4']),
        'lkrtotal'             => $this->get_amount($fields['lkrtotal']),
        // 'inctotal'             => $this->get_amount($fields['incgltotal']),
        'ceilingFloorComm'     => $this->get_amount($fields['comgltotal']),
        'custotal'             => $this->get_amount($fields['customertotal']),
        // 'receivedAmount'       => $this->get_amount($fields['receivedAmount']),
        // 'refundAmount'         => $this->get_amount($fields['refundAmount']),
        'remarks'              => $fields['remarks'],
        'account'              => $fields['accountnumber'],
        'benename'             => $fields['benename'],
        'benecountry'          => $fields['benecountryhidden'],
        'benebank'             => $fields['benebankhidden'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );
            
        return $dataArray_FCI;
    } 

     /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_PFC($fields=[])
    {
        $dataArray_FCI = [];
      
        $dataArray_FCI = array(
        'uincode'              => $fields['uinidtype'],
        'referrence'           => $this->create_reference(),
        'txntype'              => $fields['txntype'],
        'uinnumber'            => $fields['uinnumber'],
        'title'                => $fields['title'],
        'fname'                => $fields['fname'],
        'accountnumber'        => $fields['accountnumber'],
        'custaddr1'            => $fields['custaddr1'],
        'userTill'             => $fields['usertill'],
        'natureOfTxnCode'      => $fields['natureOfTxnCode'],
        'itrscode'             => $fields['itrscodehidden'],
        'accounttypecode'      => $fields['accounttypecodehidden'],
        'sectorcode'           => $fields['sectorcode'],
        'majorcountry'         => $fields['majorcountryhidden'],
        'icurrencyselector1'   => $fields['currtype'],
        'airTicketNo'          => $fields['airticketno'],
        'tamount1'             => $this->get_amount($fields['tamount1']),     
        'remarks'              => $fields['remarks'],
        'account'              => $fields['accountnumber'],
        'benename'             => $fields['benename'],
        'benecountry'          => $fields['benecountryhidden'],
        'benebank'             => $fields['benebankhidden'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );
            
        return $dataArray_FCI;
    } 


   /*******************************************************************************
     * Get Customer Data
     *
     * @return 
    *******************************************************************************/
    public function getCustomerData()
    {
        $uinType          = $this->get_json_input('uinType');
        $uinNumber        = $this->get_json_input('uinNumber');
        $uinArray   = array('uinType' => $uinType , 'uinNumber' => $uinNumber); 
        $customerData = $this->payment->get_customerData($uinArray);
        echo json_encode($customerData); 
    }
    /*******************************************************************************
     * Get Sector Codes Data
     *
     * @return 
    *******************************************************************************/
    public function getTransactionSectorCodes()
    {
        $uinType           = $this->get_json_input('uintype');
        $sectorArray   = array('uintype' => $uinType); 
        $sectorData= $this->payment->get_sectorCodesList($sectorArray);
        echo json_encode($sectorData); 
    }

     /*******************************************************************************
     * Get Exchnage Rates
     *
     * @return 
    *******************************************************************************/
    public function getExchangeRate()
    {
        $curCode          = $this->get_json_input('currency');
        $curShort        = $this->get_json_input('shortcode');
        $txnType        = $this->get_json_input('txntype');
        $exchangeRateArray   = array('currency' => $curCode , 'shortcode' => $curShort, 'txntype' => $txnType); 
        $exchangeRate = $this->payment->get_exchangeRate($exchangeRateArray);
        echo json_encode($exchangeRate); 
    }

     /*******************************************************************************
     * Get Remittance Data
     *
     * @return 
    *******************************************************************************/
    public function calculateWorkerRemittence()
    {
        $currency1           = $this->get_json_input('currency1');
        $currency2           = $this->get_json_input('currency2');
        $currency3           = $this->get_json_input('currency3');
        $currency4           = $this->get_json_input('currency4');
        $amount1             = $this->get_json_input('amount1');
        $amount2             = $this->get_json_input('amount2');
        $amount3             = $this->get_json_input('amount3');
        $amount4             = $this->get_json_input('amount4');   
        $incentiveArray   = array('currency1' => $currency1,
                                'currency2' => $currency2, 
                                'currency3' => $currency3, 
                                'currency4' => $currency4, 
                                'amount1' => $amount1, 
                                'amount2' => $amount2, 
                                'amount3' => $amount3, 
                                'amount4' => $amount4); 

        $incentiveData= $this->payment->get_workerRemittanceData($incentiveArray);
       // print_r($incentiveData);
        echo json_encode($incentiveData); 
    }

         /*******************************************************************************
     * Get Remittance Data
     *
     * @return 
    *******************************************************************************/
    public function calculateCommisionAmount()
    {
        $txnType           = $this->get_json_input('txnType');
        $passHolType       = $this->get_json_input('passHolType');
        $amount            = $this->get_json_input('amount');
          
        $commisionArray   = array('txnType' => $txnType,
                                'passHolType' => $passHolType, 
                                'amount' => $amount); 


        $commisionData= $this->payment->get_commissionData($commisionArray);
     //  print_r($commisionData); die();
        echo json_encode($commisionData); 
    }


    /*******************************************************************************
     * handle empty field
     *
     * @return string
    *******************************************************************************/
    protected function handle_benebank_field()
    {
        if (isset($fields['benebank'])){            
        return $fields['benebank']; 
        } else {
        return '0'; 
        } 
    }

    /*******************************************************************************
     * handle empty field
     *
     * @return string
    *******************************************************************************/
    protected function handle_benecountry_field()
    {
        if (isset($fields['benecountryhid'])){            
        return $fields['benecountryhid']; 
        } else {
        return ' '; 
        } 
    }

    /*******************************************************************************
     * handle empty field
     *
     * @return string
    *******************************************************************************/
    protected function handle_benename_field()
    {
        if (isset($fields['benename'])){            
        return $fields['benename']; 
        } else {
        return ''; 
        } 
    }


    /*******************************************************************************
     * get amount as a string
     *
     * @return string
    *******************************************************************************/
    protected function get_amount($amount)
    {
        if (!empty($amount)) {            
        return $this->remove_commas($amount); 
        } else {
        return '0.00'; 
        } 
    }
    /*******************************************************************************
     * get minus amount as a string
     *
     * @return string
    *******************************************************************************/
    protected function get_amount_minus($amount)
    {
        if (!empty($amount)) {            
        return $this->remove_commas_minus($amount); 
        } else {
        return '0.00'; 
     }
    } 

    /*******************************************************************************
     * get rate as a string
     *
     * @return string
    *******************************************************************************/
    protected function get_rate($rate)
    {
        if (!empty($rate)) {
        return number_format(floatval ($rate), 7); 
        } else {
        return number_format(floatval (trim('0.00')), 7);
        } 
    }


   /*******************************************************************************
     * get random number for BREFERENCE
     *
     * @return string
    *******************************************************************************/
    protected function create_reference( $len = 8 ) 
    {
        $rand   = '';
        while( !( isset( $rand[$len-1] ) ) ) {
            $rand   .= mt_rand( );
        }
        return 'T'.substr( $rand , 0 , $len );
    }
    /*******************************************************************************
     * get amount as a string
     *
     * @return string
    *******************************************************************************/
    public function get_commision($fields=[])
    {
        if ($fields['natureOfTxnCode'] == "2") {  
            return $this->get_amount($fields['commision']); ; 
        } else {
            return "0"; 
        }  
    }

    /*******************************************************************************
     * get amount as a string
     *
     * @return string
    *******************************************************************************/
    public function get_commision_percentage($fields=[])
    {
        if ($fields['natureOfTxnCode'] == "1") {            
         return "0"; 
        } else {

        return $this->get_amount($fields['commision-percentage']); 
        } 
    }

  
    
}



