<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Admin extends Base {

    protected $transaction;

    public function __construct(){
        parent::__construct();
        $this->load->model('app/Payment_model');
        $this->payment = new Payment_model();
    }




    /*******************************************************************************
     * Render view for change_tariff_details
     *
     * @return view
    *******************************************************************************/
    
    public function changeTariffData()
   
    {
     
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
       

       if(isset($subtitle)){
           $data['title']   = $subtitle;
        }

      

        $data['dir'] = 'app/admin';
        $data['route'] = 'admin';
        $data['controller'] = 'Admin';

        

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     

        $data['tariff'] = $this->payment->get_tariff_data(); 
           
     
       
        $data['table_view'] = $this->load->view('app/admin/change_tariff_details', $data, true);
            
  
        $data['body'] = $this->load->view('app/admin/admin_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }

      /*******************************************************************************
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function saveTariffData()
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
        $fields['user'] = Auth::username();
                   
        

        $data = $this->payment->save_tariff_data($fields);
        

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
     * Render view for change_gl_details
     *
     * @return view
    *******************************************************************************/
    
    public function changeGlData()
   
    {
     
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);          
       

       if(isset($subtitle)){
           $data['title']   = $subtitle;
        }

      

        $data['dir'] = 'app/admin';
        $data['route'] = 'admin';
        $data['controller'] = 'Admin';

        

        $data['angular'] = true;
        $data['datatables'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;
     

        $data['gl'] = $this->payment->get_gl_data(); 
       
           
     
       
        $data['table_view'] = $this->load->view('app/admin/change_gl_details', $data, true);
            
  
        $data['body'] = $this->load->view('app/admin/admin_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    }



    /*******************************************************************************
     * TODO
     *
     * @return response (json)
    *******************************************************************************/
    public function saveGlData()
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
        $fields['user'] = Auth::username();
                   
        

        $data = $this->payment->save_gl_data($fields);
        

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




    
  
    
}



