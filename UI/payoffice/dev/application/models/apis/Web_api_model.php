<?php
/**
* Class:  Web API Model for Services 
* Author: Eranga
* Date:   18/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_api_model extends CI_Model
{
	/*******************************************************************************
     * Establish new connection with the application web service
     *
     * @return boolean
    *******************************************************************************/  
    public function connect_to_service($request, $data=[], $method="POST") 
    {
    	$web_service_host = trim($this->config->item('app_auth_WEB_host'));
    	$web_service_port = trim($this->config->item('app_auth_WEB_port'));
    	$web_service_key  = trim($this->config->item('app_auth_WEB_key'));

        $REQUEST_URL = $web_service_host.":".$web_service_port.$request;

        // print_r('<pre>');
        // print_r($REQUEST_URL);
        // print_r('</pre>');die;
       
        $curl = curl_init();

        if (empty($data)) {

            curl_setopt_array($curl, array(

            CURLOPT_PORT => $web_service_port,
            CURLOPT_URL => $REQUEST_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => "",            
            CURLOPT_HTTPHEADER => array(
                "apiKey: ".$web_service_key,
                "Content-Type: application/json" 
            ),

            ));
            
        } else {

            curl_setopt_array($curl, array(

            CURLOPT_PORT => $web_service_port,
            CURLOPT_URL => $REQUEST_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),            
            CURLOPT_HTTPHEADER => array(
                "apiKey: ".$web_service_key,
                "Content-Type: application/json" 
            ),

            ));
        }      

        $response = curl_exec($curl);

        if (!$response) {
        $response = 500;
        } 

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        $response = 500;
        }

       

        return $response;    
    }
}