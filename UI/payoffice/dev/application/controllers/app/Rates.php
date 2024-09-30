<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Rates extends Base {



	public function __construct(){
        parent::__construct();
        $this->load->model('app/Payment_model');
        $this->payment = new Payment_model();
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
     * get random number for CHEQUE DEPOSIT TRANSCATION
     *
     * @return string
    *******************************************************************************/
    protected function create_reference( $len = 8 ) 
    {
        $rand   = '';

        while( !( isset( $rand[$len-1] ) ) ) {
            $rand   .= mt_rand( );
        }
        return 'C'.substr( $rand , 0 , $len );
    }


    /*******************************************************************************
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function upload_rates()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        if(isset($operationtype)){
            //print_r(($operationtype));
                $data['oprtype']    = $operationtype;
            } 


          $data['title']        = $subtitle;
         
          $data['dir'] = 'app/rates';
          $data['route'] = 'rates';
          $data['controller'] = 'Rates';
          $data['angular'] = true;
          $data['event'] = 'create_user';
          $tabs = [];
          $data['datatables'] = true;
          $data['datepicker'] = false;
          $data['table_datepicker'] = true;
 
          $ratesArray = array (  
           'print_type'   =>  'before_auth'           
          );
          $data['list'] = $this->payment->get_rates_data($ratesArray); 
        // $data['list'] = $this->payment->get_currencyList(); 
   

        $data['table_view'] = $this->load->view('app/rates/rates_entry_grid', $data, true); 
        $data['body'] = $this->load->view('app/rates/rates_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }




      /*******************************************************************************
     * Save Amounts from T4S to POS
     *
     * @return 
    *******************************************************************************/
    public function save_rates()
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
                $middlerate =  $this->get_json_input('middlerate'); 
                $reason =  $this->get_json_input('reason');  
                $data_string = $this->get_json_input('formArray');
                //$action = $this->get_json_input('action');
                $return_json = $this->get_json_input('return_json');
                if (isset($data_string)) {
                    parse_str($data_string, $fields);
                    $fields = array_map('trim', $fields);

                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['middlerate'] = $middlerate;
                    $fields['reason'] = $reason;
                 


                    
                    $data = $this->payment->save_currency_rates($fields);
                    

                        if (!$data->errorStatus) {
                    
                        $message = SAVE_RATES_SUCCESSFULLY;
                        $log_status = 'S';

                         

                      //  $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
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
     * Save Amounts from T4S to POS
     *
     * @return 
    *******************************************************************************/
    public function save_authorized_rates()
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
                    $fields['reason'] = '';
                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['status'] = 'A';
                    
        

        $data = $this->payment->auth_currency_rates($fields);
        

        $resdta->error_status = $data->errorStatus;
        $resdta->error_message = $data->errorMessage;

        if (!$data->errorStatus) {
        
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
    public function save_rejected_rates()
        {       
        if (true) {
        
        $fields = [];  
        $error_status = false; 
        $errors = []; 
        $data_string = $this->get_json_input('textArray');
        // $data_string = $this->get_json_input('formArray');
        $return_json = $this->get_json_input('return_json');
        $resdta = new stdClass();
        //
        if (isset($data_string)) {
                   // parse_str($data_string, $fields);
                   // $fields = array_map('trim', $fields);
                    $fields['reason'] = $data_string;
                    $fields['ip'] = $this->get_current_user_ip();
                    $fields['host'] =  $this->get_computer_name();
                    $fields['user'] = Auth::username();
                    $fields['status'] = 'R';
                    
        

        $data = $this->payment->auth_currency_rates($fields);
        

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
     * Render view for transfer T4S to POS
     *
     * @return view
    *******************************************************************************/
    public function authorize_rates()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);
        $type = $this->input->get('type', TRUE);
          if(isset($operationtype)){
            //print_r(($operationtype));
                $data['oprtype']    = $operationtype;
            } 


        $data['title'] = $subtitle;

        $data['dir'] = 'app/rates';
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
    
        $ratesArray = array (  
           'print_type'   =>  $type           
        );
        $data['list'] = $this->payment->get_rates_data($ratesArray); 

        $data['table_view'] = $this->load->view('app/rates/rates_auth_grid', $data, true); 
        $data['body'] = $this->load->view('app/rates/rates_layout', $data, true);    

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
        public function view_rates()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $type = $this->input->get('type', TRUE);
        
        if(isset($subtitle)){
         
          $data['title']    = $subtitle;
        } 



        $data['dir'] = 'app/rates';
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['dataexport'] = true;
        $data['table_datepicker'] = true;
     
        $ratesArray = array (  
           'print_type'   =>  $type           
        );
        $data['list'] = $this->payment->get_rates_data($ratesArray); 



        // print_r($data['list']);die();

        $data['table_view'] = $this->load->view('app/rates/rates_view_grid', $data, true); 
        $data['body'] = $this->load->view('app/rates/rates_layout', $data, true);    

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
        public function view_cheque_details()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        // $subtitle = $this->input->get('subtitle', TRUE);          
        $type = $this->input->get('type', TRUE); 
        $data['title']    = 'CHEQUE DEPOSIT DETAILS';
         
        



        $data['dir'] = 'app/rates';
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['dataexport'] = true;
        $data['table_datepicker'] = true;
     
       
        $data['list'] = $this->payment->get_cheque_data(); 



        // print_r($data['list']);die();

        $data['table_view'] = $this->load->view('app/rates/cheque_grid', $data, true); 
        $data['body'] = $this->load->view('app/rates/rates_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }
     /*******************************************************************************
     * Render view for before_print_view
     *
     * @return view
    *******************************************************************************/
   public function before_print_view()
    {
        if (true) {       

        $subtitle = $this->input->get('subtitle', TRUE);          
             
        if(isset($subtitle)){
         
          $data['title']    = $subtitle;
        } 

        $ratesArray = array ('print_type' => 'before_auth');
        $data['list'] = $this->payment->get_rates_data($ratesArray); 
        $data['body'] = $this->load->view('app/rates/before_rates_print', $data, true);
        
   
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

    /*******************************************************************************
     * Render view for after_print_view
     *
     * @return view
    *******************************************************************************/
   public function after_print_view()
    {
        if (true) {       
        $subtitle = $this->input->get('subtitle', TRUE);          
             
        if(isset($subtitle)){
         
          $data['title']    = $subtitle;
        }         
        

        $ratesArray = array ('print_type' => 'after_auth');
        $data['list'] = $this->payment->get_rates_data($ratesArray); 
        $data['body'] = $this->load->view('app/rates/after_rates_print', $data, true);
        
   
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }

    /*******************************************************************************
     * Render view for balancing panel
     *
     * @return view
    *******************************************************************************/
    public function balance_panel()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
            $subtitle = $this->input->get('subtitle', TRUE);  
          
            $data['title']        = 'New User Creation';  
            $data['tabtitle1']    = 'NEW USER CREATION';    
            $data['tabtitle2']    = 'NEW USER CONFIRMATION'; 
            $data['dir'] = 'app/rates';
            $data['route'] = 'rates';
            $data['controller'] = 'Rates';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];
            $data['currencies']          = $this->payment->get_currencyList(); 

         
            
            $data['bootstrap_select'] = true;

             $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/rates/balance_panel', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for balancing panel
     *
     * @return view
    *******************************************************************************/
    public function cheque_panel()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
            $subtitle = $this->input->get('subtitle', TRUE);  
          
            $data['title']        = 'New User Creation';  
            $data['tabtitle1']    = 'NEW USER CREATION';    
            $data['tabtitle2']    = 'NEW USER CONFIRMATION'; 
            $data['dir'] = 'app/rates';
            $data['route'] = 'rates';
            $data['controller'] = 'Rates';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];

         
            
            $data['bootstrap_select'] = true;

             $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/rates/cheque_panel', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

 /*******************************************************************************
     * Validate FCP Transaction
     *
     * @return 
    *******************************************************************************/
    public function validate_CHQ_deposit()
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
                    if ($fields['accountnumber']==="") {
                        $error_status      = true;
                        $errors['accountnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['accountnumber'] = "";
                    }

                    ###VALIDATION:uinnumber
                    if ($fields['customername']==="") {
                        $error_status      = true;
                        $errors['customername'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['customername'] = "";
                    }
                

                    // ###VALIDATION:UIN TYPE
                    if ($fields['bankcode']==="") {
                        $error_status      = true;
                        $errors['bankcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['bankcode'] = "";
                    }

                 
                    ###VALIDATION:ITRS CODE
                    if ($fields['branchcode']==="") {
                        $error_status      = true;
                        $errors['branchcode'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['branchcode'] = "";
                    }
                    
                   

                    

                    ###VALIDATION:ITRS CODE
                    if ($fields['amount']==="") {
                        $error_status      = true;
                        $errors['amount'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['amount'] = "";
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
    public function save_CHQ_deposit()
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

                    $dataArray = $this->get_dataArray_CHQ($fields);
                   
                    $data = $this->payment->save_cheque_deposit_request($dataArray);
                    if (!$data->errorStatus) {

                    # saved successfully
                        $message = SC_DTA_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                        $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'Reference: '.$data->bankReference,
                                "buttons"     => 
                                [[
                                "id"    => "id-okbtn",
                                "loader"=> "",
                                "icon"  => "",
                                "url"   => $this->config->item('base_url')."rates/cheque_panel?subtitle=CHEQUE DEPOSITS",
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
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_dataArray_CHQ($fields=[])
    {

        $dataArray_CHQ = [];
       // print_r('ddd'); die();  
        $dataArray_CHQ = array(
        'reference'            => $this->create_reference(),
        'accountnumber'        => $fields['accountnumber'],
        'customername'         => $fields['customername'],
        'debitbankcode'        => $fields['bankcode'],
        'debitbranchcode'      => $fields['branchcode'],
        'amount'               => $this->get_amount($fields['amount']),
       
        
        'ip'                   => $this->get_current_user_ip(),
        'mName'                => $this->get_computer_name(),
        'system'               => $this->get_system_name(),
        'userId'               => Auth::username(),
        'branchCode'           => Auth::ubranch()
        
        );
        // print_r($dataArray_FCP); die();
        return $dataArray_CHQ;
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
     



    
}



