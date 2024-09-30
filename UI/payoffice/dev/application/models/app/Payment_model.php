<?php
/**
* Class:  Payment_model 
* Author: Eranga
* Date:   17/01/2023
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/services/'.'Web_service_model.php');

class Payment_model extends Web_service_model
{
	public function __construct() {
        parent::__construct();
    }

    public function get_default_tcurrency($channel)
    {
        $defalut = "";

        if (isset($channel)) {          
            
        if ($channel=="SWFT") { 
        $defalut = $this->config->item('swft_default_tcurrency');
        } else if ($channel=="RTGS") {
        $defalut = $this->config->item('rtgs_default_tcurrency');
        } else {
        $defalut = "";
        }

        } 

        return $defalut;
    }

    public function get_default_icurrency($channel)
    {
        $defalut = "";

        if (isset($channel)) {          
            
        if ($channel=="SWFT") { 
        $defalut = $this->config->item('swft_default_icurrency');
        } else if ($channel=="RTGS") {
        $defalut = $this->config->item('rtgs_default_icurrency');
        } else {
        $defalut = "";
        }

        } 

        return $defalut;
    }

    public function get_icurrenceyList($channel, $basecur, $currencyList)
    {
        $curList = [];

        if (isset($channel)) {          
            
        if ($channel=="SWFT") { 
        $curList = $currencyList;
        } else if ($channel=="RTGS") {

        $LKROBJ;

        foreach ($currencyList as $currency) {
        if ($currency->NAME==$basecur) {
        array_push($curList, $currency);
        }

        if ($currency->NAME=="LKR") {
         $LKROBJ = $currency;
        } 
        }

        if ($basecur!="LKR") {
        array_push($curList, $LKROBJ);
        }
            
        } else {
        $curList = [];
        }

        } 

        return $curList;
    }

    public function get_tcurrenceyList($channel, $basecur, $currencyList)
    {
        $curList = [];

        if (isset($channel)) {          
            
        if ($channel=="SWFT") { 
        $curList = $currencyList;
        } else if ($channel=="RTGS") {
  
        foreach ($currencyList as $currency) {
        if ($currency->NAME==="LKR") {
        array_push($curList, $currency);
        break;
        }
        }

        } else {
        $curList = [];
        }
        
        } 
        return $curList;
    }

    public function get_message_types($channel="")
    {
        if ($channel==="RTGS") {
        $msgtypes = array (
          array('id' => '1',  'name' => 'MT103',     'subtext'  => 'FIN.103.STP',  'status' => 1),
          array('id' => '2',  'name' => 'MT202',     'subtext'  => 'FIN.202',      'status' => 1),
          array('id' => '3',  'name' => 'MT202/COV', 'subtext'  => 'FIN.202.COV',  'status' => 0),
        );
        } else {
        $msgtypes=[];
        }

        $available_msgtypes = [];
        if (isset($msgtypes) && is_array($msgtypes)) { 
        foreach ($msgtypes as $msgtype) {
        if ($msgtype['status']) {
        array_push(
        $available_msgtypes, 
        array(
        'id' => $msgtype['id'], 
        'name'  => strtoupper($msgtype['name']), 
        'subtext' => $msgtype['subtext']
        ));
        }}}

        return $available_msgtypes;
    }

    
}