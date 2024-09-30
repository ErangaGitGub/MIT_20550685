<?php
/**
* Class:  Ldap API Model for Services 
* Author: Eranga
* Date:   18/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Ldap_api_model extends CI_Model
{
	/*******************************************************************************
     * Establish new connection with the LDAP Server
     *
     * @return boolean
    *******************************************************************************/    
    public function connect_to_ldap($credintials=[])
    {
        if ( (array_key_exists('username', $credintials) && !empty($credintials['username'])) &&
             (array_key_exists('password', $credintials) && !empty($credintials['password'])) 
        ) {            

    	$ldap_host = trim($this->config->item('app_auth_LDAP_host'));
    	$ldap_port = trim($this->config->item('app_auth_LDAP_port'));
    	$ldap_key  = trim($this->config->item('app_auth_LDAP_key'));

        $ldap = ldap_connect($ldap_host, $ldap_port) or die("LDAP Service Cannot be Found..!");  

        if (isset($ldap)) {

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $ldapBind = @ldap_bind($ldap, $ldap_key.$credintials['username'], $credintials['password']);
        @ldap_close($ldap);

        if ($ldapBind) {
            return true;
        } else {
            return false;
        }

        } else {
            return false;
        }

        } else {        	    
            return false;
        }
    }

}