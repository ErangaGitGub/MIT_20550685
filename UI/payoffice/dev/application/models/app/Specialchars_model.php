<?php
/**
* Class:  Specialchars_model
* Author: Eranga
* Date:   14/10/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/core/'.'Base_model.php');

class Specialchars_model extends Base_Model
{

    //add only the relavant fields with invalid chars here
    protected $invalid_chars   = array (

        /* Allowed Chars
        a b c d e f g h i j k l m n o p q r s t u v w x y z
        A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
        0 1 2 3 4 5 6 7 8 9
        / – ? : ( ) . , ‘ + CrLf Space
        */

        /*
        back slash => \\\\
        space => \s
        */

        /* 
        original x char list       = '/[\"\'\[\]\\\\\`^£$%&*()}{!@#~?><>,|=_+¬-]/'  
        */  

        /* 
        originaly used x char list =  '/[\"\[\]\\\\\`^£$%&*}{!@#~><>;|=_¬]/'   
        */

        /* 
        original x char list for check special chars =  '/[\"\'\[\]\\\\\`\s^£$%&*()}{!@#~?><>,|=_+¬-]/' 
        */

        /*
        user requests
            REMOVE: -, (), :, comma  DATE: 26/02/2020   
        */

        //CHECK FOR ALL SPECIAL CHARS
        // CUSTOMER REQUEST 

        'brefnumber'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/', 
        'uinnumber'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/', 
        'fname'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/', 
        'custaddr1'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/', 
        'passportno'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/', 








         
        'benaccount'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',

        'benename'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',  

        'beneaddr1'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',  
        'beneaddr2'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',  
        'beneaddr3'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',  
        'beneaddr4'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',  

        // MT103 RTGS
        'f50f_name1'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_name2'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_name3'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_addr1'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_addr2'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_city'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f50f_country'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_bckacc'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_name1'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_name2'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_name3'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_addr1'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_addr2'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_city'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f59f_country'     => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f70_info1'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f70_info2'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f70_info3'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f70_info4'        => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f53a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f53a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f54a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f54a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f56a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f56a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f57a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f57a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',

        // MT202 RTGS
        'f21_reference'    => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52d_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52d_name1'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52d_name2'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52d_name3'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f52d_name4'       => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f58a_acc'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f58a_bic'         => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L1_code'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L1_narrative' => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L2_code'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L2_narrative' => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L3_code'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L3_narrative' => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L4_code'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L4_narrative' => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L5_code'      => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
        'f72_L5_narrative' => '/[\"\'\[\]\\\\\`^£$%&*}{!@#~?><>|=_+¬]|http:|https:(https?:\/\/)|(\/){2,}/',
      
    );

    public function has_invalid_chars($field_name, $field_value)
    {   
        if ($this->config->item('rtgs_check_invalid_chars')) {
            if (array_key_exists($field_name, $this->invalid_chars)) {

            $chars = $this->invalid_chars[$field_name];

            if ( preg_match($chars, $field_value) )
            {  // one or more of the 'special characters' found in $string
                return true;
            } else {
                return false;
            }

            return $this->system_messages[$status_code];
            
            } else {
            
            return false;
            
            }
        } else {
            return false;
        }       
    }  

    public function has_insufficient_balance($accountbalance, $lkrtotal)
    {   
       
        if ((float)$accountbalance < (float)$lkrtotal ) {   
            return true;
        } else {            
            return false;
        }       
    }

    public function is_not_a_number($number)
    {   
        if (is_nan($number)) {   
            return true;
        } else {            
            return false;
        }       
    }

       
}
