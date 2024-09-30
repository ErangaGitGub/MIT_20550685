<?php
/**
* Class:  Activity_model
* Author: Eranga
* Date:   14/10/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/core/'.'Base_model.php');

class Activity_model extends Base_Model
{
	protected $table_activities = "activities";
	protected $table_audit_logs = "audit_logs";

	public function write_log($log=[])
	{
		$this->db->insert($this->table_audit_logs, $log);	
	}
}