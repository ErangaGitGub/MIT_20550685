<?php
/**
* Class:  Dashboard Controller 
* Author: Eranga
* Date:   19/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Dashboard extends Base {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {	
    	$data['title'] = 'Welcome to BOC MIRREX System Dashboard';   

        $data['permissions'] = Auth::get_session_permissions(); 

    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);  

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data); 
    }
}