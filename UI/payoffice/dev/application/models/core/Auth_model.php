<?php
/**
* Class:  Auth Model for Services 
* Author: Eranga
* Date:   18/12/2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	protected $table_user_logs = "user_logs";

	public function is_session_exist($userid="")
	{
		$this->db->where('user_id', $userid);
		$this->db->where('status', 'A');

		$query = $this->db->get($this->table_user_logs);

        if($query->num_rows() > 0) {
        return true;
        } else {
        return false;
        }
	}

	public function get_session_token($user_id=0)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('status', 'A');

		$query = $this->db->get($this->table_user_logs);

		if($query->num_rows() > 0) {
        $session = $query->row();
        return $session->session_id;
        } else {
        return;
        }
	}

	public function reset_user_logs($user_id=0)
	{
		$now = new DateTime();
		$this->db->set('logged_out_on', $now->format('Y-m-d'));
		$this->db->set('logged_out_at', $now->format('H:i:s'));
		$this->db->set('reset_status', 'Y');
		$this->db->set('status', 'D');

		$this->db->where('status', 'A');	
		$this->db->where('user_id', $user_id);	
		$this->db->update($this->table_user_logs);
	}

	public function update_user_logs($state='')
	{
		if ($state==="in") {
		$data = array(
        'user_id' 		    => $_SESSION['username'],
        'logged_in_on' 		=> $_SESSION['logged_in_on'],
        'logged_in_at' 		=> $_SESSION['logged_in_at'],
        'reset_status' 		=> "N",
        'session_id' 		=> session_id(),
        'status' 		    => "A",
        'browseagent' 		=> $_SESSION['logged_in_browser'],
        'ip_address' 		=> $_SESSION['logged_in_ip'],
        'machine_name' 		=> $_SESSION['logged_in_machine'],
		);

		$this->db->insert($this->table_user_logs, $data);
		$this->session->set_userdata('sessionid', $this->db->insert_id()); 
		} else {
		if (isset($_SESSION['sessionid'])) {
		# update based on session id
		$now = new DateTime();
		$this->db->set('logged_out_on', $now->format('Y-m-d'));
		$this->db->set('logged_out_at', $now->format('H:i:s'));
		$this->db->set('status', 'D');

		$this->db->where('id', $_SESSION['sessionid']);	
		$this->db->update($this->table_user_logs);
		}
		}
	}
}