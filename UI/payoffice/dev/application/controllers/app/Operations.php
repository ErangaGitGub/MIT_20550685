<?php
/**
* Class:  Transaction Controller 
* Author: Eranga
* Date:   12/05/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Operations extends Base {

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
    public function preCheckView()
    {
     
        if (true) {

          $subtitle = $this->input->get('subtitle', TRUE);          
             
          if(isset($subtitle)){         
             $data['title']    = $subtitle;
          }  
          
            $data['dir'] = 'app/operations';
            $data['route'] = 'operations';
            $data['controller'] = 'Operations';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];            
            $data['bootstrap_select'] = true;

           
            $tabs += ['PRE-CHECK' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/operations/prior_check_view', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }
    /*******************************************************************************
     * View Operations
     *
     * @return response (json)
    *******************************************************************************/
    // public function preCheckView()
    // {
    //     if (true) { 
    //     $data['dir'] = 'app/operations';
    //     $data['route'] = 'operations';
    //     $data['controller'] = 'Operations';
    //     $data['angular'] = true;  
    //     $data['title'] = 'Prior Check';
    //     $data['tabtitle1']   = 'PRE-CHECK';  
      
    //     $data['operation_view']   = $this->load->view('app/operations/prior_check_view', $data, true);
     
    //     $data['body'] = $this->load->view('app/operations/operation_view_container', $data, true);    

    //     $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  

    //     } else {
    //     $this->load_error_page($this->heading_permission_error, $this->message_permission_error, '403'); 
    //     }
    // }

    /*******************************************************************************
     * View Operations
     *
     * @return response (json)
    *******************************************************************************/
    public function dayBeginView()
    {
        if (true) {
          
            
            $data['dir'] = 'app/operations';
            $data['route'] = 'operations';
            $data['controller'] = 'Operations';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];            
            $data['bootstrap_select'] = true;
            $dataArray = array ('operationType' => 'Day Begin'); 
            $data['status'] = $this->payment-> eod_CheckRunStatus($dataArray); 
           
            $tabs += ['DAY-BEGIN' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/operations/day_begin_view', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }


    }

        /*******************************************************************************
     * View Operations
     *
     * @return response (json)
    *******************************************************************************/
    public function dayEndView()
    {
       if (true) {
           $subtitle = $this->input->get('subtitle', TRUE);          
             
          if(isset($subtitle)){         
             $data['title']    = $subtitle;
          }  
          
            
            $data['dir'] = 'app/operations';
            $data['route'] = 'operations';
            $data['controller'] = 'Operations';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];            
            $data['bootstrap_select'] = true;
            $dataArray = array ('operationType' => 'Day End'); 
          
            $data['status'] = $this->payment-> eod_CheckRunStatus($dataArray); 
            $data['prestatus'] = $this->payment-> eod_CheckPreCheckRunStatus(); 
           
            $tabs += ['DAY-END' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/operations/day_end_view', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }


    /*******************************************************************************
     * List all Data Center Operations
     *
     * @return response (json)
    *******************************************************************************/
    public function listOperations() 
    {    
     if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $branchCode = $this->session->userdata('user_branch');
        $subtitle = $this->input->get('subtitle', TRUE);
         
          $data['dir'] = 'app/operations';
          $data['route'] = 'operations';
          $data['controller'] = 'Operations';
          $data['angular'] = true;
          $data['event'] = 'create_user';
          $tabs = [];
          $data['datatables'] = true;
          $data['datepicker'] = false;
          $data['table_datepicker'] = true;
          $data['title'] = $subtitle;
 
          
          $data['list'] = $this->payment->eod_HistoricalOpr(); 
        // $data['list'] = $this->payment->get_currencyList(); 
   

        $data['table_view'] = $this->load->view('app/operations/operation_grid', $data, true); 
        $data['body'] = $this->load->view('app/operations/report_layout', $data, true);    

        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);        

        } else {
        $this->show_error('permission', '403');   
        }  
    } 

     /*******************************************************************************
     * List all Exceptions
     *
     * @return response (json)
    *******************************************************************************/

    public function listExceptions()
    {
        if (true) {
            
        $now = new DateTime();
        $dat = $this->convert_formatted_date_to_numeric($now->format('Y-m-d'));
        $data['current_date'] = $this->get_formatted_date($dat);
        $tillID = $this->session->userdata('user_till');
        $subtitle = $this->input->get('subtitle', TRUE);          
        

        $data['title'] = $subtitle;
        $data['dir'] = 'app/operations';
        $data['route'] = 'operations';
        $data['controller'] = 'Operations';
      

         $dataArray = array (  
           'tillID'          =>  $tillID           
         );

     //   $data['event'] = 'reserve-funds';
        $data['angular'] = true;
        $data['datatables'] = true;
        $data['dataexport'] = true;
        $data['datepicker'] = false;
        $data['table_datepicker'] = true;


        $data['list'] = $this->payment->get_transaction_exceptions($dataArray); 

     //   $data['confrm_modal'] = $this->load->view('app/payments/temp/modal_confrm', $data, true); 

       // print_r("gdsdgsdg");die();

        $data['table_view'] = $this->load->view('app/operations/exception_grid', $data, true); 
        $data['body'] = $this->load->view('app/operations/report_layout', $data, true);    

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
    public function reports()
    {
       
        if (true) {
          $subtitle = $this->input->get('subtitle', TRUE);          
             
          if(isset($subtitle)){         
             $data['title']    = $subtitle;
          }         
        
          
            
            $data['dir'] = 'app/operations';
            $data['route'] = 'operations';
            $data['controller'] = 'Operations';
            $data['angular'] = true;
            $data['event'] = 'create_user';
            $tabs = [];            
            $data['bootstrap_select'] = true;
           
           
            $tabs += ['REPORTS' => [ 'id'=> '1', 'status'=> 'active', 'content'=> $this->load->view('app/operations/report_view', $data, true) ]];
            

            $data['tabs'] = $tabs; 
            $data['body'] = $this->load->view('layouts/theme-'.$this->theme.'/layout_form', $data, true); 
            $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        } 
    }

        /*******************************************************************************
     * Render view for after_print_view
     *
     * @return view
    *******************************************************************************/
   public function generateDayEndReport()
    {
        if (true) {       
        $subtitle = $this->input->get('subtitle', TRUE);          
             
        if(isset($subtitle)){
         
          $data['title']    = $subtitle;
        }         
        

        // $ratesArray = array ('print_type' => 'after_auth');
        $data['list'] = $this->payment->get_daily_summary_data(); 
        $data['body'] = $this->load->view('app/operations/view_dayend_print', $data, true);
        
   
        $data['route'] = 'rates';
        $data['controller'] = 'Rates';
        $this->load->view('layouts/theme-'.$this->theme.'/layout_page', $data);  
        } else {
        $this->show_error('permission', '403');   
        }
    } 

    /*******************************************************************************
     * Start Pre check operation
     *
     * @return response (json)
    *******************************************************************************/

    public function generateReport()
    {    
     
        $user            = $this->session->userdata('username');
         

        $Array   = array('operationType' => 'REPORT','user' => $user ); 
      
        $checkStatus = $this->payment->eod_StartOperations($Array); 
       

        echo json_encode($checkStatus); 

    }  

    /*******************************************************************************
     * Start Pre check operation
     *
     * @return response (json)
    *******************************************************************************/

    public function startPreCheck()
    {    
     
        $user            = $this->session->userdata('username'); 
        $Array   = array('user' => $user ); 
      
        $checkStatus = $this->payment->eod_StartPreCheckOperations($Array); 
        echo json_encode($checkStatus); 

    } 

    /*******************************************************************************
     * Start Day Begin operation
     *
     * @return response (json)
    *******************************************************************************/

    public function startDayBegin()
    {    
        $user            = $this->session->userdata('user_id');        

        $Array   = array('operationType' => 'DAY-BEGIN','user' => $user ); 

        $checkStatus = $this->payment->eod_StartOperations($Array); 

        echo json_encode($checkStatus); 

    } 

    /*******************************************************************************
     * Start Day End operation
     *
     * @return response (json)
    *******************************************************************************/

    public function startDayEnd()
    {    
        $user            = $this->session->userdata('username'); 
    
        $Array   = array('operationType' => 'DAY-END','user' => $user ); 
      
        $checkStatus = $this->payment->eod_StartDayEndOperations($Array); 

        echo json_encode($checkStatus); 

    } 



    
}



