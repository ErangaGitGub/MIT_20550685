<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Vault extends Base {

	protected $transaction;

	public function __construct(){
        parent::__construct();
        $this->load->model('app/Payment_model');
        $this->payment = new Payment_model();
    }


    /*******************************************************************************
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function transfer_T4StoPOS()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';

         $dataArray = array (  
           'txnType'         => "Domestic", 
           'brCode'          =>  $branchCode           
         );

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     
     
        $tillID = '1';
        $tillArray   = array('tillID' => $tillID);
        $data['list'] = $this->payment->get_currencyListWithBalances($tillArray); 


        $data['table_view'] = $this->load->view('app/vault/vault_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }
     /*******************************************************************************
     * Render view for transfer_POStoT4S
     *
     * @return view
    *******************************************************************************/
     public function transfer_POStoT4S()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';

         $dataArray = array (  
           'txnType'         => "Domestic", 
           'brCode'          =>  $branchCode           
         );

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     
     
        $tillID = '1';
        $tillArray   = array('tillID' => $tillID);
        $data['list'] = $this->payment->get_currencyListWithBalances($tillArray); 


        $data['table_view'] = $this->load->view('app/vault/vault_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

    /*******************************************************************************
     * Render view for transfer_POStoT4S
     *
     * @return view
    *******************************************************************************/
     public function transfer_POStoTILL()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $curCode          = $this->get_json_input('currency');
        $curShort        = $this->get_json_input('shortcode');
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = 'Transfer POS to TILL';

        $data['dir'] = 'app/vault';
        $data['route'] = 'user';
        $data['controller'] = 'Usr';

         $dataArray = array (  
           'txnType'         => "Domestic", 
           'brCode'          =>  $branchCode           
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);

        $tillID = '1';
        $data['sourcetill']    = $tillID;
        $tillArray   = array('tillID' => $tillID);
        $data['list'] = $this->payment->get_currencyListWithBalances($tillArray);

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/vault/till_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }


    /*******************************************************************************
     * Render view for transfer_POStoT4S
     *
     * @return view
    *******************************************************************************/
     public function transfer_TILLTOPOS()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = 'Transfer TILL TO POS';

        $data['dir'] = 'app/vault';
        $data['route'] = 'user';
        $data['controller'] = 'Usr';

         $dataArray = array (  
           'txnType'         => "Domestic", 
           'brCode'          =>  $branchCode           
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);

         $tillID = '1';
        $data['sourcetill']    = $tillID;
        $tillArray   = array('tillID' => $tillID);
        $data['list'] = $this->payment->get_currencyListWithBalances($tillArray);

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/vault/till_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }
     /*******************************************************************************
     * Render view for Transfer Till to Till 
     *
     * @return view
    *******************************************************************************/
     public function transfer_TilltoTill()
    {
    
           
         
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $user_till = $this->session->userdata('user_till');
        $user_till_desc = $this->session->userdata('user_till_desc');
      
       
        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';   
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
        // $data['sourcetill']    = '1';
        $data['title'] = 'TRANSFER CASH ';
       
        
        if(isset($user_till)){
            $data['sourcetill']    = $user_till;
         }
        if(isset($user_till_desc)){
            $data['sourcetillname']    = $user_till_desc;
         }

        // if($sourcetill=='1' && $destinationTill=='3'){
        //     $data['title'] = 'Transfer POS To Purchase Counter 01';    
        // } elseif (($sourcetill=='1' && $destinationTill=='4')) {
        //     $data['title'] = 'Transfer POS To Purchase Counter 02'; 
        // } elseif (($sourcetill=='1' && $destinationTill=='5')) {
        //     $data['title'] = 'Transfer POS To Sales Counter 01';
        // } elseif (($sourcetill=='1' && $destinationTill=='6')) {
        //     $data['title'] = 'Transfer POS To Sales Counter 02';
        // } elseif (($sourcetill=='1' && $destinationTill=='7')) {
        //     $data['title'] = 'Transfer POS To Re-Exchange Counter';
        // } else {
            // $data['title'] = 'Title Not Set';
        // }  
    
        $data['oprtype'] = 'TSFTILLTOTILL';    
        // $tillArray   = array('tillID' => '1');
        $tillArray   = array('tillID' => $user_till);
        $data['list'] = $this->payment->get_currencyListWithBalances($tillArray);    
        $data['table_view'] = $this->load->view('app/vault/till_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        } 

    }

  /*******************************************************************************
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function accept_transfers()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $user_till = $this->session->userdata('user_till');
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';

         $dataArray = array (  
           'txnType'         => "Domestic", 
           'brCode'          =>  $branchCode           
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);
     
        
        $tillArray   = array('tillID' => $user_till);
        $data['list'] = $this->payment->get_pending_transfer_list($tillArray); 
   //     $data['list'] = $this->payment->get_currencyList(); 

      //  $data['user'] = $this->payment->get_system_users(); 
     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/vault/transfer_acceptance_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    } 


     /*******************************************************************************
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function accept_reject_all_transfers()
    {
        if (true) {
         
        $error_status = false; 
        $errors = []; 

        $action = $this->get_json_input('action');
        $user_till = $this->session->userdata('user_till');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();

        $actionArray   = array('user_till' => $user_till , 'action' => $action);

        $data = $this->payment->accept_reject_all_transfers($actionArray);
        

        $resdta->error_status = $data->errorStatus;
        $resdta->error_message = $data->errorMessage;

        if (!$data->errorStatus) {
        //success

                
        } else {
        $resdta->error_status = true;
        $resdta->error_message = $data->errorMessage;
        }       

        echo json_encode($resdta); 

        } else {
        $this->show_error('permission', '403');   
        } 
    } 

    /*******************************************************************************
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function view_transfers()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $type = $this->input->get('type', TRUE);
        $user_till = $this->session->userdata('user_till');
         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';

    

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     //   $data['role'] = Auth::role();
     //   $data['permissions'] = Auth::get_session_permissions();
     //   $data['current_date'] = $this->get_formatted_date($dat);
     
        
        $tillArray   = array('tillID' => $user_till,'type' => $type );
        $data['list'] = $this->payment->get_cash_transfer_list($tillArray); 
   //     $data['list'] = $this->payment->get_currencyList(); 

      //  $data['user'] = $this->payment->get_system_users(); 
     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/vault/transfer_view_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    } 

     /*******************************************************************************
     * Render view for till balance
     *
     * @return view
    *******************************************************************************/
    public function view_tillbalance()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $user_till = $this->session->userdata('user_till');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);

         if(isset($operationtype)){
            $data['oprtype']    = $operationtype;
         } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/vault';
        $data['route'] = 'vault';
        $data['controller'] = 'Vault';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     
     
        $tillID = $user_till;
        $tillArray   = array('tillID' => $tillID);
        $data['list'] = $this->payment->get_tillBalances($tillArray); 
        $data['table_view'] = $this->load->view('app/vault/till_balance_grid', $data, true); 
        $data['body'] = $this->load->view('app/vault/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }   

 /*******************************************************************************
     * Render view for Transfer Till to Till 
     *
     * @return view
    *******************************************************************************/
     public function load_view()
    {
      
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $srctill  = $this->input->get('srctill', TRUE);          
           
   
            $data['tills'] = $this->payment->get_Tills(); 

            $data['title']    = $subtitle;
            $data['sourcetill']   = $srctill;
          
              
       
            $data['dir'] = 'app/vault';
            $data['route'] = 'vault';
            $data['controller'] = 'Vault';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];

            $data['bootstrap_select'] = true;

          
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/vault/till_transfer', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }
  /*******************************************************************************
     * Validate customer request
     *
     * @return 
    *******************************************************************************/
    public function validate_tilltotill()
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
                    

                    ##VALIDATION:UIN TYPE
                    // if ($fields['AED']==="") {
                    //     print_r('expression');
                    //     // $error_status      = true;
                    //     // $errors['sourcetill'] = ER_MSG_REQUIRED_FIELD;
                    // } else {
                    //     print_r('ddd');
                    //     // $errors['sourcetill'] = "";
                    // }


                    // ###VALIDATION:NIC|BR
                    // if ($fields['destinationtill']==="") {
                    //     $error_status      = true;
                    //     $errors['destinationtill'] = ER_MSG_REQUIRED_FIELD;
                    // } else {
                    //     $errors['destinationtill'] = "";
                    // }
               

                    
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
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function saveToPOS()
    {
        
        if (true) {
        
        $fields = [];  
        $error_status = false; 
        $errors = []; 
        $data_string = $this->get_json_input('formArray');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();
        //
        if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);

                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['sourceTill'] = '2';
                    $fields['destTill'] = '1';
        

        $data = $this->payment->save_transfer_T4STOPOS($fields);
        

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
     * Save Amounts from T4S to POS
     *
     * @return 
    *******************************************************************************/
    public function saveToTill()
    {   

        if (true) {
        
        $fields = [];  
        $error_status = false; 
        $errors = [];
        $sourcetill =  $this->get_json_input('sourcetill'); 
        $destinationtill =  $this->get_json_input('destinationtill');
        $data_string = $this->get_json_input('formArray');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();
        //
        if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);

                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['sourceTill'] = $sourcetill;
                    $fields['destTill'] = $destinationtill;
        

        $data = $this->payment->save_transfer_POSTOTILL($fields);
        

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
     * Save Amounts from POS to T4S
     * @return 
    *******************************************************************************/
    public function saveToT4S()
    {
        
        if (true) {
        
        $fields = [];  
        $error_status = false; 
        $errors = []; 
        $data_string = $this->get_json_input('formArray');
        $remarks =  $this->get_json_input('remarks');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();
        //
        if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);

                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['sourceTill'] = '1';
                    $fields['destTill'] = '2';
                    $fields['remarks'] = $remarks;
        

        $data = $this->payment->save_transfer_POSTOT4S($fields);
        

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
     * Save Amounts from T4S to POS
     *
     * @return 
    *******************************************************************************/
    public function cashToTill()
     {   

        if (true) {
        
        $fields = [];  
        $error_status = false; 
        $errors = [];
        $sourcetill =  $this->get_json_input('fromTill'); 
        $desttill =  $this->get_json_input('toTill');
        $currency =  $this->get_json_input('currency');
        $amount =  $this->get_json_input('amount');
        $user =  $this->get_json_input('user');
        $timestamp =  $this->get_json_input('timestamp');
        $action =  $this->get_json_input('action');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();
        
        $fields['sourceTill'] = $sourcetill;
        $fields['destTill'] = $desttill;
        $fields['curr'] = $currency;
        $fields['amount'] = $amount;
        $fields['user'] = $user;
        $fields['timestamp'] = $timestamp;                  
        $fields['status'] = $action;                  
      
        $data = $this->payment->save_cash_transfer_request($fields);
       
        $resdta->error_status = $data->errorStatus;
        $resdta->status = $data->status;

        if (!$resdta->error_status) {
           // success
        }  else {
            
        $resdta->error_status = true;
        $resdta->error_message = $data->errorMessage;
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
    private function get_transferArray($fields=[])
    {
        $transferArray = [];

        $transferArray = array(
        'LKR'                  => $fields['LKR'],
        'USD'                  => $fields['USD'],
        'GBP'                  => $fields['GBP'],
        'CHF'                  => $fields['CHF'],
        'AUD'                  => $fields['AUD'],
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        );

        return $transferArray;


    } 
    

     /*******************************************************************************
     * Get Branch User Details
     *
     * @return 
    *******************************************************************************/
    public function getBranchUserDetails()
    {
        $pfNumber          = $this->get_json_input('pfNumber');
        $pfArray   = array('pfNumber' => $pfNumber); 

        $brUserData = $this->payment->get_BranchUserDetails($pfArray);

        echo json_encode($brUserData); 
    }

    /*******************************************************************************
     * Get Branch User Details
     *
     * @return 
    *******************************************************************************/
    public function getCurrencyListwithBalances()
    {
        $sourcetill  = $this->get_json_input('sourceTill');
        $tillArray   = array('sourcetill' => $sourcetill); 

        $tillData = $this->payment->get_currencyListWithBalances($tillArray);

        echo json_encode($tillData); 
    }

    /*******************************************************************************
     * Get Branch User Details
     *
     * @return 
    *******************************************************************************/
    public function load_transfer_view()
    {
        $sourceTill          = $this->get_json_input('sourceTill');
        $destinationTill          = $this->get_json_input('destinationTill');
        $tillArray   = array('sourceTill' => $sourceTill, 'destinationTill' => $destinationTill); 

        $tillData = $this->payment->get_till_balances($tillArray);

        echo json_encode($tillData); 
    }




    
}



