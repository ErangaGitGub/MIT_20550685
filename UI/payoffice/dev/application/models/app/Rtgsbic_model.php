<?php
/**
* Class:  Rtgsbic_model 
* Author: Eranga
* Date:   17/01/2023
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Rtgsbic_model extends CI_Model
{
	protected $table = 'rtgsbiccodes';	

	public function __construct() {
        parent::__construct();
    }

    public function insert_biccodes($data)
	{
	 	$this->db->truncate($this->table);

		$json  = json_encode($data);
		$array = json_decode($json, true);

		return $this->db->insert_batch($this->table, $array, true, 1000);
	}

	public function search_bic($bic="", $country="", $city="", $channel="")
	{
		// SELECT * FROM rtgsbiccodes WHERE SFIFTCODE LIKE 'BSAM%'
		// SEARCH WORD ONLY WITH FIRST PART
		$this->db->like('SFIFTCODE', $bic, 'after');
		
		// REMOVE OWN BANK BIC CODES FOR RTGS
		if ($channel=="RTGS") { $this->db->not_like('SFIFTCODE', "BCEY", 'after'); }
		
		$this->db->like('COUNTRYCODE', $country, 'after');
		
		$query = $this->db->like('CITYNAME', $city, 'after')->from('rtgsbiccodes use index (SFIFTCODE)')->get();

		return $query->result();
	}

	public function search_bic_for_request($bic="", $country="", $city="", $channel="")
	{
		// SELECT * FROM rtgsbiccodes WHERE SFIFTCODE LIKE 'BSAM%'
		// SEARCH WORD ONLY WITH FIRST PART
		$this->db->like('SFIFTCODE', $bic, 'after');
		
		// REMOVE OWN BANK BIC CODES FOR RTGS
		if ($channel=="RTGS") { $this->db->not_like('SFIFTCODE', "BCEY", 'after'); }

		// DROP BICCODES THAT ENDING WITH CHARACTER 1 FOR REQUEST CREATION   ('%1')
		$this->db->not_like('SFIFTCODE', "1", 'before');
		
		$this->db->like('COUNTRYCODE', $country, 'after');
		
		$query = $this->db->like('CITYNAME', $city, 'after')->from('rtgsbiccodes use index (SFIFTCODE)')->get();

		return $query->result();
	}

	public function is_biccode_valid($key="", $country="")
	{
		$this->db->where('SFIFTCODE',$key);

		if ($country=="LK") {
		$this->db->where('COUNTRYCODE',$country);
		}

	    $query = $this->db->get($this->table);
	    if ($query->num_rows() > 0){ return 1; }
	    else{ return 0; }
	}

	public function get_biccode_description($key="")
	{
		$this->db->where('SFIFTCODE',$key);
	    $query = $this->db->get($this->table);

	    $row = $query->row();

	    if (isset($row)) {
		return $row->BANKNAME."   ".$row->COUNTRYCODE."   ".$row->CITYNAME;
		} else {
		return;
		}
	}

	public function get_biccode_bankname($key="")
	{
		$this->db->where('SFIFTCODE',$key);
	    $query = $this->db->get($this->table);

	    $row = $query->row();

	    if (isset($row)) {
		return $row->BANKNAME;
		} else {
		return '';
		}
	}

	public function is_length_valid($bic, $account)
	{
		if ($this->config->item('app_ui_check_ac_length')) {

		$this->db->where('SFIFTCODE',$bic);
		$query = $this->db->get($this->table);

		$row = $query->row();

		if (isset($row)) { 
		if ( $row->ACCOUNTLEN==0 ) {
		return true;
		} else {
		if ( $row->ACCOUNTLEN == strlen($account) ) {
		return true;
		} else {
		return false;
		}
		}				
		} else{ 
		return true;
		}

		} else {
		return true;
		}
	}
}