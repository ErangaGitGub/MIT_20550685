<?php
/**
* Class:  Auth Controller 
* Author: Eranga
* Date:   18/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    private $auth;
    private $reset;
    private $message;
    private $authresponse;
    private $authuser;

	public function __construct() {
        parent::__construct();

        $this->load->model('core/Auth_model');

        $this->auth = new Auth_model();
        $this->reset = false;
    }
    /*******************************************************************************
     * Render index component for auth view
     *
     * @return view
    *******************************************************************************/
    public function index() 
    {
        #redirect to dashbaord if already logged in
        if (Auth::auth()) {
        redirect($this->config->item('app_redirect_to'), 'refresh'); 
        }

        $data['title'] = 'Login';
        $data['body'] = $this->load->view('core/auth/login', $data, true);  
        $this->load->view('core/auth/layout', $data);         
    }

    public function login()
    {
        log_message('info', 'LT_INIT_LOGIN:'.$this->get_current_timestamp());

        if (Auth::auth()) {
        redirect($this->config->item('app_redirect_to'), 'refresh'); 
        }

        if ( $this->attempt() && $this->is_sessionValid() ) {  #new-code-only-this-line

            $this->__redirect();

                               

        } else {
            $this->failed_attempt(true);
        } 
    }

    public function logout() 
    {
        #update user logs
        $this->auth->update_user_logs('out');
        $this->session->sess_destroy();     

        redirect('auth', 'refresh');  
    }

    private function __redirect()
    {
        #update user logs here
        $this->auth->update_user_logs('in');
        redirect($this->config->item('app_redirect_to'), 'refresh'); 
    }

    private function failed_attempt($failed=true, $reset=false)
    {
        if ($failed) {
        #destroy session if there is an error  
        
        #new-code-replace
        if ( isset($_SESSION) && !empty($_SESSION) ) {
            $this->session->sess_destroy();   
        }
          
        $data['header'] = $this->config->item('app_name'); 

        $data['error_status']  = true;
        $data['error_message'] = $this->message;
       
        $data['username'] = trim($this->input->post('username'));
        $data['password'] = trim($this->input->post('password'));

        $data['title'] = 'Login';     
        $data['body'] = $this->load->view('core/auth/login', $data, true);  
        $this->load->view('core/auth/layout', $data); 

        } else {   
        redirect('auth', 'refresh');  
        }
    }

    private function attempt()
    {
        if ($this->web_login()) {
            log_message('info', 'LT_WEB_LOGIN_RECEIVED:'.$this->get_current_timestamp());
            return true;
        } else {
            return false;
        }
    }


    private function web_login()
    {      
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));


        if (empty($username)) {
            $this->message = ER_MSG_REQUIRED_FIELD_USERNAME;
            return false;
        } elseif (empty($password)) {
            $this->message = ER_MSG_REQUIRED_FIELD_PASSWORD;
            return false;
        } else {
            $this->load->model('services/Web_service_model'); 
            $webservice = new Web_service_model();

            $creds = array ( 
            "username"=> strtoupper($username),
            "password"   => $password
            );

            log_message('info', 'LT_WEB_LOGIN_SENT:'.$this->get_current_timestamp()); 
            $rspw = $webservice->check_user($creds);

            if (isset($rspw->password) && password_verify($password, $rspw->password)) {
                $rs = $webservice->get_user(["username"=> strtoupper($username)]);
                $this->manage_session($rs);
                return true;
            } else {
                $this->message = ER_MSG_INVALID_USERNAME_OR_PASSWORD;
                return false;
            }

        }              
    }

    #new-code
    private function is_sessionValid()
    {
        if ( !$this->agent->is_browser('Chrome') ) {

            $this->message = "This browser access is restricted by the system.";
            return false;
        }

        return true;
    }

    private function manage_session($rs) 
    { 
        if (isset($rs)) {

        $auth['username']          = trim(strtoupper($rs->userID));
        $auth['fullname']          = trim(strtoupper($rs->name));
        $auth['user_branch']       = trim($rs->branchCode);
       

        if (isset($rs->lastLogDate)) {
            $auth['lastLogDate']       = trim($rs->lastLogDate);
        } else {
            $auth['lastLogDate']       = "";
        }

        if (isset($rs->lastLogTime)) {
            $auth['lastLogTime']       = trim($rs->lastLogTime);
        } else {
            $auth['lastLogTime']       = "";
        }
        

        $auth['user_till']         = trim($rs->userTill);
        $auth['user_level']        = trim($rs->userLevel);
        $auth['user_till_desc']    = trim($rs->userTillDesc);
        $auth['user_level_desc']   = trim($rs->userLevelDesc);
      
        $auth['user_env']          = trim(strtoupper($this->config->item('app_enviornment')));
        $auth['user_brname']       = trim(substr($rs->branchName,0,10));

        $auth['logged_in']         = true;
        $auth['logged_in_on']      = $this->get_current_date();
        $auth['logged_in_at']      = $this->get_current_time();
        $auth['logged_in_ip']      = $this->get_current_user_ip();
        $auth['logged_in_browser'] = $this->current_browser();
        $auth['logged_in_machine'] = $this->get_computer_name();
        $auth['last_activity_at']  = time();

        $this->session->set_userdata($auth);

        }
    }

    private function is_session_exist()
    {
        $usersession = $this->auth->is_session_exist($this->authuser->userID);

        if ($usersession) {
        // $this->message = ER_MSG_USER_SESSION_EXIST;
        $this->reset   = true;
        return true;
        } else {        
        return false;
        }
    }

    protected function current_browser()
    {
        if ($this->agent->is_browser()) {
        $agent = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
        $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
        $agent = $this->agent->mobile();
        } else {
        $agent = 'undefined';
        }

        return $agent;
    }

    #new-code
    // protected function is_browserChrome()
    // {
    //     $browser = explode(" ", $this->current_browser());

    //     if ( $browser[0] == 'Chrome') {

    //         return true;
    //     }

    //     return false;
    // }

    protected function platform()
    {
        return $this->agent->platform();
    }

    protected function get_current_agent() 
    {
        return $this->config->item('app_auth_method');
    }

    protected function client()
    {
       return gethostbyaddr($_SERVER['REMOTE_ADDR']); 
    }

    protected function get_current_user_ip() 
    {
        return $this->input->ip_address();
    }

    protected function get_computer_name()
    {
        $hostname = explode(".",gethostbyaddr($this->get_current_user_ip()));
        return $hostname[0];
    }

    protected function get_current_timestamp() 
    {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s'); 
    }

    protected function get_current_date() 
    {
        $now = new DateTime();
        return $now->format('Y-m-d'); 
    }

    protected function get_current_time() 
    {
        $now = new DateTime();
        return $now->format('H:i:s'); 
    }

    protected function is_response_valid($response=500)
    {
        if ($response===500) {
        return false;
        } else {
        return true;
        }
    }

    protected function is_token_matched()
    {
        if ($this->config->item('app_reset_on_timeout')) {
        $sessionid = $this->session->session_id;
        $token = $this->auth->get_session_token(Auth::username());

        if ($sessionid===$token) {
        return true;
        } else {
        return false;
        }
        } else {
        return true;
        }
    }

    protected function is_timedout()
    {
        if ($this->config->item('app_sess_timeout')) {
        if ( (time() - $_SESSION['last_activity_at']) > $this->config->item('app_sess_expiration')) {
        return true;
        } else {
        $_SESSION['last_activity_at'] = time();
        return false;
        }
        } else {
        $_SESSION['last_activity_at'] = time();
        return false;
        }        
    }

    protected function is_node_active($channel="RTGS")
    {
        $this->load->model('services/Web_service_model'); 
        $webservice = new Web_service_model();

        $current_time = date("H:i:s");
        
        $nodedataArray = array('bCode' => Auth::ubranch(), 'tChannel' => $channel);

        $node = $webservice->get_branch_cutoffs($nodedataArray)[0];

        $node_started_time = $node->START_TIME;
        $node_ended_time   = $node->END_TIME;
        $node_extend       = $node->IS_TIME_EXTENDED; 
        $node_extend_till  = $node->EXTENDED_TIME; 

        if ($current_time >= $node_started_time && $current_time <= $node_ended_time) {
        return true;
        } else {

        if ($node_extend=="Y") {
        if ($current_time >= $node_started_time && $current_time <= $node_extend_till) {
            return true;
        } else {
            return false;
        }
        } else {
        return false;
        }        

        }
    }

    public static function auth() 
    {   
        if ( (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
        return true;
        } else {
        return false;
        }
    } 

    public static function username() 
    {
        if (Auth::auth() && isset($_SESSION['username'])) {
            return trim($_SESSION['username']);
        } else {
            return;
        }
    }

    public static function fullname() 
    {
        if (Auth::auth() && isset($_SESSION['fullname'])) {
            return trim($_SESSION['fullname']);
        } else {
            return;
        }
    }

    public static function ubranch() 
    {
        if (Auth::auth() && isset($_SESSION['user_branch'])) {
            return trim($_SESSION['user_branch']);
        } else {
            return;
        }
    }

    public static function utill() 
    {
        if (Auth::auth() && isset($_SESSION['user_till'])) {
            return trim($_SESSION['user_till']);
        } else {
            return;
        }
    }

    public static function role() 
    {      
        if (Auth::auth() && isset($_SESSION['user_level'])) {
            return trim($_SESSION['user_level']);
        } else {
            return;
        }
    } 

    public static function cluster() 
    {      
        if (Auth::auth() && isset($_SESSION['user_clscode'])) {
            return trim($_SESSION['user_clscode']);
        } else {
            return;
        }
    } 

    public static function get_session_permissions()
    {
        if (isset($_SESSION['permissions'])) {
        $permissionsArray = (array) $_SESSION['permissions'];
        } else {
        $permissionsArray = [];
        }

        return $permissionsArray;
    }  

    public static function has_permission($permission_key='') 
    {      
        if ($permission_key == '') {
            return false;        
        } else {

        if (isset($_SESSION['permissions'])) {
        $permissionsArray = (array) $_SESSION['permissions'];
        } else {
            return false;
        }            

        if (isset($permissionsArray) && isset($permissionsArray[$permission_key]) && $permissionsArray[$permission_key]==1) {
            return true;
        } else {
            return false;
        }
        
        } 
    }    
}
