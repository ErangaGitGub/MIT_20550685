<?php
/**
* Class:  Base Controller 
* Author: Eranga
* Date:   19/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Auth.php');

class Base extends Auth {	

    protected $theme;
    protected $activity;

    public function __construct() {
        parent::__construct();    

        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');

        // if (Auth::auth() && $this->is_token_matched() && !$this->is_timedout()) {
        if (Auth::auth()) {
        $this->load_default_packages();
        } else {
        $this->session->sess_destroy();
        redirect('auth', 'refresh');
        }
    }

    protected function load_default_packages()
    {
        //load any default models and configs here
        $this->theme =  $this->config->item('app_ui_theme');

        $this->load->model('core/Activity_model');
        $this->activity = new Activity_model();          
    }

    public function get_log()
    {
        $now = new DateTime();

        $log = [
        'user_id'      => Auth::username(),
        'user_role'    => Auth::role(),
        'user_branch'  => Auth::ubranch(),
        'cluster_id'   => Auth::cluster(),
        'action_date'  => $now->format('Y-m-d'),
        'action_time'  => $now->format('H:i:s'),
        'browse_agent' => $this->current_agent(),
        'platform'     => $this->platform(),
        'ip_address'   => $this->get_current_user_ip(),
        'machine_name' => $this->get_computer_name()
        ];

        return $log;
    }

    public function current_agent()
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
    public function platform()
    {
        return $this->agent->platform();
    }
    public function client()
    {
       return gethostbyaddr($_SERVER['REMOTE_ADDR']); 
    }
    public function get_current_user_ip() 
    {
        return $this->input->ip_address();
    }
    public function get_computer_name()
    {
        return $this->input->ip_address();
    }
    public function get_system_name()
    {
        return $this->config->item('app_code');
    }  
    public function get_current_timestamp() 
    {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s'); 
    }

    protected function get_error_message($data)
    {
        $skelton = $this->load->view("messages/error_message", $data, true);
        return $skelton;
    }
    protected function get_success_message($data)
    {
        $skelton = $this->load->view("messages/success_message", $data, true);
        return $skelton;
    }
    protected function get_warning_message($data)
    {
        $skelton = $this->load->view("messages/warning_message", $data, true);
        return $skelton;
    }
    protected function handle_json_response($resdta, $return_json=false)
    {
        if ($return_json) {
            echo json_encode($resdta);
        } else {
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        }
    }
    
    protected function show_error($error_type='404', $error_message=ER_MSG_PAGE_NOT_FOUND, $description='')
    {       
        $data['message']     = $error_message;
        $data['description'] = $description;

        if ($error_type=="permission") {
        $data['heading'] = 'Access Forbidden';
        $this->load->view('errors/html/error_permission', $data);  
        } else {
        $data['heading'] = 'Page Not Found';
        $this->load->view('errors/html/error_notfound', $data);   
        }
    }

    protected function show_warning($error_type='404', $warning_message=ER_MSG_PAGE_NOT_FOUND, $description='')
    {       
        $data['message']     = $warning_message;
        $data['description'] = $description;

        if ($error_type=="timedout") {
        $data['heading'] = 'Request Time-out';
        } else {
        $data['heading'] = '';
        }
        
        $this->load->view('errors/html/system_warning', $data);
    }


    protected function is_post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        } else {
            return false;
        }
    }
    protected function is_get()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return true;
        } else {
            return false;
        }
    }
    /*******************************************************************************
     * Get short name of current controller 
     *
     * @return string
    *******************************************************************************/
    protected function get_controller_name() 
    {
        $controller = $this->router->fetch_class(); // for controller
        return strtolower($controller); 
    } 
    /*******************************************************************************
     * Get short name of current controller 
     *
     * @return string
    *******************************************************************************/
    protected function get_controller_short_name() 
    {
        $controller = $this->router->fetch_class(); // for controller
        $short_ctrl = strtok($controller, '_');
        return $short_ctrl;
    }
    /*******************************************************************************
     * Get name of current router function 
     *
     * @return string
    *******************************************************************************/
    protected function get_controller_funtion() 
    {
        $method = $this->router->fetch_method(); // for method
        return $method;
    }
    /*******************************************************************************
     * Get json post input value by key
     *
     * @return response
    *******************************************************************************/
    protected function get_json_input($token) 
    {
        $_POST = json_decode(file_get_contents('php://input'), true);        
        if (isset($_POST[$token])) {
            return $_POST[$token];
        } else {
            return null;
        }
    }
    /*******************************************************************************
     * Get post input value by key
     *
     * @return response
    *******************************************************************************/
    protected function get_input($token) 
    {
        return $this->input->post($token);
    }
    /*******************************************************************************
     * Get all post inputs values
     *
     * @return response
    *******************************************************************************/
    protected function get_all_inputs() 
    {
        return $this->input->post();
    }
    /*******************************************************************************
     * check email is valid or not
     *
     * @return boolean
    *******************************************************************************/
    protected function get_email_validator($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return true;
        } else {
          return false;
        }
    }
    /*******************************************************************************
     * Remove commas from a number string
     *
     * @return string
    *******************************************************************************/
    protected function remove_commas($number_string)
    {
        return preg_replace('/[^\d.]/', '', trim($number_string));
    }

    /*******************************************************************************
     * Remove commas from a minus number string
     *
     * @return string
    *******************************************************************************/
    protected function remove_commas_minus($number_string)
    {
        return preg_replace('/[^\d-]/', '', trim($number_string));
    }

    

    /*******************************************************************************
     * decrypt number with decryption key
     *
     * @return string
    *******************************************************************************/
    protected function decrypt_ubrn($text)
    {
        $encrptdTxt = strrev($text);
        $encrptdArr = str_split($encrptdTxt);

        $dectxt = '';

        for ($i=0; $i < count($encrptdArr) ; $i++) {             
        if ($this->is_found_in_char0($encrptdArr[$i])) {
        $dectxt = $dectxt.'0';
        } else {
        $dectxt = $dectxt.$this->get_crypt_char($encrptdArr[$i]);
        } }

        return $dectxt;
    }
    /*******************************************************************************
     * encrypt number with encryption key
     *
     * @return string
    *******************************************************************************/
    protected function encrypt_ubrn($ubrn)
    {
        $reference  = number_format($ubrn,0,'.','');
        $refferenceArr = str_split($reference);
        $enctxt = '';
        for ($i=0; $i < count($refferenceArr) ; $i++) {    
        if ($refferenceArr[$i]=='0') {
        $key=$this->config->item('app_crypt0_key');
        $keyArray = str_split($key);
        $randomIndex = array_rand($keyArray);
        $enctxt = $enctxt.$keyArray[$randomIndex];
        } else {
        $key=$this->config->item('app_crypto_key');
        $keyArray = str_split($key);
        $enctxt = $enctxt.$keyArray[$refferenceArr[$i]];
        }
        }
        return strrev($enctxt);
    }    
    protected function get_formatted_date ($date) 
    {
        if ($date != 0) {
            $year  = substr($date, 0, 4);
            $month = substr($date, 4, 2);
            $day   = substr($date, 6, 2);

            return $year.'-'.$month.'-'.$day;
        } else {
            return '0';
        }        
    } 
    /*******************************************************************************
     * Get timestamp for given date and time 
     *
     * @params $date(20190603), $time(10:12:30)
     * @return number (float)
    *******************************************************************************/
    protected function get_timestamp($date, $time)
    {
        $_time = trim($time);

        if ($date==0 || $_time=="") {
        return (float)0;
        }

        $_timeArray = explode(':', $_time);

        $_timeString = $_timeArray[0].$_timeArray[1].$_timeArray[2];

        $_timestamp = $date.$_timeString;

        return (float)$_timestamp;
    }
    /*******************************************************************************
     * Get numeric date in two two format (YYYYMMDD => YYMMDD)
     *
     * @return string
    *******************************************************************************/
    protected function get_numeric_date_in_two_two ($date) 
    {
        if ($date != 0) {
            $year  = substr($date, 2, 2);
            $month = substr($date, 4, 2);
            $day   = substr($date, 6, 2);
            return $year.$month.$day;
        } else {
            return '0';
        }        
    } 
    /*******************************************************************************
     * Convert charter with encryption key
     *
     * @return int
    *******************************************************************************/
    private function get_crypt_char($char)
    {
        $key = $this->config->item('app_crypto_key');
        $pos = strpos($key, $char);
        if (!$pos) { return 0; } else { return $pos; }
    }
    /*******************************************************************************
     * Check 0 is in the encrypted key
     *
     * @return boolean
    *******************************************************************************/
    private function is_found_in_char0($char)
    {
        $key = $this->config->item('app_crypt0_key');
        if (!strpos($key, $char)) { return false; } else { return true; }
    }    
    /*******************************************************************************
     * convert formatted date to numeric date (YYYY-MM-DD => YYYYMMDD)
     *
     * @return int
    *******************************************************************************/
    protected function convert_formatted_date_to_numeric ($date, $delimiter="-") 
    {
        $datArray = str_split($date, 1);

        if (!isset($date)) {
        return 0;
        } elseif (strlen($date)!=10) {
        return 0;
        } elseif ($datArray[4]!=$delimiter) {
        return 0;
        } elseif ($datArray[7]!=$delimiter) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[0])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[1])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[2])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[3])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[5])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[6])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[8])) {
        return 0;
        } elseif (!preg_match('/^[0-9]+$/', $datArray[9])) {
        return 0;
        } else {
        $date_array = explode($delimiter, $date);
        return $date_array[0].$date_array[1].$date_array[2];
        }    
    } 
    /*******************************************************************************
     * Get boolean value as char true => "Y/N"
     *
     * @return string
    *******************************************************************************/
    protected function get_boolean_as_char ($val) 
    {
    if ($val) { return "Y"; } else { return "N"; }        
    }

    public function is_date_valid($date=0)
    {
        $dat = $this->convert_formatted_date_to_numeric($date);
        if ($dat==0) {
        return false;
        } else {
        return true;
        }
    }

    public function is_branch_valid($brn=0)
    {
        if ($brn==0) {
        return false;
        } elseif (!preg_match('/^[0-9]+$/', $brn)) {
        return false;
        } elseif (strlen($brn)>5) {
        return false;
        } elseif (Auth::cluster()=="DBU" && (int)$brn!=Auth::ubranch()) {
        return false;
        } else {
        return true;
        }
    }

    public function is_filter_valid($filter)
    {
        if ($filter=="R") {
        return true;
        } elseif ($filter=="C") {
        return true;
        } else {
        return false;
        }
    }

    public function is_reference_valid($ref=0)
    {
        if ($ref==0) {
        return false;
        } elseif (!preg_match('/^[0-9]+$/', $ref)) {
        return false;
        } elseif (strlen($ref)>5) {
        return false;
        } else {
        return true;
        }
    }

    public function is_channel_valid($channelList=[], $channelcode="")
    {
        $found=false;        
        foreach ($channelList as $channel) {
        if (isset($channel->CHANNEL_CODE)) {
        if (strtolower($channel->CHANNEL_CODE) == strtolower($channelcode)) {                
        $found=true;
        } } }

        return $found;        
    }
}
