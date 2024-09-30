<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class User extends Base {

	protected $transaction;

	public function __construct(){
        parent::__construct();
        $this->load->model('app/Payment_model');
        $this->payment = new Payment_model();
    }


    /*******************************************************************************
     * Render view for Create New User
     *
     * @return view
    *******************************************************************************/
    public function create_new_user()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
   
            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            $data['tabtitle1']    = $subtitle;
            $data['title']        = 'New User Creation';  
            $data['tabtitle1']    = 'NEW USER CREATION';    
            $data['tabtitle2']    = 'NEW USER CONFIRMATION'; 
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];

            $data['users']          = $this->payment->get_branchUserList(); 

            
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_remove_user', $data, true) ]];
            } else {
                $tabs += ['CREATE NEW USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_remove_user', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for Reset User
     *
     * @return view
    *******************************************************************************/
    public function reset_user()
    {
       
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
   
            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            $data['title']    = "Reset User";
            $data['tabtitle1']    = $subtitle;
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'reset_user';
            $tabs = [];

            $data['users']          = $this->payment->get_system_users();

            
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/reset_user', $data, true) ]];
            } else {
                $tabs += ['CREATE NEW USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/reset_user', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

      /*******************************************************************************
     * Render view for Change User Password
     *
     * @return view
    *******************************************************************************/
    public function change_password()
    {
       
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
   
            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            $data['title']    = "Change Password";
            $data['tabtitle1']    = $subtitle;
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'change_user_password';
            $tabs = [];

                       
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/change_user_password', $data, true) ]];
            } else {
                $tabs += ['CREATE NEW USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/change_user_password', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }


    /*******************************************************************************
     * Render view for Delete User
     *
     * @return view
    *******************************************************************************/
    public function remove_user()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
            $userPF = $this->input->get('usrPF', TRUE);
            $userName = $this->input->get('userName', TRUE);
   
            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            if(isset($userPF)){
                $data['userPF']    = $userPF;
            }

            if(isset($userName)){
                $data['userName']    = $userName;
            }



            $data['tabtitle1']    = $subtitle;
            $data['title']        = 'User Deletion';  
            $data['tabtitle1']    = 'USER DELETION';    
            $data['tabtitle2']    = 'USER DELETION CONFIRMATION'; 
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'delete_user';
            $tabs = [];

            $data['users']          = $this->payment->get_system_users();
            
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_remove_user', $data, true) ]];
            } else {
                $tabs += ['REMOVE USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_remove_user', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

     /*******************************************************************************
     * Render view for Assign User
     *
     * @return view
    *******************************************************************************/
    public function assign_user()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
            $effDate = $this->payment->get_EffectiveDate();
            

            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            if(isset($effDate)){
                $data['effDate']    = $effDate[0]->SYSTEMDATE;
            }

            $data['tabtitle1']    = $subtitle;
            $data['title']        = 'User Deletion';  
            $data['tabtitle1']    = 'USER DELETION';    
            $data['tabtitle2']    = 'USER DELETION CONFIRMATION'; 
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'assign_user';
            $tabs = [];

            $data['users']          = $this->payment->get_system_users();
            $data['levels']         = $this->payment->get_UserLevels();
            $data['tills']          = $this->payment->get_Tills();
            
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_user_assignment', $data, true) ]];
            } else {
                $tabs += ['ASSIGN USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/create_user_assignment', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    /*******************************************************************************
     * Render view for Delete User
     *
     * @return view
    *******************************************************************************/
    public function remove_assignment()
    {
       // if (Auth::has_permission('request_creation')) {
        if (true) {
          
            $subtitle = $this->input->get('subtitle', TRUE);          
            $operationtype = $this->input->get('operationtype', TRUE);
            $userPF = $this->input->get('usrPF', TRUE);
            $userName = $this->input->get('userName', TRUE);
            $userLevel = $this->input->get('userLevel', TRUE);
            $userTill = $this->input->get('userTill', TRUE);
            $effDate = $this->input->get('effDate', TRUE);
   
            if(isset($operationtype)){
                $data['operationtype']    = $operationtype;
            }

            if(isset($userPF)){
                $data['userPF']    = $userPF;
            }

            if(isset($userName)){
                $data['userName']    = $userName;
            }

            if(isset($userName)){
                $data['userLevel']    = $userLevel;
            }

            if(isset($userName)){
                $data['userTill']    = $userTill;
            }

            if(isset($userName)){
                $data['effDate']    = $effDate;
            }

            $data['tabtitle1']    = $subtitle;
            $data['title']        = 'User Deletion';  
            $data['tabtitle1']    = 'USER DELETION';    
            $data['tabtitle2']    = 'USER DELETION CONFIRMATION'; 
            $data['dir'] = 'app/user';
            $data['route'] = 'user';
            $data['controller'] = 'Usr';
            $data['angular'] = true;
            $data['event'] = 'delete_user';
            $tabs = [];

            $data['users']          = $this->payment->get_system_users();
            
            $data['bootstrap_select'] = true;

            if(isset($subtitle)){
                $tabs += [$subtitle => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/remove_user_assignment', $data, true) ]];
            } else {
                $tabs += ['REMOVE USER' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/user/remove_user_assignment', $data, true) ]];
            }

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

   /*******************************************************************************
     * Render view for Assign User
     *
     * @return view
    *******************************************************************************/
        public function view_user()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
        $operationtype = $this->input->get('operationtype', TRUE);

       if(isset($subtitle)){
           $data['title']   = $subtitle;
        }

      

        $data['dir'] = 'app/user';
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

        $data['user'] = $this->payment->get_system_users(); 
        $data['list'] = $this->payment->get_user_assignments();     
     
        if ($operationtype==="VIEWSYSUSR") {
            $data['table_view'] = $this->load->view('app/user/user_grid', $data, true); 
        }elseif ($operationtype==="VIEWASSIGNMENT") {
           $data['table_view'] = $this->load->view('app/user/assignment_grid', $data, true); 
        }elseif ($operationtype==="DELETESYSUSR") {
           $data['table_view'] = $this->load->view('app/user/delete_user_grid', $data, true);
        }elseif ($operationtype==="DELETEASSIGNMENT") {
           $data['table_view'] = $this->load->view('app/user/delete_assignment_grid', $data, true);
        }      
     //   $data['table_view'] = $this->load->view('app/user/user_grid', $data, true); 
        $data['body'] = $this->load->view('app/user/grid_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

     /*******************************************************************************
     * Validate customer request
     *
     * @return 
    *******************************************************************************/
    public function validate()
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


                    ###VALIDATION:UIN TYPE
                    if ($fields['userpfnumber']==="") {
                        $error_status      = true;
                        $errors['userpfnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['userpfnumber'] = "";
                    }


                    if ($fields['userpassword']==="") {
                        $error_status      = true;
                        $errors['userpassword'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['userpassword'] = "";
                    }


                    ###VALIDATION:NIC|BR
                    if ($fields['username']==="") {
                        $error_status      = true;
                        $errors['username'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['username'] = "";
                    }


                    if ($fields['branch']==="") {
                        $error_status      = true;
                        $errors['branch'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['branch'] = "";
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
     * Validate customer request
     *
     * @return 
    *******************************************************************************/
    public function validate_assign()
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


                    ###VALIDATION:USER PF NUMBEr
                    if ($fields['userpfnumber']==="") {
                        $error_status      = true;
                        $errors['userpfnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['userpfnumber'] = "";
                    }


                    ###VALIDATION:USER NAME
                    if ($fields['username']==="") {
                        $error_status      = true;
                        $errors['username'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['username'] = "";
                    }
                
                    ###VALIDATION:USER LEVEL
                    if ($fields['userlevel']==="") {
                        $error_status      = true;
                        $errors['userlevel'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['userlevel'] = "";
                    }

                     ###VALIDATION:DEPARTMENT/TILL
                    if ($fields['hiddenuserTill']==="") {
                        $error_status      = true;
                        $errors['till'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['till'] = "";
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
    }/*******************************************************************************
     * Validate customer request
     *
     * @return 
    *******************************************************************************/
    public function validate_delete()
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


                    ###VALIDATION:USER PF NUMBEr
                    if ($fields['userpfnumber']==="") {
                        $error_status      = true;
                        $errors['userpfnumber'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['userpfnumber'] = "";
                    }


                    ###VALIDATION:USER NAME
                    if ($fields['username']==="") {
                        $error_status      = true;
                        $errors['username'] = ER_MSG_REQUIRED_FIELD;
                    } else {
                        $errors['username'] = "";
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
     * Save User
     *
     * @return 
    *******************************************************************************/
    public function save()
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
                    $dataArray = $this->get_userArray($fields);
                    $data = $this->payment->save_user($dataArray);
                    // print_r($data); die();
                    if (!$data->error_status) {
                    # saved successfully
                        $message = SC_USR_SAVED_SUCCESSFULLY;
                        $log_status = 'S';
                      //  $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'User ID Reference: '.$data->pfNumber,
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
                        $log_description = $data->error_message;

                        $resdta->unexpected = true;
                        $resdta->message_skelton = $this->get_error_message([
                        "message"     => $data->error_message,
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
     * Save User
     *
     * @return 
    *******************************************************************************/
    public function save_assign()
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
                    $dataArray = $this->get_userassignmentArray($fields);
                    $data = $this->payment->save_assigned_user($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                        $message = SC_USR_ASSIGN_SUCCESSFULLY;
                        $log_status = 'S';
                      //  $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'User Reference: '.$data->userReference,
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
     * Save User
     *
     * @return 
    *******************************************************************************/
    public function delete()
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
                    $dataArray = $this->get_delete_userArray($fields);
                    $data = $this->payment->delete_user($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                        $message = SC_USR_DELETE_SUCCESSFULLY;
                        $log_status = 'S';
                      //  $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'User ID Reference: '.$data->userReference,
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
     * Save User
     *
     * @return 
    *******************************************************************************/
    public function delete_assign()
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
                    $dataArray = $this->get_delete_userAssignmentArray($fields);
                    $data = $this->payment->delete_user_assignment($dataArray);
                    if (!$data->errorStatus) {
                    # saved successfully
                        $message = SC_USR_DELETE_ASSIGN_SUCCESSFULLY;
                        $log_status = 'S';
                      //  $log_description = $data->bankReference;

                        $resdta->unexpected = false;
                        $resdta->message_skelton = $this->get_success_message([
                                "message"     => $message,
                                "description" => 'User ID Reference: '.$data->userReference,
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
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function reset_user_request()
    {
        // if (Auth::has_permission('request_verification')) {
        if (true) {
            //give access only to role==B
            $pfNumber  = $this->get_json_input('pfnumber');
            $hostname   = $this->get_computer_name();
            $ip         = $this->get_current_user_ip();
            $userId     = $this->session->userdata('username');
            
            $resdta = new stdClass();

            $dataArray = array(
                'pfNumber'      => $pfNumber,
                'resetpw'       => password_hash(trim($pfNumber), PASSWORD_DEFAULT),
                'user'          => $userId,
                'ip'            => $ip,
                'hostname'      => $hostname
            );

            $data = $this->payment->reset_user_password_request($dataArray);
            
            // print_r('<pre>');
            // print_r($data);
            // print_r('</pre>');die;

            if (!$data->errorStatus) {
                $resdta->error_status = false;
                $resdta->error_message = "";
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
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function change_password_request()
    {
        // if (Auth::has_permission('request_verification')) {
        if (true) {
            //give access only to role==B
            $pfNumber  = $this->session->userdata('username');
            $newpassword = $this->get_json_input('passwordnew');
            $hostname   = $this->get_computer_name();
            $ip         = $this->get_current_user_ip();
            $userId     = $this->session->userdata('username');
            
            $resdta = new stdClass();

            $dataArray = array(
                'pfNumber'      => $pfNumber,
                'newpassword'   => password_hash(trim($newpassword), PASSWORD_DEFAULT),
                'user'          => $userId,
                'ip'            => $ip,
                'hostname'      => $hostname
            );

            $data = $this->payment->change_user_password_request($dataArray);
            
            

            if (!$data->errorStatus) {
                $resdta->error_status = false;
                $resdta->error_message = "";
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
     * 
     *
     * @return response (json)
    *******************************************************************************/
    public function load_assignment_view()
    {
        if (true) {       

        $usrPF = $this->input->get('usrPF', TRUE);

        $dataArray = array ('usrPF' => $usrPF);
        $data['txn'] = $this->payment->load_international_transaction($dataArray); 
        $data['body'] = $this->load->view('app/user/view_user_assignment', $data, true);
        $data['title'] = 'View International Transaction | '.$txnNo; 
   
        $data['route'] = 'user';
        $data['controller'] = 'Usr';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    }
    

      /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_userArray($fields=[])
    {
        $userArray = [];
        $userArray = array(
        'pfNumber'         => $fields['userpfnumber'],
        'password'         => password_hash($fields['userpassword'], PASSWORD_DEFAULT),
        'userName'         => $fields['username'],
        'branch'         => $fields['branch'],
        'ip'               => $this->get_current_user_ip(),
        'host'             => $this->get_computer_name(),
        'user'             => Auth::username()
        );
        return $userArray;
    } 

      /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_delete_userArray($fields=[])
    {
        $userArray = [];
        $userArray = array(
        'pfNumber'         => $fields['userpfnumber'],
        'userName'         => $fields['username'],
        'ip'               => $this->get_current_user_ip(),
        'host'             => $this->get_computer_name(),
        'user'             => Auth::username()
        );
        return $userArray;
    } 

        /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_delete_userAssignmentArray($fields=[])
    {
        $userArray = [];
        $userArray = array(
        'pfNumber'         => $fields['userpfnumber'],
        'userName'         => $fields['username'],
        'userLevel'        => $fields['userlevel'],
        'userTill'         => $fields['usertill'],
        'effDate'          => $fields['effdate'],
        'ip'               => $this->get_current_user_ip(),
        'host'             => $this->get_computer_name(),
        'user'             => Auth::username() 
        );
        return $userArray;
    }       

    /*******************************************************************************
     * Create Save data array
     *
     * @return 
    *******************************************************************************/
    private function get_userassignmentArray($fields=[])
    {
        $userAssArray = [];
        $userAssArray = array(
        'pfNumber'         => $fields['hiddenuserpfnumber'],
        'userName'         => $fields['username'],
        'userLevel'        => $fields['hiddenuserLevel'],
        'userTill'         => $fields['hiddenuserTill'],
        'effectiveDate'    => $fields['effectiveDate'],
        'ip'               => $this->get_current_user_ip(),
        'host'             => $this->get_computer_name(),
        'user'             => Auth::username()
        );
        return $userAssArray;
    } 
    
    /*******************************************************************************
     * get random number for User 
     *
     * @return string
    *******************************************************************************/
    protected function create_reference( $len = 8 ) 
    {
        $rand   = '';
        while( !( isset( $rand[$len-1] ) ) ) {
            $rand   .= mt_rand( );
        }
        return 'U'.substr( $rand , 0 , $len );
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
           //  print_r('<pre>');
           // print_r($brUserData);
           // print_r('</pre>');die;
        echo json_encode($brUserData); 
    } 

    /*******************************************************************************
     * Get Branch User Details
     *
     * @return 
    *******************************************************************************/
    public function getSystemDate()
    {
        $systemDate = $this->payment->get_SystemDate();

        echo json_encode($systemDate); 
    }

    




    
}



